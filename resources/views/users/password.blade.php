@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            用户
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($user, ['route' => ['users.password', $user->id], 'method' => 'post']) !!}
                   <div class="form-group col-sm-12">
                       {!! Form::label('password', '密码:') !!}
                       {!! Form::text('password', '', ['class' => 'form-control']) !!}
                   </div>
                   <div class="form-group col-sm-12">
                       {!! Form::label('password', '重新输入密码:') !!}
                       {!! Form::text('re_password', '', ['class' => 'form-control']) !!}
                   </div>
                   <div class="form-group col-sm-12">
                       {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                       <a href="{!! route('users.index') !!}" class="btn btn-default">返回</a>
                   </div>
                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection