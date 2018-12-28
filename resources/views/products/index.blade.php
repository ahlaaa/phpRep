@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">商品管理</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{!! route('products.create',['search'=>request()->get('search',1)]) !!}">新增</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @if(Request::is('products*')&& request()->get('search',1)==1 && !Request::is('products.trash'))
                    @include('products.table')
                @endif
<!--                售罄-->
                @if(Request::is('products*') && request()->get('search',1)==3)
                    @include('products.table3')
                @endif
<!--                仓库在-->
                @if(Request::is('products*') && request()->get('search',1)==2)
                    @include('products.table2')
                @endif
                <!--                树苗-->
                @if(Request::is('products*') && request()->get('search',1)==6)
                @include('products.table4')
                @endif
<!--                回收站-->
                @if(Request::is('products.trash*'))
                    @include('products.table0')
                @endif
            </div>
        </div>
        <div class="text-center">
        
       @include('adminlte-templates::common.paginate', ['records' => $products])
        </div>
    </div>
@endsection

