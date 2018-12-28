@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">

        代理申请

    </h1>
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            @include('applications.table')
        </div>
    </div>
    <div class="text-center">

        @include('adminlte-templates::common.paginate', ['records' => $applications])

    </div>
</div>
@endsection

