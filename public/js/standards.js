var standards_list = [];//初始化规格数组
$(document).ready(function () {
    var isTrue = true;
    var checkbox = $("#checkbox-id");
    checkbox.on("change", function () {
        if (checkbox.prop('checked') == true) {
            $(".shuoming").show();
            $(".add").show();
            $(".content .no").attr('readonly', true)
        } else {
            $(".shuoming").hide();
            $(".xiangmu").hide();
            $(".add").hide();
            $(".table_box").hide();
            $(".content .no").attr('readonly', false)
        }
    })
    //点击添加大模块
    $(".add_BigBtn").on("click", function () {
        var id_length = standards_list.length;
        if (id_length >= 5) {
            alert("最多添加五种规格")
            return false;
        }
        var standards_big = {
            id: id_length,
            name: "",
            stock: "",
            children: []
        };
        var html = '<div class="add_bigBox">'
            + '<div class="xiangmu">'
            + '<div class="xiangmu_box">'
            + '<div class="input-group xiangmu_wrap">'
            + '<input type="text" data-index="' + id_length + '" class="form-control add_bigBox_input add_bigBox_' + id_length + '" placeholder="规格名称（比如颜色，尺寸等）">'
            + '<span class="input-group-btn">'
            + '<button data-index="' + id_length + '" class="btn btn-info add_minBoxBtn" type="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加规格项</button>'
            + '</span>'
            + '<span class="input-group-btn">'
            + '<button data-index="' + id_length + '" class="btn btn-danger removeBigBoxBtn" type="button"><span class="glyphicon glyphicon-remove " aria-hidden="true"></span></button>'
            + '</span>'
            + '</div>'
            + '<div data-index="' + id_length + '" class="xiangmu_add">'
            + '<div class="row minBoxWrap">'
            + '<!-- 这里添加小模块 -->'
            + '</div>'
            + '</div>'
            + '</div>'
            + '</div>'
            + '</div>'
        $('.add_modleWrap').append(html);
        standards_list.push(standards_big);

        $(".table_box").show();
        eventAddMinBox()
        eventRmoveBigBox()
    })

    //在大模块中点击  添加规格项 按钮 
    function eventAddMinBox() {

        //先用off(‘click’) 解除事件绑定，然后添加事件，不然事件会累积添加，造成点击一次添加多个
        $('.add_minBoxBtn').off("click").on('click', function (event) {
            var index = $(this).attr("data-index");
            var id_length_min = standards_list[index].children.length;
            var standards_min = {
                id: id_length_min,
                name: "",
                stock: "",
            };
            var html = '<div class="add_minBox">'
                + '<div class="col-lg-4 col-sm-4 minBox">'
                + '<div class="input-group">'
                + '<!--<span class="input-group-addon">'
                + '<input type="checkbox" aria-label="...">'
                + '</span>-->'
                + '<input type="text" data-indexb="' + index + '" data-index="' + id_length_min + '" class="form-control add_minBox_input add_minBox_' + index + '" aria-label="...">'
                + '<!--<span class="input-group-btn">'
                + '<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></button>'
                + '</span>-->'
                + '<span class="input-group-btn">'
                + '<button data-index="' + id_length_min + '" class="btn btn-default removeBtn" type="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="glyphicon glyphicon-move" aria-hidden="true"></span></button>'
                + '</span>'
                + '</div>'
                + '</div>'
                + '</div>'
            var el = $(event.currentTarget);
            el.parents('.xiangmu_box').find('.minBoxWrap').append(html);
            standards_list[index].children.push(standards_min);
            // console.log(standards_list);
            eventRemoveElem()
        })
    }

    //大模块 中的 叉号 按钮 点击事件
    function eventRmoveBigBox() {
        $('.removeBigBoxBtn').off("click").on('click', function (event) {
            if (confirm("确定删除此规格吗？")) {
                var index_big = $(this).attr("data-index");
                for (var i = 0; i < standards_list.length; i++) {
                    if (standards_list[i].id == index_big) {
                        standards_list.splice(i, 1);
                    }
                }
                var el = $(event.currentTarget);
                el.parents('.xiangmu').remove();
                $(".alert-danger").show();
            }
        })
    }


    //小模块中 叉号 按钮点击事件
    function eventRemoveElem() {
        $('.removeBtn').off("click").on('click', function (event) {
            var index_min = $(this).attr("data-index");
            var index_big = $(this).parents('.xiangmu_add').attr("data-index");
            for (var i = 0; i < standards_list.length; i++) {
                for (var j = 0; j < standards_list[i].children.length; j++) {
                    if (standards_list[i].id == index_big && standards_list[i].children[j].id == index_min) {
                        standards_list[i].children.splice(j, 1);
                    }
                }
            }
            var el = $(event.currentTarget);
            el.parents('.minBox').remove();
            $(".alert-danger").show();
        })
    }

    $("body").on("click", ".refreshBtn", function () {
        var num = $(".kucun_num").val();
        if (num <= 0) {
            $(".Num").val(0);
            $(".kucun_num").val(0);
        } else {
            $(".Num").val(num);
        }

    })
    $(".refresh_BigBtn").on("click", function () {
        updatestandardsList(".add_bigBox_input", ".add_minBox_input");
        // console.log(standards_list);
        $(".alert-danger").hide();
        var t_top_length = standards_list.length * 2;
        t_top_length == 0 ? t_top_length = 2 : t_top_length;
        var t_head = '<div class="row"><div class="col-lg-' + t_top_length + '"></div><div class="col-lg-2">库存</div></div><div class="row">';
        var t_foot = '<div class="col-lg-2"><div class="input-group"><input type="number" min="0" class="form-control kucun_num" placeholder=""><span class="input-group-btn">' +
            '<button class="btn btn-default refreshBtn" type="button"><span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span></button></span></div></div></div>';
        var t_body = "";
        for (var i = 0; i < standards_list.length; i++) {
            t_body += '<div class="col-lg-2">' + standards_list[i].name + '</div>';
        }
        $(".t_head").html(t_head + t_body + t_foot);
        updatestandardsMsg();
    })
    //更新规格信息
    function updatestandardsMsg() {
        var length = standards_list.length;
        if (length == 0) {
            return false;
        }
        var f_head = "";
        if (length == 1) {
            for (var j = 0; j < standards_list[0].children.length; j++) {
                f_head += '<div class="table_line"></div><div class="row table_last">'
                    + '<div class="col-lg-2">' + standards_list[0].children[j].name + '</div>'
                    + '<div class="col-lg-2"><div class="input-group">'
                    + '<input type="number" class="form-control Num" id="spece_' + j + '" placeholder="">'
                    + '</div></div>'
                    + '</div>'
            }
        }
        if (length == 2) {
            for (var j = 0; j < standards_list[0].children.length; j++) {
                var f_head_0 = "";
                for (var x = 0; x < standards_list[1].children.length; x++) {
                    if (x == 0) {
                        f_head_0 += '<div class="table_line"></div><div class="row table_last">'
                            + '<div class="col-lg-2">' + standards_list[0].children[j].name + '</div>'
                            + '<div class="col-lg-2">' + standards_list[1].children[x].name + '</div>'
                            + '<div class="col-lg-2"><div class="input-group">'
                            + '<input type="number" class="form-control Num" id="spece_' + j + x + '" placeholder="">'
                            + '</div></div>'
                            + '</div>'
                    } else {
                        f_head_0 += '<div class="row table_last">'
                            + '<div class="col-lg-2"></div>'
                            + '<div class="col-lg-2">' + standards_list[1].children[x].name + '</div>'
                            + '<div class="col-lg-2"><div class="input-group">'
                            + '<input type="number" class="form-control Num" id="spece_' + j + x + '" placeholder="">'
                            + '</div></div>'
                            + '</div>'
                    }

                }
                f_head += f_head_0;
            }
        }
        if (length == 3) {
            for (var j = 0; j < standards_list[0].children.length; j++) {
                var f_head_0 = "";
                for (var x = 0; x < standards_list[1].children.length; x++) {
                    for (var k = 0; k < standards_list[2].children.length; k++) {
                        if (x == 0 && k == 0) {
                            f_head_0 += '<div class="table_line"></div><div class="row table_last">'
                                + '<div class="col-lg-2">' + standards_list[0].children[j].name + '</div>'
                                + '<div class="col-lg-2">' + standards_list[1].children[x].name + '</div>'
                                + '<div class="col-lg-2">' + standards_list[2].children[k].name + '</div>'
                                + '<div class="col-lg-2"><div class="input-group">'
                                + '<input type="number" class="form-control Num" id="spece_' + j + x + k + '" placeholder="">'
                                + '</div></div>'
                                + '</div>'
                        } else {
                            if (k == 0) {
                                f_head_0 += '<div class="row table_last">'
                                    + '<div class="col-lg-2"></div>'
                                    + '<div class="col-lg-2">' + standards_list[1].children[x].name + '</div>'
                                    + '<div class="col-lg-2">' + standards_list[2].children[k].name + '</div>'
                                    + '<div class="col-lg-2"><div class="input-group">'
                                    + '<input type="number" class="form-control Num" id="spece_' + j + x + k + '" placeholder="">'
                                    + '</div></div>'
                                    + '</div>'
                            } else {
                                f_head_0 += '<div class="row table_last">'
                                    + '<div class="col-lg-2"></div>'
                                    + '<div class="col-lg-2"></div>'
                                    + '<div class="col-lg-2">' + standards_list[2].children[k].name + '</div>'
                                    + '<div class="col-lg-2"><div class="input-group">'
                                    + '<input type="number" class="form-control Num" id="spece_' + j + x + k + '" placeholder="">'
                                    + '</div></div>'
                                    + '</div>'
                            }
                        }
                    }
                }
                f_head += f_head_0;
            }
        }
        if (length == 4) {
            for (var j = 0; j < standards_list[0].children.length; j++) {
                var f_head_0 = "";
                for (var x = 0; x < standards_list[1].children.length; x++) {
                    for (var k = 0; k < standards_list[2].children.length; k++) {
                        for (var l = 0; l < standards_list[3].children.length; l++) {
                            if (x == 0 && k == 0 && l == 0) {
                                f_head_0 += '<div class="table_line"></div><div class="row table_last">'
                                    + '<div class="col-lg-2">' + standards_list[0].children[j].name + '</div>'
                                    + '<div class="col-lg-2">' + standards_list[1].children[x].name + '</div>'
                                    + '<div class="col-lg-2">' + standards_list[2].children[k].name + '</div>'
                                    + '<div class="col-lg-2">' + standards_list[3].children[l].name + '</div>'
                                    + '<div class="col-lg-2"><div class="input-group">'
                                    + '<input type="number" class="form-control Num" id="spece_' + j + x + k + l + '" placeholder="">'
                                    + '</div></div>'
                                    + '</div>'
                            } else {
                                if (k == 0 && l == 0) {
                                    f_head_0 += '<div class="row table_last">'
                                        + '<div class="col-lg-2"></div>'
                                        + '<div class="col-lg-2">' + standards_list[1].children[x].name + '</div>'
                                        + '<div class="col-lg-2">' + standards_list[2].children[k].name + '</div>'
                                        + '<div class="col-lg-2">' + standards_list[3].children[l].name + '</div>'
                                        + '<div class="col-lg-2"><div class="input-group">'
                                        + '<input type="number" class="form-control Num" id="spece_' + j + x + k + l + '" placeholder="">'
                                        + '</div></div>'
                                        + '</div>'
                                } else {
                                    if (l == 0) {
                                        f_head_0 += '<div class="row table_last">'
                                            + '<div class="col-lg-2"></div>'
                                            + '<div class="col-lg-2"></div>'
                                            + '<div class="col-lg-2">' + standards_list[2].children[k].name + '</div>'
                                            + '<div class="col-lg-2">' + standards_list[3].children[l].name + '</div>'
                                            + '<div class="col-lg-2"><div class="input-group">'
                                            + '<input type="number" class="form-control Num" id="spece_' + j + x + k + l + '" placeholder="">'
                                            + '</div></div>'
                                            + '</div>'
                                    } else {
                                        f_head_0 += '<div class="row table_last">'
                                            + '<div class="col-lg-2"></div>'
                                            + '<div class="col-lg-2"></div>'
                                            + '<div class="col-lg-2"></div>'
                                            + '<div class="col-lg-2">' + standards_list[3].children[l].name + '</div>'
                                            + '<div class="col-lg-2"><div class="input-group">'
                                            + '<input type="number" class="form-control Num" id="spece_' + j + x + k + l + '" placeholder="">'
                                            + '</div></div>'
                                            + '</div>'
                                    }

                                }
                            }
                        }
                    }
                }
                f_head += f_head_0;
            }
        }
        if (length == 5) {
            for (var j = 0; j < standards_list[0].children.length; j++) {
                var f_head_0 = "";
                for (var x = 0; x < standards_list[1].children.length; x++) {
                    for (var k = 0; k < standards_list[2].children.length; k++) {
                        for (var l = 0; l < standards_list[3].children.length; l++) {
                            for (var m = 0; m < standards_list[4].children.length; m++) {
                                if (x == 0 && k == 0 && l == 0 && m == 0) {
                                    f_head_0 += '<div class="table_line"></div><div class="row table_last">'
                                        + '<div class="col-lg-2">' + standards_list[0].children[j].name + '</div>'
                                        + '<div class="col-lg-2">' + standards_list[1].children[x].name + '</div>'
                                        + '<div class="col-lg-2">' + standards_list[2].children[k].name + '</div>'
                                        + '<div class="col-lg-2">' + standards_list[3].children[l].name + '</div>'
                                        + '<div class="col-lg-2">' + standards_list[4].children[m].name + '</div>'
                                        + '<div class="col-lg-2"><div class="input-group">'
                                        + '<input type="number" class="form-control Num" id="spece_' + j + x + k + l + m + '" placeholder="">'
                                        + '</div></div>'
                                        + '</div>'
                                } else {
                                    if (k == 0 && l == 0 && m == 0) {
                                        f_head_0 += '<div class="row table_last">'
                                            + '<div class="col-lg-2"></div>'
                                            + '<div class="col-lg-2">' + standards_list[1].children[x].name + '</div>'
                                            + '<div class="col-lg-2">' + standards_list[2].children[k].name + '</div>'
                                            + '<div class="col-lg-2">' + standards_list[3].children[l].name + '</div>'
                                            + '<div class="col-lg-2">' + standards_list[4].children[m].name + '</div>'
                                            + '<div class="col-lg-2"><div class="input-group">'
                                            + '<input type="number" class="form-control Num" id="spece_' + j + x + k + l + m + '" placeholder="">'
                                            + '</div></div>'
                                            + '</div>'
                                    } else {
                                        if (l == 0 && m == 0) {
                                            f_head_0 += '<div class="row table_last">'
                                                + '<div class="col-lg-2"></div>'
                                                + '<div class="col-lg-2"></div>'
                                                + '<div class="col-lg-2">' + standards_list[2].children[k].name + '</div>'
                                                + '<div class="col-lg-2">' + standards_list[3].children[l].name + '</div>'
                                                + '<div class="col-lg-2">' + standards_list[4].children[m].name + '</div>'
                                                + '<div class="col-lg-2"><div class="input-group">'
                                                + '<input type="number" class="form-control Num" id="spece_' + j + x + k + l + m + '" placeholder="">'
                                                + '</div></div>'
                                                + '</div>'
                                        } else {
                                            if (m == 0) {
                                                f_head_0 += '<div class="row table_last">'
                                                    + '<div class="col-lg-2"></div>'
                                                    + '<div class="col-lg-2"></div>'
                                                    + '<div class="col-lg-2"></div>'
                                                    + '<div class="col-lg-2">' + standards_list[3].children[l].name + '</div>'
                                                    + '<div class="col-lg-2">' + standards_list[4].children[m].name + '</div>'
                                                    + '<div class="col-lg-2"><div class="input-group">'
                                                    + '<input type="number" class="form-control Num" id="spece_' + j + x + k + l + m + '" placeholder="">'
                                                    + '</div></div>'
                                                    + '</div>'
                                            } else {
                                                f_head_0 += '<div class="row table_last">'
                                                    + '<div class="col-lg-2"></div>'
                                                    + '<div class="col-lg-2"></div>'
                                                    + '<div class="col-lg-2"></div>'
                                                    + '<div class="col-lg-2"></div>'
                                                    + '<div class="col-lg-2">' + standards_list[4].children[m].name + '</div>'
                                                    + '<div class="col-lg-2"><div class="input-group">'
                                                    + '<input type="number" class="form-control Num" id="spece_' + j + x + k + l + m + '" placeholder="">'
                                                    + '</div></div>'
                                                    + '</div>'
                                            }

                                        }

                                    }
                                }
                            }
                        }
                    }
                }
                f_head += f_head_0;
            }
        }
        $(".t_boay").html(f_head);
    }
    //更新数组信息
    function updatestandardsList(c1, c2) {
        $(c1).each(function (i, item) {
            var index = $(item).attr("data-index");
            var name = $(item).val();
            for (var i = 0; i < standards_list.length; i++) {
                if (standards_list[i].id == index) {
                    standards_list[i].name = name;
                }
            }
        })
        $(c2).each(function (i, item) {
            var indexb = $(item).attr("data-indexb");
            var index = $(item).attr("data-index");
            var name = $(item).val();
            for (var i = 0; i < standards_list.length; i++) {
                for (var j = 0; j < standards_list[i].children.length; j++) {
                    if (standards_list[i].id == indexb && standards_list[i].children[j].id == index) {
                        standards_list[i].children[j].name = name;
                    }
                }
            }
        })
    }
    //更新页面输入后的数据
    function updatestandardsInput(list) {

    }
})
