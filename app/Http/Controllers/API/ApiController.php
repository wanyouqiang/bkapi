<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use BenbenLand\Services\UtilService as Util;
use BenbenLand\Services\HandleService as Handle;
use Illuminate\Validation\Validator;

/*
 * API返回的基础类，供其他api继承
 *
 * */

class ApiController extends Controller
{
    /**
     * api返回数据格式
     *
     * */
    public function apiResponse (string $msg, int $code, array $data = [])
    {
        return Util::response($msg, $code, $data);
    }

    /**
     * 处理表单验证报错
     *
     * @param Validator $validator
     */
    protected function validatorErrors(Validator $validator)
    {
        return Handle::validatorErrors($validator);
    }

    /**
     * 验证规则信息
     *
     * @param $code 错误编号
     * @param array $values
     * @return array
     */
    protected function ruleMsg($code, $values = [])
    {
        return Util::rulesErr($code, $values);
    }

    /**
     * 抛出API用的异常
     *
     * @param $code
     * @param array $values
     */
    protected function thrown($code, $values = [])
    {
        return Util::thrownErr($code, $values);
    }

}
