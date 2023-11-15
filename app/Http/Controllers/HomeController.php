<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiConvertidorController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = ApiConvertidorController::getCurrencies();

        return view('home', compact('data'));
    }





    public  function convert_currencies(Request $request)
    {
        $apiConverter = new ApiConvertidorController();
        $precios = ApiConvertidorController::getRatesBaseUSD();


        $importe = $request->importe;
        $moneda_base = $request->moneda_base;
        $moneda_destino = $request->moneda_destino;

        // $result = [];
        if (array_key_exists($moneda_base, $precios)) {
            // Existe la moneda base
            if ($moneda_base == 'USD') {
                $precio = $precios[$moneda_destino];
                $conversion = $precio * $importe;

                $precio_base = $precios[$moneda_base];
                $precio_destino = $precios[$moneda_destino];

                $result = [
                    'error' => 0,
                    'importe' => $importe,
                    'moneda_base' => $moneda_base,
                    'moneda_destino' => $moneda_destino,
                    'conversion' => $conversion,
                    'precio' => $precio,
                    'precio_base' => $precio_base,
                    'precio_destino' => $precio_destino,


                ];
            } else {
                $precio_base = $precios[$moneda_base];
                $precio_destino = $precios[$moneda_destino];
                $conversion = ($precio_destino / $precio_base) * $importe;
                $result = [
                    'error' => 0,
                    'importe' => $importe,
                    'moneda_base' => $moneda_base,
                    'moneda_destino' => $moneda_destino,
                    'conversion' => $conversion,
                    'precio_base' => $precio_base,
                    'precio_destino' => $precio_destino,
                ];
                // return $result;
            }
        } else {
            // No existe la moneda base
            $result = [
                'error' => 1,
                'message' => 'No existe la moneda base',
            ];
        }

        // $apiKey = env('API_CONVERTIDOR_KEY');

        // $data = $this->list_currencies();
        // $url = self::$base_api_url . 'convert?access_key=' . $apiKey . '&from=' . $request->moneda_base . '&to=' . $request->moneda_destino . '&amount=' . $request->importe;

        // $client = new Client();
        // $response = $client->request('GET', $url);
        // $result = json_decode($response->getBody(), true);
        // return $result;

        $data = ApiConvertidorController::getCurrencies();

        return view('home', compact('data', 'result'));
    }
}
