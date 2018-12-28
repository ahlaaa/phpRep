<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/12/15
 * Time: 15:39
 */

namespace App\Http\Controllers\Common;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

class SmsController extends AppBaseController
{
    public function index(Request $request){
        $input = $request->input();
        $mobile = array_get($input,'telephone');
        $code = random_int(1000,9999);
//        $in_valid = $_COOKIE['jmy_tel_code']??null;
//        if (!empty($in_valid))
//            return $this->sendResponse($in_valid, '验证码获取成功');
        $result = $this->sendSms($mobile,$code);
        if ($result->code != 0)
            return $this->sendError($result->msg,422);
        setcookie('jmy_tel_code',$code,time()+30000);
        return $this->sendResponse($code, '验证码获取成功');
    }

    private function sendSms($mobile,$code){
        $uri2 = 'http://api.1cloudsp.com/api/v2/single_send?accesskey=6eVfMiKlLZSwcfQ5&secret=2aB0pCKWDAFMDxomVgbgR5di6mlWVtp7&sign=814&templateId=1026&mobile='.$mobile.'&content='.$code;
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $uri2);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
//    //显示获得的数据
//    print_r($data);
        return json_decode($data);
    }
}