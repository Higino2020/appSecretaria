<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurmaController extends Controller
{
            /**
             * Display a listing of the resource.
             */
            public function index()
            {
                //
                $valor=Turma::all();
                return view("pages.Turma",compact("valor"));
            }
            /**
             * Store a newly created resource in storage.
             */
            public function store(Request $request)
            {
                //
                $valor=null;
                if(isset($request->id)){
                    $valor= Turma::find($request->id);
                }else{

                    $valor= new Turma();
                }
                $valor->nome_turma=$request->nome_turma;
                $valor->funcionario_id= Auth::user()->funcionario->id ?? null;
                $valor->save();
                return redirect()->back()->with("SUCESSO","Turma CADASTRADO");
            }

            /**
             * Display the specified resource.
             */
            public function show( $id)
            {
                //
                $valor=Turma::find($id);
                return view("pages.Turma",compact("valor"));
            }

            /**
             * Remove the specified resource from storage.
             */
            public function apagar( $id)
            {
                //
                Turma::find($id)->delete();
                return redirect()->back()->with("SUCESSO","Turma ELIMINADO");
            }
        }

