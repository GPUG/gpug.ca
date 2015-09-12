<?php

namespace GPUG\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GPUG\Http\Requests;
use GPUG\Http\Controllers\Controller;

class SlackController extends Controller
{
    public function invite(Request $request)
    {
        $client = new Client(['http_errors' => false]);
        $client->post(
            'http://localhost:8080',
            ['form_params' => ['email' => $request->input('email')]]
        );

        return redirect('/slack-invited');
    }

    public function invited()
    {
        return view('slack.invited');
    }
}
