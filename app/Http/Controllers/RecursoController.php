<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $valor= Recurso::all();
        return view("pages.recurso",compact("valor"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $valor=null;
        if(isset($request->id)){
            $valor= Recurso::find($request->id);
        }else{
            $valor= new Recurso();
        }
        $valor->nome_recurso=$request->nome_recurso;
        $valor->tipo_recurso=$request->tipo_recurso;
        $valor->descricao=$request->descricao;
        $valor->localizacao=$request->localizacao;
        $valor->status=$request->status;
        $valor->save();
        return redirect()->back()->with("Sucesso","RECURSO CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $valor=Recurso::find($id);
        return view("pages.recurso",compact("valor"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Recurso::find($id)->delete;
        return redirect()->back()->with("SUCESSO","RECURSO ELIMINADO");
    }
}
