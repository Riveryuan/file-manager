<?php
namespace Riveryuan\FileManager;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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
    public function index(Request $request){
        // 处理页面消息
        if ($request->session()->has('login_out')){
            $this->tplParams['tpl_info'] = $this->service->
            buildAlertInfo($request->session()->get('login_out'), 'success');
        }
        if ($request->session()->has('login_error')){
            $this->tplParams['tpl_info'] = $this->service->
            buildAlertInfo($request->session()->get('login_error'), 'danger');
        }


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

    public function indexAction(Request $request){
        $login_name = trim($request->post('inputName',''));
        $login_password = trim($request->post('inputPassword',''));
        $remember_me = trim($request->post('checkboxRememberMe','off'));

        if ($this->service->checkLogin($login_name, $login_password)){
            $this->service->saveLogin();

            return redirect('fm/file-list');
        }

        return redirect('fm/')
            ->with('login_error', '登录失败，请检查登录信息是否正确。');
    }

    /**
     * 退出登录。
     *
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(){
        $this->service->cleanLogin();

        return redirect('fm/')->with('login_out', '退出登录成功!');
    }

}
