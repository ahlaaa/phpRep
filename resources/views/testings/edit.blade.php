@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Testing
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($testing, ['route' => ['testings.update', $testing->id], 'method' => 'patch']) !!}

                        @include('testings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection