<?php

namespace Riveryuan\FileManager;

use App\Http\Controllers\Controller as BasicController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Controller
 *
 * @package Riveryuan\FileManager
 */
class Controller extends BasicController {

    /**
     * Imports
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var array $tplParams
     */
    protected $tplParams = [];

    /**
     * Before action.
     *
     * @param $action
     * @return void
     */
    public function beforeAction($action){
        $this->tplParams['assets_path'] = config('app.url').'/vendor/riveryuan/filemanager';
    }

    /**
     * Call action.
     *
     * @param $method
     * @param $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters) {
        if (method_exists($this, 'beforeAction')) {
            call_user_func_array([$this, 'beforeAction'], ['action' => $method]);
        }

        $return = $this->{$method}(...array_values($parameters));

        if (method_exists($this, 'afterAction')) {
            call_user_func_array([$this, 'afterAction'], ['action' => $method]);
        }

        return $return;
    }

}