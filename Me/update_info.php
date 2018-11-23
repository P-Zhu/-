<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-25 10:09:22
 * @version $Id$
 */

date_default_timezone_set('PRC');
require_once "../config.php";

?>
<html>
<head>
<meta charset="utf-8">
<title></title>
    <script type="text/javascript" src="../Public/Js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="../Public/Js/md5.js"></script>
    <script type="text/javascript" src="../Public/Js/CheckData.js"></script>
    <script type="text/javascript">
     function getClist(){
        $.ajax({
            type: "POST",
            url: "../Public/Lib/getlist.php?action=Clist",
            dataType: "json",
            data: {},
            success: function(json) {
                if (json.success == 1) {
                    $("#ID_Stu_College_CODE").html(json.list);
                }
            }
        });
    }
    getClist();
    </script>

</head>
<body>
<div class="page__bd" style="margin-bottom: 100px;">
    <div class="bd__header">
        <h3><?php echo "修改信息"; ?></h3>

    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">姓名</label>
            </div>
            <div class="weui-cell__bd">
                <input name="Stu_NAME" id="ID_Stu_NAME" class="weui-input" type="text" placeholder="请输入姓名">
            </div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd" style="line-height: 44px">
                <label class="weui-label">性别</label>
            </div>
            <div class="weui-cell__bd">
                <input type="radio" name="Stu_SEX" value="1"> 男&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="Stu_SEX" value="0"> 女
            </div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">生日</label>
            </div>
            <div class="weui-cell__bd">
                <input name="Stu_DATE" id="ID_Stu_DATE" class="weui-input" type="date" value="">
            </div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">手机号</label>
            </div>
            <div class="weui-cell__bd">
                <input name="Stu_TEL" id="ID_Stu_TEL" class="weui-input" type="number" value="" placeholder="请输入11位手机号">
            </div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">E-mail</label>
            </div>
            <div class="weui-cell__bd">
                <input name="Stu_EMAIL" id="ID_Stu_EMAIL" class="weui-input" type="email" value="" placeholder="请输入E-mail">
            </div>
        </div>
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label class="weui-label">学院</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="Stu_college" id="ID_Stu_College_CODE">
                    <option value="0000">请选择学院</option>
                </select>
            </div>
        </div>
    </div>
    <div id="update_btn" class="weui-btn_primary btn"> 更新 </div>
    <div id="back" class="weui-btn_primary btn"> 返回 </div>
    <script type="text/javascript" src="./js/Me_nav.js"></script>
</div>
</body>
<script type="text/javascript">
    getinfo();
    function getinfo(){
        $.ajax({
            type: "POST",
            url: "../login/Check.php?action=check_info",
            dataType: "json",
            data: {},
            success: function(json) {
                if (json.success == 1) {
                    $("#ID_Stu_NAME").val(json.Stu_NAME);
                    $(":radio[name='Stu_SEX'][value='" + json.Stu_SEX + "']").prop("checked", "checked");
                    $("#ID_Stu_DATE").val(json.Stu_DATE);
                    $("#ID_Stu_TEL").val(json.Stu_TEL);
                    $("#ID_Stu_EMAIL").val(json.Stu_EMAIL);
                    $("#ID_Stu_College_CODE option[value='"+json.Stu_College_CODE+"']").prop("selected", "selected");
                }
            }
        });
    }
</script>
</html>