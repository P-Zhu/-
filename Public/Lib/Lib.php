<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-10 14:14:49
 * @version $v1.0$
 */

date_default_timezone_set('PRC');

// ***************************************
//****************基础部件****************
// ***************************************
function islogin() {
	if (!isset($_SESSION['User_id'])) {
		echo '<script type="text/javascript"> alert("请登录！");window.location.href="http://lf.wh820.top";</script>';
	}
}
function Header_Html() {
	echo '
    <div id="logopic">
     <img src="/Public/Images/logo.png" alt="" class="lgog_pic">
    </div>
    <div id="introduce">
        <h3>云南师范大学欢迎您</h3>
        <p>信息学院&nbsp;失物招领</p>
    </div>
	';
	# code...
}

function Footer_Html() {
	echo '
	<div class="weui-footer weui-footer_fixed-bottom">
	    <span class="weui-footer__text">信息学院</span>
    	<br>
    	<span class="weui-footer__text">Copyright © 2016-2017 wh820.top</span>
	</div>
	';
}
function Tabbar_Html() {
	// include "../config.php";
	global $sqllink;
	// $sql = "SELECT COUNT(*),`Role_ID`,`Res_ID`,`Res_STATUS`,`Msg_DT`  FROM `Msg_info` WHERE `Msg_STATUS`=0 AND `Stu_NO` =" . $_SESSION['User_id'] . " ORDER BY `Msg_DT` DESC";
	$sql_cc = "SELECT COUNT(*) as CC FROM `msg_info` WHERE `Msg_STATUS`=0 AND `Stu_NO` =" . $_SESSION['User_id'];
	$c = mysqli_query($sqllink, $sql_cc);
	$query = mysqli_fetch_array($c);
	$count = $count = $query['CC'];
	// echo $count = $query['CC'];
	echo '
        <div class="weui-tab">
            <div class="weui-tab__panel">
            </div>
            <div class="weui-tabbar">
                <a href="/Notice/Notice_index.php" class="weui-tabbar__item weui-bar__item_on">
                    <span style="display: inline-block;position: relative;">
                        <img src="/Public/Images/icon_nav_check.png" alt="" class="weui-tabbar__icon">
                    </span>
                    <p class="weui-tabbar__label">查询</p>
                </a>
                <a href="/Announce/Announce_index.php?action=Announce" class="weui-tabbar__item">
                    <img src="/Public/Images/icon_nav_an.png.png" alt="" class="weui-tabbar__icon">
                    <p class="weui-tabbar__label">登记</p>
                </a>
                <a href="/Warning/Warning_index.php" class="weui-tabbar__item">
                    <span style="display: inline-block;position: relative;">
                        <img src="/Public/Images/icon_nav_msg.png" alt="" class="weui-tabbar__icon">
                        <span class="weui-badge btn_hidden" style="position: absolute;top: -2px;right: -13px;" id="NewWarning">' . $count . '</span>
                    </span>
                    <p class="weui-tabbar__label">提醒</p>
                </a>
                <a href="/Me/Me_index.php" class="weui-tabbar__item">
                    <img src="/Public/Images/icon_nav_me.png" alt="" class="weui-tabbar__icon">
                    <p class="weui-tabbar__label">我</p>
                </a>
            </div>
        <script type="text/javascript" src="../Public/Js/warning.js"></script>
        <script type="text/javascript"> checkNewWarning();</script>
        </div>
	';
	// <span class="weui-badge weui-badge_dot" style="position: absolute;top: 0;right: -6px;"></span>

}
function Login_Index() {

}

//注册、更改个人信息
//$v 提交按钮的文本
//$t_get 提交到目标处理程序
function Information($v, $t_get) {

}

// 修改密码
//$v 提交按钮的文本
//$t_get 提交到目标处理程序
function Me_Pw($v, $t_get) {
	echo '
        <div class="bd__header">
        <h3>修改密码</h3>
    </div>
    <form accept="' . $t_get . '" method="post">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">旧密码</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="number" placeholder="请输入旧密码">
            </div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">新密码</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="number" placeholder="请输入新密码">
            </div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">新密码</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="number" placeholder="请输入新密码">
            </div>
        </div>
        <div class="page__bd_spacing" >
            <input type="submit" class="weui-btn weui-btn_primary btn1" value="' . $v . '"/>
        </div>
    </div>
    </form>
    ';
}

// ***************************************
//****************END****************
// ***************************************

function Print_Html($Html) {
	$Html();
}

?>