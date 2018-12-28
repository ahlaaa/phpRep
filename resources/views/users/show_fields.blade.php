<div class="col-sm-12">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active">
            <a href="#base" data-toggle="tab">基本</a>
        </li>
        <li><a href="#orders" data-toggle="tab">交易信息</a></li>
        <li><a href="#distributers" data-toggle="tab">分销商信息</a></li>
        <li><a href="#proxs" data-toggle="tab">区域代理信息</a></li>
        <!--    <li><a href="#sales" data-toggle="tab">分销</a></li>-->
        <!--    <li class="dropdown">-->
        <!--        <a href="#" id="myTabDrop1" class="dropdown-toggle"-->
        <!--           data-toggle="dropdown">Java <b class="caret"></b>-->
        <!--        </a>-->
        <!--        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">-->
        <!--            <li><a href="#jmeter" tabindex="-1" data-toggle="tab">-->
        <!--                    jmeter</a>-->
        <!--            </li>-->
        <!--            <li><a href="#ejb" tabindex="-1" data-toggle="tab">-->
        <!--                    ejb</a>-->
        <!--            </li>-->
        <!--        </ul>-->
        <!--    </li>-->
    </ul>
</div>
<div id="myTabContent" class="tab-content col-sm-12">
    @include('users.base')
    @include('users.orders')
    @include('users.distributers')
    @include('users.proxs')
</div>