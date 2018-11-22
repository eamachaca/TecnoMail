<?php
use WatsonSDK\Common\WatsonCredential;
use WatsonSDK\Common\SimpleTokenProvider;
use WatsonSDK\Services\NaturalLanguageUnderstanding;
use WatsonSDK\Services\NaturalLanguageUnderstanding\AnalyzeModel;
use Faker\Generator as Faker;
$factory->define(\App\Mail::class, function (Faker $faker) {
    $user = \App\User::all()->random();
    $realText=$faker->realText();
	$nlu = new NaturalLanguageUnderstanding( WatsonCredential::initWithCredentials('initWithCredentials','*#DeIt0*#') );
	$model = new AnalyzeModel($realText,[]);
	$result = $nlu->analyze($model);
	dd($result->getContent());
    return [
        'subject' => substr($faker->slug, 0, 50),
        'body' => '<h1> hola ' . $realText . '</h1>',
        'sended' => $faker->boolean(),
        'readed' => $faker->boolean(70),
        'user_id' => $user->id,
        'e_mail_id' => \App\EMail::all()->random()->id,

    ];
});
