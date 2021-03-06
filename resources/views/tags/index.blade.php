@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">标签组</h1>
    <h1 class="pull-right">
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('rebates.create') !!}">新增</button>
    </h1>
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            @include('tags.table')
        </div>
    </div>
    <div class="col-sm-12">
        @include('adminlte-templates::common.paginate', ['records' => $tags])
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">添加标签组</h4>
                </div>
                {!! Form::open(['route' => 'tags.store']) !!}
                <div class="modal-body row">
                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">标签组名称<span class="text-danger">*</span></div>
                        <div class="col-sm-8">
                            <input name="name" class="form-control" type="text" />
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">标签组内容<span class="text-danger">*</span></div>
                        <div class="col-sm-8">
                            <textarea name="contents" class="form-control" style="resize: none;height: 50%;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
<!--                    <button type="button" class="btn btn-primary">提交更改</button>-->
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
</div>
@endsection