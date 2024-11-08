<?php

namespace Riveryuan\FileManager;

use Illuminate\Support\Facades\File;

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
    public function buildAlertInfo($msg = '', $type = 'info', $closeButton = true) {
        $class = [
            'light' => ['alert-default-light', 'fa-info'],
            'info' => ['alert-default-info', 'fa-info'],
            'danger' => ['alert-default-danger', 'fa-ban'],
            'warning' => ['alert-default-warning', 'fa-exclamation-triangle'],
            'success' => ['alert-default-success', 'fa-check']
        ];

        return !isset($class[$type]) ? ''
            : '<div class="alert ' . $class[$type][0] . ' ' . ($closeButton ? 'alert-dismissible' : '') . '">' .
            ($closeButton ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                : '') . '<h5><i class="icon fas ' . $class[$type][1] . '"></i> ' . $msg . '</h5></div>';
    }

    /**
     * 登录验证.
     *
     * @param $loginName
     * @param $loginPassword
     * @return bool
     */
    public function checkLogin($loginName, $loginPassword) {
        return ($loginName === config('filemanager.login_name') &&
            $loginPassword === config('filemanager.login_password'));
    }

    /**
     * 保存登录状态.
     *
     * @return void
     */
    public function saveLogin() {
        \request()->session()->forget('fm_login_user_info');
        \request()->session()->put('fm_login_user_info', ['is_login' => true, 'login_time' => time()]);
        \request()->session()->save();
    }

    /**
     * 清除登录状态.
     *
     * @return void
     */
    public function cleanLogin() {
        \request()->session()->forget('fm_login_user_info');
        \request()->session()->save();
    }

    /**
     * 获取某个目录中的文件列表（含目录）.
     *
     * @param $path
     * @return array
     */
    public function getDirFileList($path = '') {
        $path = !empty($path) ? $path : base_path();

        return [
            'current_dir' => $path,
            'dir' => array_map(function ($nowItem) {
                return $this->getFileDetail($nowItem);
            }, File::directories($path)),
            'files' => array_map(function ($nowItem) {
                return $this->getFileDetail($nowItem, true);
            }, File::files($path))
        ];
    }

    /**
     * 格式化文件权限.
     *
     * @param $perms
     * @return string
     */
    public function formatPermissions($perms) {
        if (!$perms){
            return '';
        }

        // 判断是否为目录
        $info = ($perms & 0x4000) ? 'd' : '-';

        // 拥有者权限
        $info .= ($perms & 0x0100) ? 'r' : '-';
        $info .= ($perms & 0x0080) ? 'w' : '-';
        $info .= ($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-');

        // 组权限
        $info .= ($perms & 0x0020) ? 'r' : '-';
        $info .= ($perms & 0x0010) ? 'w' : '-';
        $info .= ($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-');

        // 其他权限
        $info .= ($perms & 0x0004) ? 'r' : '-';
        $info .= ($perms & 0x0002) ? 'w' : '-';
        $info .= ($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-');

        return $info;
    }

    /**
     * 获取文件详细信息，包括文件名、修改时间、所属用户等.
     *
     * @param $file
     * @param $getSize
     * @return array
     */
    public function getFileDetail($file, $getSize = false){
        $file_permissions = fileperms($file);
        $owner = fileowner($file);
        $group = filegroup($file);
        $info = [
            'base_name' => basename($file),
            'modified_time' => date("Y-m-d H:i:s", File::lastModified($file)),
            'created_time' => date("Y-m-d H:i:s", filectime($file)),
            'permissions' => substr(sprintf('%o', $file_permissions), -4),
            'permissions_text' => $this->formatPermissions($file_permissions),
            'owner' => $owner,
            'group' => $group,
            'owner_title' => posix_getpwuid($owner)['name'],
            'group_title' => posix_getgrgid($group)['name']
        ];

        if ($getSize){
            $info['size'] = File::size($file);
            $info['size_text'] = $this->formatFileSize($info['size']);
        }

        return $info;
    }

    /**
     * 格式化输出字节数.
     *
     * @param $bytes
     * @return string
     */
    function formatFileSize($bytes) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $unitIndex = 0;

        // 当大小超过 1024，提升到更大的单位
        while ($bytes >= 1024 && $unitIndex < count($units) - 1) {
            $bytes /= 1024;
            $unitIndex++;
        }

        // 保留两位小数并加上单位
        return number_format($bytes, 2) . ' ' . $units[$unitIndex];
    }

}
