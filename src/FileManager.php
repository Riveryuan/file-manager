<?php

namespace Riveryuan\FileManager;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Riveryuan\FileManager\Controller;

/**
 * FileManager
 *
 * Package: Riveryuan\FileManager
 */
class FileManager extends Controller {

    /**
     * 登录页(首页).
     *
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        // 处理页面消息
        if ($request->session()->has('login_out')) {
            $this->tplParams['tpl_info'] = $this->service->
            buildAlertInfo($request->session()->get('login_out'), 'success');
        }
        if ($request->session()->has('login_error')) {
            $this->tplParams['tpl_info'] = $this->service->
            buildAlertInfo($request->session()->get('login_error'), 'danger');
        }

        // 加载视图
        return view('filemanager::index', $this->tplParams);
    }

    /**
     * 文件列表页(用户首页).
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function fileList(Request $request) {
        // $this->tplParams['tpl_info'] = $this->service->buildAlertInfo('文件列表页面');
        $this->tplParams['menu_tag'] = 'm-file-list';
        $this->tplParams['file_list'] = $this->service->getDirFileList();

        // 加载视图
        return view('filemanager::file-list', $this->tplParams);
    }

    /**
     * 登录验证(接口).
     *
     * @param Request $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function indexAction(Request $request) {
        $login_name = trim($request->post('inputName', ''));
        $login_password = trim($request->post('inputPassword', ''));
        $remember_me = trim($request->post('checkboxRememberMe', 'off'));

        if ($this->service->checkLogin($login_name, $login_password)) {
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
    public function logout() {
        $this->service->cleanLogin();

        // 跳转登录页
        return redirect('fm/')->with('login_out', '退出登录成功!');
    }


}
