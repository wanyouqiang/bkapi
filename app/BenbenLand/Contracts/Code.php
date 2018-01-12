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
    // 文章
    const E_ARTICLE_CATE_DELETE_ID = 2001;
    const E_ARTICLE_CATE_ISINT = 2002;

    // 商品
    const E_PRODUCT_CATEGORY_ID_EMPYT = 3001; //商品分类id不能为空
    const E_PRODUCT_LOCATION_ID_EMPYT = 3002; //国家id不能为空
    const E_PRODUCT_BRAND_ID_EMPYT = 3003; //品牌id不能为空
    const E_PRODUCT_THUMBNAIL_EMPYT = 3004; //缩略图不能为空
    const E_PRODUCT_TITLE_EMPYT = 3005; //标题不能为空
    const E_PRODUCT_SUB_TITLE_EMPYT = 3006; //副标题不能为空
    const E_PRODUCT_KEYWORDS_EMPYT = 3007; //关键词不能为空
    const E_PRODUCT_DESCRIPTION_EMPYT = 3008; //商品详情不能为空
    const E_PRODUCT_PRICE_ORIGIN_EMPYT = 3009; //商品原价不能为空
    const E_PRODUCT_PRICE_EMPYT = 3010; //商品现价不能为空
    const E_PRODUCT_PRICE_EXPRESS_EMPYT = 3011; //商品邮费不能为空


}