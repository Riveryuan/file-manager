<?php
namespace Riveryuan\FileManager;

use App\Http\Kernel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use \Riveryuan\FileManager\Middleware\FileManagerCheckLogin;

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
        // 注册中间件
        $this->app['router']->aliasMiddleware('fm_check_login', FileManagerCheckLogin::class);

        // 加载路由
        $default_routes = __DIR__.'/routes/routes_default.php';
        $extend_routes = base_path('riveryuan/filemanager/routes/routes.php');

        $this->loadRoutesFrom($default_routes);
        if (file_exists($extend_routes)){
            $this->loadRoutesFrom($extend_routes);
        }

        // 加载视图
        $this->loadViewsFrom(__DIR__.'/resources/views', 'filemanager');

        // 配置资源发布规则
        $this->publishes([
            __DIR__.'/config/filemanager.php' => config_path('filemanager.php'),
            __DIR__.'/resources/assets' => public_path('vendor/riveryuan/filemanager'),
            __DIR__.'/routes/routes.php' => $extend_routes,
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
