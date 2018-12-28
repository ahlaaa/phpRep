<?php
/**
 * Created by PhpStorm.
 * User: huangming
 * Date: 2018/4/28
 * Time: 13:33
 */

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use EasyWeChat;
use Intervention\Image\Facades\Image;

class MiniProgramController extends BaseController
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        $miniProgram = EasyWeChat::miniProgram();

        return $miniProgram->server->serve();
    }

    public function userList()
    {
//        $miniProgram = EasyWeChat::miniProgram();
//
//        dd($miniProgram->data_cube->visitDistribution("2017-06-11", "2017-06-17"));
////        return $miniProgram->userPortrait("2017-06-11", "2018-06-11");
////
////        // dd(($miniProgram->auth->session(1)));
//        return $miniProgram->user->list();
    }

    public function code(Request $request)
    {
        $miniProgram = EasyWeChat::miniProgram();

        return $miniProgram->auth->session($request->post('code'));

    }

    public function customerService(Request $request)
    {
        if ($request->isMethod('get')) {
            return $request->get('echostr');
        }
        $img = Image::make(public_path() .'/image/background0.png')->resize(600, 800);

        $text = function ($font) {

            $font->file(public_path().'/fonts/simsun.ttc');

            $font->size(32);

            $font->valign('bottom');

            $font->color('#333333');
        };

        $img->text('扫码加我微信，随时聊一聊', 110, 110, $text);
        $img->text('长按二维码  扫一扫', 150, 720, $text);

        $qrcode = public_path('/') . $request->post('qrcode');

        $erweimaimage = Image::make($qrcode)->resize(450, 450);

        $img->insert($erweimaimage, 'bottom', 0, 150);

        $imgName = public_path('/image/qrcode/') . uniqid() . '.jpg';

        $img->save($imgName);

        $miniProgram = EasyWeChat::miniProgram();

        $media = $miniProgram->media->uploadImage($imgName);
//
        $message = new EasyWeChat\Kernel\Messages\Image($media['media_id']);
//
        return $miniProgram->customer_service->message($message)
            //->to($request->post('openid'))
            ->to($request->post('openid'))
            ->send();

    }

    public function appCode(Request $request)
    {
        $app = EasyWeChat::miniProgram();

        $response = $app->app_code->get($request->get('path')??'/pages/index/index', [
            'width' => $request->get('width', 600),
        ]);
        $imgPath = public_path('/image/app_code/');
        $filename = $response->saveAs($imgPath,  uniqid() . '.png');
        return 'image/app_code/' . $filename;

    }

}