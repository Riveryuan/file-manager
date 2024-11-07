<?php
use Illuminate\Support\Facades\Route;
use \Riveryuan\FileManager\FileManager;

// 路由

Route::prefix('fm')->group(function(){
    Route::match(['post','get'], '/', [FileManager::class, 'index']);

    Route::middleware(['web','fm_check_login'])->group(function () {
        Route::match(['post','get'], 'file-list', [FileManager::class, 'fileList']);

    });

});
