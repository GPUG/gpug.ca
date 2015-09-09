<?php

namespace GPUG\Http\Controllers\Auth;

use OAuth;
use GPUG\Http\Controllers\Controller;
use SocialNorm\Exceptions\ApplicationRejectedException;
use SocialNorm\Exceptions\InvalidAuthorizationCodeException;


class AuthController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogout()
    {
        auth()->logout();

        return redirect('/');
    }

    public function redirectToProvider()
    {
        return OAuth::authorize('meetup');
    }

    public function handleProviderCallback()
    {
        try {
            OAuth::login('meetup', function ($user, $details) {
                $user->name = $details->full_name;
                $user->email = $details->email;
                $user->avatar = $details->avatar;
                $user->save();
            });
        } catch (ApplicationRejectedException $e) {
            // User rejected application
            return redirect('/');
        } catch (InvalidAuthorizationCodeException $e) {
            // Authorization was attempted with invalid
            // code,likely forgery attempt
            return redirect('https://www.youtube.com/watch_popup?v=dQw4w9WgXcQ');
        }

        return redirect()->intended();
    }
}
