<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    echo date('Y-m-d H:i:s');
    //return view('welcome');
});

Route::get('/adduser','User\UserController@add');

//路由跳转
Route::redirect('/hello1','/world1',301);
Route::get('/world','Test\TestController@world1');

Route::get('hello2','Test\TestController@hello2');
Route::get('world2','Test\TestController@world2');


//路由参数
Route::get('/user/test','User\UserController@test');
//Route::get('/user/{uid}','User\UserController@user');
Route::get('/month/{m}/date/{d}','Test\TestController@md');
Route::get('/name/{str?}','Test\TestController@showName');



// View视图路由
Route::view('/mvc','mvc');
Route::view('/child','/test/child');
Route::view('/error','error',['code'=>40300]);


// Query Builder
Route::get('/query/get','Test\TestController@query1');
Route::get('/query/where','Test\TestController@query2');


//Route::match(['get','post'],'/test/abc','Test\TestController@abc');
Route::any('/test/abc','Test\TestController@abc');


Route::get('/view/test1','Test\TestController@viewTest1');
Route::get('/view/test2','Test\TestController@viewTest2');


//用户注册
Route::get('/userreg','User\UserController@reg');
Route::post('/userreg','User\UserController@doReg');

//用户登录
Route::get('/userlogin','Login\LoginController@login_reg');
Route::post('/userlogin','Login\LoginController@doLogin');

//个人主页
Route::get('/user/center','User\UserController@center');

//购物车
//购物车
//Route::get('/cart','Cart\IndexController@index')->middleware('check.uid');
Route::get('/cart','Cart\IndexController@index')->middleware('check.login.token');
Route::get('/cart/add/{goods_id}','Cart\IndexController@add');      //添加商品
Route::post('/cart/add2','Cart\IndexController@add2');      //添加商品
Route::get('/cartdel/{goods_id}','Cart\IndexController@del')->middleware('check.login.token');
Route::get('/cartdel2/{goods_id}','Cart\IndexController@del2')->middleware('check.login.token');

Route::get('/goods/{goods_id}','Goods\IndexController@index');
Route::get('/goodslist','Goods\IndexController@show');


//购物车的展示
Route::get('/cartList','Cart\IndexController@show');

// 订单 添加
Route::get('/orderadd','Order\IndexController@add');
//订单展示
Route::get('/orderlist','Order\IndexController@show');
//删除订单
Route::get('/orderdel/{oid}','Order\IndexController@del');


//订单支付
Route::get('/Pay/{oid}','Pay\AlipayController@pay')->middleware('check.login.token');         //订单支付



//支付
Route::get('/payorder','Pay\IndexController@order')->middleware('check.login.token');         //订单支付

Route::post('/pay/alipay/notify','Pay\AlipayController@aliNotify');        //支付宝支付 异步通知回调
Route::get('/pay/alipay/return','Pay\AlipayController@aliReturn');        //支付宝支付 同步通知回调


//微信
Route::get('/weixin/test','Weixin\WeixinController@test');
Route::get('/weixin/valid','Weixin\WeixinController@validToken');
Route::get('/weixin/valid1','Weixin\WeixinController@validToken1');
Route::post('/weixin/valid1','Weixin\WeixinController@wxEvent');        //接收微信服务器事件推送
Route::post('/weixin/valid','Weixin\WeixinController@validToken');

Route::get('/weixin/create_menu','Weixin\WeixinController@createMenu');     //创建菜单
Route::any('/all','Weixin\WeixinController@all');//q群发


//素材
Route::get('/form/show','Weixin\WeixinController@formShow');     //表单测试
Route::post('/form/test','Weixin\WeixinController@formTest');     //表单测试


Route::get('/Weixin/material/list','Weixin\WeixinController@materialList');     //获取永久素材列表
Route::get('/Weixin/material/upload','Weixin\WeixinController@upMaterial');     //上传永久素材
Route::post('/Weixin/material','Weixin\WeixinController@materialTest');     //创建菜单


//微信聊天
Route::get('/kefu/show/{id}','Weixin\WeixinController@kefu');     //客服测试
Route::get('/kefu/chat','Weixin\WeixinController@chat');     //聊天测试
Route::post('/chat/msg','Weixin\WeixinController@chatmsg');  //客服发送消息

//微信支付
Route::get('/weixin/pay/test/{id}','Weixin\PayController@test');     //微信支付测试
Route::post('/weixin/pay/notice','Weixin\PayController@notice');     //微信支付通知回调
Route::get('/weixin/pay/success','Weixin\PayController@success');//


//微信登录
Route::get('/weixin/login','Weixin\WeixinController@login');        //微信登录
Route::get('/weixin/getcode','Weixin\WeixinController@getCode');        //接收code


//微信 JSSDK

Route::get('/weixin/jssdk/test','Weixin\WeixinController@jssdkTest');       // 测试