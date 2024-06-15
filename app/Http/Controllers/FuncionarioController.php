<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $valor= Funcionario::all();
        return view("pages.Funcionario",compact("valor"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $valor=null;
        if(isset($request->id)){
            $valor= Funcionario::find($request->id);
        }else{
            $valor= new Funcionario();
            $valor->nome=$request->nome;
            $valor->sobrenome=$request->sobrenome;
            $valor->cargo=$request->cargo;
            $valor->departamento=$request->departamento;
            $valor->telefone=$request->telefone;
            $valor->email=$request->email;
            $valor->data_contratacao=$request->data_contratacao;
            $valor->user_id=$request->user_id ?? $valor->user_id;
            return redirect()->back()->with("SUCESSO","FUNCIONARIO CADASTRADO");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $valor=Funcionario::find($id);
        return view("pages.Funcionario",compact("valor"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Funcionario::find($id)->delete;
        return redirect()->back()->with("SUCESSO","FUNCIONARIO ELIMINADO");
    }
}
