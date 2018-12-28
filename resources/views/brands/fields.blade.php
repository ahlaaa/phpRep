<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', '标题:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', '内容:') !!}
    <div id="content_div" style="width:100%; height:200px;">{!! $brand->content ?? '' !!}</div>
    {!! Form::textarea('content', $brand->content ?? '', ['class' => 'form-control', 'id'=> 'content']) !!}
</div>

<div class="form-group col-md-12">
    {!! Form::label('status', '状态:') !!}
    {!! Form::select('status', constants('BRAND_STATUS'), $brand->status ?? 0, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('brands.index') !!}" class="btn btn-default">返回</a>
</div>
@section('scripts')
    <script>
        /*
            富文本 start
         */
        var editor = new wangEditor('#content_div')
        var $content = $('#content')

        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $content.val(html)
        }

        editor.create()

        $content.val(editor.txt.html())

        /*
            富文本 end
         */
    </script>
@endsection
@section('css')
    <style>
        #content_div {
            width: 100%;
            min-height: 330px;
            height: auto;
        }
        #content{
            display: none;
        }
    </style>
@endsection