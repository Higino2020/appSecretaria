<?php

namespace App\Http\Controllers;

use App\Models\Projecto;
use Illuminate\Http\Request;

class ProjectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $valor= Projecto::all();
        return view("pages.projecto",compact("valor"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $valor=null;
        if(isset($request->id)){
            $valor= Projecto::find($request->id);
        }else{
            $valor= new Projecto();
        }
        $valor->nome_projeto=$request->nome_projeto;
        $valor->descricao=$request->descricao;
        $valor->data_inicio=$request->data_inicio;
        $valor->data_termino=$request->data_termino;
        $valor->status=$request->status;
        $valor->responsavel=$request->responsavel ?? $valor->responsavel;
        return redirect()->back()->with("Sucesso","PROJECTO CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $valor=Projecto::find($id);
        return view("pages.projecto",compact("valor"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Projecto::find($id)->delete;
        return redirect()->back()->with("SUCESSO","PROJECTO ELIMINADO");
    }
}
