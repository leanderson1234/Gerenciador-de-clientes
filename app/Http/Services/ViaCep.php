<?php

namespace App\Http\Services;

use GuzzleHttp\Client as GuzzleClient;


class ViaCep
{
    public function getAdresses($ceps)
    {
        $client = new GuzzleClient();
        foreach ($ceps['cep']  as $key => $c) {
            $uri[] = "viacep.com.br/ws/$c/json/";
            $response[] = $client->get( $uri[$key]);
            $adress[] =json_decode($response[$key]->getBody()) ;
        }
        return $adress;
    }
}
