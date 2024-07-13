<?php

namespace App\Http\Controllers;

use App\Models\Financeiro;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $valor= Financeiro::all();
        return view("pages.financeiro",compact("valor"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $valor=null;
        if(isset($request->id)){
            $valor= Financeiro::find($request->id);
        }else{
            $valor= new Financeiro();
        }
        $valor->tipo_transacao=$request->tipo_transacao;
        $valor->data=$request->data;
        $valor->valor=$request->valor;
        $valor->descricao=$request->descricao;
        $valor->categoria=$request->categoria;
        $valor->responsavel=$request->responsavel ?? $valor->responsavel;
        $valor->save();
        return redirect()->back()->with("Sucesso","FINANCEIRO CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $valor= Financeiro::find($id);
        return view("pages.financeiro",compact("valor"));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Financeiro::find($id)->delete();
        return redirect()->back()->with("SUCESSO","FINANCEIRO ELIMINADO");

    }
}
