<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Plank\Mediable\Media;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Illuminate\Http\Request;
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
use Illuminate\Support\Facades\Storage;

Route::group(['middleware'=>'auth'],function(){
    
    Route::get('/', function () {
        return view('pages.index');
    });
    Route::resource('user',UserController::class);
    Route::resource('funcio',FuncionarioController::class);
    Route::resource('doc',DocumentoController::class);
    Route::resource('agenda',AgendaController::class);
    Route::get('apager/{id}/agenda',[AgendaController::class,'apagar'])->name('agenda.apagar');
    Route::resource('corresp',CorrespondeciaController::class);
    Route::resource('visit',VisitanteController::class);
    Route::resource('project',ProjectoController::class);
    Route::resource('tarefas',TarefaController::class);
    Route::resource('recurso',RecursoController::class);
    Route::resource('financ',FinanceiroController::class);
    Route::resource('logist',LogisticaController::class);

    Route::get('getfile/{nome}',function($name){
        $path = '';
    $media = Media::whereBasename($name)->first();

    if ($media != null) {
        $path = $media->getDiskPath();
    } else {
        $path = 'default.png';
    }
    return (new Response(200))
        ->header('Content-Type', '*');
})->name('getfile');


    Route::get('download/{nome}',function($nome){
        $path = Storage::path('public/docEmpresa/'.$nome); // Update the path as per your PDF file location.
            
        return \Illuminate\Support\Facades\Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename='.$nome, // You can change the filename here.
        ]);
    })->name('baixar');

});
Auth::routes();

Route::get('/home', function(){
    return view('welcome');
})->name('home');
