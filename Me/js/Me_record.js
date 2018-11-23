/**
 * 
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-25 22:26:06
 * @version $Id$
 */
// alert(document.getElementsByClassName("record")[0].id)
var role = $(".record").attr("id");
var record = {
    'Res_CP': { 'Res_CP': '发布记录', 'PP': '认领人', 'role': 'Res_CLA' },
    'Res_CLA': { 'Res_CLA': '领取记录', 'PP': '发布人', 'role': 'Res_CP' }
};
$("h3").html(record[role][role]);

function Check_ANN_all(argument) {
    $.ajax({
        type: "POST",
        url: "../Notice/look.php?action=Rec" + "&role=" + role,
        dataType: "json",
        data: {},
        success: function(json) {
            if (json.success == 1) {
                if (json.length == 0) {
                    $("#list_bd").html("暂无相关记录！");
                }
                for (var i = 0; i < json.length; i++) {
                    $("#list_bd").append('<a onClick="handleEvent(this.id)" id=' + json[i].ID + ' class="weui-cell weui-cell_access item weui-cell-notice-list-item open-popup" data-target="#full" ><div class="weui-cell__bd item_hd1"><p>' + json[i].CLASS + '</p></div><div class="weui-cell__bd item_hd1"><p>' + json[i].RDT.substr(0, 10) + '</p></div><div class="weui-cell__bd item_hd2" ><p><p>' + json[i].DESC.replace(/&/g, '<br/>') + '</p></div></a>');
                }
            }
        }
    });
}
Check_ANN_all();

// <!-- 获取触发事件对象的 Details -->
function handleEvent(e) {
    $.ajax({
        type: "POST",
        url: "../Notice/look.php?action=Rec_Details&id=" + e + "&Role_ID=" + record[role]['role'],
        dataType: "json",
        data: {},
        success: function(json) {
            if (json.success == 1) {
                $("#Res_Class").html(json.CLASS);
                $("#Res_RDT").html(json.RDT);
                $("#Res_DESC").html(json.DESC.replace(/&/g, '<br/>'));
                $("#Res_P").html(json.P);
                $("#Res_PIC").attr('src', json.PIC);
                $("#PP").html(record[role]['PP']);
                $("#Res_PP").html(json.PP);
                $("#Res_TEL").html(json.TEL);
                $("#Res_CT").html(json.CT);
                $("#Res_CDT").html(json.CDT);

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
            }
        }
    });
}


$(function() {
    FastClick.attach(document.body);
});

$('#show_filter').on('click', function() {
    $.ajax({
        type: "POST",
        url: "../Public/Lib/getlist.php?action=filter",
        dataType: "json",
        data: {},
        success: function(json) {
            if (json.success == 1) {
                $("#filter_Class").html(json.list);
            }
        }
    });
});
$('#filter_btn').on('click', function() {
    $.ajax({
        type: "POST",
        url: "../Notice/look.php?action=filter&role=" + $(this).attr('role'),
        dataType: "json",
        data: {
            "filter_Class": $("#filter_Class").val(),
            "Start_DATE": $("#Start_DATE").val(),
            "End_DATE": $("#End_DATE").val() + ' 23:59:59'
        },
        success: function(json) {
            if (json.success == 1) {
                $("#list_bd").empty();
                if (json.length) {
                    for (var i = 0; i < json.length; i++) {
                        $("#list_bd").append('<a onClick="handleEvent(this.id)" id=' + json[i].ID + ' class="weui-cell weui-cell_access item weui-cell-notice-list-item open-popup" data-target="#full" ><div class="weui-cell__bd item_hd1"><p>' + json[i].CLASS + '</p></div><div class="weui-cell__bd item_hd1"><p>' + json[i].RDT.substr(0, 10) + '</p></div><div class="weui-cell__bd item_hd2" ><p><p>' + json[i].DESC.replace(/&/g, '<br/>') + '</p></div></a>');
                    }
                } else {
                    $("#list_bd").append("没有找到相关招领信息");
                }
            }
        }
    });
});

//初始化时间控件
var now = new Date();

var nowYear = now.getFullYear(); //年
var nowMonth = now.getMonth() + 1 < 10 ? "0" + (now.getMonth() + 1) : now.getMonth(); //月
var nowDay = now.getDate() < 10 ? "0" + now.getDate() : now.getDate(); //日期

// var nowHour = now.getHours()<10?"0"+now.getHours():now.getHours() ; //时
// var nowMinute = now.getMinutes()<10?"0"+now.getMinutes():now.getMinutes() ; //分

var nowDate = nowYear + "-" + nowMonth + "-" + nowDay;
// var nowTime = nowHour+":"+nowMinute;

$("#Start_DATE,#End_DATE").val(nowDate);
// $("#nowTime").val(nowTime) ;


