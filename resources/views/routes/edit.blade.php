@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            路线
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($route, ['route' => ['routes.update', $route->id], 'method' => 'patch']) !!}

                        @include('routes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection