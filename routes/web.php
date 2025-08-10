<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Message\MessageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/'], function (){

    Route::get('', [HomeController::class, 'index'])->name('pages.home');
    Route::group(['prefix'=>'servicos'], function (){
        Route::get('{slug}', [HomeController::class, 'service'])->name('pages.service');
    });
    Route::get('parceiros', [HomeController::class, 'partners'])->name('pages.partners');
    Route::get('quem-somos', [HomeController::class, 'about'])->name('pages.about');
    Route::post('enviar/mensagem', [MessageController::class, 'store'])->name('send.message');
    Route::get('eliminar/mensagem/{id}', [MessageController::class, 'destroy'])->name('delete.message');

    Route::group(['prefix'=>'admin'], function (){
        Route::get('', [AdminController::class, 'index'])->name('admin.home');
        Route::get('pagina-principal', [AdminController::class, 'home'])->name('admin.pages.index');
        Route::get('servicos', [AdminController::class, 'services'])->name('admin.pages.services');
        Route::get('parceiros', [AdminController::class, 'partners'])->name('admin.pages.partners');
        Route::get('actualizar/servico/{slug}', [AdminController::class, 'showService'])->name('admin.pages.services.show');

        Route::put('actualizar/pagina-principal/{id}', [AdminController::class, 'updateHome'])->name('admin.pages.index.update');
        Route::put('actualizar/informacoes/servico/{id}', [AdminController::class, 'updateService'])->name('admin.pages.service.update');
        Route::put('actualizar/parceiro', [AdminController::class, 'updatePartners'])->name('admin.pages.partners.update');

    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
