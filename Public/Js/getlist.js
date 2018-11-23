/**
 * 
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-23 15:32:28
 * @version $Id$
 */

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
function getReslist(){
    $.ajax({
                type: "POST",
                url: "../Public/Lib/getlist.php?action=ResClass",
                dataType: "json",
                data: {},
                success: function(json) {
                    if (json.success == 1) {
                        $("#Res_Class").html(json.list);
                    }
                }

    });

}
