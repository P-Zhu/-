<?php
/*
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-10 14:14:49
 * @version $v1.0$
 */
date_default_timezone_set('PRC');
session_start();
include 'Public/Lib/Lib.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="icon" href="Public/Images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="Public/Images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/Css/weui.min.css" />
    <link rel="stylesheet" href="./Public/Css/style.css">
    <link rel="stylesheet" href="./Public/Css/btn.css">

    <script type="text/javascript" src="./Public/Js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="./Public/Js/md5.js"></script>
    <script type="text/javascript" src="./Public/Js/CheckData.js"></script>
    <title>失物招领</title>
</head>

<body>
<div class="page__hd">
<?php Print_Html("Header_Html");?>
</div>
    <div class="container">
        <div class="page__bd">
            <div id="login_div">
                <div class="bd__header">
                    <h3>用户登录</h3>
                </div>
                <br>
                <div class="msg">
                    <h4 class="error"></h4>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd">
                        <label class="weui-label login_text">学号</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input name="userid" id="User_id" class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入学号">
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd">
                        <label class="weui-label login_text">密码</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input name="userpwd" id="User_pwd" class="weui-input" type="password" placeholder="请输入密码">
                    </div>
                </div>
                <div class=" weui-cell resetpw">
                    <div class="weui-cell__hd ">
                         <a class="weui-label resetpw" href="./Me/Regainpw.php">找回密码？</a>
                   </div>
                </div>
            </div>
            <div id="Reg_div" style="display: none">
                <script type="text/javascript" src="./Public/Js/getlist.js"></script>
                <div class="bd__header">
                    <h3>完善信息</h3>
                </div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell weui-cell_vcode">
                        <div class="weui-cell__hd">
                            <label class="weui-label">学号</label>
                        </div>
                        <div class="weui-cell__bd">
                            <input name="Stu_NO" id="ID_Stu_NO" class="weui-input" type="number" maxlength="10" placeholder="请输入10位数字的学号">
                        </div>
                    </div>
                    <div class="weui-cell weui-cell_vcode">
                        <div class="weui-cell__hd">
                            <label class="weui-label">密码</label>
                        </div>
                        <div class="weui-cell__bd">
                            <input name="Stu_PW" id="ID_Stu_PW" class="weui-input" type="password" placeholder="请输入密码">
                        </div>
                    </div>
                    <div class="weui-cell weui-cell_vcode">
                        <div class="weui-cell__hd">
                            <label class="weui-label">确认密码</label>
                        </div>
                        <div class="weui-cell__bd">
                            <input id="ID_Stu_PW_c" class="weui-input" type="password" placeholder="确认密码">
                        </div>
                    </div>
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
            </div>
            <div class="btn">
                <div id="Show_login" class="weui-btn_primary btn btn_hidden"> 登录 </div>
                <div id="Show_sign" class="weui-btn_primary btn btn_show"> 注册 </div>
                <div id="login" class="weui-btn_primary btn"> 登录 </div>
                <div id="sign" class="weui-btn_primary btn btn_hidden"> 注册 </div>
            </div>
        </div>
    </div>
    <?php Print_Html("Footer_Html");?>
</body>
<script type="text/javascript">
var ua = navigator.userAgent.toLowerCase();
var isWeixin = ua.indexOf('micromessenger') != -1;
if (!isWeixin) {
document.head.innerHTML = '<title>抱歉，出错了</title><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"><link rel="stylesheet" type="text/css" href="https://res.wx.qq.com/connect/zh_CN/htmledition/style/wap_err1a9853.css">';
document.body.innerHTML = '<div class="page_msg"><div class="inner"><span class="msg_icon_wrp"><i class="icon80_smile"></i></span><div class="msg_content">请在微信客户端打开链接,打开微信扫一扫下方二维码</div><img width="200px" src="/Public/Images/http_qr.png"></div></div>';
}
</script>
</html>
