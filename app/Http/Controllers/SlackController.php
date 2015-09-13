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
        $channels = ['lobby' => 'C0A0C4EBA', 'random' => 'C0A0CGSPK'];
        $formData = [
            ['name' => 'email', 'contents' => $request->input('email')],
            ['name' => 'channels', 'contents' => implode(',', $channels)],
            ['name' => 'token', 'contents' => env('SLACK_KEY')],
            ['name' => 'set_active', 'contents' => 'true']
        ];

        $client = new Client(['http_errors' => false]);
        $client->post(
            'https://gpug.slack.com/api/users.admin.invite',
            ['multipart' => $formData]
        );

        return redirect('/slack-invited');
    }

    public function invited()
    {
        return view('slack.invited');
    }
}
