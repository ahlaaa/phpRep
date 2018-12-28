<!-- User Id Field -->
@if(isset($store))
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 750px;">
            <div class="modal-header" style="background-color:#ccc;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">预存款充值</h4>
            </div>
            <div class="modal-body row" style="padding-left:30px;">
                <div class="form-group col-sm-12">
                    <div class="form-group col-sm-6" style="border: 1px solid #ccc;box-shadow: 1px 1px 7px;border-radius: 4%;height: 143px;">
                        <div class="form-group col-sm-5">
                            <strong>门店名称</strong>
                        </div>
                        <div class="" style="display: inline-block;">
                            <span class='form-control' style="border: 0px;"><img alt="" style="max-width: 38px;border-radius: 50%;" title="门店头像" src="/{{ $store->img_avatar }}" />&nbsp;&nbsp;{{ $store->name??null }}<span>
                        </div>
                    </div>
                    <div class="form-group col-sm-6" style="border: 1px solid #ccc;box-shadow: 1px 1px 7px;border-radius: 4%;height: 143px;">
                        <div class="form-group col-sm-5">
                            <strong>门店用户</strong>
                        </div>
                        <div class=""  style="display: inline-block;">
                        
                            {!! Form::text('user_id',  app(\App\Repositories\UserRepository::class)->stores()[$store->user_id??null]??null, ['class' => 'form-control','disabled',"style"=>'border: 0px;background-color: #fff;']) !!}
                    
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <div class="form-group col-sm-12">
                    <strong>充值预存款</strong>
                    </div>
                    <div style='background-color:blue;height:1px;border:none;'></div>
                    <div class="form-group col-sm-12">
                        <div class="form-group col-sm-12">
                            <div class="form-group col-sm-3">
                                <label><strong>当前余额</strong></label>
                            </div>
                            <div class="form-group col-sm-4">
                                <span id="final1">{!! $store->balance??0 !!}</span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="form-group col-sm-3">
                                <label><strong>最终余额</strong></label>
                            </div>
                            <div class="form-group col-sm-4">
                                <span id="final">{!! $store->balance??0 !!}</span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="form-group col-sm-3">
                                <label><strong>变化</strong></label>
                            </div>
                            <div class="form-group col-sm-8">
                                <span><input type="radio" checked name="r_balance" name="r_balance_add" id="r_balance_add" value="1" /><label for="r_balance_add">增加</label></span>
                                <span><input type="radio" name="r_balance" name="r_balance_del" id="r_balance_del" value="-1" /><label for="r_balance_del">减少</label></span>
                                <span><input type="radio" name="r_balance" name="r_balance_final" id="r_balance_final" value="0" /><label for="r_balance_final">最终余额</label></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="form-group col-sm-3">
                                <label for="add_num"><strong>充值数量</strong></label>
                            </div>
                            <div class="form-group col-sm-4">
                                <span><input onblur="javascript:blurs(this);" id="add_num" type="number" value="0" /></span>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" id="m_close" class="btn btn-default" data-dismiss="modal">取消充值</button>
                <button type="button" class="btn btn-primary" id="excelOut">充值</button>
            </div>
        </div>
    </div>

</div>
@endif
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    {!! Form::label('user_id', '门店用户:') !!}
    {!! Form::select('user_id',  app(\App\Repositories\UserRepository::class)->stores(), $store->user_id ?? old('user_id'), ['class' => 'form-control']) !!}
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-2">
    {!! Form::label('telephone', '电话:') !!}
    {!! Form::text('telephone', null, ['class' => 'form-control']) !!}
</div>

</div>
<div class="form-group col-sm-12">

