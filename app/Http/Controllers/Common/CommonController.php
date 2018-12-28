<?php
/**
 * Created by PhpStorm.
 * User: SX
 * Date: 2017/12/26
 * Time: 14:20
 */

namespace App\Http\Controllers\Common;

use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CommonController extends AppBaseController
{
    public function alisms(Request $request)
    {
        if ($request->isMethod('get')) {
            return $this->sendResponse(Redis::hgetall('ygx_alisms'), '获取成功');

        }
        $validator = \Validator::make($request->all(), [
            'key' => 'required',
            'secretkey'=> 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 400);
        }

        Redis::hset('ygx_alisms', 'key', $request->post('key'));
        Redis::hset('ygx_alisms', 'secretkey', $request->post('secretkey'));

        return $this->sendResponse(Redis::hgetall('ygx_alisms'), '设置成功');
    }
}