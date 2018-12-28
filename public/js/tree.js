/*递归实现获取无级树数据并生成DOM结构*/
var str = "";
var forTree = function (o) {
    for (var i = 0; i < o.length; i++) {
        var urlstr = "";
        try {
            if (o[i]["nodes"] != null) {
                o[i]["text"] = o[i]["text"] + "(" + o[i]["nodes"].length + ")"
            }
            if (o[i].nodes.length != 0) {
                var imgss = o[i]["self"].img_head ? imgurl + o[i]["self"].img_head : "images/moren.png";
                urlstr = "<div><a data-name='" + o[i]["self"].name + "' data-tel='" + o[i]["self"].telephone + "' data-email='" + o[i]["self"].email + "' data-wechat='" + o[i]["self"].wechat + "' href='#middlePopover'>" + 
                "<img src='"+ imgss +"'>" +
                o[i]["text"] +
                    "</a><span>查看下级</span><ul>";
            } else {
                var imgss = o[i]["self"].img_head ? imgurl + o[i]["self"].img_head : "images/moren.png";
                urlstr = "<div><a data-name='" + o[i]["self"].name + "' data-tel='" + o[i]["self"].telephone + "' data-email='" + o[i]["self"].email + "' data-wechat='" + o[i]["self"].wechat + "' href='#middlePopover'>" + 
                "<img src='"+ imgss +"'>" +
                o[i]["text"] +
                    "</a><span></span><ul>";
            }
            str += urlstr;
            if (o[i].nodes != null && o[i].nodes.length > 0) {
                forTree(o[i].nodes);
            }
            str += "</ul></div>";
        } catch (e) { }
    }
    return str;
}
//<b>" + o[i]["nodes"].length + "</b>
/*添加无级树*/
// <b class='mui-badge mui-badge-primary'>" + o[i]["num"] + "下级</b>
// <b class='mui-badge mui-badge-primary'>" + o[i]["num"] + "下级</b>
//document.getElementById("menuTree").innerHTML = forTree(json);
$(document).ready(function () {
    //数据格式
    var data = [
        {
            "id": 1,
            "text":"张三",
            "img":"../images/icon1.png",
            "nodes": [
                {
                    "id": 2,
                    "text":"张武",
                    "img":"../images/icon2.png",
                    "nodes": [
                        {
                            "id": 3,
                            "text":"张琦",
                            "img":"../images/icon5.png"
                        }
                    ]
                }
            ]
        },
        {
            "id": 1,
            "text":"李四",
            "img":"../images/icon2.png",
            "nodes": [
                {
                    "id": 2,
                    "text":"李八",
                    "img":"../images/icon5.png",
                    "nodes": [
                        {
                            "id": 3,
                            "text":"李玖",
                            "img":"../images/icon4.png"
                        }
                    ]
                }
            ]
        }
    ];
    jqload();
    $.ajax({
        url:url + '/users_tree/' + localStorage.getItem("bzf-ywcfkj-user-id"),
        type:'GET',
        dataType:'json',
        data:{
            "with":"superior"
        },
        async:true,
        success:function(data){
            console.log(data);
            $("#superior").text("我的上级：" + data.data.superior.name);
            $("#superior").attr("data-name",data.data.superior.name);
            $("#superior").attr("data-tel",data.data.superior.telephone);
            $("#superior").attr("data-email",data.data.superior.email);
            $("#superior").attr("data-wechat",data.data.superior.wechat);
            document.getElementById("menuTree").innerHTML = forTree(data.data.nodes);
        },
        error:function(data){

        },
        complete:function(data){
            jqloadC();
        }
    })
})
mui(".mui-content").on('tap', 'span', function () {
    var ul = $(this).siblings("ul");
    var id = $(this).data("id");
    if (ul.find("div").html() != null) {
        if (ul.css("display") == "none") {
            ul.show(300);
            // $(this).html("[-]" + spanContent);
        } else {
            ul.hide(300);
            // $(this).html("[+] " + spanContent);
        }
    }
})
mui(".mui-content").on('tap', 'a', function () {
    var name = $(this).data("name")?$(this).data("name"):"暂无";
    var tel = $(this).data("tel")?$(this).data("tel"):"暂无";
    var email = $(this).data("email")?$(this).data("email"):"暂无";
    var wechat = $(this).data("wechat")?$(this).data("wechat"):"暂无";
    // console.log(name);
    // console.log(tel);
    $("#truename").text(name);
    $("#wecat").text(wechat);
    $("#telephone").text(tel);
    $("#email").text(email);
    // $("#profit").text(tel);
})
mui("body").on('tap', '.mui-icon-closeempty', function () {
    mui('.mui-popover').popover('toggle');
})
mui("body").on('tap', '.mui-pull-left', function () {
    window.location.href = this.href;
})

/*树形列表展开*/
$("#btn_open").click(function () {
    $("#menuTree ul").show(300);
    curzt("-");
})

/*收缩*/
$("#btn_close").click(function () {
    $("#menuTree ul").hide(300);
    curzt("+");
})

function curzt(v) {
    $("#menuTree span").each(function (index, element) {
        var ul = $(this).siblings("ul");
        var spanStr = $(this).html();
        var spanContent = spanStr.substr(3, spanStr.length);
        if (ul.find("div").html() != null) {
            $(this).html("[" + v + "] " + spanContent);
        }
    });
}