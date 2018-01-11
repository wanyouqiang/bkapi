<?php

namespace App\Http\Controllers\API;

use BenbenLand\Contracts\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Qiniu\Auth;

class QiNiuController extends ApiController
{
    // 获取七牛云up权限
    public function auth(Request $request)
    {
        $bucket = config('filesystems.disks.qiniu.bucket');
        $accessKey = config('filesystems.disks.qiniu.access_key');
        $secretKey = config('filesystems.disks.qiniu.secret_key');

        $auth = new Auth($accessKey, $secretKey);
        $upToken = $auth->uploadToken($bucket);
        return $this->apiResponse('获取成功！', Code::R_OK, [
            'uptoken' => $upToken,
            'qiniu_domain' => env('QINIU_DOMAIN')
        ]);
    }

    // 百度编辑器上传文件
    public function ueditor(Request $request)
    {

        $upload = config('ueditor.upload');
        $storage = app('ueditor.storage');

        $callback = $request->get('callback');

        switch ($request->get('action')) {
            case 'config':
                $result = config('ueditor.upload');
                break;

            // lists
            case $upload['imageManagerActionName']:
                $result = $storage->listFiles(
                    $upload['imageManagerListPath'],
                    $request->get('start'),
                    $request->get('size'),
                    $upload['imageManagerAllowFiles']);
                break;
            case $upload['fileManagerActionName']:
                $result = $storage->listFiles(
                    $upload['fileManagerListPath'],
                    $request->get('start'),
                    $request->get('size'),
                    $upload['fileManagerAllowFiles']);
                break;
            default:
                $result = $storage->upload($request);
                break;
        }
        if ($callback) {
            if (preg_match("/^[\w_]+$/", $callback)) {
                return htmlspecialchars($callback) . '(' . json_encode($result) . ')';
            } else {
                return json_encode(['state'=> 'callback参数不合法']);
            }
        }
        return $result;
    }

}
