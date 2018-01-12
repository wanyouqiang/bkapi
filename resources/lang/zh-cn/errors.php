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

    // 商品
    Code::E_PRODUCT_CATEGORY_ID_EMPYT => '商品分类id不能为空',
    Code::E_PRODUCT_LOCATION_ID_EMPYT => '国家id不能为空',
    Code::E_PRODUCT_BRAND_ID_EMPYT => '品牌id不能为空',
    Code::E_PRODUCT_THUMBNAIL_EMPYT => '缩略图不能为空',
    Code::E_PRODUCT_TITLE_EMPYT => '标题不能为空',
    Code::E_PRODUCT_SUB_TITLE_EMPYT => '副标题不能为空',
    Code::E_PRODUCT_KEYWORDS_EMPYT => '关键词不能为空',
    Code::E_PRODUCT_DESCRIPTION_EMPYT => '商品详情不能为空',
    Code::E_PRODUCT_PRICE_ORIGIN_EMPYT => '商品原价不能为空',
    Code::E_PRODUCT_PRICE_EMPYT => '商品现价不能为空',
    Code::E_PRODUCT_PRICE_EXPRESS_EMPYT => '商品邮费不能为空',
];