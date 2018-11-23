/**
 * 
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-28 13:59:53
 * @version $Id$
 */
$(document).ready(function() {

//获取GET方式传递的变量
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1]; }
    }
    return (false);
}

 // 重置密码
    $("#reset_pw").on('click', function() {
        if($("#new_pw").val() == ""){
            alert("请输入新密码！");
            $("#new_pw").focus();
            return false;
        }else if($("#new_pw_c").val() != $("#new_pw").val()){
            alert("两次输入的密码不一致！");
            return false;
        }
       $.ajax({
            type: "POST",
                url: "../login/Check.php?action=reset_pw",
                dataType: "json",
                data: {
                    "Stu_NO": getQueryVariable("id"),
                    "Stu_STATUS": getQueryVariable("str"),
                    "New_PW": md5($("#new_pw").val()),
                },
                success: function(json) {
                    if (json.success == 1) {
                        alert(json.msg);
                        parent.window.open(json.url, '_top');
                    } else {
                        alert(json.msg);
                        return false;
                    }
                }
        });
    });


});