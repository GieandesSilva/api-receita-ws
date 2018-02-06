<?php

namespace App;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Database\Eloquent\Model;

class Cnpj extends Model
{
    //
    protected $fillable = [
        'cnpj', 'retorno_api',
    ];

    public static function buscaCnpjNoReceitaWs($id) {

        $client = new GuzzleClient();
        $response = $client->request('GET', 'https://www.receitaws.com.br/v1/cnpj/' . $id);
        $dadosCnpj = json_decode($response->getBody(), true);
        return $dadosCnpj;
    }

    public static function cnpjSemCaracteres($cnpj) {

        return preg_replace( '/[^0-9]/', '', $cnpj );
    }
}
