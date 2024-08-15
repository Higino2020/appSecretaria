<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $classe= Classe::all();
        return view("pages.classe",compact("classe"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $classe=null;
        if(isset($request->id)){
            $classe= Classe::find($request->id);
        }else{
            $classe= new Classe();
        }
        $classe->nome_classe=$request->nome_classe;
        $classe->funcionario_id= Auth::user()->funcionario->id ?? null;
        $classe->save();
        return redirect()->back()->with("Sucesso","CLASSE CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $classe=Classe::find($id);
        return view("pages.classe",compact("classe"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Classe::find($id)->delete();
        return redirect()->back()->with("Sucesso","CLASSE ELIMINADO");
    }
}
