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
Route::get('/test', function () {
    $users = app(\App\Models\User::class)->find(225);
    $users->load("grades");
    return json_encode($users);
});
Route::post('register', 'FreeAPIController@register');

Route::post('upload', 'UploadController@upload');

//Route::post('orders.stores', 'OrderAPIController@store');
Route::get('orders.shows/{id}', 'OrderAPIController@show');

Route::group(['middleware' => 'api-auth'], function () {
    Route::get('login_info', function () {
        return Auth::user()->load([
            'superior',
            'subordinates',
            'grade',
            'store',
            'grades'
        ]);
    });
    /**
     * 用户拥有
     */
    //卡片
    Route::get('cards.user', function (){
        $user = Auth::user();
        $user->load('cards');
        return Response::json(\InfyOm\Generator\Utils\ResponseUtil::makeResponse('优惠券获取成功', $user));
    });
    //证书
    Route::get('certs.user', function (){
        $user = Auth::user();
        $user->load('certs');
        return Response::json(\InfyOm\Generator\Utils\ResponseUtil::makeResponse('证书获取成功', $user));
    });
    //勋章
    Route::get('medals.user', function (){
        $user = Auth::user();
        $user->load('medals');
        return Response::json(\InfyOm\Generator\Utils\ResponseUtil::makeResponse('勋章获取成功', $user));
    });
    //树
    Route::get('saplings.user', function (){
        $user = Auth::user();
        $user->load('saplings','saplingsSmall');
        return Response::json(\InfyOm\Generator\Utils\ResponseUtil::makeResponse('树苗获取成功', $user));
    });
    //抽奖
    Route::get('medals.gains', 'MedalAPIController@gains');
    /**
     * 勋章兑换
     */
    Route::get('medals.exchange', function (){
        $user = Auth::user();
        $modals = optional($user)->medals??[];
        $flag = true;
        $log_arr = array();
        if (sizeof($modals) < 4)
            $flag = false;
        foreach ($modals as $modal){
            $num = $modal->pivot->medal_num;
            if ($num <= 0){
                $flag = false;
                break;
            }
            array_push($log_arr,$modal->id);
        }
        if (!$flag)
            return Response::json(\InfyOm\Generator\Utils\ResponseUtil::makeError('勋章不足'), 401);
        foreach ($log_arr as $k=>$v){
            $medal = DB::table('medal_user')->find($v);
            if (!empty($medal))
                \DB::table('medal_user')->where('id',$medal->id)->update(['medal_num'=>($medal->medal_num-1),'updated_at'=>date('Y-m-d H:i:s')]);
        }
        /**
         * 添加/修改 兑换券(面膜)
         */
        $cards = \DB::table('card_user')->where([['user_id'=>$user->id],['card_id'=>2]])->first();
        if (!empty($cards)){
            \DB::table('card_user')->where('id',$cards->id)->update(['card_num'=>($cards->card_num+1),'updated_at'=>date('Y-m-d H:i:s')]);
        }else{
            $card = \App\Models\Card::find(2);
            $data = array('user_id'=>$user->id,
                'card_id'=>1,'price'=>$card->price,'product_num'=>$card->product_num,
                'product_id'=>$card->product_id,'card_num'=>1,'created_at'=>date('Y-m-d H:i:s'));
            \DB::table('card_user')->insert($data);
        }
        return Response::json(\InfyOm\Generator\Utils\ResponseUtil::makeResponse('兑换成功', $user));
    });

    Route::resource('rebates', 'RebateAPIController');
    Route::get('rebates.statistics', 'RebateAPIController@statistics');

    Route::resource('addresses', 'AddressAPIController');
    Route::resource('saplings', 'SaplingAPIController');
    Route::resource('orders', 'OrderAPIController');

    Route::resource('gifts', 'GiftAPIController');
//    Route::get('orders.store', 'OrderAPIController@storeOrders');
    Route::get('orders.statistics', 'OrderAPIController@statistics');

    Route::resource('account_flows', 'AccountFlowAPIController');

    Route::resource('withdraws', 'WithdrawAPIController');

    Route::get('wechat.order/{id}', 'WeChatAPIController@order');
    Route::post('wechat.balance/{amount}', 'WeChatAPIController@balance');
    Route::get('wechat.qrcode', 'WeChatAPIController@regisetQrcode');

    Route::resource('testings', 'TestingAPIController');

    Route::resource('maintains', 'MaintainAPIController');

    Route::resource('exchangelogs', 'ExchangelogAPIController');

    //自己加入的团
    Route::get('tourists.user', function (){
        $user = Auth::user();
        $user->load('tourists');
        return Response::json(\InfyOm\Generator\Utils\ResponseUtil::makeResponse('用户旅游信息取成功', $user));
    });
    //获取所有团
    Route::resource('tourists', 'TouristAPIController');

    Route::resource('applications', 'ApplicationAPIController');

    //用户加入旅游团  带order_id:购买路线订单id  id:团id
    Route::get('tourists.add/{id}', 'TouristAPIController@user');
    //路线
    Route::resource('routes', 'RouteAPIController');
});
Route::resource('saplings', 'SaplingAPIController');

Route::resource('maintains1', 'MaintainAPIController');

Route::get('wechat.query_balance_order/{tradeNo}', 'WeChatAPIController@queryBalanceOrder');

Route::get('users_tree/{id}', 'UserAPIController@tree');

Route::get('rebates.district', 'RebateAPIController@district');

Route::resource('users', 'UserAPIController');

Route::resource('articles', 'ArticleAPIController');

Route::resource('visions', 'VisionAPIController');

Route::resource('expresses', 'ExpressAPIController');

Route::resource('article_categories', 'ArticleCategoryAPIController');

Route::resource('system_configs', 'SystemConfigAPIController');

Route::resource('brands', 'BrandAPIController');

Route::resource('grades', 'GradeAPIController');

Route::resource('products', 'ProductAPIController');

Route::resource('stores', 'StoreAPIController');


Route::resource('standards', 'StandardAPIController');

Route::resource('cates', 'CateAPIController');

Route::resource('product_categories', 'ProductCategoryAPIController');


Route::resource('barters', 'BarterAPIController');

Route::resource('visitors', 'VisitorAPIController');

Route::resource('cards', 'CardAPIController');

Route::resource('certs', 'CertAPIController');

Route::resource('medals', 'MedalAPIController');



//Route::resource('tourists', 'TouristAPIController');




