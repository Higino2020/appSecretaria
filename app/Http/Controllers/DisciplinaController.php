<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisciplinaController extends Controller
{
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            //
            $valor=Disciplina::orderBy('nome_disciplina','asc')->get();
            return view("pages.Disciplina",compact("valor"));
        }
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            //
            $valor=null;
            if(isset($request->id)){
                $valor= Disciplina::find($request->id);
            }else{

                $valor= new Disciplina();
            }
            $valor->nome_disciplina=$request->nome_disciplina;
            $valor->professor=$request->professor;
            $valor->funcionario_id= Auth::user()->funcionario->id ?? null;
            $valor->save();
            return redirect()->back()->with("Sucesso","Disciplina CADASTRADO");
        }

        /**
         * Display the specified resource.
         */
        public function show( $id)
        {
            //
            Disciplina::find($id)->delete;
            return redirect()->back()->with("Sucesso","Disciplina ELIMINADO");
        }

        /**
         * Remove the specified resource from storage.
         */
        public function apagar( $id)
        {
            //
            Disciplina::find($id)->delete();
            return redirect()->back()->with("Sucesso","Disciplina ELIMINADO");
        }
    }

