<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = \request()->get('type',1);
        $count = $_COOKIE['count']??0;
        $count_num = $_COOKIE['count_num']??0;
        $date = \Carbon\Carbon::now();
        $subday1 = date('Y-m-d',strtotime('-7 day'));
        $addday1 = date('Y-m-d',strtotime('+1 day'));
        $now1 = $date->copy()->addDay(1);
        $copy1 = $date->copy()->subDay(7);
        $list1 = array();
        $list2 = array();
        $orders1 =
            Order::whereBetween('created_at',[$copy1->year.'-'.$copy1->month.'-'.$copy1->day.' 00:00:00',$now1->year.'-'.$now1->month.'-'.$now1->day.' 00:00:00'])
                ->orWhereBetween('deal_time',[$subday1.' 00:00:00',$addday1.' 00:00:00'])->where('status','!=',5)->get();
        $orders1->load('cates');
        $dayList = [date('m-d'),date('m-d',strtotime('-1 day')),date('m-d',strtotime('-2 day'))
            ,date('m-d',strtotime('-3 day')),date('m-d',strtotime('-4 day'))
            ,date('m-d',strtotime('-5 day')),date('m-d',strtotime('-6 day'))];
        $orders1->map(function($order) use ($date,&$list1,&$list2,$dayList){
            $dates = date('m-d',strtotime($order->created_at));
            $dates1 = date('m-d',strtotime($order->deal_time));
            //                num1: 2666,//交易量
            //                money1: 2647,//交易额
            if (in_array($dates,$dayList)) {
                if (!isset($list1[$dates])) {
                    $array = array();
                    $array['num1'] = sizeof($order->cates) > 0 ? sizeof($order->cates) : 1;
                    $array['money1'] = $order->amount;
                    $array['time'] = $dates;
                    $list1[$dates] = $array;
                } else {
                    $list1[$dates]['num1'] += (sizeof($order->cates) > 0 ? sizeof($order->cates) : 1);
                    $list1[$dates]['money1'] += $order->amount;
                }
            }

            //                num2: null,//成交量
            //                money2: 425//成交额
            if (!empty($order->deal_time) && in_array($dates1,$dayList)) {
                if (!isset($list2[$dates1])) {
                    $array = array();
                    $array['num2'] = sizeof($order->cates) > 0 ? sizeof($order->cates) : 1;
                    $array['money2'] = $order->amount;
                    $array['time'] = $dates1;
                    $list2[$dates1] = $array;
                } else {
                    $list2[$dates1]['num2'] += (sizeof($order->cates) > 0 ? sizeof($order->cates) : 1);
                    $list2[$dates1]['money2'] += $order->amount;
                }
            }
            return $order;
        });
        array_reverse($dayList);
        array_map(function($value) use(&$list1,&$list2){
            if(!isset($list1[$value]))
                $list1[$value] = array();
            if(!isset($list2[$value]))
                $list2[$value] = array();
            return $value;
        },$dayList);
//        array_reverse($list1);
//        array_reverse($list2);
        if (0 == $count_num || 0 == $count) {
                $count_num = 0;
                $count = 0;
            $users = User::get()->map(function ($user) use (&$count, &$count_num) {
                $grades = $user->grades;
                foreach ($grades as $grade) {
                    if ($grade->pivot->type == 2) {
                        \Log::info('grades::'.json_encode($grade));
//                        if (!(0 === $count))
                            $count_num++;
                        if ($grade->pivot->status == 0)
                            $count++;
                    }
                }
                return $user;
            });
            setcookie('count',$count,time()+24*60*60-20,'/');
            setcookie('count_num',$count_num,time()+24*60*60-20,'/');
        };
        $now = Carbon::now();
        $copy = $now->copy();
        \Log::info('type::'.$type);
