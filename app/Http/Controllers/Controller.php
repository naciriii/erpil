<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    //
    protected $client;
    protected $api_url;
    protected $token;

    public function __construct(Client $client,Request $request)
    {
    	$this->validate($request, [
    		'api_url' => 'required']);
    	$this->client = $client;
    	$this->api_url = rtrim($request->api_url,'/');
    	$this->token = $request->has('token') ?? '';

    }

    protected function send($method,$url,$headers = null)
    {
    
    	$headers = $headers??['headers' => 
    	[
    		'Accept' => 'application/json',
    		'Authorization' =>  $this->token
    	]
		];
		try {
        $response = $this->client->request($method, $this->api_url.'/'.$url, $headers);
        $data = json_decode($response->getBody()->getContents());
    	}catch(GuzzleException $e) {
    	$data = ['status' => 'Unauthorized'];


    }


        return $data;

    }

    protected function getAuthToken($login,$pass)
    {

    $url = $this->api_url.'/'.config('api.auth_url');
  
    	try {
    	$response = $this->client->request('POST', $url, [
    		 'headers' => [
    		 	"Content-Type"=>"application/json"
    ],
    'json' => [
        'username' => $login,
        'password' => $pass
    ]
	]);
    	$data = json_decode($response->getBody()->getContents());
    } catch(GuzzleException $e) {
    	$data = ['status' => 'Unauthorized'];
    }

        return $data;
}

}
