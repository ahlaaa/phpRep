@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            规格管理
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($standard, ['route' => ['standards.update', $standard->id], 'method' => 'patch']) !!}

                        @include('standards.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection