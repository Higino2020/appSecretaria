<?php

namespace App\Http\Controllers;

use App\Models\Pauta;
use Illuminate\Http\Request;

class PautaController extends Controller
{
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            //
            $paut= Pauta::all();
            return view("pages.Pauta",compact("paut"));
        }
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            //
            $paut=null;
            if(isset($request->id)){
                $paut= Pauta::find($request->id);
            }else{
                $paut= new Pauta();
            }
            $paut->prova1=$request->prova1;
            $paut->prova2=$request->prova2;
            $paut->exame=$request->exame;
            $paut->periodo=$request->periodo;
            $valor=$request->prova1;
            $valor2=$request->prova2;
            $valor3=$request->exame;
            $somatorio=($valor+$valor2+$valor3)/3;
            $paut->final=$request->$somatorio;
            $paut->status=$request->status;
            $paut->estudante_id=$request->estudante_id;
            $paut->funcionario_id=$request->funcionario_id;
            $paut->disciplina_id=$request->disciplina_id;
            $paut->save();
            return redirect()->back()->with("Sucesso","PAUTA CADASTRADO");
        }

        /**
         * Display the specified resource.
         */
        public function show( $id)
        {
            //
            $paut=Pauta::find($id);
            return view("pages.Pauta",compact("paut"));
        }

        /**
         * Remove the specified resource from storage.
         */
        public function apagar( $id)
        {
            //
            Pauta::find($id)->delete();
            return redirect()->back()->with("Sucesso","PAUTA ELIMINADO");
        }
    }

