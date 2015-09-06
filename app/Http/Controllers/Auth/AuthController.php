<?php

namespace GPUG\Http\Controllers\Auth;

use GPUG\User;
use Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;
use SocialNorm\Meetup\MeetupProvider;
use GPUG\Http\Controllers\Controller;
use SocialNorm\Request as SocialNormRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use SocialNorm\Exceptions\ApplicationRejectedException;
use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function redirectToProvider(Request $request)
    {
        $this->registerSocialNormMeetupProvider($request);

        return \OAuth::authorize('meetup');
    }

    public function handleProviderCallback(Request $request)
    {
        $this->registerSocialNormMeetupProvider($request);

        try {
            \OAuth::login('meetup');
        } catch (ApplicationRejectedException $e) {
            // User rejected application
        } catch (InvalidAuthorizationCodeException $e) {
            // Authorization was attempted with invalid
            // code,likely forgery attempt
        }

        return Redirect::intended();
    }

    protected function registerSocialNormMeetupProvider($request)
    {
        \OAuth::registerProvider(
            'meetup',
            new MeetupProvider(
                config('eloquent-oauth.providers')['meetup'],
                new HttpClient(),
                new SocialNormRequest($request->all())
            )
        );
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
