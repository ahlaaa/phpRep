@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Account Flow
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($accountFlow, ['route' => ['accountFlows.update', $accountFlow->id], 'method' => 'patch']) !!}

                        @include('account_flows.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection