<?php
/**
 * 工具服务.
 * User: EcareYu
 * Date: 2017/9/27
 * Time: 16:52
 */

namespace BenbenLand\Services;


use App\Exceptions\ApiException;
use BenbenLand\Contracts\Code;
use BenbenLand\Contracts\Constant;

class UtilService
{

    /**
     * 数据返回
     *
     * @param $message
     * @param int $code
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function response($message, $code = Code::R_OK, $data = [])
    {
        $out = [
            'msg' => $message,
            'code' => $code
        ];

        if ($data) {
            // null转换成'' true|false转换成1|0
            array_walk_recursive($data, function (&$item, $key) {
                if (is_null($item)) {
                    $item = '';
                } elseif (is_bool($item)) {
                    $item = (true === $item) ? 1 : 0;
                }
            });
            $out['data'] = $data;
        }

        return \Response::make($out);
    }

    /**
     * 错误文字
     *
     * @param $key errors语言包中key
     * @param array $values 变量
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    public static function error($key, $values = [])
    {
        $msg = __(sprintf('errors.%s', $key));

        if (count($values) > 0) {
            return vsprintf($msg, $values);
        } else {
            return $msg;
        }
    }

    /**
     * 表单规则错误格式
     *
     * @param $code
     * @param array $values
     * @return array
     */
    public static function rulesErr($code, $values = [])
    {
        return [self::error($code, $values), $code];
    }

    /**
     * 抛异常专用工具
     *
     * @param $code
     * @param array $values
     * @throws ApiException
     */
    public static function thrownErr($code, $values = [])
    {
        throw new ApiException(self::error($code, $values), $code);
    }

    /**
     * 格式化金钱输出
     *
     * @param $price
     * @return string
     */
    public static function priceFormat($price)
    {
        return bcdiv(bcmul($price, 100, 0), 100, 2);
    }
}