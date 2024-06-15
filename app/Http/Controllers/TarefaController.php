<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $valor= Tarefa::all();
        return view("pages.Tarefa",compact("valor"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $valor=null;
        if(isset($request->id)){
            $valor= Tarefa::find($request->id);
        }else{
            $valor= new Tarefa();
            $valor->nome_tarefa=$request->nome_tarefa;
            $valor->descricao=$request->descricao;
            $valor->data_limite=$request->data_limite;
            $valor->status=$request->status;
            $valor->prioridade=$request->prioridade;
            $valor->responsavel=$request->responsavel ?? $valor->responsavel;
            $valor->projeto_id=$request->projeto_id ?? $valor->projeto_id;
            return redirect()->back()->with("SUCESSO","TAREFA CADASTRADO");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $valor=Tarefa::find($id);
        return view("pages.Tarefa",compact("valor"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Tarefa::find($id)->delete;
        return redirect()->back()->with("SUCESSO","TAREFA ELIMINADO");
    }
}
