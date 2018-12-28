@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            用户
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 'onsubmit' => "return confirm_ch();"]) !!}

                        @include('users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection