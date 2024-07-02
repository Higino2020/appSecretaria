<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $valor= Visitante::all();
        return view("pages.visitante",compact("valor"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $valor=null;
        if(isset($request->id)){
            $valor= Visitante::find($request->id);
        }else{
            $valor= new Visitante();
        }
        $valor->nome=$request->nome;
        $valor->empresa_organizacao=$request->empresa_organizacao;
        $valor->data_visita=$request->data_visita;
        $valor->hora_entrada=$request->hora_entrada;
        $valor->hora_saida=$request->hora_saida;
        $valor->proposito_visita=$request->proposito_visita;
        $valor->responsavel=$request->responsavel ?? $valor->responsavel;
        $valor->save();
        return redirect()->back()->with("Sucesso","VISITANTE CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $valor=Visitante::find($id);
        return view("pages.visitante",compact("valor"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Visitante::find($id)->delete;
        return redirect()->back()->with("Sucesso","VISITANTE ELIMINADO");
    }
}
