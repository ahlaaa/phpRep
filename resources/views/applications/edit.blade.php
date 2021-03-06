@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        代理商
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                {!! Form::model($application, ['route' => ['applications.update', $application->id], 'method' => 'patch']) !!}

                @include('applications.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection