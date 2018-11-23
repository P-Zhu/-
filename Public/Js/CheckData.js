/**
 * 
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-14 11:00:42
 * @version $Id$
 */
/*
var errorr = {
    "flag": 0,
    "Stu_NO": "学号",
    "Stu_PW": "密码",
    "Stu_NAME": "姓名",
    "Stu_SEX": "性别",
    "Stu_DATE": "生日",
    "Stu_TEL": "电话",
    "Stu_EMAIL": "E-mail",
    "Stu_College_CODE": "学院",
    "err": "请填写："
}*/

var get_check_url = "./login/Check.php";
var get_college_url = "./Public/Lib/getlist.php";


$(document).ready(function() {

    //默认登录页学号输入框获得焦点
    $("#User_id").focus();

    //登录页单击注册事件，切换到注册页
    $("#Show_sign").on("click", function() {
        $("#login_div").css("display", "none");
        $("#Reg_div").css("display", "block");
        $("#ID_Stu_NO").focus();

        $("#login").toggleClass("btn_hidden");
        $("#Show_login").toggleClass("btn_hidden btn_show");
        // $("#login").toggleClass("btn");
        // $("#Show_login").toggleClass("btn_show");

        // $("#Show_sign").toggleClass("btn_show");
        $("#Show_sign").toggleClass("btn_hidden btn_show");
        $("#sign").toggleClass("btn_hidden");
        $.ajax({
            type: "POST",
            url: get_college_url + "?action=Clist",
            dataType: "json",
            data: {},
            success: function(json) {
                if (json.success == 1) {
                    $("#ID_Stu_College_CODE").html(json.list);
                }
            }
        });
    });
    //注册页单击登录事件，切换回登录页
    $("#Show_login").on("click", function() {
        $("#login_div").css("display", "block");
        $("#Reg_div").css("display", "none");

        $("#sign").toggleClass("btn_hidden");
        $("#Show_login").toggleClass("btn_hidden btn_show");
        $("#login").toggleClass("btn_hidden");
        $("#Show_sign").toggleClass("btn_hidden btn_show");
        $("#User_id").focus();
    });
    //登录处理
    $("#login").on('click', function() {
        var User_id = $("#User_id").val().length;
        var User_pwd = md5($("#User_pwd").val());
        if (User_id != 10) {
            $(".error").html("请输入10位数字的学号！");
            $("#User_id").focus();
            return false;
        }
        if (User_pwd == md5("")) {
            $(".error").html("密码不能为空！");
            $("#User_pwd").focus();
            return false;
        }
        $.ajax({
            type: "POST",
            url: get_check_url + "?action=login",
            dataType: "json",
            data: { "User_id": $("#User_id").val(), "User_pwd": User_pwd },
            beforeSend: function() {
                $(".error").html("正在登录...");
            },
            success: function(json) {
                if (json.success == 1) {
                    alert(json.User_id + json.User_name + json.msg);
                    parent.window.open(json.url, '_top');
                    // var div = "<div id='result'><p><strong>" + json.User_id + "</strong>，恭喜您登录成功！</p><p><a href='#' id='logout'>【退出】</a></p></div>";
                    // $("#login_div").html(div);
                } else {
                    $(".error").html(json.msg);
                    return false;
                }
            }
        });
    });

    // 注册处理
    $("#sign,#update_btn").on('click', function() {
        var Stu_info = {
            "Stu_NAME": $("#ID_Stu_NAME").val().replace(/ /g, ''),
            "Stu_SEX": $(":radio[name='Stu_SEX']:checked").val(),
            "Stu_DATE": $("#ID_Stu_DATE").val(),
            "Stu_TEL": $("#ID_Stu_TEL").val().replace(/ /g, ''),
            "Stu_EMAIL": $("#ID_Stu_EMAIL").val().replace(/ /g, ''),
            "Stu_College_CODE": $("#ID_Stu_College_CODE").val()
        }
        if(this.id=='sign'){
            Stu_info["Stu_NO"]= $("#ID_Stu_NO").val().replace(/ /g, '');
            Stu_info["Stu_PW"]= md5($("#ID_Stu_PW").val());

            var num = /^1\d{9}$/;
            if (!(num.test(Stu_info['Stu_NO']))) {
                alert("请输入正确的学号！");
                $("#ID_Stu_NO").focus();
                return false;
            }
            if ($("#ID_Stu_PW").val() == "") {
                alert("请输入密码");
                $("#ID_Stu_PW").focus();
                return false;
            } else {
                if ($("#ID_Stu_PW").val() !== $("#ID_Stu_PW_c").val()) {
                    alert("两次输入的密码不一致！")
                    $("#ID_Stu_PW_c").focus();
                    return false;
                }
            }
        }
        if (Stu_info['Stu_NAME'] == "") {
            alert("请填写姓名！");
            $("#ID_Stu_NAME").focus();
            return false;
        }
        if (typeof(Stu_info['Stu_SEX']) == "undefined") {
            alert("请选择性别！");
            $("input:radio[name='Stu_SEX']:checked").focus();
            return false;
        }
        var date = /^(\d{4})\-(\d{2})\-(\d{2})$/;
        if (!(date.test(Stu_info['Stu_DATE']))) {
            alert("请填写生日！");
            $("#ID_Stu_DATE").focus();
            return false;
        }
        var tel = /^1\d{10}$/;
        if (!(tel.test(Stu_info['Stu_TEL']))) {
            alert("请正确填写11位手机号！");
            $("#ID_Stu_TEL").focus();
            return false;
        }
        var em = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
        if (!(em.test(Stu_info['Stu_EMAIL']))) {
            alert("请正确填写邮箱地址：example@xx.com！");
            $("#ID_Stu_EMAIL").focus();
            return false;
        }
        if (Stu_info['Stu_College_CODE'] == "0000") {
            alert("请选择学院！");
            $("#ID_Stu_College_CODE").focus();
            return false;
        }
        if(this.id=='sign'){
            var action='reg';
        }else{
            var action='update_info';
            get_check_url="../login/Check.php";
        }
        $.ajax({
            type: "POST",
            url: get_check_url + "?action="+action,
            dataType: "json",
            data: {
                "Stu_NO": Stu_info['Stu_NO'],
                "Stu_PW": Stu_info['Stu_PW'],
                "Stu_NAME": Stu_info['Stu_NAME'],
                "Stu_SEX": Stu_info['Stu_SEX'],
                "Stu_DATE": Stu_info['Stu_DATE'],
                "Stu_TEL": Stu_info['Stu_TEL'],
                "Stu_EMAIL": Stu_info['Stu_EMAIL'],
                "Stu_College_CODE": Stu_info['Stu_College_CODE']
            },
            success: function(json) {
                if (json.success == 1) {
                    alert(json.msg);
                    if(json.url=='#'){
                       location.reload();
                    }
                    parent.window.open(json.url, '_top');
                } else {
                    alert(json.msg);
                    return false;
                }
            }
        });
    });

    // 修改密码
    $("#up_pw").on('click', function() {

        if($("#old_pw").val() == ""){
            alert("请输入旧密码！");
            $("#old_pw").focus();
            return false;
        }
        if($("#new_pw").val() == ""){
            alert("请输入新密码！");
            $("#new_pw").focus();
            return false;
        }else if($("#new_pw_c").val() != $("#new_pw").val()){
            alert("两次输入的密码不一致！");
            return false;
        }
       get_check_url="../login/Check.php";
       $.ajax({
            type: "POST",
            url: get_check_url + "?action=update_pw",
            dataType: "json",
            data: {
                "Stu_PW": md5($("#old_pw").val()),
                "New_PW": md5($("#new_pw").val()),
            },
            success: function(json) {
                if (json.success == 1) {
                    alert(json.msg);
                   location.reload();
                } else {
                    alert(json.msg);
                    return false;
                }
            }
        });
    });

    // 找回密码
    $("#regain_pw").on('click', function() {
        if ( $("#ID_Stu_NO").val().length != 10) {
            alert("请输入10位数字的学号！");
            $("#ID_Stu_NO").focus();
            return false;
        }
        var em = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
        if (!(em.test($("#ID_Stu_EMAIL").val()))) {
            alert("请正确填写邮箱地址：example@xx.com！");
            $("#ID_Stu_EMAIL").focus();
            return false;
        }
       $.ajax({
            type: "POST",
            url: "../login/Check.php?action=regain_pw",
            dataType: "json",
            data: {
                "Stu_No":   $("#ID_Stu_NO").val(),
                "Stu_EMAIL":$("#ID_Stu_EMAIL").val()
            },
            success: function(json) {
                if (json.success == 1) {
                    alert(json.msg);
                    // parent.window.open("../index.php", '_top');
                } else {
                     alert(json.msg);
                    return false;
               }
            }
        });
    });
});
