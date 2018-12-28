<div class="col-sm-12" style="padding: 35px 0px!important;">
    {!! Form::hidden('search',6) !!}
    {!! Form::hidden('searchFields','type:=') !!}
    {!! Form::hidden('type',6) !!}
    <div class="form-group col-sm-12">
        <div class="col-sm-2">
            名称
        </div>
        <div class="col-sm-6">
            {!! Form::text('name',null,['class'=>'form-control','style'=>'width:35%;','placeholder'=>'树苗名称']) !!}
            <!--            <input class="form-control" style="width: 35%;" name="level" type="number" value="0" placeholder="数字越大，等级越高" />-->
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-2">
            价格
        </div>
        <div class="col-sm-6">
            {!!
            Form::number('price',$product->price??1,['class'=>'form-control','style'=>'width:35%;','placeholder'=>'树苗价格','step'=>0.01])
            !!}
            <!--            <input class="form-control" style="width: 35%;" name="level" type="number" value="0" placeholder="数字越大，等级越高" />-->
        </div>
    </div>
    <div class="col-sm-12">
        <label class="col-sm-12">
            <span class="col-sm-2" style="margin: 8px -14px;margin-right: 4px;">图片:</span>
            <div class="controls col-sm-10">
                <input id="img_main_file" type="file" class="file-loading" accept="image/*">
                <input type="hidden" name="img_main" id="img_main"
                       value="{{ $product->img_main ?? '' }}">
            </div>
        </label>
        <label class="col-sm-12" style="margin-left: 16.5%;">
            {!! Form::hidden('details','0') !!}
            {{--{!! Form::checkbox('details', 'true',[1===($product->details??0)?'checked':'','id'=>'details']) !!}--}}
            <input type="checkbox" id="details" name="details" value="1" {!! 1===($product->details??0)?'checked':'' !!}
            />
            {!! Form::label('details', '详情显示首图:') !!}

            <!-- <input type="checkbox"><span>详情显示首图</span> -->
        </label>

    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-2">
            是否可用
        </div>
        <div class="col-sm-6">
            {!! Form::select('status',constants('CATE_STATUS'),null,['class'=>'form-control','style'=>'width:35%;']) !!}
            <!--            <input class="form-control" style="width: 35%;" name="level" type="number" value="0" placeholder="数字越大，等级越高" />-->
        </div>
    </div>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index',['type'=>6]) !!}" class="btn btn-default">返回</a>
</div>
@section('scripts')
<script>
    fileinput('img_main', 10);

    function fileinput(ref, num) {
        num = num || 10;

        var $ref = $('#' + ref);
        var $refFile = $('#' + ref + '_file');
        var imgPaths = $ref.val().split(',').filter(function (t) {
            return Boolean(t)
        }).map(function (imgPath) {
            return "<img src='/" + imgPath + "'  class='file-preview-image'>"
        });

        var imgConfigs = imgPaths.map(function () {
            return {
                width: '120px',
                //url: '/eim/project/deleteFile.do', // 删除url
                //key: 1, // 删除是Ajax向后台传递的参数
                //extra: {id: 100}
            }
        });

        $refFile.fileinput({
            language: 'zh',
            uploadUrl: "/upload",
            showUpload: true,//是否显示上传按钮
            showRemove: true,//是否显示删除按钮
            // showCaption: true,//是否显示输入框
            showPreview: true,
            showCancel: true,
            dropZoneEnabled: false,
            maxFileCount: num,
            minFileCount: 0,
            initialPreviewShowDelete: true,
            msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值！",
            previewFileIcon: '<i class="fa fa-file"></i>',
            allowedPreviewTypes: ['image'],
            initialPreviewConfig: imgConfigs,
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
            browseClass: "btn btn-primary", //按钮样式
            initialPreview: imgPaths,
            // initialPreview: imgPaths,
            layoutTemplates: {
                actionDelete: '',
                actionUpload: '',
            }
        }).on("fileuploaded", function (e, data) {
            var res = data.response;
            if (res.success === true) {
                if (num === 1) {
                    $ref.val(res.data.path)
                } else {
                    $ref.val($ref.val() ? $ref.val() + ',' + res.data.path : res.data.path)
                }
            } else {
                alert('上传失败')
            }
        }).on('filecleared', function (e, data, msg) {
            if (confirm("确定清空轮播图吗？保存后生效")) {
                // console.log($ref);
                $ref.val("");
                setTimeout(function () {
                    $('#l_rsize').prev('div').eq(0).height($('#l_rsize')[0].offsetHeight);
                }, 200);

            } else {
                window.location.reload()
            }
        });
        // var btn = num == 1 ? document.getElementsByClassName('fileinput-remove-button')[0] : document.getElementsByClassName('fileinput-remove-button')[1];
        //
        // btn.onclick = function () {
        //     if (confirm("确定清空轮播图吗？保存后生效")) {
        //         $ref.val("")
        //     } else {
        //         window.location.reload()
        //     }
        // };

    }
</script>
@endsection
@section('css')
<style>
    img.file-preview-image {
        width: 80px;
        height: 80px;
    }

    .file-zoom-content > .file-preview-image {
        width: 75%;
        height: 75%;
    }
</style>
@endsection