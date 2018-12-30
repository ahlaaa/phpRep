<div class="row box-body">
    <?php
    $productClass = app(\App\Models\Product::class);
    $orderClass = app(\App\Models\Order::class);
    $maintainClass = app(\App\Models\Maintain::class);
    $userClass = app(\App\Models\User::class);
    $end = time();
    $chartList = sizeof($list1) > sizeof($list2)?$list1:$list2;
    ?>
    <div class="row box-body">
        <div class="col-sm-5 panel-body" style="min-height: 410px;">
            <p class="row">
                <span class="col-sm-4">近七日交易走势</span>
                <?php $d_list = array(date('m-d',strtotime("-6 day")),date('m-d',strtotime("-5 day")),date('m-d',strtotime("-4 day")),date('m-d',strtotime("-3 day")),date('m-d',strtotime("-2 day")),date('m-d',strtotime("-1 day")),date('m-d')); ?>
                <span class="col-sm-8">
                    <span><a style="color:#39a6f7;"><span class="glyphicon glyphicon-stop"></span></a>交易量</span>

                    <span><a style="color:#66cc00;"><span class="glyphicon glyphicon-stop"></span></a>成交量</span>

                    <span><a style="color:#f9a20a;"><span class="glyphicon glyphicon-stop"></span></a>交易额</span>

                    <span><a style="color:#ff0000;"><span class="glyphicon glyphicon-stop"></span></a>成交额</span>
                </span>
            </p>
            <p class="row">
            <div class="container-fluid">
                <div id="pad-wrapper">
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <h4 class="title"><?php echo date("Y"); ?></h4>
                        <div class="span12">
                            <div id="hero-area" style="height: 250px;"></div>
                        </div>
                    </div>

                </div>
            </div>
            </p>
        </div>
