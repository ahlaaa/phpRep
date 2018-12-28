@extends('layouts.app')

@section('content')
<div style='margin: 0px 10px;'>

</div>
    <section class="content-header" style='display: inline-block;padding-right:18px;'>
        <h1 class="pull-left">订单</h1>
    </section>
    <div>
        <form class="navbar-form navbar-left" style="width:100%;" role="search">
            <div class="form-group">
                {!! Form::text('type', '1',['class' => 'form-control','style' => 'display:none;']) !!}
                @if(request()->get('searchFields','')=='number:=;')
                {!! Form::text('search',null, ['class' => 'form-control','placeholder' => '请输入订单号']) !!}
                {!! Form::text('searchFields','number:=;', ['class' =>
                'form-control','style' => 'display:none;']) !!}
                @else
                <input class="form-control" placeholder="请输入订单号" type="text" name="search" />
                <input class="form-control" value="number:=;" type="hidden" name="searchFields" />
                @endif
                <!--{!! Form::select('grade_id',constants('REBATE_TYPE'),null, ['class' => 'form-control']) !!}-->

            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
    </div>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('orders.table')
            </div>
        </div>
        <div class="text-center">
        
        @include('adminlte-templates::common.paginate', ['records' => $orders])

        </div>
    </div>

@endsection

