@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content-header">
        <h1 class="pull-left">
            <span class="glyphicon glyphicon-minus" style="transform: rotate(90deg);color: aqua;"></span>
            <span>当前位置:首页</span>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary" style="background: #ecf0f5!important;">
            <div class="box-body">
                @include('block')
            </div>
        </div>
        <div class="text-center">


        </div>
    </div>
</div>
@endsection