<!--        <div class="col-sm-6 panel-body" style="margin-left: 10px;min-height: 410px;padding-top: 50px;">-->
<!--            <div class="row panel-body" style="min-height: 110px;">-->
<!--                <div class="col-sm-3">-->
<!--                    <p class="row">-->
<!--                        <span class="col-sm-6"-->
<!--                              style="background: url('/images/首页/u165.svg') no-repeat center;height: 30px;"></span>-->
<!--                        <span class="col-sm-6 clearfix">-->
<!--                            -->
<!--                        </span>-->
<!--                    </p>-->
<!--                    <p class="pull-right">已售罄商品</p>-->
<!--                </div>-->
<!--                <div class="col-sm-3">-->
<!--                    <p class="row">-->
<!--                        <span class="col-sm-6"-->
<!--                              style="background: url('/images/首页/u173.svg') no-repeat center;height: 30px;"></span>-->
<!--                        <span class="col-sm-6 clearfix">-->
<!--                            -->
<!--                        </span>-->
<!--                    </p>-->
<!--                    <p class="pull-right">自营代发货订单</p>-->
<!--                </div>-->
<!--                <div class="col-sm-3">-->
<!--                    <p class="row">-->
<!--                        <span class="col-sm-6"-->
<!--                              style="background: url('/images/首页/u177.svg') no-repeat center;height: 30px;"></span>-->
<!--                        <span class="col-sm-6 clearfix">-->
<!--                            -->
<!--                        </span>-->
<!--                    </p>-->
<!--                    <p class="pull-right">自营维权中订单</p>-->
<!--                </div>-->
<!--                <div class="col-sm-3">-->
<!--                    <p class="row">-->
<!--                        <span class="col-sm-6"-->
<!--                              style="background: url('/images/首页/u174.svg') no-repeat center;height: 30px;"></span>-->
<!--                        <span class="col-sm-6 clearfix">0</span>-->
<!--                    </p>-->
<!--                    <p class="pull-right">待审核提现</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row panel-body" style="min-height: 110px;">-->
<!--                <div class="col-sm-3">-->
<!--                    <p class="row">-->
<!--                        <span class="col-sm-6"-->
<!--                              style="background: url('/images/首页/u175.svg') no-repeat center;height: 30px;"></span>-->
<!--                        <span class="col-sm-6 clearfix">-->
<!--                            -->
<!--                        </span>-->
<!--                    </p>-->
<!--                    <p class="pull-right">分销商总数</p>-->
<!--                </div>-->
<!--                <div class="col-sm-3">-->
<!--                    <p class="row">-->
<!--                        <span class="col-sm-6"-->
<!--                              style="background: url('/images/首页/u176.svg') no-repeat center;height: 30px;"></span>-->
<!--                        <span class="col-sm-6 clearfix">-->
<!--                            -->
<!--                        </span>-->
<!--                    </p>-->
<!--                    <p class="pull-right">待审核分销商</p>-->
<!--                </div>-->
<!--                <div class="col-sm-3">-->
<!--                    <p class="row">-->
<!--                        <span class="col-sm-6"-->
<!--                              style="background: url('/images/首页/u177.svg') no-repeat center;height: 30px;"></span>-->
<!--                        <span class="col-sm-6 clearfix">0</span>-->
<!--                    </p>-->
<!--                    <p class="pull-right">待审核佣金申请</p>-->
<!--                </div>-->
<!--                <div class="col-sm-3">-->
<!--                    <p class="row">-->
<!--                        <span class="col-sm-6"-->
<!--                              style="background: url('/images/首页/u179.svg') no-repeat center;height: 30px;"></span>-->
<!--                        <span class="col-sm-6 clearfix">0</span>-->
<!--                    </p>-->
<!--                    <p class="pull-right">待打款佣金申请</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <div class="row box-body">
        <div class="col-sm-6 panel-body" style="min-height: 430px;">
            <div class="row" style="border-bottom: 1px solid #ccc;">
                <span class="col-sm-3">订单概述</span>
                <span class="col-sm-2"></span>
                <span class="col-sm-7 pull-right">
                    <div class="row">
                        <span class="col-sm-3" style="max-height: 31px;">
                            <span><a class="<?php echo e((Request::is('home*')||Request::is('admin*'))&&request()->get('type',1)==1?'unclick':''); ?>"
                                     href="<?php echo url('home?type=1'); ?>">今日</a></span>
                            <br>
                            <span class="<?php echo e((Request::is('home*')||Request::is('admin*'))&&request()->get('type',1)==1?'btmc':''); ?>"></span>
                        </span>
                        <span class="col-sm-3">
                            <span><a class="<?php echo e((Request::is('home*')||Request::is('admin*'))&&request()->get('type',1)==-1?'unclick':''); ?>"
                                     href="<?php echo url('home?type=-1'); ?>">昨日</a></span>
                            <br>
                            <span class="<?php echo e((Request::is('home*')||Request::is('admin*'))&&request()->get('type',1)==-1?'btmc':''); ?>"></span>
                        </span>
                        <span class="col-sm-3">
                            <span><a class="<?php echo e((Request::is('home*')||Request::is('admin*'))&&request()->get('type',1)==7?'unclick':''); ?>"
                                     href="<?php echo url('home?type=7'); ?>">最近7日</a></span>
                            <br>
                            <span class="<?php echo e((Request::is('home*')||Request::is('admin*'))&&request()->get('type',1)==7?'btmc':''); ?>"></span>
                        </span>
                        <span class="col-sm-3">
                            <span><a class="<?php echo e((Request::is('home*')||Request::is('admin*'))&&request()->get('type',1)==31?'unclick':''); ?>"
                                     href="<?php echo url('home?type=31'); ?>">本月</a></span>
                            <br>
                            <span class="<?php echo e((Request::is('home*')||Request::is('admin*'))&&request()->get('type',1)==31?'btmc':''); ?>"></span>
                        </span>
                    </div>
                </span>
            </div>
            <div class="row" style="margin-top: 27%;text-align: center;">
                <?php
                    $deal_num = 0;
                    $all_nums = 0;
                    $deal_price = 0;
                    $all_price = 0;
                    foreach ($orders as $order){
                        $cates = sizeof($order->cates);
                        if($cates > 0){
                            if($order->status == 4) {
                                $deal_num += $cates;
                                $deal_price += $order->amount;
                            }
                            if (in_array(date('Y-m-d',strtotime($order->created_at)),$dayList))
                                $all_nums += $cates;
                        }else{
                            if($order->status == 4) {
                                $deal_num += 1;
                                $deal_price += $order->amount;
                            }
                            if (in_array(date('Y-m-d',strtotime($order->created_at)),$dayList))
                                $all_nums += 1;
                        }

                    }
                ?>
                <div class="col-sm-4">
                    <p style="color: #f9a20a;font-size: 25px;"><?php echo $deal_num.'/'.$all_nums; ?></p>
                    <p>成交量/交易量(件)</p>
                </div>
                <div class="col-sm-4">
                    <p style="color: #f9a20a;font-size: 25px;"><?php echo round($deal_price,2); ?>/<?php echo round($orders->sum('amount'),2); ?></p>
                    <p>成交额/交易额(元)</p>
                </div>
                <div class="col-sm-4">
                    <p style="color: #f9a20a;font-size: 25px;"><?php echo round(($orders->sum('amount'))/(sizeof($uLists)),2); ?></p>
                    <p>人均消费(元)</p>
                </div>
            </div>
        </div>
        <div class="col-sm-5 panel-body" style="margin-left: 10px;min-height: 430px;">
            <div class="row panel-body" style="border-bottom: 1px solid #ccc;">
                <span>商品销量排行</span>
            </div>
            <div class="row panel-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>排名</th>
                        <th>商品名称</th>
                        <th>成交数量</th>
                        <th>成交金额</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo $loop->index+1; ?></td>
                        <td class="spehidden"><?php echo $product->name; ?></td>
                        <td><?php echo $product->sort; ?></td>
                        <td><?php echo round($product->price*$product->sort,2); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('css'); ?>
