<!-- Name Field -->
<div class="form-group col-sm-12">
    <div class="form-group col-sm-4">
        {!! Form::label('iig', '用户头像:') !!}
        <div class="form-group">
            <img src="{{ $user->img_head ?? old('img_head') }}" title="用户头像" alt="显示错误" />
        </div>
    </div>
    <div class="form-group col-sm-12" style="padding-left:0px;">
        <div class="form-group col-sm-2">
            {!! Form::label('name', '姓名:') !!}
            @if(isset($user))
            {!! Form::text('name', null, ['class' => 'form-control','disabled']) !!}
            @else
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @endif
        </div>

        <!-- Username Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('username', '用户名:') !!}
            @if(isset($user))
            {!! Form::text('username', null, ['class' => 'form-control','disabled']) !!}
            @else
            {!! Form::text('username', null, ['class' => 'form-control']) !!}
            @endif
        </div>
    </div>
    <!-- Wechat Field -->
    {{--<div class="form-group col-sm-2">--}}
        {{--{!! Form::label('wechat', '微信:') !!}--}}
        {{--{!! Form::text('wechat', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
</div>
<div class="form-group col-sm-12">
    <!-- Telephone Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('telephone', '电话:') !!}
        {!! Form::text('telephone', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Email Field -->
    {{-- <div class="form-group col-sm-2">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div> --}}

    <!-- Birthday Field -->
    {{--<div class="form-group col-sm-2">--}}

        {{--{!! Form::label('birthday', '生日:') !!}--}}

        {{--{!! Form::date('birthday', $user->birthday ?? null, ['class' => 'form-control']) !!}--}}

        {{--</div>--}}

</div>
<div class="form-group col-sm-12">
    <!-- Open Id Field -->
    {{--<div class="form-group col-sm-2">--}}
        {{--{!! Form::label('open_id', 'Open Id:') !!}--}}
        {{--{!! Form::text('open_id', null, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}


    <!-- Type Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('type', '类型:') !!}
        @if(isset($user))
        {!! Form::select('type', constants('USER_TYPE'), $user->type ?? old('type'), ['class' => 'form-control','disabled']) !!}
        @else
        {!! Form::select('type', constants('USER_TYPE'), $user->type ?? old('type'), ['class' => 'form-control']) !!}
        @endif
    </div>

    <!-- Grade Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('grade', '等级:') !!}
        <?php
        $g_list = resolve(\App\Repositories\GradeRepository::class)->pluck('name', 'id');
        $list1 = array();
        $list2 = array();
        $lenh = sizeof($g_list);
        for($i = 1;$i < $lenh+1;$i++){
            if($i < $lenh-2){
                $oper = $g_list->get($i);
                // if(empty($oper)){
                //     $oper = "普通会员";
                // }
                $list1[$i] = $oper;
                // array_push($list1,$oper);
            }else{
                $list2[$i] = $g_list->get($i);
                // array_push($list2,$g_list->get($i));
            }
        }
        ?>
        @if(isset($user))
        @if($user->type === 1)
        {!! Form::select('grade_id', $list1, $user->grade_id ?? old('grade_id'), ['class' => 'form-control']) !!}
        @else
        {!! Form::select('grade_id', $list2, $user->grade_id ?? old('grade_id'), ['class' => 'form-control']) !!}
        @endif
        @else
        {!! Form::select('grade_id', $g_list, $user->grade_id ?? old('grade_id'), ['class' => 'form-control']) !!}
        @endif
    </div>
</div>
<div class="form-group col-sm-12">
    <div id="div-distpicker">

        <!-- Province Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('province', '省:') !!}
            {!! Form::select('province', [] , null, ['class' => 'form-control']) !!}
        </div>

        <!-- City Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('city', '市:') !!}
            {!! Form::select('city', [] , null, ['class' => 'form-control']) !!}

            {{--{!! Form::text('city', null, ['class' => 'form-control']) !!}--}}
        </div>

        <!-- County Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('county', '县:') !!}
            {!! Form::select('county', [] , null, ['class' => 'form-control']) !!}
        </div>

    </div>
</div>
<div class="form-group col-sm-12">
    <div class="form-group col-sm-2">
        {!! Form::label('point', '献金:') !!}
        {!! Form::number('point', null, ['class' => 'form-control', 'step'=> 0.1, 'min'=> 0,'disabled']) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('rebate', '返利:') !!}
        {!! Form::number('rebate', null, ['class' => 'form-control', 'step'=> 0.1, 'min'=> 0,'disabled']) !!}

    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('t_ch', '修改:') !!}
        <br>
        <button class="btn btn-default" type="button" name="t_ch" onclick="javascript:$('input[type=\'number\']').prop('disabled',false);$('input[type=\'number\']').eq(0).focus();">献金和返利</button>
    </div>
</div>
<div class="form-group col-sm-12">
    <!-- Superior Id Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('superior_id', '上级:') !!}

        {!! Form::select('superior_id', resolve(\App\Repositories\UserRepository::class)->another($user->id ?? ''),
        $user->superior_id ?? old('superior_id'), ['class' => 'form-control dept_select','id'=>"dept"]) !!}
    </div>

    <!-- Status Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('status', '状态:') !!}
        {!! Form::select('status', constants('USER_STATUS'), $user->status ?? old('status'), ['class' => 'form-control']) !!}
    </div>


