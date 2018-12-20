<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Counter;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class RecognizeController extends Controller
{
	private const URL_RECOGNIZE = "https://gateway.watsonplatform.net/natural-language-understanding/api/v1/analyze?version=2018-11-16";
	private const URL_TRANSLATE = "https://gateway.watsonplatform.net/language-translator/api/v3/translate?version=2018-05-01";
    public function recognizeView()
    {

        $counter = Counter::where('user_id', Auth::user()->id)->where('place', 'recognize')->first();
        if (is_null($counter)) {
            $counter = Counter::create([
                'user_id' => Auth::user()->id,
                'place' => 'recognize'
            ]);
        }
        $counter->quantity++;
        $counter->save();
        return view('translate_recognize')->with([
                'count' => $counter->quantity
            ]);
    }
    private function translate($value)
    {
    	$client = new Client();
    	$response = $client->post(self::URL_TRANSLATE,
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
            ]);
    	return json_decode($response->getBody()->getContents())->translations[0]->translation;
    }
    public function recognize()
    {
    	$translated = $this->translate(request()->get('text'));
    	$client = new Client();
    	$response = $client->post(self::URL_RECOGNIZE,
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
					"return_analyzed_text"=>true
				]
            ]);
    	$recognized= json_decode($response->getBody()->getContents());
		return response()->json($recognized);
    }
}
