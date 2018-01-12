<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// auth
Route::post('auth/login', 'AuthController@login');

//Route::resource('activity', 'ActivityController');
//Route::resource('article', 'ArticleController');
//Route::resource('product', 'ProductController');

//通用
$router->get('qiniu/auth', 'QiNiuController@auth');
$router->any('qiniu/ueditor', 'QiNiuController@ueditor');

$router->get('region/index', 'RegionController@index');
$router->get('region/get_dist', 'RegionController@getDist');
$router->get('region/get_city', 'RegionController@getCity');
$router->get('region/get_province', 'RegionController@getProvince');

//商品相关
$router->resource('product/products', 'ProductController');















































