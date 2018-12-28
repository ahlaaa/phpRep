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

//Route::resource('products1', 'ProductController');
//use Illuminate\Support\Facades\Redis;
use App\Models\Card;

Route::post('upload', 'Common\UploadController@upload');
Route::post('upload.delete', 'Common\UploadController@delete');

Route::any('wechat', 'Common\WeChatController@serve');
Route::get('wechat.oauth', 'Common\WeChatController@oauth');
Route::post('wechat.login', 'Common\WeChatController@login');
Route::get('wechat.code', 'Common\WeChatController@code');
Route::get('wechat.js_bridge/{prepayId}', 'Common\WeChatController@jsBridge');
Route::get('wechat.jssdk/{prepayId}', 'Common\WeChatController@jssdk');
Route::post('wechat.notify', 'Common\WeChatController@notify');
Route::get('alipay.transfer', 'Common\AliPayController@transfer');
Route::get('alipay.notify', 'Common\AliPayController@notify');
Route::get('alipay.return', 'Common\AliPayController@return');

Route::post('/mini_program/app_code', 'Common\MiniProgramController@appCode');
Route::post('/mini_program/code', 'Common\MiniProgramController@code');
Route::post('/mini_program/fromId', 'Common\MiniProgramController@fromId');


Route::get('/sms/code', 'Common\SmsController@index');


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/block', 'HomeController@block');
    Route::get('/ajaxblock', 'HomeController@ajax');

    Route::get('/admin', 'HomeController@index');


    Route::name('users.password')->any('password/{id}', 'UserController@password');

    Route::name('users.tree')->get('tree/{id}', 'UserController@tree');
//    Route::get('users.tags',function(){
//        return view('tags.index');
//    });

    Route::resource('users', 'UserController');

    Route::resource('maintains', 'MaintainController');

    Route::resource('tags', 'TagController');

    Route::resource('articles', 'ArticleController');

    Route::resource('orders', 'OrderController');

    Route::resource('addresses', 'AddressController');

    Route::resource('expresses', 'ExpressController');

    Route::resource('articleCategories', 'ArticleCategoryController');

    Route::resource('systemConfigs', 'SystemConfigController');

    Route::resource('brands', 'BrandController');

    Route::resource('rebates', 'RebateController');

    Route::resource('accountFlows', 'AccountFlowController');

    Route::resource('grades', 'GradeController');

    Route::resource('products', 'ProductController');
    Route::post('products.change', 'ProductController@change');
    Route::get('products.trash', 'ProductController@trash');
    Route::get('products.untrash/{id}', 'ProductController@untrash');

    Route::resource('stores', 'StoreController');

    Route::resource('standards', 'StandardController');

    Route::resource('productCategories', 'ProductCategoryController');

    Route::resource('administrators', 'AdministratorController');

    Route::name('administrators.password')->any('admin_password/{id}', 'AdministratorController@password');

    Route::resource('points', 'PointController');


    Route::resource('withdraws', 'WithdrawController');

    Route::resource('barters', 'BarterController');

    Route::resource('visitors', 'VisitorController');

    Route::resource('testings', 'TestingController');

    Route::resource('cards', 'CardController');

    Route::resource('syscerts', 'CertController');

    Route::resource('medals', 'MedalController');

    Route::resource('gifts', 'GiftController');

    Route::get("tourists.out/{id}","TouristController@out");
});

Route::resource('tourists', 'TouristController');
Route::resource('routes', 'RouteController');

Route::resource('saplings', 'SaplingController');

Route::resource('exchangelogs', 'ExchangelogController');

Route::resource('applications', 'ApplicationController');

Route::resource('chlog', 'LogController');//war4bala
Route::get('/war4bala', function(){
    $stores = app(\App\Models\Store::class)->where("balance","<=",50)->paginate(15);
    // return json_encode($stores);
    return view('stores.index')
            ->with('stores', $stores);
});
