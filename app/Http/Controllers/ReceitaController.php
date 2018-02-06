<?php

namespace App\Http\Controllers;
use App\Cnpj;
use App\Transformers\CnpjTransform;
use Illuminate\Http\Request;
use Mockery\Exception;
use Illuminate\Database\Eloquent\toJson;

class ReceitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($cnpjNumero, $content)
    {
        //
        Cnpj::create([
            'cnpj' => $cnpjNumero,
            'retorno_api' => $content,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cnpj = Cnpj::where('cnpj', '=', $id)->first();

        if(empty($cnpj)) {

            $dadosCnpj = Cnpj::buscaCnpjNoReceitaWs($id);
            $cnpjNumero = Cnpj::cnpjSemCaracteres($dadosCnpj['cnpj']);
            $content = collect($dadosCnpj)->toJson();

            $this->store($cnpjNumero, $content);
            $cnpj = new CnpjTransform($dadosCnpj);

            return json_decode($cnpj,true);
        }else{

            $dadosCnpj = Cnpj::buscaCnpjNoReceitaWs($id);
            $content = collect($dadosCnpj)->toJson();
            $this->update($id, $content);

            $cnpj = new CnpjTransform($dadosCnpj);

            return json_decode($cnpj,true);
//            $cnpjNumero = preg_replace( '/[^0-9]/', '', $content['cnpj'] );
//            $dadosCnpj = collect($dadosCnpj)->toJson();
//            $retorno = $dadosCnpj['nome'] . " - " . $dadosCnpj['uf'];
//            return $retorno;
        }
//        return $content['atividade_principal'][0]['text'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $content)
    {
        //
        $cnpj = Cnpj::where('cnpj', '=', $id)->first();
        $cnpj->retorno_api = $content;
        $cnpj->updated_at = time();
        $cnpj->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