<!-- Name Field -->
<div class="form-group col-sm-2">
    {!! Form::label('name', '门店名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-2">
    {!! Form::label('balance', '预存款:') !!}
    @if(isset($store))
    {!! Form::text('balance1', $store->balance??0, ['class' => 'form-control','disabled',"id"=>'st_balance']) !!}
    {!! Form::hidden('balance', $store->balance??0, ['class' => 'form-control',"id"=>'st_balance1']) !!}
    @else
    {!! Form::text('balance', $store->balance??0, ['class' => 'form-control',"id"=>'balance']) !!}
    @endif
</div>
@if(isset($store->user_id))
<div class="form-group col-sm-2">
    {!! Form::label('button', '',["style"=>'opacity: 0;']) !!}
    <button name="button" id="button" class="btn btn-primary" style="display: -webkit-box;" type="button" data-toggle="modal" data-target="#myModal">
    充值
    </button>
</div>
@endif
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
<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', '地址:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="form-group col-sm-12">
<!-- Balance Field -->
<!-- Status Field -->
<div class="form-group col-sm-2">
    {!! Form::label('status', '状态:') !!}
    {!! Form::select('status',  constants('STORE_STATUS'), $store->status ?? old('status'), ['class' => 'form-control']) !!}
</div>
</div>
<div class="form-group col-sm-12">
<!-- Img Main Field -->
<div class="form-group col-sm-2 col-lg-2">
    {!! Form::label('img_avatar', '门店头像:') !!}
    <div class="controls">
        <input id="img_avatar_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_avatar" id="img_avatar" value="{{ $store->img_avatar ?? '' }}">
    </div>
</div>
</div>
<div class="form-group col-sm-12">
<!-- Img Main Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('img_introduce', '图片展示:') !!}
    <div class="controls">
        <input id="img_introduce_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_introduce" id="img_introduce" value="{{ $store->img_introduce ?? '' }}">
    </div>
</div>
</div>
<div class="form-group col-sm-12 col-lg-12" id="container" style="width: 100%;height: 185px">

</div>
<div style="margin-left: 9px" class="form-group col-sm-3 col-lg-12">
    <input id="address1" type="text" placeholder="中国,北京,海淀区,海淀大街38号" style="width: 230px;max-width: 450px" value="">
    <button onclick="javascript:void(0);" type="button" id="codeAddress">search</button>
    <button type="button" onclick="javascript:get();">获取经纬度</button>
</div>
<div class="form-group col-sm-12">
<!-- Img Main Field -->
<div class="form-group col-sm-2 col-lg-2">
    {!! Form::label('lng', '经度:') !!}
    {!! Form::text('lng', null, ['class' => 'form-control', 'readonly',"id"=>"lng"]) !!}
</div>

<!-- Img Main Field -->
<div class="form-group col-sm-2 col-lg-2">
    {!! Form::label('lat', '纬度:') !!}
    {!! Form::text('lat', null, ['class' => 'form-control', 'readonly',"id"=>"lat"]) !!}
</div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary',"id"=>"f_sub"]) !!}
    <a href="{!! route('stores.index') !!}" class="btn btn-default">返回</a>
</div>
@section('scripts')
<script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp"></script>
    <script>
    // $("#add_num").blur(function(){
    //     alert("blur");
    //     var type = $(":radio").val();
    //     var number = $("#add_num").val();
    //     var final = $("#final"),f_htl = $("#final").html();
    //     console.log(type+":"+number+":"+f_htl);
    //     if(type == 0){
    //         final.eq(0).html(number);
    //     }else if(type == 1){
    //         final.eq(0).html(eval(f_htl)+number);
    //     }else{
    //         final.eq(0).html(eval(f_htl)-number);
    //     }
    // });
    $("#excelOut").click(function(){
        var final = $("#final");
        $("#st_balance1").val(final.eq(0).html());
        // $("#m_close").click();
        $("#f_sub").click();
    })
    $("[name='r_balance']").change(function(){
        $("#add_num").focus();
        var f_htl = $("#final1").html();
        if($(this).val()==0){
            $("#add_num").val(f_htl);
        }else{
            $("#add_num").val(0);
        }
    })
    function blurs(e){
        // alert("blur");
        var type = $("[name='r_balance']:checked").val();
        var number = $(e).val();
        var final = $("#final"),f_htl = $("#final1").html();
        // console.log(type+":"+number+":"+f_htl);
        if(type == 0){
            // $("#add_num").val(f_htl);
            final.eq(0).html(number);
        }else if(type == 1){
            final.eq(0).html(eval(f_htl+"+"+number));
        }else{
            if(eval(number) >= 0){
                final.eq(0).html(eval(f_htl+"-"+number));
            }else{
                number = Math.abs(eval(number));
                final.eq(0).html(eval(f_htl+"+"+number));
            }
        }
        
    }
     var station = null, marker1 = null, geocoder1 = null;
        function get() {
            var position = marker1.position;
            console.log(marker1.position);
            $("#lng").val(position.lng);
            $("#lat").val(position.lat);
        }
        $(function () {
            var lng = $("#lng").val(), lat = $("#lat").val();
            var latLng = null, $flag = false;
            console.log(lat + ":" + lng);
            if (lng != 0 || lat != 0) {
                latLng = new qq.maps.LatLng(lat, lng);
                $flag = true;
            } else {
                latLng = new qq.maps.LatLng(39.916527, 116.397128);
            }

            var map = new qq.maps.Map(document.getElementById("container"), {
                // 地图的中心地理坐标。
                center: latLng,// new qq.maps.LatLng(39.916527, 116.397128),
                zoom: 13
            });
            var infoWin = new qq.maps.InfoWindow({
                map: map
            });
            //获取城市列表接口设置中心点
            if (!$flag) {
                citylocation = new qq.maps.CityService({
                    complete: function (result) {
                        map.setCenter(result.detail.latLng);
                    }
                });
                //调用searchLocalCity();方法    根据用户IP查询城市信息。
                citylocation.searchLocalCity();
            }
            var container = document.getElementById("container");
            console.log(latLng);
            if ($flag) {
                setTimeout(setLatLng(latLng), 300);
            }
            var mk2 = null, mk3 = null;
            qq.maps.event.addListener(map, 'click', function (event) {
                var marker = new qq.maps.Marker({
                    position: event.latLng,
                    map: map
                });
                marker1 = marker;
                mk3 = marker;
                qq.maps.event.addListener(marker, 'click', function () {
                    infoWin.open();
                    infoWin.setContent('<div style="text-align:center;white-space:' +
                        'nowrap;margin:10px;">这是新位置</div>');
                    infoWin.setPosition(event.latLng);
                });
                qq.maps.event.addListener(map, 'click', function (event) {
                    marker.setMap(null);
                    if (mk2 != null) {
                        mk2.setMap(null);
                    }
                    //marker = null;
                });

            });
            //调用地址解析类
            var geocoder = new qq.maps.Geocoder({
                complete: function (result) {
                    if (mk3 != null) {
                        mk3.setMap(null);
                    }
                    map.setCenter(result.detail.location);
                    var marker = new qq.maps.Marker({
                        map: map,
                        position: result.detail.location
                    });
                    qq.maps.event.addListener(marker, 'click', function () {
                        infoWin.open();
                        infoWin.setContent('<div style="text-align:center;white-space:' +
                            'nowrap;margin:10px;">这是搜索位置</div>');
                        infoWin.setPosition(result.detail.location);
                    });
                    marker1 = marker;
                    mk2 = marker;
                }
            });
            $("#codeAddress").click(function () {
                var address = document.getElementById("address1").value;
                //通过getLocation();方法获取位置信息值
                geocoder.getLocation(address);
            })
            geocoder1 = geocoder;
            function setLatLng(latLng) {
                var marker = new qq.maps.Marker({
                    position: latLng,
                    map: map
                });
                qq.maps.event.addListener(marker, 'click', function () {
                    infoWin.open();
                    infoWin.setContent('<div style="text-align:center;white-space:' +
                        'nowrap;margin:10px;">这是原先位置</div>');
                    infoWin.setPosition(latLng);
                });
            }
            $('#div-distpicker').distpicker()

            var province = "{!! $store->province ?? null  !!}";

            if (province) {
                defaultRegion(province)
            }
            function defaultRegion(province) {
                $('#province option[value=' + province + ']').attr('selected', true)
                $('#province').change()
                $('#city option[value="{!! $store->city ?? null  !!}"]').attr('selected', true)
                $('#city').change()
                $('#county option[value="{!! $store->county ?? null !!}"]').attr('selected', true)
            }

            fileinput('img_avatar', 1)
            fileinput('img_introduce')


            function fileinput(ref, num) {
                num = num || 9

                var $ref = $('#' + ref)
                var $refFile = $('#' + ref + '_file')
                var imgPaths = $ref.val().split(',').filter(function (t) {
                    return Boolean(t)
                }).map(function (imgPath) {
                    return "<img src='/" + imgPath + "' class='file-preview-image'>"
                })
                console.log(imgPaths)

                var imgConfigs = imgPaths.map(function () {
                    return {
                        width: '120px',
                        //url: '/eim/project/deleteFile.do', // 删除url
                        //key: 1, // 删除是Ajax向后台传递的参数
                        //extra: {id: 100}
                    }
                })

                $refFile.fileinput({
                    language: 'zh',
                    uploadUrl: "/upload",
                    showUpload: true,//是否显示上传按钮
                    showRemove: true,//是否显示删除按钮
                    // showCaption: true,//是否显示输入框
                    showPreview:true,
                    showCancel:true,
                    dropZoneEnabled: false,
                    maxFileCount: num,
                    minFileCount: 0,
                    initialPreviewShowDelete:true,
                    msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值！",
                    previewFileIcon: '<i class="fa fa-file"></i>',
                    allowedPreviewTypes: ['image'],
                    initialPreviewConfig: imgConfigs,
                    allowedFileExtensions : ['jpg', 'png', 'gif'],
                    browseClass: "btn btn-primary", //按钮样式
                    initialPreview: imgPaths,
			layoutTemplates:{
				actionDelete:'',
				actionUpload:'',
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
                }).on('filepreremove', function(event, id, index) {       //只是你删除重新选择的图片才会触发，而删除原图片不会触发。
       console.log('id = ' + id + ', index = ' + index);
    }).on('filepredelete', function(event, key, jqXHR, data) {  //就是在删除原图片之前触发，而新选择的图片不会触发。能满足我们的要求。
	//$ref.val("");
	//var rps = document.querySelectorAll(".file-preview-image");
	//console.log(rps);
         })
var btn = num == 1 ? document.getElementsByClassName('fileinput-remove-button')[0] : document.getElementsByClassName('fileinput-remove-button')[1];

btn.onclick = function(){
	if(confirm("确定清空轮播图吗？保存后生效")){
	$ref.val("")
}else{
	window.location.reload()}
}
        }
            
        })
    </script>
@endsection
@section('css')
    <style>
        label:hover{
            cursor:pointer!important
        }
        #introduce_div,
        #enterprise_synopsis_div,
        #enterprise_situation_div,
        #enterprise_growth_div,
        #enterprise_coalition_div {
            width: 100%;
            min-height: 330px;
            height: auto;
        }
        #introduce,#enterprise_synopsis,#enterprise_situation,#enterprise_growth,#enterprise_coalition{
            display: none;
        }
.krajee-default .file-preview-image{
	width:150px;
	max-height:180px;
}
.file-zoom-content img{
	width:100%;
	max-height:100%;
}
    </style>
@endsection