//        当天
        if($type == 1){
            $dayList = [date('Y-m-d')];
            $subday = date('Y-m-d',strtotime('-1 day'));
            $addday = date('Y-m-d',strtotime('+1 day'));
            $orders =
                Order::whereYear('created_at',$copy->year)->whereMonth('created_at',$copy->month)->whereDay('created_at',$copy->day)
                    ->orWhereBetween('deal_time',[$subday.' 00:00:00',$addday.' 00:00:00'])->where('status','!=',5)->get();
            $orders->load('cates');
            $users = $orders->pluck('user_id')->toArray();
            $list = array();
            array_map(function($id) use (&$list){
                if (in_array($id,$list))
                    return true;
                array_push($list,$id);
                return $id;
            },$users);
        }
//        昨天
        if($type == -1){
            $dayList = [date('Y-m-d',strtotime('-1 day'))];
            $subday = date('Y-m-d',strtotime('-1 day'));
            $addday = date('Y-m-d',strtotime('+1 day'));
            $copy = $copy->subDay(1);
            $orders =
                Order::whereYear('created_at',$copy->year)->whereMonth('created_at',$copy->month)->whereDay('created_at',$copy->day)
                    ->orWhereBetween('deal_time',[$subday.' 00:00:00',$addday.' 00:00:00'])->where('status','!=',5)->get();
            $orders->load('cates');
            $users = $orders->pluck('user_id')->toArray();
            $list = array();
            array_map(function($id) use (&$list){
                if (in_array($id,$list))
                    return true;
                array_push($list,$id);
                return $id;
            },$users);
        }
//        近7天
        if($type == 7){
            $dayList = [date('Y-m-d'),date('Y-m-d',strtotime('-1 day')),date('Y-m-d',strtotime('-2 day'))
                ,date('Y-m-d',strtotime('-3 day')),date('Y-m-d',strtotime('-4 day'))
                ,date('Y-m-d',strtotime('-5 day')),date('Y-m-d',strtotime('-6 day'))];
            $subday = date('Y-m-d',strtotime('-7 day'));
            $addday = date('Y-m-d',strtotime('+1 day'));
            $now = $now->addDay(1);
            $copy = $copy->subDay(7);
            $orders =
                Order::whereBetween('created_at',[$copy->year.'-'.$copy->month.'-'.$copy->day.' 00:00:00',$now->year.'-'.$now->month.'-'.$now->day.' 00:00:00'])
                    ->orWhereBetween('deal_time',[$subday.' 00:00:00',$addday.' 00:00:00'])->where('status','!=',5)->get();
            $orders->load('cates');
            $users = $orders->pluck('user_id')->toArray();
            $list = array();
            array_map(function($id) use (&$list){
                if (in_array($id,$list))
                    return true;
                array_push($list,$id);
                return $id;
            },$users);
        }
//        本月
        if($type == 31){
            $k = 0;
            $dayList = [];
            for($i = $now->copy()->day;$i >= 1;$i--){
                array_push($dayList,date('Y-m-d',strtotime('-'.$k++.' day')));
            }
            $addday = date('Y-m',strtotime('+1 month'));
            $orders =
                Order::whereYear('created_at',$copy->year)->whereMonth('created_at',$copy->month)->where('status','!=',5)
                    ->orWhereBetween('deal_time',[date('Y-m').'-01 00:00:00',$addday.'-01 00:00:00'])->get();
            $orders->load('cates');
            $users = $orders->pluck('user_id')->toArray();
            $list = array();
            array_map(function($id) use (&$list){
                if (in_array($id,$list))
                    return true;
                array_push($list,$id);
                return $id;
            },$users);
        }

        $products = Product::where('status',1)->orderBy('sort','desc')->paginate(5);
        return view('home')->with(['count'=>$count,
            'count_num'=>$count_num,'products'=>$products,'type'=>$type,
            'orders'=>$orders,'uLists'=>sizeof($list)>0?$list:[1],
            'list1' => array_reverse($list1),'list2' => array_reverse($list2),
            'dayList' => array_reverse($dayList),
        ]);
    }



}

    
