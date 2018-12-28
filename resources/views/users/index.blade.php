@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">会员管理</h1>
        {{--<h1 class="pull-right">--}}
           {{--<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('users.create') !!}">新增</a>--}}
        {{--</h1>--}}

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <?php $s_type = $_GET['s_type']??0;$s_type = $_GET['s_types']??null; ?>
        <form class="navbar-form navbar-left" style="width:50%;" role="search" id="form_1">
            <div class="form-group">
                {!! Form::text('type', '1',['class' => 'form-control','style' => 'display:none;']) !!}
               {{-- {!! Form:select('s_type',[1,2],null,['class' => 'form-control','id'=>'s_type']) !!} --}}
               
               <!-- <select class='form-control' id='s_type'>
                   <option value="0">关键字</option>
                   <option value="1">推荐人</option>
               </select> -->
              
                @if(empty($_GET['s_type']))
                {!! Form::hidden('search',null, ['class' => 'form-control','placeholder' => '请输入关键字','id'=>'s_sch1']) !!}
                @else
                {!! Form::hidden('search',null, ['class' => 'form-control','placeholder' => '请输入关键字','id'=>'s_sch1']) !!}
                @endif
                @if(request()->get('type', 1) == 2)
                {!! Form::select('s_type',["关键字","推荐人"],0, ['class' => 'form-control','id' => 's_type']) !!}
                {!! Form::text('searchs',null, ['class' => 'form-control','placeholder' => '请输入关键字','id'=>'s_sch']) !!}
                {!! Form::select('s_types',[],0, ['class' => 'form-control','id' => 's_types','placeholder' => '无用户']) !!}
                @else
                {!! Form::text('search',null, ['class' => 'form-control','placeholder' => '请输入关键字','id'=>'s_sch1']) !!}
                @endif
                <input type="hidden" name="searchFields" value="name:like;username:like;wechat:like;telephone:like;email:like;province:like;city:like;county:like;" id='s_ipt' />
               
		{{-- {!! Form::text('searchFields','name:like;username:like;wechat:like;telephone:like;email:like;', ['class' => 'form-control','style' => 'display:none;']) !!} --}}
	        <!--{!! Form::select('grade_id',constants('REBATE_TYPE'),null, ['class' => 'form-control']) !!}-->

            </div>
            <button type="button" onclick="javascript:$('#form_1').submit();" class="btn btn-default">搜索</button>
        </form>
    
        @if(request()->get('type', 1) == 2)
        <form class="navbar-form navbar-left" style="width:50%;" role="search" id="form_2">
            <div class="form-group">
                {!! Form::text('type', '1',['class' => 'form-control','style' => 'display:none;']) !!}
                {!! Form::select('search',app(\App\Models\Grade::class)->where('type',2)->get()->pluck('name','id'),null, ['class' => 'form-control','placeholder' => '选择查找等级']) !!}
		{!! Form::text('searchFields','grade_id:=;', ['class' => 'form-control','style' => 'display:none;']) !!}
	        <!--{!! Form::select('grade_id',constants('REBATE_TYPE'),null, ['class' => 'form-control']) !!}-->

            </div>
            <button type="button" onclick="javascript:$('#form_2').submit();"  class="btn btn-default">搜索</button>
        </form>
        @endif

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('users.table')
            </div>
        </div>
        <div class="text-center">
        
        @include('adminlte-templates::common.paginate', ['records' => $users])

        </div>
    </div>
@endsection


