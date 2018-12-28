@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            当前位置:修改商品
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch','onsubmit'=>'return check_form();']) !!}
                   @if(request()->get('search',1) == 6)
                   @include('products.saplings')
                   @else
                        @include('products.fields')
                   @endif

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection