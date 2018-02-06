<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\toJson;

class CnpjTransform extends Model
{
    //
    protected $cnpj;

    public function __construct($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function toArray() {
        return [
            'nome' => $this->cnpj['nome'],
            'uf' => $this->cnpj['uf'],
            'telefone' => $this->cnpj['telefone'],
            'situacao' => $this->cnpj['situacao'],
            'bairro' => $this->cnpj['bairro'],
            'logradouro' => $this->cnpj['logradouro'],
            'numero' => $this->cnpj['numero'],
            'cep' => $this->cnpj['cep'],
            'municipio' => $this->cnpj['municipio'],
            'abertura' => $this->cnpj['abertura'],
            'fantasia' => $this->cnpj['fantasia'],
            'cnpj' => $this->cnpj['cnpj'],
            'ultima_atualizacao' => $this->cnpj['ultima_atualizacao'],
            'complemento' => $this->cnpj['complemento'],
            'email' => $this->cnpj['email']
        ];
    }

    public function  __toString() {
        return $this->toJson();
    }
}
