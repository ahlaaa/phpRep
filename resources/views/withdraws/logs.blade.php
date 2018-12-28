@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">操作记录</h1>
        
    </section>
    <div class="content">
        <div class="clearfix"></div>

       @include('flash::message')
       

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    <table class="table">
                        <thead>
                            <th>序号</th>
                            <th>操作者</th>
                            <th>操作用户/门店</th>
                            <th>操作</th>
                            <th>时间</th>
                        </thead>
                        <tbody>
                            @foreach($logs as $k=>$log)
                            <tr>
                                <td>{!! $k+1 !!}</td>
                                <td>{!! $log->updated_user_name !!}</td>
                                <td>{!! $log->created_user_name !!}</td>
                                <td>{!! $log->txt !!}</td>
                                <td>{!! $log->created_at !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="text-center">
        
            @include('adminlte-templates::common.paginate', ['records' => $logs])

        </div>
    </div>
@endsection 

