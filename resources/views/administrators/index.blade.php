@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"><span class="glyphicon glyphicon-minus"
                                    style="transform: rotate(90deg);color: aqua;"></span>管理员管理</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('administrators.create') !!}">新增</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('administrators.table')
            </div>
        </div>
        <div class="text-center">
        
        @include('adminlte-templates::common.paginate', ['records' => $administrators])

        </div>
    </div>
@endsection

