<?php
use Illuminate\Support\Facades\Route;
use \Riveryuan\FileManager\FileManager;

// 路由

Route::prefix('fm')->group(function(){
    Route::middleware(['web'])->group(function () {
        Route::match(['post','get'], '/', [FileManager::class, 'index']);
        Route::match(['post'], '/index-action', [FileManager::class, 'indexAction']);
        Route::match(['get','post'], '/logout', [FileManager::class, 'logout']);

        Route::middleware(['fm_check_login'])->group(function () {
            Route::match(['post','get'], 'file-list', [FileManager::class, 'fileList']);

        });
    });
});
