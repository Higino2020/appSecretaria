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
            return view("pages.paut",compact("paut"));
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
            $paut->tipo=$request->tipo;
            $paut->data=$request->data;
            $paut->remetente=$request->remetente;
            $paut->destinatario=$request->destinatario;
            $paut->assunto=$request->assunto;
            $paut->descricao=$request->descricao;
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
            return view("pages.paut",compact("paut"));
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

