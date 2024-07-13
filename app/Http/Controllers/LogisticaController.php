<?php

namespace App\Http\Controllers;

use App\Models\Logistica;
use Illuminate\Http\Request;

class LogisticaController extends Controller
{
    public function index()
    {
        //
        $valor= Logistica::all();
        return view("pages.logistica",compact("valor"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $valor=null;
        if(isset($request->id)){
            $valor= Logistica::find($request->id);
        }else{
            $valor= new Logistica();
        }
        $valor->nome_evento=$request->nome_evento;
        $valor->data_evento=$request->data_evento;
        $valor->local=$request->local;
        $valor->descricao=$request->descricao;
        $valor->responsavel=$request->responsavel ?? $valor->responsavel;
        $valor->save();

        return redirect()->back()->with("Sucesso","LOGISTICA CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $valor=Logistica::find($id);
        return view("pages.logistica",compact("valor"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Logistica::find($id)->delete();
        return redirect()->back()->with("SUCESSO","LOGISTICA ELIMINADO");
    }
}
