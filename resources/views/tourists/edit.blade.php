@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        旅游
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                {!! Form::model($tourist, ['route' => ['tourists.update', $tourist->id], 'method' => 'patch']) !!}

                @include('tourists.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection