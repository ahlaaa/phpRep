@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            提现记录
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($withdraw, ['route' => ['withdraws.update', $withdraw->id], 'method' => 'patch']) !!}

                        @include('withdraws.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection