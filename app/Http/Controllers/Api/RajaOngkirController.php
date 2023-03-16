<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;


class RajaOngkirController extends Controller
{
    public static function provinces() {
        $response = Http::get("https://api.rajaongkir.com/starter/province?key=" . env("RAJA_ONGKIR_KEY"));
        return $response['rajaongkir']['results'];
    }

    public static function cities($province_id) {
        $response = Http::get("https://api.rajaongkir.com/starter/city?key=". env("RAJA_ONGKIR_KEY") ."&province=$province_id");
        return $response['rajaongkir']['results'];
    }

    public static function ongkir($city_destination, $weight) {
        $city_id = 399; // kota semarang
        $courier = "jne"; // jne, tiki, pos
        $response = Http::post("https://api.rajaongkir.com/starter/cost", [
            "key" => env("RAJA_ONGKIR_KEY"),
            "origin" => $city_id,
            "destination" => $city_destination,
            "weight" => $weight,
            "courier" => $courier
        ]);

        return $response['rajaongkir']['results'][0]['costs'];
    }
}
