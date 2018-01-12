<?php

/*错误信息*/

use BenBenLand\Contracts\Code;

return [
    Code::R_OK => '请求成功',
    Code::E_PARAM_ERROR => '参数错误',
    // Auth
    Code::E_AUTH_USERNAME_REQUIRED => '用户名必须',
    Code::E_AUTH_PASSWORD_REQUIRED => '密码必须',
    Code::E_AUTH_USERNAME_NOTEXIST => '用户名不存在',
    Code::E_AUTH_LOGIN_ERROR => '用户名或密码错误',
    // 文章
    Code::E_ARTICLE_CATE_DELETE_ID => '文章分类ID必须',

];