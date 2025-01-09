<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Plank\Mediable\Media;
use Intervention\Image\ImageManager as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ClasseController,
    FuncionarioController,
    EstudanteController,
    UserController,
    MatriculaController,
    PautaController,
    DisciplinaController,
    FaltaController,
    TurmaController
};
use Illuminate\Support\Facades\Storage;

Route::group(['middleware'=>'auth'],function(){

    Route::get('/', function () {
        return view('pages.index');
    })->name('index');
    Route::resource('user',UserController::class);
    Route::resource('funcio',FuncionarioController::class);
    Route::get('apager/{id}/funcio',[FuncionarioController::class,'apagar'])->name('funcio.apagar');
    Route::resource('Matri',MatriculaController::class);
    Route::get('apager/{id}/Matri',[MatriculaController::class,'apagar'])->name('Matri.apagar');
    Route::resource('classe',ClasseController::class);
    Route::get('apager/{id}/classe',[ClasseController::class,'apagar'])->name('classe.apagar');
    Route::resource('paut',PautaController::class);
    Route::get('apager/{id}/paut',[PautaController::class,'apagar'])->name('paut.apagar');
    Route::resource('Disc',DisciplinaController::class);
    Route::get('apager/{id}/Disc',[DisciplinaController::class,'apagar'])->name('Disc.apagar');
    Route::resource('Turm',TurmaController::class);
    Route::get('apager/{id}/Turm',[TurmaController::class,'apagar'])->name('Turm.apagar');
    Route::resource('falt',FaltaController::class);
    Route::get('apager/{id}/falt',[FaltaController::class,'apagar'])->name('falt.apagar');
    Route::resource('student',EstudanteController::class);
    Route::get('apager/{id}/student',[EstudanteController::class,'apagar'])->name('student.apagar');

    Route::get('getfile/{nome}',function($name){
        $path = '';
            $media = Media::whereBasename($name)->first();

            if ($media != null) {
                $path = $media->getDiskPath();
            } else {
                $path = 'default.png';
            }
            $img = Image::make($media->getAbsolutePath())->resize(300, 200);
            $img->stream();
            dd($img->__toString());
            //Log::debug(storage_path() . '/app/' . $path);
            return (new Response($img->__toString(), 200))
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
    return redirect()->route('index');
})->name('home');
