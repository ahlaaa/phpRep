<div class="col-sm-12">
    <?php echo Form::hidden('uri',$uri??null); ?>

<ul id="myTab" class="nav nav-tabs">
    <li class="active">
        <a href="#base" data-toggle="tab">基本</a>
    </li>
    <li><a href="#cate" data-toggle="tab">库存/规格</a></li>
    <li><a href="#parameter" data-toggle="tab">参数</a></li>
    <li><a href="#detail" data-toggle="tab">详情</a></li>
    <li><a href="#oauth" data-toggle="tab">购买权限</a></li>
    <li><a href="#vips" data-toggle="tab">会员折扣</a></li>
    <li><a href="#sales_data" data-toggle="tab">分销</a></li>
    <!--    <li class="dropdown">-->
    <!--        <a href="#" id="myTabDrop1" class="dropdown-toggle"-->
    <!--           data-toggle="dropdown">Java <b class="caret"></b>-->
    <!--        </a>-->
    <!--        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">-->
    <!--            <li><a href="#jmeter" tabindex="-1" data-toggle="tab">-->
    <!--                    jmeter</a>-->
    <!--            </li>-->
    <!--            <li><a href="#ejb" tabindex="-1" data-toggle="tab">-->
    <!--                    ejb</a>-->
    <!--            </li>-->
    <!--        </ul>-->
    <!--    </li>-->
</ul>
</div>
<div id="myTabContent" class="form-group tab-content col-sm-12">
<!--    额外参数-->
    <?php echo $__env->make('products.parameters', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('products.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!--    <div class="tab-pane fade" id="cate">-->
<!--        <p>库存/规格</p>-->
<!--    </div>-->
    <?php echo $__env->make('products.cate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('products.details', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!--    权限-->
    <?php echo $__env->make('products.oauth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!--    会员折扣-->
    <?php echo $__env->make('products.sales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!--    <div class="tab-pane fade" id="vips">-->
<!--        <p>会员折扣</p>-->
<!--    </div>-->
<!--    分销-->
    <?php echo $__env->make('products.distribute', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!--    <div class="tab-pane fade" id="sales">-->
<!--        <p>分销</p>-->
<!--    </div>-->
    <!--    <div class="tab-pane fade" id="jmeter">-->
    <!--        <p>jMeter 是一款开源的测试软件。它是 100% 纯 Java 应用程序，用于负载和性能测试。</p>-->
    <!--    </div>-->
    <!--    <div class="tab-pane fade" id="ejb">-->
    <!--        <p>Enterprise Java Beans（EJB）是一个创建高度可扩展性和强大企业级应用程序的开发架构，部署在兼容应用程序服务器（比如 JBOSS、Web Logic 等）的 J2EE 上。-->
    <!--        </p>-->
    <!--    </div>-->
</div>
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('products.index'); ?>" class="btn btn-default">返回</a>
</div>
<?php $__env->startSection('scripts'); ?>
<script>
    console.log(<?php echo json_encode($product??null); ?>);
    function check_form() {
        $('input[name="is_common"]').each(function(){
           var che = $(this).prop('checked');
           // console.log($(this).data('id'));
           if(che){
               $($(this).data('id')).val(1);
               $($(this).data('idv')).html("");
           }else{
               $($(this).data('idt')).val(0);
           }
        });
        $(".dis_in_type_v").each(function(){
            var id = $(this).data('id'),that = this,hml = '';
            $(".dis_in_type"+id).each(function(k,v){
                var t_id = $(this).data('id'),t_val = $(this).val();
                if(+k == 0){
                    hml += t_id+":"+t_val;
                }else{
                    hml += ";"+t_id+":"+t_val;
                }
            });
            $(that).val(hml);
        });
        return true;
    }
    function set_dis_details() {
        var g_id = $("#dis_grade_id option:checked").val(),g_hml = $("#dis_grade_id option:checked").html(),
            dis_type = $("#dis_type option:checked").val(),dis_hml = $("#dis_type option:checked").html(),
            len = +$(".div_dis_label").length+1,d_rules = $("#dis_rules").val(),hml = '';

        if(g_id && dis_type){
            var dis_label = $(".dis_div_label[data-id=" + g_id + "]"),in_type_length = +$(".dis_in_type").length+1;
            if(+$(".div_pre_dis").length > 0)
                $(".div_pre_dis").remove();
            if((+dis_label.length) === 0){
                hml = ' <input type="hidden" name="distributes['+g_id+'][type]" value="2" /><label class="col-sm-12 form-group dis_div_label" data-id="'+g_id+'">\n' +
                    '<input type="hidden" name="distributes['+g_id+'][grade_id]" value="'+g_id+'" /> <span class="col-sm-2">\n' +
                    g_hml+
                    ' <input type="hidden" name="distributes['+g_id+'][in_use]" class="is_detail_use" value="" />                       </span>\n' +
                    '<input type="hidden" class="dis_in_type_v" name="distributes['+g_id+'][distribute_type_num]" data-id="'+g_id+'" />  <span class="col-sm-3 ">\n' +
                    '                            <input type="text" value="'+d_rules+'" data-id="'+dis_type+'" placeholder="'+dis_hml+'" class="form-control dis_in_type'+g_id+'" />\n' +
                    '                        </span>\n'  +
                    '                    </label>';
                $("#div_dis_fv").append(hml);
            }else if($('.dis_in_type'+g_id+'[data-id='+dis_type+']').length === 0){
                hml = '<span class="col-sm-3">\n' +
                    '                            <input type="text" data-id="'+dis_type+'" placeholder="'+dis_hml+'" value="'+d_rules+'" class="form-control dis_in_type'+g_id+'" />\n' +
                    '                        </span>';
                $(dis_label).append(hml);
            }
        }
    }
    // $("#kvFileinputModal").change(function(){
    //     if($(this).hasClass('in')){
    //
    //     }
    // });
    //    details
    /*
     富文本 start
     */
    // $(function(){
    var editor = new wangEditor('#content_div')
    var $content = $('#content')

    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $content.val(html)
    }
    editor.customConfig.customUploadImg = function (files, insert) {
        // files 是 input 中选中的文件列表
        // insert 是获取图片 url 后，插入到编辑器的方法

        // 上传代码返回结果之后，将图片插入到编辑器中
        var data = new FormData();
        data.append("file_data", files[0]);
        $.ajax({
            data: data,
            type: "POST",
            url: "/upload", //图片上传出来的url，返回的是图片上传后的路径，http格式
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (datas) { //data是返回的hash,key之类的值，key是定义的文件名
                console.log(datas);
                insert("https://jmy.15dk.top/" + datas.data.path)
            },
            error: function (data) {
                alert("上传失败");
            }
        });
    }
    editor.create()

    editor.txt.html($content.val())

    $content.val(editor.txt.html())
    // })
    /*
     *   富文本 end
     */
    //    base
    $(function () {
        $('#myTab li:eq(0) a').tab('show');
        try{
            if(1===<?php echo 1===($product->on_standards??0)?1:0; ?>){
                $('input[name="on_standards"]').eq(1).click();
            }
        }catch (e) {
            
        }

        $(".file-preview-image").attr("src",$("#img_heads").val());

        // $('.dept_select').chosen();
        $('#div-distpicker').distpicker();
        // $('#div-distpicker').distpicker()

        var province = "<?php echo $user->province ?? null; ?>";

        if (province) {
            defaultRegion(province)
        }
        function defaultRegion(province) {
            $('#province option[value=' + province + ']').attr('selected', true)
            $('#province').change()
            $('#city option[value="<?php echo $user->city ?? null; ?>"]').attr('selected', true)
            $('#city').change()
            $('#county option[value="<?php echo $user->county ?? null; ?>"]').attr('selected', true)
        }

    });
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
                setTimeout(function(){
                    $('#l_rsize').prev('div').eq(0).height($('#l_rsize')[0].offsetHeight);
                },200);

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

    // parameters
    var parameters = new Vue({
        el: '',
        data: {
            row:
                '<tr>' +
                '<td><input type="text" class="form-control"/></td>' +
                '<td><input type="text" class="form-control"/></td>' +
                '<td><input type="button" class="btn btn-danger" onclick="javascript:remove_parameters(this);" value="删除"/></td>' +
                '</tr>'
        }
    })

    function add_parameters(e) {
        $("#parameters").append('<tr class="count_row">' +
            '<td><input type="text" name="parameters['+(+$('.count_row').length+1)+'][p_key]" class="form-control"/></td>' +
            '<td><input type="text" name="parameters['+(+$('.count_row').length+1)+'][p_value]" class="form-control"/></td>' +
            '<td><input type="button" class="btn btn-danger" onclick="javascript:remove_parameters(this);" value="删除"/></td>' +
            '</tr>');
    }

    function remove_parameters(e) {
        // console.log($(e).parents('tr'));
        $(e).parents('tr').remove();
    }
    // 分销
    $(".myTab1").click(function(){
        $(this).prev('input').eq(0).prop('checked',true);
        // $("#"+$(this).data('id')+" input").val("");
        // $("#"+$(this).data('id')+" select").val("");
    })
    $('input[name="is_common"]').click(function(){
        $(this).next('a').eq(0).click();
    })
    // 规格
    var list = [],cates = [],last_list = [];
    $('input[name="on_standards"]').eq(1).click(function(){
        $("#myTabCate1").click();
        var prev = $("#myTabCate1").prev('input');
        $(prev).eq(0).prop('checked',!$(prev).eq(0).prop('checked'));
        if(!$('input[name="on_standards"]').eq(1).prop('checked')){
            $("#cate_data_status").html("");
            $("#standard_data_contents").html("");
            $("#cate_data_contents").html("");
            $("#unuse_standards input").prop('disabled',false);
        }else{
            $("#unuse_standards input").prop('disabled',true);
        }
    });
    $("#myTabCate1").click(function(){
        var prev = $("#myTabCate1").prev('input');
        $(prev).eq(0).prop('checked',!$(prev).eq(0).prop('checked'));
        $("#"+$("#myTabCate1").data("id")).toggle('active in');
        // $('input[name="on_standards"]').click();
        if(!$('input[name="on_standards"]').eq(1).prop('checked')){
            $("#cate_data_status").html("");
            $("#standard_data_contents").html("");
            $("#cate_data_contents").html("");
            $("#unuse_standards input").prop('disabled',false);
        }else{
            $("#unuse_standards input").prop('disabled',true);
        }
    });
    function add_cate(){
        var hml = $(".base_cate").eq(0).clone(true);
        $(hml).attr('style','');
        $("#all_cate").append($(hml));
    }
    function add_child(e){
        var hml = $(".base_cate").eq(0).children('div').eq(0).children('div .panel-body').eq(0).children('span').eq(0).clone(true);
        // console.log($(".base_cate").eq(0).children('div').eq(0).children('div .panel-body'));
        $(e).parents('div').eq(0).next('div .panel-body').eq(0).append($(hml));
    }
    function remove_cate(e){
        $(e).parents('div .panel-default').eq(0).remove();
    }
    function remove_child(e){
        $(e).parents("span").eq(0).remove();
    }
    function refresh_cate() {
        cates = [],list = [],last_list = [];
         var hmls = '<td><input type="number" class="col-sm-12 form-control qty" /></td>\n' +
                '<td><input type="number" class="col-sm-12 form-control pre_price" /></td>\n' +
                '<td><input type="number" class="col-sm-12 form-control price" /></td>\n' +
                '<td><input type="number" class="col-sm-12 form-control old_price" /></td>\n' +
                '<td><input type="number" class="col-sm-12 form-control base_price" /></td>\n' +
                '<td><input type="number" class="col-sm-12 form-control code" /></td>\n' +
                '<td><input type="number" class="col-sm-12 form-control bar_code" /></td>\n' +
                '<td><input type="number" class="col-sm-12 form-control weight" /></td></tr>';
        $('#cate_body').html("");
        $('.in_add').each(function(){
            $(this).remove();
        });
        $(".father_cate").each(function(k,v){
            if(0 === k)
                return true;
            var father_name = $(this).children('input').eq(0).val(),children_name = [];
            $(this).next('div .children_cates').children('span').each(function(k1,v1){
                var c_val = $(this).children(".children_cate").eq(0).val();
                if(c_val)
                    children_name.push($(this).children(".children_cate").eq(0).val());
            });
            if(father_name && 0 < children_name.length)
                cates[father_name] = children_name;
        });
        for (k in cates) {
            // 添加th主规格
            $("#cate_names1").before("<th class='in_add'><span class='col-sm-12' style='padding: 0px;'>" + k + "</span></th>");
            list.push(cates[k]);
        }
        for (index in list) {
            if(+index >= +list.length - 1){
                $.each(list[+list.length-1],function(k,v){
                    var rows = v.split(','),hml = '<tr>';
                    $.each(rows,function(kk,vv){
                        hml += '<td>'+vv+'</td>';
                    });
                    hml += '<td><input type="number" data-id="'+v+',qty" class="col-sm-12 form-control qty" /></td>\n' +
                        '<td><input step="0.01" type="number" data-id="'+v+',pre_price" class="col-sm-12 form-control pre_price" /></td>\n' +
                        '<td><input step="0.01" type="number" data-id="'+v+',price" class="col-sm-12 form-control price" /></td>\n' +
                        '<td><input step="0.01" type="number" data-id="'+v+',old_price" class="col-sm-12 form-control old_price" /></td>\n' +
                        '<td><input step="0.01" type="number" data-id="'+v+',base_price" class="col-sm-12 form-control base_price" /></td>\n' +
                        '<td><input type="text" data-id="'+v+',code" class="col-sm-12 form-control code" /></td>\n' +
                        '<td><input type="text" data-id="'+v+',bar_code" class="col-sm-12 form-control bar_code" /></td>\n' +
                        '<td><input step="0.01" type="number" data-id="'+v+',weight" class="col-sm-12 form-control weight" /></td></tr>';//hmls;
                    $('#cate_body').append(""+hml);
                });
                return false;
            }
            var first_list = list[+index],next_list = list[+index+1];
            last_list=[];
            $.each(first_list,function(k,v){
                if(!next_list){
                    last_list.push(first_list);
                    return false;
                }
                $.each(next_list,function(k1,v1){
                    last_list.push(v+','+v1);
                });
            });
            list[+index+1] = last_list;
        }
        console.log(list,'last_list2');
    }
    function use_cate(){
        // console.log(list);
        last_list = list[list.length-1];
        try {
            if (!confirm('是否使用当前设置的规则') || 0 === last_list.length) {
                $("#cate_data_status").html("");
                $("#standard_data_contents").html("");
                $("#cate_data_contents").html("");
                alert('设置失败,保留更改前规格！');
                return false;
            }
        }catch (e) {
            $("#cate_data_status").html("");
            $("#standard_data_contents").html("");
            $("#cate_data_contents").html("");
            alert('设置失败,保留更改前规格！');
            return false;
        }

        $("#cate_data_status").html("<input type='text' name='is_cate' value='1' /><input type='text' name='change_cate' value='1' />");

        var idx = 0;
        var hhl = '';
        for(index in cates){
            hhl += '<input name="standard['+idx+'][name]" value="'+index+'" /><input name="standard['+idx+'][sequence]" value="'+idx+'" />';
            idx++;
            $.each(cates[index],function(k,v){
                hhl += '<input name="standard['+idx+'][name]" value="'+v+'" /><input name="standard['+idx+'][father_name]" value="'+index+'" /><input name="standard['+idx+'][sequence]" value="'+(k+1)+'" />';
                idx++;
            })
        };
        $("#standard_data_contents").html(hhl);
        hhl = "";
        $.each(last_list,function(k,v){
            // var qty = $("input[data-id='" + v + ",qty']").val();
            // console.log(qty);
            hhl += '<input type="text" name="cate['+k+'][name]" value="'+v+'" /><input type="text" name="cate['+k+'][qty]" value="'+$("input[data-id='" + v + ",qty']").val()+'" />'
            +'<input type="text" name="cate['+k+'][pre_price]" value="'+$("input[data-id='" + v + ",pre_price']").val()+'" /><input type="text" name="cate['+k+'][price]" value="'+$("input[data-id='" + v + ",price']").val()+'" /><input type="text" name="cate['+k+'][old_price]" value="'+$("input[data-id='" + v + ",old_price']").val()+'" />'
            +'<input type="text" name="cate['+k+'][base_price]" value="'+$("input[data-id='" + v + ",base_price']").val()+'" /><input type="text" name="cate['+k+'][code]" value="'+$("input[data-id='" + v + ",code']").val()+'" /><input type="text" name="cate['+k+'][bar_code]" value="'+$("input[data-id='" + v + ",bar_code']").val()+'" />'
            +'<input type="text" name="cate['+k+'][weight]" value="'+$("input[data-id='" + v + ",weight']").val()+'" /><br>';
        });
        $("#cate_data_contents").html(hhl);
        alert('设置成功,保存后生效！');
    }
    $("#cate_head input").bind(/*'input propertychange'*/'blur', function() {
        if($(this).val())
            if(confirm("'"+$(this).parents('span').eq(0).prev('span').eq(0).html()+"'列全部设值:"+$(this).val()+"?"))
                $("."+$(this).data('class')).val($(this).val());
    })
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
    .btn{
        overflow: hidden;
        white-space: inherit;
    }
    .pro_name::after{
        content: '*';
        color: #de422b;
        font-size: 22px;
        vertical-align: -webkit-baseline-middle;
    }
    .text-danger {
        vertical-align: -webkit-baseline-middle;
        /* width: 25px; */
        font-size: 28px;
    }

    input[type="radio"] {
        margin-left: 9px;
    }

    .i_right:after {
        content: "单位,如:个/包/件";
        border: 1px solid #ccc;
        position: absolute;
        right: 15%;
        height: 100%;
        padding-top: 5px;
        color: #ccc;
    }

    .s_right::after {
        content: "件";
        border: 1px solid #ccc;
        position: absolute;
        right: 19%;
        height: 100%;
        padding-top: 5px;
        color: #ccc;
        width: 30px;
        text-align: center;
    }
    .subs_presell::after {
        content: "提示：是否开启商品预售设置";
        position: absolute;
        top: 17px;
        left: 124px;
        color: #bdafaf;
    }
    .subs_price::after {
        content: '尽量填写完整，有助于于商品销售的数据分析';
        position: absolute;
        top: 33px;
        left: 120px;
        color: #bdafaf;
    }

    .full:after {
        content: "元";
        border: 1px solid #ccc;
        position: absolute;
        width: 28px;
        right: 15%;
        text-align: center;
        height: 100%;
        padding-top: 5px;
        color: #ccc;
    }

    .full:before {
        content: "满";
        border: 1px solid #ccc;
        position: absolute;
        left: 18%;
        width: 28px;
        z-index: 99;
        text-align: center;
        height: 100%;
        padding-top: 5px;
        color: #ccc;
    }

    .no_before:before {
        content: '';
        border: none;
        z-index: -1;
    }
    #content_div {
        width: 100%;
        min-height: 330px;
        height: auto;
        background-color: white;
    }

    #content {
        display: none;
    }
    .pieces::after{
        content: "件";
        position: absolute;
        top: 17px;
        right: 110px;
        color: #ccc;
    }
    img.file-preview-image {
        width: 80px;
        height: 80px;
    }
    .file-zoom-content>.file-preview-image{
        width: 75%;
        height: 75%;
    }
    #cate_head input{
        padding: 2px;
    }
    #cate_body input{
         padding: 2px;
     }
</style>
<?php $__env->stopSection(); ?>