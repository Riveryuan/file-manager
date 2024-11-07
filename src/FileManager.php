<?php
namespace Riveryuan\FileManager;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Riveryuan\FileManager\Controller;

/**
 * FileManager
 *
 * Package: Riveryuan\FileManager
 */
class FileManager extends Controller {

    /**
     * Index page.
     *
     * @return Application|Factory|View
     */
    public function index(){

        return view('filemanager::index', $this->tplParams);
    }

    /**
     * File list page.
     *
     * @return string
     */
    public function fileList(){
        return 'File List';
    }
}
