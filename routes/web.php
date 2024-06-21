<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AgendaController,
    CorrespondeciaController,
    DocumentoController,
    FinanceiroController,
    FuncionarioController,
    LogisticaController,
    ProjectoController,
    RecursoController,
    TarefaController,
    UserController,
    VisitanteController
};

Route::group([],function(){
    
    Route::get('/', function () {
        return view('pages.index');
    });

    Route::resource('user',UserController::class);
    Route::resource('funcio',FuncionarioController::class);
    Route::resource('doc',DocumentoController::class);
    Route::resource('agenda',AgendaController::class);
    Route::resource('corresp',CorrespondeciaController::class);
    Route::resource('visit',VisitanteController::class);
    Route::resource('project',ProjectoController::class);
    Route::resource('tarefas',TarefaController::class);
    Route::resource('recurso',RecursoController::class);
    Route::resource('financ',FinanceiroController::class);
    Route::resource('logist',LogisticaController::class);
});
Auth::routes();

Route::get('/home', function(){
    return view('welcome');
})->name('home');
