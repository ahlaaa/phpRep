<!--<li class="header">功能菜单</li>-->
<!--主菜单-->
<div class="col-sm-6 sidebar-menu" style="height: 100%;padding-top:45px;">
    <li style="background-color: #222d32!important;"
        class="row treeview <?php echo e(Request::is('syscerts*')|| Request::is('cards*') || Request::is('brands*')||Request::is('systemConfigs*')||Request::is('administrators*') || Request::is('points*')|| Request::is('chlog*')? 'active' : ''); ?>">
        <a href="#menuBar21" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">
            <i class="fa fa-building-o"></i>
            系统管理1
            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
        </a>
    </li>
    <li style="background-color: #222d32!important;"
        class="row treeview <?php echo e(Request::is('product*')||Request::is('standards*')? 'active' : ''); ?>">
        <a href="#factBar12" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">
            <i class="glyphicon glyphicon-th-list"></i>
            商品
            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
        </a>
    </li>
    <li style="background-color: #222d32!important;"
        class="row treeview <?php echo e(Request::is('user*')||Request::is('tags*')||Request::is('grades*')? 'active' : ''); ?>">
        <a href="#user" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">
            <i class="glyphicon glyphicon-user"></i>
            会员
            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
        </a>
    </li>
    <li style="background-color: #222d32!important;"
        class="row treeview <?php echo e(Request::is('order*')||Request::is('maintains*')? 'active' : ''); ?>">
        <a href="#orders" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">
            <i class="glyphicon glyphicon-euro"></i>
            订单
            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
        </a>
    </li>
    <li style="background-color: #222d32!important;"
        class="row treeview <?php echo e(Request::is('saplings*')? 'active' : ''); ?>">
        <a href="#saplings" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">
            <i class="glyphicon glyphicon-euro"></i>
            公益造林
            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
        </a>
    </li>
<!--    <li style="background-color: #222d32!important;"-->
<!--        class="row treeview <?php echo e(Request::is('exchangelogs*')? 'active' : ''); ?>">-->
<!--        <a href="#exchangelogs" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">-->
<!--            <i class="glyphicon glyphicon-euro"></i>-->
<!--            兑换记录-->
<!--            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>-->
<!--        </a>-->
<!--    </li>-->
    <li style="background-color: #222d32!important;"
        class="row treeview <?php echo e(Request::is('tourists*') || Request::is('routes*')? 'active' : ''); ?>">
        <a href="#tourists" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">
            <i class="glyphicon glyphicon-euro"></i>
            旅游
            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
        </a>
    </li>
    <li style="background-color: #222d32!important;"
        class="row treeview <?php echo e(Request::is('applications*')? 'active' : ''); ?>">
        <a href="#applications" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">
            <i class="glyphicon glyphicon-euro"></i>
            代理申请
            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
        </a>
    </li>
    <li style="background-color: #222d32!important;"
        class="row treeview <?php echo e(Request::is('medals*')? 'active' : ''); ?>">
        <a href="#medals" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">
            <i class="glyphicon glyphicon-euro"></i>
            勋章
            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
        </a>
    </li>
    <li style="background-color: #222d32!important;"
        class="row treeview <?php echo e(Request::is('withdraws*')? 'active' : ''); ?>">
        <a href="#withdraws" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">
            <i class="glyphicon glyphicon-euro"></i>
            提现
            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
        </a>
    </li>
    <li style="background-color: #222d32!important;"
        class="row treeview <?php echo e(Request::is('rebates*')? 'active' : ''); ?>">
        <a href="#rebates" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">
            <i class="glyphicon glyphicon-euro"></i>
            奖励/余额
            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
        </a>
    </li>
