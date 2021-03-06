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



//微信注册登录
Route::get('auth/login','Auth\AuthController@getLogin');

Route::post('auth/login','Auth\AuthController@postLogin');

Route::get('auth/register','Auth\AuthController@getRegister');

Route::post('auth/register','Auth\AuthController@Register');

Route::get('auth/logout','Auth\AuthController@getLogout');

Route::get('auth/resetPassword','Auth\PasswordController@resetPassword');
Route::post('auth/setPassword','Auth\PasswordController@setPassword');

Route::get('weixin','weixin\homeController@index');
Route::get('/','weixin\homeController@index');
Route::get('/home','weixin\homeController@index');



//手机站个人中心

Route::get('weixin/member','weixin\memberController@home');

Route::post('/weixin/member/addPic','weixin\memberController@addPic');

Route::post('/weixin/member/DelUserHeadImg','weixin\memberController@DelUserHeadImg');

//手机站产品分类

Route::get('weixin/product/sellCategory/{type}','weixin\productController@getSellCategory');
//Route::get('weixin/category','weixin\productController@toCategory');

//手机站产品中心

Route::get('weixin/product/{productId}','weixin\productController@showProduct');
Route::post('/weixin/checkProductLimit','weixin\productController@checkProductLimit');



//手机站购物车
Route::get('weixin/cart','weixin\cartController@show');// ['middleware' => '','uses' => ]);
Route::post('weixin/addToCart/', 'weixin\cartController@addToCart');
Route::any('weixin/getCartCookie', 'weixin\cartController@getCartCookie');
Route::post('weixin/deleteFromCart',  'weixin\cartController@deleteFromCart');
Route::post('weixin/updateOrderDateTime',  'weixin\cartController@updateOrderDateTime');
Route::post('weixin/updateSelectedStore',  'weixin\cartController@updateSelectedStore');



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
Route::post('/weixin/cancelOrder','weixin\orderController@cancelOrder');
Route::post('/weixin/generateOrder', 'weixin\orderController@generateOrder');

Route::get('/weixin/order/all','weixin\orderController@getAllOrder');
Route::get('/weixin/order/all/{status}','weixin\orderController@getAllOrder');

Route::get('/weixin/order/{orderNo}','weixin\orderController@orderDetail');



//后台管理

Route::group(['prefix' => '/weixin/admin/', 'middleware' => 'App\Http\Middleware\AdminAuthenticate'], function() {

    Route::get('','weixin\admin\homeController@index' );

    Route::get('userAdmin','weixin\admin\UserAdminController@index');

    Route::post('useradmin/getRole','weixin\admin\UserAdminController@getRole');

    Route::post('useradmin/editOraddUserAdmin','weixin\admin\UserAdminController@editOraddUserAdmin');

    Route::get('order/StockingPage','weixin\admin\orderController@StockingPage');

    Route::get('Statement','weixin\admin\orderController@Statement');

    Route::post('order/seachStatementData','weixin\admin\orderController@seachStatementData');

    Route::post('order/check_Real_One','weixin\admin\orderController@check_Real_One');

    Route::post('order/check_All_Real','weixin\admin\orderController@check_All_Real');

    Route::get('order/seachUser','weixin\admin\userController@seachUser');

    Route::get('checkOrder/{order_no?}','weixin\admin\orderController@checkOrder');

    Route::post('permission/addPermission','weixin\admin\PermissionController@addPermission');

    Route::get('UserGroup','weixin\admin\PermissionController@UserGroup');

    Route::post('permissions/updateOraddRole','weixin\admin\PermissionController@updateOraddRole');

    Route::post('permissions/delRole','weixin\admin\PermissionController@delRole');

    Route::get('permission/UserGroupPermission/{id?}','weixin\admin\PermissionController@UserGroupPermission');

    Route::post('permission/PermissionRole','weixin\admin\PermissionController@PermissionRole');

});





// Route::get('/weixin/admin', ['middleware'=>'App\Http\Middleware\AdminAuthenticate'] ,'weixin\admin\homeController@index');
Route::post('/weixin/admin/getChartData','weixin\admin\homeController@getChartData');

Route::get('/weixin/admin/DataFill','weixin\admin\DataFillController@index');

Route::post('/weixin/admin/datafill/getTableStructure','weixin\admin\DataFillController@getTableStructure');

