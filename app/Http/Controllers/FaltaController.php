<?php

namespace App\Http\Controllers;

use App\Models\Falta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaltaController extends Controller
{
            /**
             * Display a listing of the resource.
             */
            public function index()
            {
                //
                $valor=Falta::all();
                return view("pages.Falta",compact("valor"));
            }
            /**
             * Store a newly created resource in storage.
             */
            public function store(Request $request)
            {
                //
                $valor=null;
                if(isset($request->id)){
                    $valor= Falta::find($request->id);
                }else{

                    $valor= new Falta();
                }
                $valor->qtd_falta=$request->qtd_falta;
                $valor->data=$request->data;
                $valor->estudantes_Id=$request->estudantes_Id;
                $valor->funcionario_id= Auth::user()->funcionario->id ?? null;
                $valor->save();
                return redirect()->back()->with("SUCESSO","FALTA CADASTRADO");
            }

            /**
             * Display the specified resource.
             */
            public function show( $id)
            {
                //
                $valor=Falta::find($id);
                return view("pages.Falta",compact("valor"));
            }

            /**
             * Remove the specified resource from storage.
             */
            public function apagar( $id)
            {
                //
                Falta::find($id)->delete();
                return redirect()->back()->with("SUCESSO","FALTA ELIMINADO");
            }
        }


