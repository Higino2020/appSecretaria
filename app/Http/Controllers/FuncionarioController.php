<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $valor=Funcionario::orderBy('nome','asc')->get();
        return view("pages.funcionario",compact("valor"));
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
            $user  = User::cadastrar($request);
            $valor->user_id=$user->id;
        }
        $valor->nome=$request->nome;
        $valor->sobrenome=$request->sobrenome;
        $valor->cargo=$request->cargo;
        $valor->departamento=$request->departamento;
        $valor->telefone=$request->telefone;
        $valor->email=$request->email;
        $valor->data_contratacao=$request->data_contratacao;
        $valor->save();
        return redirect()->back()->with("Sucesso","FUNCIONARIO CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        Funcionario::find($id)->delete;
        return redirect()->back()->with("Sucesso","FUNCIONARIO ELIMINADO");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Funcionario::find($id)->delete();
        return redirect()->back()->with("Sucesso","FUNCIONARIO ELIMINADO");
    }
}
