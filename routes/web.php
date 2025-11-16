<?php

use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return 'Laravel está funcionando ✅';
});

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::redirect('/dashboard', '/despesas')->name('dashboard');

    Route::resource('despesas', DespesaController::class);
    Route::post('/despesas/avancar-mes', [DespesaController::class, 'avancarMes'])->name('despesas.avancarMes'); 
    Route::post('/despesas/voltar-mes', [DespesaController::class, 'voltarMes'])->name('despesas.voltarMes');
    
});

require __DIR__.'/auth.php';
