<?php
/**
 * Created by PhpStorm.
 * User: mhl
 * Date: 2018/01/09
 * Time: 16:43
 */

/**
 * api统一返回数据格式
 *
 * User: mhl
 * Date: 2018/01/09
 * Time: 16:43
 */
function apiResponse($msg, $code = R_OK, $data = [])
{
    $out = [
        'msg' => $msg,
        'code' => $code,
    ];

    if ($data) {
        #过滤掉null和bool值
        array_walk_recursive($data, function(&$item, $key){
            if (is_null($item)) {
                $item = '';
            } elseif (is_bool($item)) {
                $item = $item ? 1 : 0;
            }
        });

        $out['data'] = $data;
    }

    return Response::json($out);
}






