<?php

use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;

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

    // Dashboard - chama o controller DespesaController
    Route::get('/dashboard', [DespesaController::class, 'index'])->name('dashboard');

    // Rotas de despesas
    Route::post('/despesas', [DespesaController::class, 'store'])->name('despesas.store');
    Route::patch('/despesas/{despesa}', [DespesaController::class, 'update'])->name('despesas.update');
    Route::delete('/despesas/{despesa}', [DespesaController::class, 'destroy'])->name('despesas.destroy');

    Route::resource('produtos', ProdutoController::class);
});

require __DIR__.'/auth.php';
