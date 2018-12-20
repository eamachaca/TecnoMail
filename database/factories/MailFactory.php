<?php

use Faker\Generator as Faker;
use GuzzleHttp\Client;

$factory->define(\App\Mail::class, function (Faker $faker) {
    $user = \App\User::all()->random();
    $value=$faker->realText(100);
    $client = new Client();
    $response = $client->post("https://gateway.watsonplatform.net/language-translator/api/v3/translate?version=2018-05-01",
    	[
    		'auth' => [
    			'apikey', 'DRM1JY1BFHK6Tmntp6Dr2dwI0trmJ8XUAW9QM_Z9VbVg'
    		],
    		'headers' =>[
	    		'Accept'=>'application/json',
	    		'Content-Type'=>'application/json'
    		],
    		'json' => [
    			'text'=>$value,
    			'source'=>'es',
    			'target'=>'en'
    		]
        ]
    );
    $translated=json_decode($response->getBody()->getContents())->translations[0]->translation;
    $client = new Client();
    $response = $client->post("https://gateway.watsonplatform.net/natural-language-understanding/api/v1/analyze?version=2018-11-16",
		[
			'auth' => [
				'apikey', 'yLCIg0cPixb4Rpx30XetuW8Kja99YuxJ4jq8RZXhgvpb'
			],
			'headers' =>[
				'Accept'=>'application/json',
				'Content-Type'=>'application/json'
			],
			'json' => [
				'text'=>$translated,
				"features"=> [
					"sentiment"=> new \stdClass(),
					"emotion" => new \stdClass(),
				],
			]
		]);
    $recognized= $response->getBody()->getContents();
    return [
        'subject' => substr($faker->slug, 0, 50),
        'body' => $value,
        'translated'=>$translated,
        'recognized'=>$recognized,
        'sended' => $faker->boolean(),
        'readed' => $faker->boolean(70),
        'user_id' => $user->id,
        'e_mail_id' => \App\EMail::all()->random()->id,

    ];
});
