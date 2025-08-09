<?php

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

});
