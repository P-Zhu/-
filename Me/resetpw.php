<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-27 13:52:30
 * @version $Id$
 */
date_default_timezone_set('PRC');

require_once '../Public/Lib/Lib.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="Public/Images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="Public/Images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../Public/Css/weui.min.css" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/Css/weui.min.css" />
    <link rel="stylesheet" href="../Public/Css/style.css">
    <link rel="stylesheet" href="../Public/Css/btn.css">

	<title>重置密码</title>
    </head>

<body>
    <div class="page__hd">
	<?php Print_HTML("Header_Html")?>

	</div>
    <div class="page__bd" id="content">
        <div class="bd__header">
            <h3>重置密码</h3>
        </div>
        <form accept="" method="post">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell weui-cell_vcode">
                    <div class="weui-cell__hd">
                        <label class="weui-label">新密码</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="password" id="new_pw" placeholder="请输入新密码">
                    </div>
                </div>
                <div class="weui-cell weui-cell_vcode">
                    <div class="weui-cell__hd">
                        <label class="weui-label">确认</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="password" id="new_pw_c" placeholder="请输入新密码">
                    </div>
                </div>
            </div>
        </form>
        <div id="reset_pw" class="weui-btn_primary btn"> 重置 </div>
    </div>

      <?php Print_Html("Footer_Html")?>

</body>
    <script type="text/javascript" src="../Public/Js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="../Public/Js/md5.js"></script>
    <script type="text/javascript" src="./js/resetpw.js"></script>
</html>
