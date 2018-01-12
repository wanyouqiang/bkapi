<?php

// 公众号相关配置
return [
    // 预览秘钥（用于预览文章，产品，）,preview_token = md5(preview_salt . id);
    'preview_salt' => 'FFFtFUBGkXrQ73K9',
    // 文章详情地址模板
    'article_url_tpl' => 'http://wx.sx.benbenland.com/m2#/articles/%d',
    // 产品详情地址
    'product_url_tpl' => 'http://wx.sx.benbenland.com/m2#/products/%d',
];