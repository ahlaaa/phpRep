@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Visitor
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'visitors.store']) !!}

                        @include('visitors.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