<!-- bootstrap -->
<!--<link href="/chart/css/bootstrap/bootstrap.css" rel="stylesheet"/>-->
<!--<link href="/chart/css/bootstrap/bootstrap-responsive.css" rel="stylesheet"/>-->
<!--<link href="/chart/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet"/>-->

<!-- global styles -->
<!--<link rel="stylesheet" type="text/css" href="/chart/css/layout.css"/>-->
<link rel="stylesheet" type="text/css" href="/chart/css/elements.css"/>
<link rel="stylesheet" type="text/css" href="/chart/css/icons.css"/>

<!-- libraries -->
<link href="/chart/css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css"/>
<link href="/chart/css/lib/font-awesome.css" type="text/css" rel="stylesheet"/>
<link href="/chart/css/lib/morris.css" type="text/css" rel="stylesheet"/>

<!-- this page specific styles -->
<link rel="stylesheet" href="/chart/css/compiled/chart-showcase.css" type="text/css" media="screen"/>

<!-- open sans font -->
<!--<link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'-->
<!--      rel='stylesheet' type='text/css'/>-->

<!--[if lt IE 9]>
<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<!-- scripts for this page -->
<script src="/chart/js/jquery-latest.js"></script>
<!--<script src="/chart/js/bootstrap.min.js"></script>-->
<script src="/chart/js/jquery-ui-1.10.2.custom.min.js"></script>
<!-- knob -->
<script src="/chart/js/jquery.knob.js"></script>
<!-- flot charts -->
<script src="/chart/js/jquery.flot.js"></script>
<script src="/chart/js/jquery.flot.stack.js"></script>
<script src="/chart/js/jquery.flot.resize.js"></script>
<!-- morrisjs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/chart/js/morris.min.js"></script>
<!-- call all plugins -->
<script src="/chart/js/theme.js"></script>
<!-- build the charts -->
<script>
    var list = [];
    <?php $__currentLoopData = $chartList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    var k = ''+<?php echo json_encode($k); ?>,list1 = <?php echo json_encode($list1[$k]??[]); ?>,list2 = <?php echo json_encode($list2[$k]??[]); ?>;
    var datas = {
        'period': k,
        'num1': list1.num1,//交易量
        'num2': list2.num2,//成交量
        'money1': list1.money1,//交易额
        'money2': list2.money2,//成交额
    };
    list.push(datas);
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    // Morris Area Chart
    Morris.Area({
        element: 'hero-area',
        resize: true,
        parseTime: false,
        data: list,
            // [
            // {
            //     period: '01-02',
            //     num1: 2778,
            //     num2: 2294,
            //     money1: 2441,
            //     money2: 425
            // },
            // {
            //     period: '01-03',
            //     num1: 4912,
            //     num2: 1969,
            //     money1: 2501,
            //     money2: 425
            // },
            // {
            //     period: '01-04',
            //     num1: 3767,
            //     num2: 3597,
            //     money1: 5689,
            //     money2: 425
            // },
            // {
            //     period: '01-05',
            //     num1: 6810,
            //     num2: 1914,
            //     money1: 2293,
            //     money2: 425
            // },
            // {
            //     period: '01-06',
            //     num1: 5670,
            //     num2: 4293,
            //     money1: 1881,
            //     money2: 425
            // },
            // {
            //     period: '01-07',
            //     num1: 4820,
            //     num2: 3795,
            //     money1: 1588,
            //     money2: 425
            // },
            // {period: '2011 Q4', num1: 15073, num2: 5967, money1: 5175, money2: 425},
            // {period: '2012 Q1', num1: 10687, num2: 4460, money1: 2028, money2: 425},
            // {period: '2012 Q2', num1: 8432, num2: 5713, money1: 1791, money2: 425},
        // ],
        xkey: 'period',
        ykeys: ['num1', 'num2', 'money1', 'money2'],
        labels: ['交易量', '成交量 ', '交易额', '成交额'],
        lineWidth: 2,
        hideHover: 'auto',
        lineColors: ["#39a6f7", "#66cc00", "#f9a20a", "#ff0000"]
    });


    // Build jQuery Knobs
    $(".knob").knob();

    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y - 30,
            left: x - 50,
            color: "#fff",
            padding: '2px 5px',
            'border-radius': '6px',
            'background-color': '#000',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }
</script>
<?php $__env->stopSection(); ?>