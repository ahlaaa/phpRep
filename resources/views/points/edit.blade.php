@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            献金管理
        </h1>
   </section>
   <div class="content">
       {{--@include('adminlte-templates::common.errors')--}}
       @include('flash::message')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($point, ['route' => ['points.update', $point->id], 'method' => 'patch']) !!}

                        @include('points.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection