<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $agenda= Agenda::all();
        return view("pages.agenda",compact("agenda"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $agenda=null;
        if(isset($request->id)){
            $agenda= Agenda::find($request->id);
        }else{
            $agenda= new Agenda();
        }
        $agenda->data=$request->data;
        $agenda->hora_inicio=$request->hora_inicio;
        $agenda->hora_fim=$request->hora_fim;
        $agenda->descricao_evento=$request->descricao_evento;
        $agenda->local=$request->local;
        $agenda->participante=$request->participante ?? $agenda->participante;
        $agenda->tipo_evento=$request->tipo_evento;
        $agenda->save();
        return redirect()->back()->with("Sucesso","AGENDA CADASTRADO");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $agenda=Agenda::find($id);
        return view("pages.agenda",compact("agenda"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function apagar( $id)
    {
        //
        Agenda::find($id)->delete();
        return redirect()->back()->with("Sucesso","AGENDA ELIMINADO");
    }
}
