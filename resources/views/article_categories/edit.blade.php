@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            文章分类
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($articleCategory, ['route' => ['articleCategories.update', $articleCategory->id], 'method' => 'patch']) !!}

                        @include('article_categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection