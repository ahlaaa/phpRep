@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            系统设置
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($systemConfig, ['route' => ['systemConfigs.update', $systemConfig->id], 'method' => 'patch']) !!}

                        @include('system_configs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection