@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{!! array_get(constants('USER_TYPE'), request()->get('type', 1)) !!}管理</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('users.create') !!}">新增</a>
        </h1>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <form class="navbar-form navbar-left" style="width:100%;" role="search" id="form_1">
            <div class="form-group">
                {!! Form::text('type', '1',['class' => 'form-control','style' => 'display:none;']) !!}
                {!! Form:select('s_type',['关键字','推荐人'],0,['class' => 'form-control','id'=>'s_type']) !!}

                {!! Form::text('search',null, ['class' => 'form-control','placeholder' => '请输入关键字','id'=>'s_sch']) !!}
                <input type="hidden" name="searchFields" value="name:like;username:like;wechat:like;telephone:like;email:like;" id='s_ipt' />
               
		{{-- {!! Form::text('searchFields','name:like;username:like;wechat:like;telephone:like;email:like;', ['class' => 'form-control','style' => 'display:none;']) !!} --}}
	        <!--{!! Form::select('grade_id',constants('REBATE_TYPE'),null, ['class' => 'form-control']) !!}-->

            </div>
            <button type="button" onclick="javascript:$('#form_1').submit();" class="btn btn-default">搜索</button>
        </form>
    
        @if($_GET['type'] == 2)
        <form class="navbar-form navbar-left" style="width:100%;" role="search" id="form_2">
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
@section('scripts')
<script>
    $("#s_type").on('change',function(){
        var val = $(this).val();
        if(val == 0){
            $("#s_ipt").val('name:like;username:like;wechat:like;telephone:like;email:like;');
        }else{
            $("#s_ipt").val('superior_id:in;');
        }
    });
    $("#s_sch").on('hover',function(){
        alert(hover);
        $.ajax({
            url:'http://yhs.yungx.xyz/api/v1/users?search='+$("#s_sch").val()+'&searchFields=name:like',
            data:'',
            dataType:"JSON",
            type:"GET",
            success:function(res){
                console.log(res);
            }
        });
    })
</script>
@endsection

