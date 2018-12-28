var url = "https://bzf.15dk.top/api/v1";
var imgurl = "https://bzf.15dk.top/";
function isInArray(arr, value) {
	for (var i = 0; i < arr.length; i++) {
		if (value === arr[i]) {
			return true;
		}
	}
	return false;
}
function getLoginInfo() {
	$.ajax({
		url: url + '/login_info',
		type: 'GET',
		dataType: 'json',
		headers: {
			'Authorization': "Bearer " + localStorage.getItem('Rev-U-Me-token')
		},
		async: true,
		success: function (data) {
			localStorage.setItem('Rev-U-Me-user-id', data.id);
			localStorage.setItem('Rev-U-Me-user-name', data.name);
			checkIsLogin();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//alert(XMLHttpRequest.status);
			var str = window.location.href;
			var index = str.lastIndexOf("\/");
			str = str.substring(index + 1, str.length);
			localStorage.setItem("Rev-U-Me-back-url", str);
			if (XMLHttpRequest.status == 401) {
				layui.use('layer', function () {
					var layer = layui.layer;
					layer.msg('当前操作需要登录<br/>Not logged in', {
						icon: 0,
						time: 1200 //2秒关闭（如果不配置，默认是3秒）
					}, function () {
						location.href = "login.html";
						layer.close(index);
					});
				})
			}
		},
	})
}
function getBrand() {
	$.ajax({
		url: url + "/brands",
		type: "GET",
		dataType: 'json',
		async: true,
		success: function (data) {
			// console.log(data);
			var html = "";
			$.each(data.data,function(i,item){
				if(item.status == 1){
					html += '<a href="gw_brand.html?id='+item.id+'">'+item.title+'</a>';
				}
			})
			$("#brand_list").html(html);
		},
		error: function (data) {
			console.log(data);
		}
	})
}
function needLogin() {
	if (!localStorage.getItem('Rev-U-Me-token')) {
		layui.use('layer', function () {
			var layer = layui.layer;
			layer.msg('当前操作需要登录<br/>Not logged in', {
				icon: 0,
				time: 3000 //2秒关闭（如果不配置，默认是3秒）
			}, function () {
				location.href = "login.html";
				layer.close(index);
			});
		})
	}
}
//获取页面传值
function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]);
	return null;
}
//验证手机号
function checkMobile(str) {
	var re = /^1\d{10}$/
	if (re.test(str)) {
		return true;
	} else {
		return false;
	}
}
//验证座机
function checkPhone(str) {
	var re = /^0\d{2,3}-?\d{7,8}$/;
	if (re.test(str)) {
		return true;
	} else {
		return false;
	}
}
//验证邮箱
function checkEmail(str) {
	var re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/
	if (re.test(str)) {
		return true;
	} else {
		return false;
	}
}
//验证多个input是否空值
function yzIsEmpty(cla) {
	var m = document.getElementsByClassName(cla);
	for (var i = 0; i < m.length; i++) {
		if (m[i].value == "" || m[i].value == null) {
			return true;
		}
	}
	return false;
}
//数组去重
function unique(arr) {
	var res = [];
	var json = {};
	for (var i = 0; i < arr.length; i++) {
		if (!json[arr[i]]) {
			res.push(arr[i]);
			json[arr[i]] = 1;
		}
	}
	return res;
}
function compare(propertyName) {
	return function (object1, object2) {
		var value1 = object1[propertyName];
		var value2 = object2[propertyName];
		if (value2 < value1) {
			return -1;
		}
		else if (value2 > value1) {
			return 1;
		}
		else {
			return 0;
		}
	}
}