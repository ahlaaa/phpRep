@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">门店管理</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('stores.create') !!}">新增</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        <div class="clearfix"></div>
		<form class="navbar-form navbar-left" style="width:100%;" role="search">
            <div class="form-group">
                <!--{!! Form::label('name', '姓名:') !!}-->
                {!! Form::text('search',null, ['class' => 'form-control','placeholder' => '请输入门店关键字']) !!}
		{!! Form::text('searchFields','user.name:like;name:like;province:like;city:like;county:like;address:like;telephone:like;', ['class' => 'form-control','style' => 'display:none;']) !!}
	        <!--{!! Form::select('grade_id',constants('REBATE_TYPE'),null, ['class' => 'form-control']) !!}-->

            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('stores.table')
            </div>
        </div>
        <div class="text-center">
        
        @include('adminlte-templates::common.paginate', ['records' => $stores])

        </div>
    </div>
@endsection

