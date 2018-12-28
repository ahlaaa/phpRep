{{--<!-- Percentage Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('percentage', 'Percentage:') !!}--}}
    {{--{!! Form::number('percentage', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Point Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('point', 'Point:') !!}--}}
    {{--{!! Form::number('point', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Submit Field -->--}}


@foreach(app(\App\Repositories\PointRepository::class)->findWhere([['id', '>', 0]]) as $point)
    <!-- Point Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('point', '献金余额'. $point->percentage  . '%以上每消费一元获得') !!}
        {!! Form::number('point[' . $point->id . '][point]', $point->point, ['class' => 'form-control', 'step'=> 0.01, 'min'=> 0]) !!}
        {!! Form::hidden('point[' . $point->id . '][id]', $point->id) !!}
    </div>
@endforeach

<div class="form-group col-sm-12">
{!! Form::submit('提交', ['class' => 'btn btn-primary']) !!}
{{--<a href="{!! route('points.index') !!}" class="btn btn-default">返回</a>--}}
</div>