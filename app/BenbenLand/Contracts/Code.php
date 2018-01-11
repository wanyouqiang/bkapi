<?php
/**
 * Created by PhpStorm.
 * User: EcareYu
 * Date: 2017/9/27
 * Time: 16:57
 */

namespace BenbenLand\Contracts;


interface Code
{
    const R_OK = 0;
    const E_PARAM_ERROR = 400;                          // 参数错误
    // auth
    const E_AUTH_USERNAME_REQUIRED = 1001;
    const E_AUTH_PASSWORD_REQUIRED = 1002;
    const E_AUTH_USERNAME_NOTEXIST = 1003;
    const E_AUTH_LOGIN_ERROR = 1004;



}