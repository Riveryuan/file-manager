<?php
namespace Riveryuan\FileManager;

use Illuminate\Support\ServiceProvider;

/**
 * FileManagerServiceProvider
 *
 * Package: Riveryuan\FileManager
 */
class FileManagerServiceProvider extends ServiceProvider{

    /**
     * boot
     *
     * @return void
     */
    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'filemanager');
        $this->publishes([
            __DIR__.'/config/filemanager.php' => config_path('filemanager.php'),
        ]);
    }

    /**
     * register
     *
     * @return void
     */
    public function register(){

    }
}
