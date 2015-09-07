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
            OAuth::login('meetup');
        } catch (ApplicationRejectedException $e) {
            // User rejected application
        } catch (InvalidAuthorizationCodeException $e) {
            // Authorization was attempted with invalid
            // code,likely forgery attempt
        }

        return redirect()->intended();
    }
}
