<?php

return [
	'table' => 'oauth_identities',
	'providers' => [
		'meetup' => [
			'client_id' => env('MEETUP_KEY'),
			'client_secret' => env('MEETUP_SECRET'),
			'redirect_uri' => env('MEETUP_REDIRECT'),
			'scope' => [],
		],
	],
];
