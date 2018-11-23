/**
 * 
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-29 01:32:17
 * @version $Id$
 */

$(document).ready(function() {
    // 定义新消息记录样式为600
    var Rec_style = ['font: bold 1em arial,sans-serif;', 'font-weight: 300;'];
    // 输出消息列表
    $.ajax({
        type: "POST",
        url: "Warning_server.php?action=Warning_list",
        dataType: "json",
        data: {},
        success: function(json) {
            if (json.success == 1) {
                for (var i = 0; i < json.length; i++) {
                    $(".container").append('<a onClick="handleEvent(this)" id="' + json[i].Res_ID + '" Role_id="' + json[i].Role_ID + '" Msg_ID="' + json[i].Msg_ID + '" style="' + Rec_style[json[i].Msg_STATUS] + '" class="weui-cell weui-cell_access item weui-cell-notice-list-item open-popup" data-target="#full">' + json[i].Msg_Text + json[i].Msg_DT + '</a>');
                }
            }
        }
    });
});
// <!-- 获取触发事件对象的 Details -->
// var btn={{'status_id':'1','text':'撤消'},{'status_id':'2','text':'已被领'},{'status_id':'3','text':'已领'}}
var record = {
    'Res_CP': { 'Res_PP': '发布记录', 'PP': '认领人', 'role': 'Res_CLA', 'title': '您发布的信息：' },
    'Res_CLA': { 'Res_CLA': '领取记录', 'PP': '发布人', 'role': 'Res_CP', 'title': '您申请的信息：' }
};

function handleEvent(e) {
    $("#Res_Class").html("");
    $("#Res_RDT").html("");
    $("#Res_DESC").html("");
    $("#Res_P").html("");
    $("#Res_PIC").attr('src', '');
    $("#PP").html("");
    $("#Res_PP").html("");
    $("#Res_TEL").html("");
    $("#Res_CT").html("");
    $("#Res_CDT").html("");
    $("#Res_STATUS").html("");
    $("span.opt").css("display", "none");
    $("#D_hd").html(record['Res_' + e.getAttribute("Role_id")]['title']);
    $.ajax({
        type: "POST",
        // if ($("#")) {}
        url: "../Notice/look.php?action=Rec_Details&id=" + e.id + "&Role_ID=" + record["Res_" + e.getAttribute("Role_id")]['role'] + "&Msg_ID=" + e.getAttribute("Msg_ID"),
        dataType: "json",
        data: {},
        success: function(json) {
            if (json.success == 1) {
                $("#Res_Class").html(json.CLASS);
                $("#Res_RDT").html(json.RDT);
                $("#Res_DESC").html(json.DESC.replace(/&/g, '<br/>'));
                $("#Res_P").html(json.P);
                $("#Res_PIC").attr('src', json.PIC);
                $("#PP").html(record["Res_" + e.getAttribute("Role_id")]['PP']);
                $("#Res_PP").html(json.PP);
                $("#Res_TEL").html(json.TEL);
                $("#Res_CT").html(json.CT);
                $("#Res_CDT").html(json.CDT);
                $("#Res_STATUS").attr("st", json.STAUTS);
                switch (json.STAUTS) {
                    case '0':
                        $("#Res_STATUS").html("待领");
                        break;
                    case '1':
                        $("#Res_STATUS").html("认领中");
                        break;
                    case '2':
                        $("#Res_STATUS").html("待确认");
                        break;
                    case '3':
                        $("#Res_STATUS").html("已领");
                        break;
                }
                $("span[status_id='1']").css({
                    "display": function() {
                        if (($("#Res_STATUS").attr("st") == '1' && e.getAttribute("Role_id") == 'CLA') ||
                            ($("#Res_STATUS").attr("st") == '2' && e.getAttribute("Role_id") == 'CP')) {
                            return "block";
                        }
                    }
                });
                $("span[status_id='2']").css("display", function() {
                    // alert($("#Res_STATUS").attr("st"));
                    // alert(e.getAttribute("Role_id"));
                    if ($("#Res_STATUS").attr("st") == '1' && e.getAttribute("Role_id") == 'CP') {
                        return "block";
                    }
                });
                $("span[status_id='3']").css("display", function() {
                    if ($("#Res_STATUS").attr("st") == '2' && e.getAttribute("Role_id") == 'CLA') {
                        return "block";
                    }
                });
                $(".opt").attr({
                    'id':e.id,
                    'Msg_ID': e.getAttribute("Msg_ID"),
                    'Res_STATUS': $("#Res_STATUS").attr("st"),
                    'Role_ID': e.getAttribute("Role_ID"),
                    'Msg_ID':e.getAttribute("Msg_ID")
                });
            }
        }
    });
}

// 撤消操作
$("span[status_id='1']").on("click", function() {
    // 处理程序
    var url = "./Warning_server.php?action=cancel";
    // 添加参数:物品ID，操作角色，物品当前状态
    url = url + "&id=" + $(this).attr("id")+ "&Role_ID=" +$(this).attr("Role_ID") + "&Res_STATUS=" + $(this).attr("Res_STATUS");
    // 要更新的消息记录ID
    url = url + "&Msg_ID=" +$(this).attr("Msg_ID");

    $.ajax({
        type: "POST",
        // if ($("#")) {}
        url: url,
        dataType: "json",
        data: {},
        success: function(json) {
            if (json.success == 1) {
                alert(json.msg);
                // parent.window.open('Warning_index.php', '_top');
                document.location.reload();
            }
        }
    });
});
// 交还给失主
$("span[status_id='2']").on("click", function() {
    // 处理程序
    var url = "./Warning_server.php?action=CP_ed";
    // 添加参数:物品ID，操作角色，物品当前状态
    url = url + "&id=" + $(this).attr("id")+ "&Role_ID=" +$(this).attr("Role_ID") + "&Res_STATUS=" + $(this).attr("Res_STATUS");
    // 要更新的消息记录ID
    url = url + "&Msg_ID=" +$(this).attr("Msg_ID");

    $.ajax({
        type: "POST",
        // if ($("#")) {}
        url: url,
        dataType: "json",
        data: {},
        success: function(json) {
            if (json.success == 1) {
                alert(json.msg);
                document.location.reload();
            }
        }
    });
});


// 失主确认找回物品
$("span[status_id='3']").on("click", function() {
    // 处理程序
    var url = "./Warning_server.php?action=CLA_ed";
    // 添加参数:物品ID，操作角色，物品当前状态
    url = url + "&id=" + $(this).attr("id")+ "&Role_ID=" +$(this).attr("Role_ID") + "&Res_STATUS=" + $(this).attr("Res_STATUS");
    // 要更新的消息记录ID
    url = url + "&Msg_ID=" +$(this).attr("Msg_ID");

    $.ajax({
        type: "POST",
        // if ($("#")) {}
        url: url,
        dataType: "json",
        data: {},
        success: function(json) {
            if (json.success == 1) {
                alert(json.msg);
                document.location.reload();
            }
        }
    });
});
