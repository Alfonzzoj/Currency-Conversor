<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\HomeController;

class ApiConvertidorController extends Controller
{
    public static  $base_api_url = 'http://api.currencylayer.com/';

    public static function getRatesBaseUSD()
    {
        $jsonString = file_get_contents(public_path('rates.json'));
        $data = json_decode($jsonString, true); // Decodificar el JSON como un array asociativo

        return $data;
    }
    public static function getCurrencies()
    {
        $jsonString = file_get_contents(public_path('currencies.json'));
        $data = json_decode($jsonString, true); // Decodificar el JSON como un array asociativo

        return $data;
    }




    public function verify()
    {
        // $apiKey = env('API_CONVERTIDOR_KEY');
        // $url = $this->base_api_url . 'live?access_key=' . $apiKey;
        // $client = new Client();
        // $response = $client->request('GET', $url);
        // $data = json_decode($response->getBody(), true);
        $data = $this->getRatesBaseUSD();
        return $data;
    }
    public function pricesBaseUsd()
    {
        $data = $this->getRatesBaseUSD();
        return $data;
    }

    public  function list_currencies()
    {
        // $apiKey = env('API_CONVERTIDOR_KEY');
        // $url = self::$base_api_url . 'list?access_key=' . $apiKey;
        // $client = new Client();
        // $response = $client->request('GET', $url);
        // $data = json_decode($response->getBody(), true);
        $data = $this->getCurrencies();
        return $data;
    }
}
