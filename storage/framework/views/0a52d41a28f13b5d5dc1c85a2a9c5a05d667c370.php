<li class="header">功能菜单</li>

<li class="treeview <?php echo e(Request::is('users*')||Request::is('addresses*') ? 'active' : ''); ?>">
    <a href="#userBar" class="nav-header collapsed" data-toggle="collapse">
        <i class="fa fa-address-book"></i>
        用户管理
        <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
    </a>

    <ul id="userBar" class="nav nav-list collapse secondmenu <?php echo e(Request::is('users*')||Request::is('addresses*') ? 'in' : ''); ?>">
        <li><a class="<?php echo e(Request::is('users')||Request::is('users/*')? 'isThisPage' : ''); ?>" href="<?php echo route('users.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>用户列表</span></a></li>
        <li><a class="<?php echo e(Request::is('users.healthers*')? 'isThisPage' : ''); ?>" href="<?php echo url('users.healthers/0'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>合伙人--健康使者</span></a></li>
        <li><a class="<?php echo e(Request::is('addresses*')? 'isThisPage' : ''); ?>" href="<?php echo route('addresses.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>收货地址</span></a></li>
    </ul>
</li>
<li class="treeview <?php echo e(Request::is('factories*')||Request::is('giveaways*') ? 'active' : ''); ?>">
    <a href="#factBar" class="nav-header collapsed" data-toggle="collapse">
        <i class="fa fa-bank"></i>
        厂家管理
        <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
    </a>

    <ul id="factBar" class="nav nav-list collapse secondmenu <?php echo e(Request::is('factories*')||Request::is('giveaways*') ? 'in' : ''); ?>">
        <li><a class="<?php echo e(Request::is('factories*')? 'isThisPage' : ''); ?>" href="<?php echo route('factories.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>厂家列表</span></a></li>
        <li><a class="<?php echo e(Request::is('giveaways*')? 'isThisPage' : ''); ?>" href="<?php echo route('giveaways.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>赠品列表</span></a></li>
    </ul>
</li>
<li class="treeview <?php echo e(Request::is('orders*')||Request::is('sales*') ? 'active' : ''); ?>">
    <a href="#orderBar" class="nav-header collapsed" data-toggle="collapse">
        <i class="fa fa-reorder"></i>
        订单管理
        <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
    </a>

    <ul id="orderBar" class="nav nav-list collapse secondmenu <?php echo e(Request::is('orders*')||Request::is('sales*') ? 'in' : ''); ?>">
        <li><a class="<?php echo e(Request::is('orders*')? 'isThisPage' : ''); ?>" href="<?php echo route('orders.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>菜品订单</span></a></li>
        <li><a class="<?php echo e(Request::is('sales*')? 'isThisPage' : ''); ?>" href="<?php echo route('sales.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>赠品订单</span></a></li>
    </ul>
</li>
<li class="treeview <?php echo e(Request::is('bags*')||Request::is('bags*') ? 'active' : ''); ?>">
    <a href="#bagsBar" class="nav-header collapsed" data-toggle="collapse">
        <i class="fa fa-reorder"></i>
        袋子管理
        <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
    </a>

    <ul id="bagsBar" class="nav nav-list collapse secondmenu <?php echo e(Request::is('bags*')||Request::is('bags*') ? 'in' : ''); ?>">
        <li><a class="<?php echo e(Request::is('bags*')? 'isThisPage' : ''); ?>" href="<?php echo route('bags.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>袋子</span></a></li>
    </ul>
</li>
<li class="treeview <?php echo e(Request::is('accountFlows*')||Request::is('rebates*') || Request::is('withdraws*') ? 'active' : ''); ?>">
    <a href="#flowBar" class="nav-header collapsed" data-toggle="collapse">
        <i class="fa fa-bar-chart-o"></i>
        流水记录
        <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
    </a>

    <ul id="flowBar" class="nav nav-list collapse secondmenu <?php echo e(Request::is('accountFlows*')||Request::is('rebates*') || Request::is('withdraws*') ? 'in' : ''); ?>">
        <li><a class="<?php echo e(Request::is('accountFlows*')? 'isThisPage' : ''); ?>" href="<?php echo route('accountFlows.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>流水记录</span></a></li>
        <li><a class="<?php echo e(Request::is('rebates*')? 'isThisPage' : ''); ?>" href="<?php echo route('rebates.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>返利记录</span></a></li>
        <li><a class="<?php echo e(Request::is('withdraws*')? 'isThisPage' : ''); ?>" href="<?php echo route('withdraws.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>提现记录</span></a></li>
    </ul>
</li>
<li class="treeview <?php echo e(Request::is('articleCategories*')||Request::is('articles*')||Request::is('brands*')||Request::is('systemConfigs*') ? 'active' : ''); ?>">
    <a href="#menuBar" class="nav-header collapsed" data-toggle="collapse">
        <i class="fa fa-building-o"></i>
        首页管理
        <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
    </a>

    <ul id="menuBar" class="nav nav-list collapse secondmenu <?php echo e(Request::is('articleCategories*')||Request::is('articles*')||Request::is('brands*')||Request::is('systemConfigs*') ? 'in' : ''); ?>">
        <li><a class="<?php echo e(Request::is('articleCategories*')? 'isThisPage' : ''); ?>" href="<?php echo route('articleCategories.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>文章分类</span></a></li>
        <li><a class="<?php echo e(Request::is('articles*')? 'isThisPage' : ''); ?>" href="<?php echo route('articles.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>文章列表</span></a></li>
        <li><a class="<?php echo e(Request::is('brands*')? 'isThisPage' : ''); ?>" href="<?php echo route('brands.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>品牌列表</span></a></li>
        <li><a class="<?php echo e(Request::is('systemConfigs*')? 'isThisPage' : ''); ?>" href="<?php echo route('systemConfigs.edit', [1]); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>首页配置</span></a></li>
    </ul>
</li>
<li class="treeview <?php echo e(Request::is('testingStores*') ? 'active' : ''); ?>">
    <a href="#storeBar" class="nav-header collapsed" data-toggle="collapse">
        <i class="fa fa-flag-checkered"></i>
        线下体验店
        <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
    </a>

    <ul id="storeBar" class="nav nav-list collapse secondmenu <?php echo e(Request::is('testingStores*') ? 'in' : ''); ?>">
        <li><a class="<?php echo e(Request::is('testingStores*')? 'isThisPage' : ''); ?>" href="<?php echo route('testingStores.index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>线下体验店</span></a></li>
    </ul>
</li>
<!-- <script src="https://cdn.bootcss.com/jquery/2.1.0/jquery.min.js"></script>
<script>
    $(".treeview").click(function(){
        console.log(222)
    })
</script> -->