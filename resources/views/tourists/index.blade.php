@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">

        旅游信息

    </h1>
    <h1 class="pull-right">
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
           href="{!! route('tourists.create') !!}">新增旅游团</a>
    </h1>
    <div>
        <form class="navbar-form navbar-left" style="width:100%;" role="search">
            <div class="form-group">
                {!! Form::text('type', '1',['class' => 'form-control','style' => 'display:none;']) !!}
                {!! Form::text('search',null, ['class' => 'form-control','placeholder' => '请输入团名称']) !!}
                {!! Form::text('searchFields','name:like;', ['class' =>
                'form-control','style' => 'display:none;']) !!}
                <!--{!! Form::select('grade_id',constants('REBATE_TYPE'),null, ['class' => 'form-control']) !!}-->

            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
    </div>
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            @include('tourists.table')
        </div>
    </div>
    <div class="text-center">

        @include('adminlte-templates::common.paginate', ['records' => $tourists])

    </div>
</div>
@endsection

