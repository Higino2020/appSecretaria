<?php

namespace App\Http\Controllers;

use App\Models\Correspondecia;
use Illuminate\Http\Request;

class CorrespondeciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $valor= Correspondecia::all();
        return view("pages.Correspondencia",compact("valor"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $valor=null;
        if(isset($request->id)){
            $valor= Correspondecia::find($request->id);
        }else{
            $valor= new Correspondecia();
            $valor->tipo=$request->tipo;
            $valor->data=$request->data;
            $valor->remetente=$request->remetente;
            $valor->destinatario=$request->destinatario;
            $valor->assunto=$request->assunto;
            $valor->descricao=$request->descricao;
            return redirect()->back()->with("SUCESSO","CORRESPONDENCIA CADASTRADO");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $valor=Correspondecia::find($id);
        return view("pages.Correspondencia",compact("valor"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Correspondecia::find($id)->delete;
        return redirect()->back()->with("SUCESSO","CORRESPONDENCIA ELIMINADO");
    }
}
