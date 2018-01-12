<?php
/**
 * Created by PhpStorm.
 * User: EcareYu
 * Date: 2017/9/27
 * Time: 16:51
 */

namespace BenbenLand\Services;

use App\Exceptions\ApiException;
use BenbenLand\Services\UtilService as Util;
use Illuminate\Validation\Validator;

class HandleService
{

    /**
     * 处理表单验证错误输出
     *
     * @param Validator $validator
     * @throws ApiException
     */
    public static function validatorErrors(Validator $validator)
    {
        if (!$validator->errors()->isEmpty()) {
            foreach ($validator->errors()->messages() as $error) {
                if (is_string($error[0])) {
                    // 扩展验证规则返回的错误信息
                    $tmpError = explode('###', $error[0]);
                    if (count($tmpError) >= 2) {
                        list($msg, $code) = $tmpError;
                        throw new ApiException($msg, $code);
                    } else {
                        throw new ApiException($error[0]);
                    }
                } else {
                    list($msg, $code) = $error[0];
                    throw new ApiException($msg, $code);
                }
            }
        }
    }

    /**
     * 处理异常
     *
     * @param \Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * 处理异常
     *
     * @param \Exception $exception
     * @param int $statusCode
     * @return $this
     */
    public static function exception(\Exception $exception, $statusCode = 500)
    {
        switch ($statusCode) {
            case 404:
                $errorCode = 404;
                $message = 'Not found';
                break;
            case 401:
                $errorCode = 401;
                $message = 'Unauthorized.';
                break;
            default:
                $errorCode = $exception->getCode();
                $message = $exception->getMessage();
        }

        if ('production' != getenv('APP_ENV')) {
            return Util::response($message, $errorCode, [
                'line' => $exception->getLine(),
                'errors' => $exception->getMessage(),
                'file' => $exception->getFile()
            ])->setStatusCode($statusCode);
        } else {
            return Util::response($message, $errorCode)->setStatusCode($statusCode);
        }
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