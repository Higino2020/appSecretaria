<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Plank\Mediable\Facades\MediaUploader;

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
        if(!isset($doc->localizacao_arquivo) ){
            if (request()->hasFile('localizacao_arquivo')) {
                $media = MediaUploader::fromSource(request()->file('localizacao_arquivo'))
                    ->toDirectory('docEmpresa')->onDuplicateIncrement()
                    ->useHashForFilename()
                    ->setAllowedExtensions(['doc','docx','pdf','xlsx','pptx','jpg','png','jpeg'])->upload();
                $doc->localizacao_arquivo = $media->basename;
            }
        }
        $doc->tipo_documento=$request->tipo_documento;
        $doc->descricao=$request->descricao;
        $doc->data_criacao=date('Y-m-d');
        $doc->funcionario_id=Auth::user()->funcionario->id ?? null;
        $doc->status="Enviado";
        $doc->save();
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
        Documento::find($id)->delete();
        return redirect()->back()->with("Sucesso","DOCUMENTO ELIMINADO");
    }
}
