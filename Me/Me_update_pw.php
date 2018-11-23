<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-25 18:09:21
 * @version $Id$
 */
date_default_timezone_set('PRC');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

</head>

<body>
    <div>
        <div class="bd__header">
            <h3>修改密码</h3>
        </div>
        <form accept="" method="post">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell weui-cell_vcode">
                    <div class="weui-cell__hd">
                        <label class="weui-label">旧密码</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="password" id="old_pw" placeholder="请输入旧密码">
                    </div>
                </div>
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
                        <label class="weui-label">新密码</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="password" id="new_pw_c" placeholder="请输入新密码">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="up_pw" class="weui-btn_primary btn"> 更新 </div>
    <div id="back" class="weui-btn_primary btn"> 返回 </div>
	<script type="text/javascript" src="./js/Me_nav.js"></script>
</body>
    <script type="text/javascript" src="../Public/Js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="../Public/Js/md5.js"></script>
    <script type="text/javascript" src="../Public/Js/CheckData.js"></script>

</html>
