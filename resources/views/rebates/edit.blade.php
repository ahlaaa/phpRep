@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            返利列表
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($rebate, ['route' => ['rebates.update', $rebate->id], 'method' => 'patch']) !!}

                        @include('rebates.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection