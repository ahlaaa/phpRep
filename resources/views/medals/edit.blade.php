@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        勋章
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                {!! Form::model($medal, ['route' => ['medals.update', $medal->id], 'method' => 'patch']) !!}

                @include('medals.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection