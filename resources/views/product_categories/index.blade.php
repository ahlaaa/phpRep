@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">分类管理</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('productCategories.create') !!}">新增</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">


        @foreach($productCategories as $productCategory)
            <div class="panel panel-default form-group col-sm-12">
                <div class="panel-heading form-group col-sm-12 father_categories" style="border: 1px solid #ccc;margin: 6.5px;">
                    <span style="text-align: left;border: none;background-color: inherit;cursor: pointer;" data-id="{!! $productCategory->id !!}" class="col-sm-4" data-toggle="collapse"
                            data-target="#demo{!! $productCategory->id !!}">
                        {!! $productCategory->title !!}
                    </span>
                    <div class="col-sm-8">
                        {!! Form::open(['route' => ['productCategories.destroy', $productCategory->id], 'method' => 'delete']) !!}
                        <div class="col-sm-4 pull-right right" style="display: flex;padding: 2px 0px;">
                            <span class="col-sm-3 text-gray">{{ $productCategory->statusstr }}</span>
                            <a href="{!! route('productCategories.create', ['pid'=>$productCategory->id]) !!}" class="col-sm-3 btn btn-default">添加</a>
                            <a href="{!! route('productCategories.edit', [$productCategory->id]) !!}" class="col-sm-3 btn btn-default">编辑</a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'col-sm-3 btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div id="demo{!! $productCategory->id !!}" class="col-sm-12 collapse {!! $loop->index==0?'in':'' !!}">
                    {{--  {!! $loop->index==0?'collapse in':'' !!} --}}
                @foreach(app(\App\Models\ProductCategory::class)->where('pid',$productCategory->id)->get() as $pcs)
                <div class="panel-body col-sm-11 pull-right children_categories" style="padding:0px;border: 1px solid #ccc;margin: 6.5px;">
                    <div class="col-sm-12">
                        <span style="text-align: left;border: none;background-color: inherit;" data-id="{!! $pcs->id !!}" class=" col-sm-4 pull-left">
                            {!! $pcs->title !!}
                        </span>
                        <div class="col-sm-8" style="padding: 2px 0px;">
                            {!! Form::open(['route' => ['productCategories.destroy', $pcs->id], 'method' => 'delete']) !!}
                            <div class="col-sm-4 pull-right right" style="display: flex;flex-direction: row;justify-content: flex-end;">
                                <span class="col-sm-3 text-gray">{{ $productCategory->statusstr }}</span>
                                <a href="{!! route('productCategories.edit', [$pcs->id]) !!}" class="col-sm-3 btn btn-default">编辑</a>
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'col-sm-3 btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>

        @endforeach
                   {{-- @include('product_categories.table') --}}
            </div>
        </div>
        <div class="text-center">
        
        @include('adminlte-templates::common.paginate', ['records' => $productCategories])

        </div>
    </div>
@endsection
@section('css')
<style>
    .right span,a,button{
        padding: 1px;
        margin-left: 6.5px;
    }
</style>
@endsection

