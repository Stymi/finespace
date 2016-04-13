<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//微信注册登录
Route::get('auth/login','Auth\AuthController@getLogin');

Route::post('auth/login','Auth\AuthController@postLogin');

Route::get('auth/register','Auth\AuthController@getRegister');

Route::post('auth/register','Auth\AuthController@postRegister');

Route::get('auth/logout','Auth\AuthController@getLogout');

Route::get('weixin','weixin\homeController@index');

//手机站个人中心

Route::get('weixin/member','weixin\memberController@home');



//手机站产品分类

Route::get('weixin/category','weixin\productController@toCategory');

//手机站产品中心

Route::get('weixin/product/{productId}','weixin\productController@showProduct');



//手机站购物车
Route::get('weixin/cart','weixin\cartController@show');// ['middleware' => '','uses' => ]);
Route::post('weixin/addToCart/', 'weixin\cartController@addToCart');
Route::any('weixin/getCartCookie', 'weixin\cartController@getCartCookie');
Route::post('weixin/deleteCookieProd',  'weixin\cartController@deleteCookieProd');

//手机站结算
Route::get('weixin/checkout','weixin\checkoutController@checkout');




//图片验证码
Route::post('verifyValidateCode','Service\CommonController@verifyValidateCode');
Route::get('getValidateCode','Service\CommonController@createValidateCode');

//获取手机验证码

Route::any('/sendSmsCode','Service\CommonController@sendSmsCode');


Route::post('/authCheck/CheckMobile','Auth\AuthController@clientCheckMobile');

//订单
Route::post('/weixin/updatePaymentMethod','weixin\orderController@updatePaymentMethod');
Route::post('/weixin/generateOrder', 'weixin\orderController@generateOrder');

Route::get('/weixin/order/all','weixin\orderController@getAllOrder');
Route::get('/weixin/order/all/{status}','weixin\orderController@getAllOrder');

Route::get('/weixin/order/{orderNo}','weixin\orderController@orderDetail');


//后台管理
Route::get('/weixin/admin','weixin\admin\productController@index');


//后台商品管理////
Route::get('/weixin/admin/product','weixin\admin\productController@manageProduct');

//添加新的商品
Route::get('/weixin/admin/product/add','weixin\admin\productController@newProduct');
//商品表单提交
Route::post('/weixin/admin/product/add','weixin\admin\productController@addProduct');

//添加商品属性
Route::get('/weixin/admin/product/addProductSpec/{productId}','weixin\admin\productController@newProductSpecs');
//商品属性表单提交
Route::post('/weixin/admin/product/addProductSpec','weixin\admin\productController@addProductSpecs');


//添加商品图片
Route::get('/weixin/admin/product/addImage/{productId}','weixin\admin\productController@addProductImages');


//编辑产品
Route::get('/weixin/admin/product/edit/{productId}','weixin\admin\productController@editProduct');
Route::post('/weixin/admin/product/edit','weixin\admin\productController@updateProduct');

Route::get('/weixin/admin/product/editProductSpec/{productId}','weixin\admin\productController@editProductSpecs');
Route::post('/weixin/admin/product/editProductSpec','weixin\admin\productController@updateProductSpecs');

Route::post('/weixin/admin/loadSpecs','weixin\admin\productController@loadSpecs');



//上传图片
Route::post('/weixin/uploadImage','Service\CommonController@uploadImage');
//删除图片
Route::post('/wexin/deleteImage','Service\CommonController@deleteImage');

Route::post('/weixin/setImageCover','Service\CommonController@setImageCover');





///后台订单管理//////
Route::get('/weixin/admin/order','weixin\admin\orderController@manageOrder');
Route::get('/weixin/admin/order/today','weixin\admin\orderController@todayOrder');
Route::get('/weixin/admin/order/{orderNo}','weixin\admin\orderController@orderDetail');


//后台用户管理
Route::get('/weixin/admin/user','weixin\admin\userController@manageUser');
Route::get('/weixin/admin/user/{userId}','weixin\admin\userController@userDetail');

////加载产品类别
//
//Route::post('/weixin/loadCategory','Service\CommonController@loadCategory');
//Route::post('/weixin/loadBrand','Service\CommonController@loadBrand');


Route::get('/weixin/Pudding','weixin\productController@PuddingList');