Route::post('/weixin/admin/datafill/submitTableStructure','weixin\admin\DataFillController@submitTableStructure');


//后台商品管理////
Route::any('/weixin/admin/product','weixin\admin\productController@manageProduct');
//Route::get('/weixin/admin/product/rank','weixin\admin\productController@productRank');
Route::any('/weixin/admin/product/rank/{order?}','weixin\admin\productController@productRank');


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

Route::post('/weixin/admin/product/changeStatus','weixin\admin\productController@changeStatus');

//搜索产品
Route::post('/weixin/admin/product/seachProduct','weixin\admin\productController@seachProduct');



//上传图片
Route::post('/weixin/uploadImage','Service\CommonController@uploadImage');
//删除图片
Route::post('/wexin/deleteImage','Service\CommonController@deleteImage');

Route::post('/weixin/setImageCover','Service\CommonController@setImageCover');





///后台订单管理//////
Route::any('/weixin/admin/order','weixin\admin\orderController@manageOrder');
Route::get('/weixin/admin/order/today','weixin\admin\orderController@todayOrder');
Route::post('/weixin/getOrderNotification','weixin\admin\orderController@getOrderNotification');



//Route::post('/weixin/admin/order/seachOrder','weixin\admin\orderController@seachOrder');
Route::get('/weixin/admin/order/seachOrder','weixin\admin\orderController@seachOrder');
Route::get('/weixin/admin/order/{orderNo}','weixin\admin\orderController@orderDetail');


//后台用户管理
Route::any('/weixin/admin/user','weixin\admin\userController@manageUser');
Route::get('/weixin/admin/user/{userId}','weixin\admin\userController@userDetail');

////加载产品类别
//
//Route::post('/weixin/loadCategory','Service\CommonController@loadCategory');
//Route::post('/weixin/loadBrand','Service\CommonController@loadBrand');


Route::get('/weixin/CateProList/{id}','weixin\productController@CateProList');

Route::get('/weixin/admin/category','weixin\admin\categoryController@categoryList');

Route::post('/weixin/admin/category/getCategory','weixin\admin\categoryController@getCategory');

Route::post('/weixin/admin/category/updateOraddCategory','weixin\admin\categoryController@updateOraddCategory');

Route::get('/weixin/admin/category/add','weixin\admin\categoryController@add');

Route::post('/weixin/admin/category/delCategory','weixin\admin\categoryController@del');

Route::get('/weixin/admin/categorySpec','weixin\admin\categoryController@categorySpecList');

Route::post('/weixin/admin/category/getAllCategoryNameInfo','weixin\admin\categoryController@getAllCategoryNameInfo');

Route::post('/weixin/admin/category/updateOraddSpecInfo','weixin\admin\categoryController@updateOraddSpecInfo');

Route::post('/weixin/admin/category/delSpecInfo','weixin\admin\categoryController@delSpecInfo');





//首页幻灯片设置
Route::get('/weixin/admin/manageHomeSlide','weixin\admin\settingController@manageHomeSlide');
Route::get('/weixin/admin/editHomeSlide','weixin\admin\settingController@editHomeSlide');
Route::post('/weixin/admin/setting/updateSlide','weixin\admin\settingController@updateSlide');
Route::post('/weixin/admin/setting/deleteSlide','weixin\admin\settingController@deleteSlide');


//门店列表
Route::get('/weixin/store','weixin\storeController@index');

//后台门店管理
Route::get('weixin/admin/store','weixin\admin\storeController@index');
Route::post('/weixin/admin/store/updateOraddStore','weixin\admin\storeController@updateOraddStore');
Route::post('/weixin/admin/category/delStore','weixin\admin\storeController@delStore');

Route::get('/weixin/testMapApi','weixin\storeController@MapApi');
Route::get('/weixin/getJW','weixin\storeController@getJW');


//权限管理

Route::get('/weixin/admin/Permission','weixin\admin\PermissionController@index');

Route::post('weixin/admin/Addpermission','weixin\admin\PermissionController@AddPermission');

Route::get('weixin/admin/login','weixin\admin\homeController@loginPage');

Route::post('/weixin/admin/Sign','weixin\admin\homeController@login');

Route::get('/weixin/admin/logout','weixin\admin\homeController@Logout');
