<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Matricula= Matricula::all();
        return view("pages.Matricula",compact("Matricula"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $Matricula=null;
        if(isset($request->id)){
            $Matricula= Matricula::find($request->id);
        }else{
            $Matricula= new Matricula();
        }
        $Matricula->data_matricula=date('Y-m-d');
        $Matricula->ano_lectivo=$request->ano_lectivo;
        $Matricula->estudante_Id=$request->estudante_Id;
        $Matricula->turma_Id=$request->turma_Id;
        $Matricula->funcionario_Id=$request->funcionario_Id;
        $Matricula->save();
        return redirect()->back()->with("Sucesso","Matricula CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $Matricula=Matricula::find($id);
        return view("pages.Matricula",compact("Matricula"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Matricula::find($id)->delete();
        return redirect()->back()->with("Sucesso","Matricula ELIMINADO");
    }
}