</div>
{{-- <div class="form-group col-sm-12">
    <!-- Img Head Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('img_head', '头像:') !!}
        <input type="hidden" id="img_heads" value="{{ $user->img_head ?? old('img_head') }}">
        <div class="controls">
            <input id="img_head_file" type="file" class="file-loading" accept="image/*">
            <input type="hidden" name="img_head" id="img_head" value="{{ $user->img_head ?? old('img_head') }}">
        </div>--}}
        {{--{!! Form::text('img_head', null, ['class' => 'form-control']) !!}--}}
        {{--</div>
</div> --}}
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">返回</a>
</div>
@section('scripts')
<!-- <script type="text/javascript" src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script> -->
<script type="text/javascript" src="{{ URL::asset('/choosen/chosen.jquery.min.js') }}"></script>
<script>

    $(function () {

        $(".file-preview-image").attr("src",$("#img_heads").val());

        $('.dept_select').chosen();
        $('#div-distpicker').distpicker();
        // $('#div-distpicker').distpicker()

        var province = "{!! $user->province ?? null  !!}";

        if (province) {
            defaultRegion(province)
        }
        function defaultRegion(province) {
            $('#province option[value=' + province + ']').attr('selected', true)
            $('#province').change()
            $('#city option[value="{!! $user->city ?? null  !!}"]').attr('selected', true)
            $('#city').change()
            $('#county option[value="{!! $user->county ?? null !!}"]').attr('selected', true)
        }
    });
    fileinput('img_head');

    function fileinput(ref) {
        var $ref = $('#' + ref);
        var $refFile = $('#' + ref + '_file');
        // console.log($('#' + ref + '_file'));
        var imgPaths = $ref.val().split(',').filter(function (t) {
            return Boolean(t)
        }).map(function (imgPath) {
            return "<img src='/" + imgPath + "' class='file-preview-image'>"
        })

        var imgConfigs = imgPaths.map(function () {
            return {
                width: '120px',
                url: '/eim/project/deleteFile.do', // 删除url
                key: 1, // 删除是Ajax向后台传递的参数
                extra: {id: 100}
            }
        })

        $('#' + ref + '_file').eq(0).fileinput({
            language: 'zh',
            uploadUrl: "/upload",
            showUpload: true,//是否显示上传按钮
            // showRemove: false,//是否显示删除按钮
            // showCaption: true,//是否显示输入框
            showPreview:true,
            showCancel:true,
            dropZoneEnabled: false,
            maxFileCount: 1,
            minFileCount: 0,
            autoReplace: true,
            initialPreviewShowDelete:true,
            msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值！",
            previewFileIcon: '<i class="fa fa-file"></i>',
            allowedPreviewTypes: ['image'],
            initialPreviewConfig: imgConfigs,
            allowedFileExtensions : ['jpg', 'png', 'gif'],
            browseClass: "btn btn-primary", //按钮样式
            initialPreview: imgPaths,
        }).on("fileuploaded", function (e, data) {
            var res = data.response;
            if (res.success === true) {
                $ref.val(res.data.path)
            } else {
                alert('上传失败')
            }
        })
    }
</script>
@endsection
@section('css')
<link type="text/css" href="{{ URL::asset('/choosen/chosen.min.css') }}" rel="stylesheet"/>
<style>
    img.file-preview-image {
        width: 80px;
        height: 80px;
    }
</style>
@endsection