@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            维权管理
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($maintain, ['route' => ['maintains.update', $maintain->id], 'method' => 'patch']) !!}

                        @include('maintains.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection