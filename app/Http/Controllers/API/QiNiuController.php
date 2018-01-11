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



}
