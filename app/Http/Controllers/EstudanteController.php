<?php

namespace App\Http\Controllers;

use App\Models\estudante;
use Illuminate\Http\Request;
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
        return view('pages.estudante',compact('student'));
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
        } 
        $student->nome=$request->nome;
        $student->sobrenome=$request->sobrenome;
        $student->n_bilhete=$request->n_bilhete;
        $student->telefone=$request->telefone;
        $student->bilhete=$request->bilhete;
        $student->gmail=$request->gmail;
        $student->certificado=$request->certificado;
        $student->curso=$request->curso;
        $student->matricula=$request->matricula;
        $student->ano_academico=$request->ano_academico;
        $student->status=$request->status;
        $student->funcionario_id=$request->funcionario_id;
        $student->save();
        return redirect()->back()->with('SUCESSO','ESTUDANTE CADASTRADO');
    }

    /**
     * Display the specified resource.
     */
    public function show(estudante $estudante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(estudante $estudante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, estudante $estudante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(estudante $estudante)
    {
        //
    }
}
