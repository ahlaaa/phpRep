@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            管理员管理
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($administrator, ['route' => ['administrators.update', $administrator->id], 'method' => 'patch']) !!}

                        @include('administrators.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection