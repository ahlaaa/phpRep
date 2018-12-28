@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Express
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($express, ['route' => ['expresses.update', $express->id], 'method' => 'patch']) !!}

                        @include('expresses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection