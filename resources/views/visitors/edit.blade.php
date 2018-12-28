@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            访客记录
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($visitor, ['route' => ['visitors.update', $visitor->id], 'method' => 'patch']) !!}

                        @include('visitors.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection