<div class="col-sm-12">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active">
            <a href="#base" data-toggle="tab">基本</a>
        </li>
        <li><a href="#orders_user" data-toggle="tab">交易信息</a></li>
        <li><a href="#distributers" data-toggle="tab">分销商信息</a></li>
        <li><a href="#proxs" data-toggle="tab">区域代理信息</a></li>
        <!--    <li><a href="#sales" data-toggle="tab">分销</a></li>-->
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
<div id="myTabContent" class="tab-content col-sm-12">
    <?php
        $grades = $user->grades??[1];
        $list11 = array();//分销商数组
        $list22 = array();//代理商数组
//        $list_cp1 = array();//分销商数组
//        $list_cp2 = array();//代理商数组

        foreach ($grades as $grade){
            if ($grade->pivot->type == 2){
                array_push($list11,$grade);
            }
            if ($grade->pivot->type == 3){
                array_push($list22,$grade);
            }
        }
//        $list_cp1 = array_add$list11->copy();
//        $list_cp2 = $list22->copy();
        $list1 = end($list11);//array_diff(array_pop($list11),$list_cp1);
        $list2 = end($list22);//array_diff(array_pop($list22),$list_cp2);
//        if(!isset($list1))
//            $list1 = array();//分销商数组
//        if(!isset($list2))
//            $list2 = array();//代理商数组
    ?>
    <?php echo $__env->make('users.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('users.orders', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('users.distributers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('users.proxs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('users.index'); ?>" class="btn btn-default">返回</a>
</div>
<?php $__env->startSection('scripts'); ?>
<script>
    console.log(<?php echo json_encode($list2); ?>);
    console.log(<?php echo json_encode($list1); ?>);


    // $('#div-distpicker').distpicker()

    // var province = "<?php echo $user->province ?? null; ?>";
    //
    // if (province) {
    //     defaultRegion(province)
    // }
    // function defaultRegion(province) {
    //     $('#prox_province option[value=' + province + ']').attr('selected', true)
    //     $('#prox_province').change();
    //     $('#prox_city option[value="<?php echo $user->city ?? null; ?>"]').attr('selected', true)
    //     $('#city').change();
    //     $('#prox_county option[value="<?php echo $user->county ?? null; ?>"]').attr('selected', true)
    // }
    $(function(){
        var value = $("#prox_grade").val();

        $('#prox-distpicker').distpicker();

        var province = "<?php echo isset($list2->pivot->prox_name4)?$list2->pivot->prox_name4:''; ?>",
            city = '<?php echo isset($list2->pivot->prox_name3)?$list2->pivot->prox_name3:''; ?>',
            country1 = "<?php echo isset($list2->pivot->prox_name2)?$list2->pivot->prox_name2:''; ?>";

        if (province) {
            defaultRegion(province)
        }
        function defaultRegion(province) {
            $('#prox_province option[value=' + province + ']').attr('selected', true)
            $('#prox_province').change()
            $('#prox_city option[value="'+city+'"]').attr('selected', true)
            $('#prox_city').change()
            $('#prox_country option[value="'+country1+'"]').attr('selected', true)
        }
        $("#user_grade").children('option').attr('name','grades_id');
        $("#dis_grade").children('option').attr('name','gradesid');
        $("#prox_grade").children('option').attr('name','gradesid1');
        if($("#dis_grade").data('id'))
            $("#dis_grade").val($("#dis_grade").data('id'));
        if($("#prox_grade").data('id'))
            $("#prox_grade").val($("#prox_grade").data('id'));
        // $(".is_oauthed").attr('name','grades[8][is_oauthed]');
        // $("#u_distribute_type").attr('name','grades[8][type]');
        // $("#u_distribute_id").attr('name','grades[8][type]');
        // $(".dist_status").attr('name','grades[8][status]');
        // $(".dist_is_autoup").attr('name','grades[8][is_autoup]');
    });
    var flag = false;
    function change_pwd(e) {
        $(e).attr('name','password');
        flag = true;
    }
    function confirm_ch() {
        if(flag){
            if(!confirm('密码已修改，是否保存?')){
                $('#password').attr('name','');
            }
        }
        return true;
    }
    // 分销
    function select_desc(e){
        var value = $(e).val()?$(e).val():null;
        $(e).attr('name','gradesid');
        $(e).children('option').attr('name','gradesid');
        if(value) {
            $(".is_oauthed").attr('name', 'grades[' + value + '][is_oauthed]');
            $("#u_distribute_type").attr('name', 'grades[' + value + '][type]');
            $("#u_distribute_id").attr('name', 'grades[' + value + '][superior_id]');
            $(".dist_status").attr('name', 'grades[' + value + '][status]');
            $(".dist_is_autoup").attr('name', 'grades[' + value + '][is_autoup]');
        }

    }
    function del_disc_sup() {
        $("#u_distribute_id").val("");
        $("#u_distribute_name").val("");
    }
    function select_disc_sup() {
        if ($("#disc_sup_id").val()) {
            $("#u_distribute_id").val($("#disc_sup_id").val());
            $("#u_distribute_name").val($("#disc_sup_id").children("option[value='"+$("#disc_sup_id").val()+"']").html());
        }
        $("#disc_Modal").modal('hide');
    }
    // 代理
    function add_prox() {
        var value = $("#prox_grade").val()?$("#prox_grade").val():0,province = $("#prox_province").val(),
            city = $("#prox_city").val(),country = $("#prox_country").val(),prox_level = $('#prox_level').val(),
            prox_level_name = $('#prox_level option:selected').val();
        if (value == 0 || !prox_level)
            return false;
        console.log($(".prox_name4"));
        $("#prox_level_name").html(prox_level_name+"级代理商");
        $('#prox_level').attr('name','grades['+value+'][prox_level]');
        // 区
        if (value == 2 && country){
            $(".prox_name4").eq(0).children('span').eq(0).html(province);
            $(".prox_name4").eq(0).children('input').eq(0).val(province).attr('name','grades['+value+'][prox_name4]');
            $(".prox_name3").eq(0).children('span').eq(0).html(city);
            $(".prox_name3").eq(0).children('input').eq(0).val(city).attr('name','grades['+value+'][prox_name3]');
            $(".prox_name2").eq(0).children('span').eq(0).html(country);
            $(".prox_name2").eq(0).children('input').eq(0).val(country).attr('name','grades['+value+'][prox_name2]');
        }

        // 市
        if (value == 3 && city){
            $(".prox_name4").eq(0).children('span').eq(0).html(province);
            $(".prox_name4").eq(0).children('input').eq(0).val(province).attr('name','grades['+value+'][prox_name4]');
            $(".prox_name3").eq(0).children('span').eq(0).html(city);
            $(".prox_name3").eq(0).children('input').eq(0).val(city).attr('name','grades['+value+'][prox_name3]');
            $(".prox_name2").eq(0).children('span').eq(0).html("");
            $(".prox_name2").eq(0).children('input').eq(0).val("").attr('name','grades['+value+'][prox_name2]');
        }

        // 省
        if (value == 4 && province){
            $(".prox_name4").eq(0).children('span').eq(0).html(province);
            $(".prox_name4").eq(0).children('input').eq(0).val(province).attr('name','grades['+value+'][prox_name4]');
            $(".prox_name3").eq(0).children('span').eq(0).html("");
            $(".prox_name3").eq(0).children('input').eq(0).val("").attr('name','grades['+value+'][prox_name3]');
            $(".prox_name2").eq(0).children('span').eq(0).html("");
            $(".prox_name2").eq(0).children('input').eq(0).val("").attr('name','grades['+value+'][prox_name2]');
        }
    }
    function prox_change(e) {
        var value = $(e).val()?$(e).val():0;
        console.log(value);
        // 区
        if (value == 2){
            $("#div-province").show();
            $("#div-city").show();
            $("#div-country").show();
        }

        // 市
        if (value == 3){
            $("#div-province").show();
            $("#div-city").show();
            $("#div-country").hide();
        }

        // 省
        if (value == 4 || value == 0){
            $("#div-province").show();
            $("#div-city").hide();
            $("#div-country").hide();
        }
        $(e).attr('name','gradesid1');
        $(e).children('option').attr('name','gradesid1');
        if (value != 0) {
            $(".is_oauthed2").attr('name', 'grades[' + value + '][is_oauthed]');
            $("#u_distribute_types2").attr('name', 'grades[' + value + '][type]');
            $(".dist_status2").attr('name', 'grades[' + value + '][status]');
            $(".dist_is_autoup2").attr('name', 'grades[' + value + '][is_autoup]');
        }
    }
</script>
<?php $__env->stopSection(); ?>