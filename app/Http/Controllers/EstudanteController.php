<?php

namespace App\Http\Controllers;

use App\Models\estudante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Plank\Mediable\Facades\MediaUploader;

class EstudanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $student= estudante::all();
        return view("pages.estudante",compact("student"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $student=null;
        if (isset($request->id)) {
            # code...
            $student= estudante::find($request->id);
        } else {
            # code...
            $student= new estudante();
            $user  = User::cadastrar($request);
            $student->user_id=$user->id;
        }
        if (!isset($student->bilhete)) {
            # code...
            if (request()->hasFile('bilhete')) {
                # code...
                $doc=MediaUploader::fromSource(request()->file('bilhete'))
                ->toDirectory('docEstudante')->onDuplicateIncrement()
                ->useHashForFilename()
                ->setAllowedExtensions(['doc','docx','pdf','xlsx','pptx','jpg','png','jpeg'])->upload();
                $student->bilhete=$doc->basename;
            }
            if (request()->hasFile('certificado')) {
                # code...
                $doc=MediaUploader::fromSource(request()->file('certificado'))
                ->toDirectory('docEstudante')->onDuplicateIncrement()
                ->useHashForFilename()
                ->setAllowedExtensions(['doc','docx','pdf','xlsx','pptx','jpg','png','jpeg'])->upload();
                $student->certificado=$doc->basename;
            }
            if (request()->hasFile('foto')) {
                # code...
                $doc=MediaUploader::fromSource(request()->file('foto'))
                ->toDirectory('docEstudante')->onDuplicateIncrement()
                ->useHashForFilename()
                ->setAllowedExtensions(['jpg','png','jpeg'])->upload();
                $student->foto=$doc->basename;
            }
        }
        $student->nome=$request->nome;
        $student->genero=$request->genero;
        $student->n_bilhete=$request->n_bilhete;
        $student->telefone=$request->telefone;
        $student->provincia=$request->provincia;
        $student->foto=$request->foto;
        $student->naturalidade=$request->naturalidade;
        $student->afiliacao=$request->afiliacao;
        $student->bilhete=$request->bilhete;
        $student->certificado=$request->certificado;
        $student->data=date("Y-m-d");
        $student->status="Enviado";
        $student->funcionario_id=$request->funcionario_id;
        $student->save();
        return redirect()->back()->with("SUCESSO","ESTUDANTE CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $student= estudante::find($id);
        return view("page.estudante",compact("student"));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function apagar($id)
    {
        estudante::find($id)->delete();
        return redirect()->back()->with("SUCESSO","ESTUDANTE ELIMINADO");
    }
}