<!--    <li style="background-color: #222d32!important;"-->
<!--        class="row treeview <?php echo e(Request::is('pay*')||Request::is('pay*')? 'active' : ''); ?>">-->
<!--        <a href="#pay" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">-->
<!--            <i class="glyphicon glyphicon-piggy-bank"></i>-->
<!--            财务-->
<!--            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>-->
<!--        </a>-->
<!--    </li>-->
<!--    <li style="background-color: #222d32!important;"-->
<!--        class="row treeview <?php echo e(Request::is('data*')||Request::is('data*')? 'active' : ''); ?>">-->
<!--        <a href="#data" class="col-sm-12 nav-header collapsed" data-toggle="collapse" style="padding-top: 10px;">-->
<!--            <i class="glyphicon glyphicon-book"></i>-->
<!--            数据-->
<!--            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>-->
<!--        </a>-->
<!--    </li>-->
</div>
<!--副菜单-->
<div class="col-sm-6" style="padding-right: 0px;height: 100%;background-color: white!important;top: 1px;">
    <li style="background-color: white!important;"
        class="treeview">
        <ul id="menuBar21"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('syscerts*')|| Request::is('cards*')|| Request::is('brands*')||Request::is('systemConfigs*')||Request::is('administrators*') || Request::is('points*') ||Request::is('chlog*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">系统管理1</a></li>
            <li><a class="<?php echo e(Request::is('administrators*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('administrators.index'); ?>"><span>管理员管理</span></a>
            </li>
            
            <!--<li><a class="<?php echo e(Request::is('brands*')? 'isThisPage' : ''); ?>" href="<?php echo route('brands.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>品牌列表</span></a></li>-->
            <li><a class="<?php echo e(Request::is('systemConfigs*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('systemConfigs.edit', [1]); ?>"><span>首页配置</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('points*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('points.edit', [1]); ?>"><span>献金配置</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('chlog*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('chlog.index'); ?>"><span>操作记录</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('cards*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('cards.index'); ?>"><span>优惠券</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('syscerts*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('syscerts.index'); ?>"><span>证书</span></a>
            </li>
        </ul>
        <ul id="factBar12"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('productCategories*')||Request::is('products*')  ||Request::is('standards*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">商品管理</a></li>
            <li><a class="<?php echo e(Request::is('products*')&& request()->get('search',1)==1 && !Request::is('products.trash') ? 'isThisPage' : ''); ?>"
                   href="<?php echo url('products?search=1&searchFields=status:='); ?>"><span>出售中</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('products*') && request()->get('search',1)==3? 'isThisPage' : ''); ?>"
                   href="<?php echo url('products?search=3&searchFields=status:='); ?>"><span>已售罄</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('products*') && request()->get('search',1)==2? 'isThisPage' : ''); ?>"
                   href="<?php echo url('products?search=2&searchFields=status:='); ?>"><span>仓库中</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('products.trash*')? 'isThisPage' : ''); ?>"
                   href="<?php echo url('products.trash'); ?>"><span>回收站</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('productCategories*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('productCategories.index'); ?>"><span>商品分类</span></a>
            </li>
            <li>
                <a class="<?php echo e(Request::is('products*')&& request()->get('search',1)==6 && !Request::is('products.trash') ? 'isThisPage' : ''); ?>"
                   href="<?php echo url('products?search=6&searchFields=type:='); ?>"><span>公益造林</span></a>
            </li>
        </ul>
        <ul id="user"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('grades*')||Request::is('user*')  ||Request::is('tags*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">会员</a></li>
            <li><a class="<?php echo e(Request::is('users*')&&!(Request::is('tags*')||Request::is('users.grades*'))? 'isThisPage' : ''); ?>"
                   href="<?php echo route('users.index'); ?>"><span>会员列表</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('grades*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('grades.index',['search'=>'1','searchFields'=>'type:=;']); ?>"><span>会员等级</span></a>
            </li>
            <li><a class="<?php echo e(request()->is('tags*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('tags.index'); ?>"><span>标签组</span></a>
            </li>
        </ul>
        <ul id="orders"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('orders*')||Request::is('orders*')  ||Request::is('maintains*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">订单</a></li>
            <li><a class="<?php echo e((Request::is('orders*')&& 2 == request()->get('search',null)) || (2 == (isset($order->status)?$order->status:0)) ? 'isThisPage' : ''); ?>"
                   href="<?php echo route('orders.index',['search'=>'2','searchFields'=>'status:=;']); ?>"><span>待發貨</span></a>
            </li>
            <li><a class="<?php echo e((Request::is('orders*')&& 3 == request()->get('search',null)) || (3 == (isset($order->status)?$order->status:0))? 'isThisPage' : ''); ?>"
                   href="<?php echo route('orders.index',['search'=>'3','searchFields'=>'status:=;']); ?>"><span>待收货</span></a>
            </li>
            <li><a class="<?php echo e((Request::is('orders*')&& 1 == request()->get('search',null)) || (1 == (isset($order->status)?$order->status:0))? 'isThisPage' : ''); ?>"
                   href="<?php echo route('orders.index',['search'=>'1','searchFields'=>'status:=;']); ?>"><span>待付款</span></a>
            </li>
            <li><a class="<?php echo e((Request::is('orders*')&& 4 == request()->get('search',null)) || (4 == (isset($order->status)?$order->status:0))? 'isThisPage' : ''); ?>"
                   href="<?php echo route('orders.index',['search'=>'4','searchFields'=>'status:=;']); ?>"><span>已完成</span></a>
            </li>
            <li><a class="<?php echo e((Request::is('orders*')&& 5 == request()->get('search',null)) || (5 == (isset($order->status)?$order->status:0))? 'isThisPage' : ''); ?>"
                   href="<?php echo route('orders.index',['search'=>'5','searchFields'=>'status:=;']); ?>"><span>已取消</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('orders') && is_null(request()->get('search',null))? 'isThisPage' : ''); ?>"
                   href="<?php echo route('orders.index'); ?>"><span>全部订单</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('maintains*') && (4 != (request()->get('search',1)))? 'isThisPage' : ''); ?>"
                   href="<?php echo route('maintains.index'); ?>"><span>维权申请</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('maintains*') && (4 == (request()->get('search',1)))? 'isThisPage' : ''); ?>"
                   href="<?php echo route('maintains.index',['search'=>'4','searchFields'=>'status:=;']); ?>"><span>维权完成</span></a>
            </li>
            
                 
            
        </ul>
        <ul id="pay"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('pay*')||Request::is('pay*')  ||Request::is('pay*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">财务</a></li>
            <li><a class="<?php echo e(Request::is('pay*')? 'isThisPage' : ''); ?>"
                   href="javascript:void(0);"><span>提现</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('pay*')? 'isThisPage' : ''); ?>"
                   href="javascript:void(0);"><span>佣金申请</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('pay*')? 'isThisPage' : ''); ?>"
                   href="javascript:void(0);"><span>财务3</span></a>
            </li>
        </ul>
        <ul id="data"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('data*')||Request::is('data*')  ||Request::is('data*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">数据</a></li>
            <li><a class="<?php echo e(Request::is('data*')? 'isThisPage' : ''); ?>"
                   href="javascript:void(0);"><span>数据1</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('data*')? 'isThisPage' : ''); ?>"
                   href="javascript:void(0);"><span>数据2</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('data*')? 'isThisPage' : ''); ?>"
                   href="javascript:void(0);"><span>数据3</span></a>
            </li>
        </ul>
        <ul id="saplings"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('saplings*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">公益造林</a></li>
            <li><a class="<?php echo e(Request::is('saplings*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('saplings.index'); ?>"><span>记录</span></a>
            </li>
        </ul>
<!--        <ul id="exchangelogs"-->
<!--            class="nav nav-list collapse secondmenu <?php echo e(Request::is('exchangelogs*')? 'in' : ''); ?>">-->
<!--            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"-->
<!--                                                          style="cursor: default;color:black;">兑换记录</a></li>-->
<!--            <li><a class="<?php echo e(Request::is('exchangelogs*')? 'isThisPage' : ''); ?>"-->
<!--                   href="<?php echo route('exchangelogs.index'); ?>"><span>记录</span></a>-->
<!--            </li>-->
<!--        </ul>-->
        <ul id="tourists"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('tourists*') || Request::is('routes*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">旅游</a></li>
            <li><a class="<?php echo e(Request::is('tourists*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('tourists.index'); ?>"><span>旅游</span></a>
            </li>
            <li><a class="<?php echo e(Request::is('routes*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('routes.index'); ?>"><span>路线</span></a>
            </li>
        </ul>
        <ul id="applications"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('applications*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">代理申请</a></li>
            <li><a class="<?php echo e(Request::is('applications*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('applications.index'); ?>"><span>代理申请</span></a>
            </li>
        </ul>
        <ul id="medals"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('medals*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">勋章</a></li>
            <li><a class="<?php echo e(Request::is('medals*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('medals.index'); ?>"><span>勋章</span></a>
            </li>
        </ul>
        <ul id="withdraws"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('withdraws*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">提现</a></li>
            <li><a class="<?php echo e(Request::is('withdraws*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('withdraws.index'); ?>"><span>提现</span></a>
            </li>
        </ul>
        <ul id="rebates"
            class="nav nav-list collapse secondmenu <?php echo e(Request::is('rebates*')? 'in' : ''); ?>">
            <li style="height: 55px;padding-top: 8px;"><a href="javascript:void(0);"
                                                          style="cursor: default;color:black;">获得奖励/余额</a></li>
            <li><a class="<?php echo e(Request::is('rebates*')? 'isThisPage' : ''); ?>"
                   href="<?php echo route('rebates.index'); ?>"><span>记录</span></a>
            </li>
        </ul>
    </li>
</div>