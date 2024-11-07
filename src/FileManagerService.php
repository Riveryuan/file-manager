<?php
namespace Riveryuan\FileManager;

/**
 * FileManagerService
 *
 * @package Riveryuan\FileManager
 */
class FileManagerService {

    /**
     * 构建模板提示消息(HTML).
     *
     * @param string $msg 消息内容
     * @param string $type 消息类型：light, danger, info, warning, success
     * @param boolean $closeButton 是否显示关闭按钮：true, false
     * @return string
     */
    public function buildAlertInfo($msg='', $type='info', $closeButton = true) {
        $class = [
            'light'=>['alert-default-light','fa-info'],
            'info'=>['alert-default-info','fa-info'],
            'danger'=>['alert-default-danger','fa-ban'],
            'warning'=>['alert-default-warning','fa-exclamation-triangle'],
            'success'=>['alert-default-success','fa-check']
        ];

        return !isset($class[$type]) ? ''
            : '<div class="alert '.$class[$type][0].' '.($closeButton ? 'alert-dismissible' : '').'">'.
            ($closeButton ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                : '').'<h5><i class="icon fas '.$class[$type][1].'"></i> '.$msg.'</h5></div>';
    }

    /**
     * 登录验证.
     *
     * @param $loginName
     * @param $loginPassword
     * @return bool
     */
    public function checkLogin($loginName, $loginPassword){
        return ($loginName===config('filemanager.login_name') &&
            $loginPassword===config('filemanager.login_password'));
    }

    /**
     * 保存登录状态.
     *
     * @return void
     */
    public function saveLogin(){
        \request()->session()->forget('fm_login_user_info');
        \request()->session()->put('fm_login_user_info', ['is_login'=>true,'login_time'=>time()]);
        \request()->session()->save();
    }

    /**
     * 清除登录状态.
     *
     * @return void
     */
    public function cleanLogin(){
        \request()->session()->forget('fm_login_user_info');
        \request()->session()->save();
    }
}
