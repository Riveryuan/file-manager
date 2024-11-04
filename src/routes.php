<?php
use Illuminate\Support\Facades\Route;
use \Riveryuan\FileManager\FileManager;

// 路由
Route::group(['prefix' => 'fm', 'middleware' => []], function () {

    Route::match(['post','get'], 'file-list', [FileManager::class, 'FileList']);

});
