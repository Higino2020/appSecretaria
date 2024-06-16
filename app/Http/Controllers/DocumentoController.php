<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $doc= Documento::all();
        return view("pages.documento",compact("doc"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $doc=null;
        if(isset($request->id)){
            $doc= Documento::find($request->id);
        }else{
            $doc= new Documento();
        }
        $doc->tipo_documento=$request->tipo_documento;
        $doc->descricao=$request->descricao;
        $doc->data_criacao=$request->data_criacao;
        $doc->funcionario_id=$request->funcionario_id ?? $doc->funcionario_id;
        $doc->localizacao_arquivo=$request->localizacao_arquivo;
        $doc->status=$request->status;
        return redirect()->back()->with("Sucesso","DOCUMENTO CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $doc=Documento::find($id);
        return view("pages.documento",compact("doc"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Documento::find($id)->delete;
        return redirect()->back()->with("Sucesso","DOCUMENTO ELIMINADO");
    }
}
