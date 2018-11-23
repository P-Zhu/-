<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-14 10:09:04
 * @version $Id$
 */
date_default_timezone_set('PRC');
session_start();
require_once "../config.php";
require_once "../Public/Lib/mail.php";
$act = $_GET['action'];

if ($act == 'reg') {
	$Stu_info = array(
		"Stu_NO" => stripslashes(trim($_POST['Stu_NO'])),
		"Stu_PW" => stripslashes(trim($_POST['Stu_PW'])),
		"Stu_NAME" => stripslashes(trim($_POST['Stu_NAME'])),
		"Stu_SEX" => stripslashes(trim($_POST['Stu_SEX'])),
		"Stu_DATE" => stripslashes(trim($_POST['Stu_DATE'])),
		"Stu_TEL" => stripslashes(trim($_POST['Stu_TEL'])),
		"Stu_EMAIL" => stripslashes(trim($_POST['Stu_EMAIL'])),
		"Stu_College_CODE" => stripslashes(trim($_POST['Stu_College_CODE'])),
		"Stu_RT" => date('Y-m-d H:i:s'),
		"Stu_STATUS" => md5(rand(0, 10000)),
	);
	$sql = "insert user_stu(Stu_NO,Stu_PW,Stu_NAME,Stu_SEX,Stu_DATE,Stu_TEL,Stu_EMAIL,Stu_College_CODE,Stu_RT,Stu_STATUS) values($Stu_info[Stu_NO],'$Stu_info[Stu_PW]','$Stu_info[Stu_NAME]','$Stu_info[Stu_SEX]','$Stu_info[Stu_DATE]','$Stu_info[Stu_TEL]','$Stu_info[Stu_EMAIL]','$Stu_info[Stu_College_CODE]','$Stu_info[Stu_RT]','$Stu_info[Stu_STATUS]')";

	$check_result = mysqli_fetch_array(mysqli_query($sqllink, "SELECT COUNT(*) FROM user_stu WHERE Stu_NO =$Stu_info[Stu_NO]"));
	if ($check_result['COUNT(*)']) {
		$arr['success'] = 0;
		$arr['msg'] = '用户已存在，请重新注册！';

	} else {
		$reg_result = mysqli_query($sqllink, $sql);
		if ($reg_result) {
			$url = $http . "/login/Active_Account.php?id=" . $Stu_info['Stu_NO'] . "&str=" . $Stu_info['Stu_STATUS'];
			$subject = "帐号激活";
			$contenttext = $Stu_info['Stu_NAME'] . "先生/女士：您好！<br />&nbsp;&nbsp;&nbsp;&nbsp;
	您在云南师范大学失物招领系统注册了新帐户，如果你确认此行为是您本人的操作，请点击下面的链接，激活您的帐户！<br><br><br><Br><a href=$url>$url</a>";
			send_mail($Stu_info['Stu_EMAIL'], $subject, $contenttext);

			$arr['success'] = 1;
			$arr['msg'] = '注册成功,请登录邮箱激活您的帐号！';
			$arr['url'] = "index.php";

		} else {
			$arr['success'] = 0;
			$arr['msg'] = '提交失败，请重新提交！';
		}
	}
	echo json_encode($arr);
	mysqli_close($sqllink);

}

if ($act == 'check_info') {
	$User_id = $_SESSION['User_id'];
	$sql = "SELECT Stu_NAME ,Stu_SEX ,Stu_DATE ,Stu_TEL,Stu_EMAIL ,Stu_College_CODE FROM user_stu where Stu_NO=$User_id";
	$query = mysqli_query($sqllink, $sql);
	$ch_result = mysqli_fetch_array($query);
	if ($ch_result) {
		$arr = array(
			"success" => 1,
			"msg" => '查询失败',
			"Stu_NAME" => $ch_result['Stu_NAME'],
			"Stu_SEX" => $ch_result['Stu_SEX'],
			"Stu_DATE" => $ch_result['Stu_DATE'],
			"Stu_TEL" => $ch_result['Stu_TEL'],
			"Stu_EMAIL" => $ch_result['Stu_EMAIL'],
			"Stu_College_CODE" => $ch_result['Stu_College_CODE']);
	} else {
		$arr['success'] = 0;
		$arr['msg'] = '查询失败';
	}

	echo json_encode($arr);
	mysqli_close($sqllink);
}

// 修改个人信息
if ($act == 'update_info') {
	$Stu_info = array(
		"Stu_NO" => $_SESSION['User_id'],
		"Stu_NAME" => stripslashes(trim($_POST['Stu_NAME'])),
		"Stu_SEX" => stripslashes(trim($_POST['Stu_SEX'])),
		"Stu_DATE" => stripslashes(trim($_POST['Stu_DATE'])),
		"Stu_TEL" => stripslashes(trim($_POST['Stu_TEL'])),
		"Stu_EMAIL" => stripslashes(trim($_POST['Stu_EMAIL'])),
		"Stu_College_CODE" => stripslashes(trim($_POST['Stu_College_CODE'])));
	$sql = "update user_stu set Stu_NAME='$Stu_info[Stu_NAME]',Stu_SEX=$Stu_info[Stu_SEX],Stu_DATE='$Stu_info[Stu_DATE]',Stu_TEL='$Stu_info[Stu_TEL]',Stu_EMAIL='$Stu_info[Stu_EMAIL]',Stu_College_CODE='$Stu_info[Stu_College_CODE]' where Stu_NO=$Stu_info[Stu_NO]";

	$up_result = mysqli_query($sqllink, $sql);
	if ($up_result) {
		$arr['success'] = 1;
		$arr['msg'] = '更新成功！';
		$arr['url'] = "#";
	} else {
		$arr['success'] = 0;
		$arr['msg'] = '更新失败，请重新提交！';
	}
	echo json_encode($arr);
	mysqli_close($sqllink);
}

// 修改密码
if ($act == 'update_pw') {
	$Stu_info = array(
		"Stu_NO" => $_SESSION['User_id'],
		"Stu_PW" => stripslashes(trim($_POST['Stu_PW'])),
		"New_PW" => stripslashes(trim($_POST['New_PW'])));

	$query = mysqli_query($sqllink, "SELECT Stu_PW FROM user_stu WHERE Stu_NO=$Stu_info[Stu_NO]");
	$us = is_array($check_result = mysqli_fetch_array($query));
	$ps = $us ? $Stu_info['Stu_PW'] == $check_result['Stu_PW'] : FALSE;
	if ($ps) {
		$sql = "update user_stu set Stu_PW='$Stu_info[New_PW]' where Stu_NO=$Stu_info[Stu_NO]";
		$up_result = mysqli_query($sqllink, $sql);
		if ($up_result) {
			$arr['success'] = 1;
			$arr['msg'] = '密码已修改！';
			$arr['url'] = "#";
		} else {
			$arr['success'] = 0;
			$arr['msg'] = '修改失败，请重新提交！';
		}
	} else {
		$arr['success'] = 0;
		$arr['msg'] = '旧密码不符！';
	}
	echo json_encode($arr);
	mysqli_close($sqllink);
}

// 重置密码
if ($act == 'reset_pw') {
	$Stu_info = array(
		"Stu_NO" => stripslashes(trim($_POST['Stu_NO'])),
		"Stu_STATUS" => stripslashes(trim($_POST['Stu_STATUS'])),
		"New_PW" => stripslashes(trim($_POST['New_PW'])),
	);
	$us = is_array($check_result = mysqli_fetch_array(mysqli_query($sqllink, "SELECT * FROM `user_stu` WHERE `Stu_NO` =1234567890")));
	if ($us) {
		// !strcasecmp($check_result['Stu_STATUS'], $_GET['str'])
		if (!strcasecmp($check_result['Stu_STATUS'], $Stu_info['Stu_STATUS'])) {
			$arr['success'] = 0;
			$arr['msg'] = '非法的操作！';
		} else {
			$sql = "update user_stu set Stu_PW='$Stu_info[New_PW]' where Stu_NO=$Stu_info[Stu_NO]";
			$up_result = mysqli_query($sqllink, $sql);
			if ($up_result) {
				$arr['success'] = 1;
				$arr['msg'] = '重置成功，请重新登录';
				$arr['url'] = $wwwroot;
				mysqli_query($sqllink, "update user_stu set Stu_STATUS=null WHERE Stu_NO =$Stu_info[Stu_NO]");
			}
		}
	} else {
		$arr['success'] = 0;
		$arr['msg'] = '用户名不存在！';
	}
	echo json_encode($arr);
	mysqli_close($sqllink);
}

//找回密码
if ($act == 'regain_pw') {
	$Stu_NO = stripslashes(trim($_POST['Stu_No']));
	$Stu_EMAIL = stripslashes(trim($_POST['Stu_EMAIL']));
	$us = is_array($check_result = mysqli_fetch_array(mysqli_query($sqllink, "SELECT * FROM user_stu WHERE Stu_NO =$Stu_NO")));
	if ($us) {
		if ($check_result['Stu_EMAIL'] != $Stu_EMAIL) {
			$arr['success'] = 0;
			$arr['msg'] = '邮箱错误！';
		} else {
			$string = md5(rand(0, 10000));
			$sql = "update user_stu set Stu_STATUS='$string' where Stu_NO=$Stu_NO";
			$up_result = mysqli_query($sqllink, $sql);
			if ($up_result) {
				$url = $wwwroot . "Me/resetpw.php?id=" . $check_result['Stu_NO'] . "&str=" . $string;
				$subject = "找回密码";
				$contenttext = $check_result['Stu_NAME'] . "先生/女士：您好！<br />&nbsp;&nbsp;&nbsp;&nbsp;
				您使用了云南师范大学失物招领系统的密码找回功能，如果你确认此密码找回功能是您启用的，请点击下面的链接，按流程进行密码重设！<br><br><br><Br><a href=$url>$url</a>";
				// send_mail($SMTP_Sersers, $Email_Account, $Email_Passwd, $check_result['Stu_EMAIL'], $subject, $contenttext);
				send_mail($check_result['Stu_EMAIL'], $subject, $contenttext);
				$arr['success'] = 1;
				$arr['msg'] = '成功提交，请登录邮箱重置密码';
			}

		}
	} else {
		$arr['success'] = 0;
		$arr['msg'] = '用户名不存在！';
	}

	echo json_encode($arr);
	mysqli_close($sqllink);
}

// 登录
if ($act == 'login') {
	$User_id = stripslashes(trim($_POST['User_id']));
	$User_pwd = stripslashes(trim($_POST['User_pwd']));
	$query = mysqli_query($sqllink, "SELECT * FROM user_stu where Stu_NO like $User_id");

	$us = is_array($check_result = mysqli_fetch_array($query));
	$ps = $us ? $User_pwd == $check_result['Stu_PW'] : FALSE;
	if ($ps) {
		if (empty($check_result['Stu_STATUS'])) {
			$_SESSION['User_id'] = $check_result['Stu_NO'];
			$arr['success'] = 1;
			$arr['msg'] = '登录成功！';
			$arr['User_id'] = $_SESSION['User_id'];
			$arr['User_name'] = $check_result['Stu_NAME'];
			$arr['url'] = "Notice/Notice_index.php";
		} else {
			$arr['success'] = 0;
			$em = substr($check_result['Stu_EMAIL'], 0, 2) . preg_replace('/([\d\w+_-]{0,100})@/', '***@', $check_result['Stu_EMAIL']);
			$arr['msg'] = "帐号未激或已申请重置密码！<br/>请通过帐号绑定的邮箱" . $em . "激活或重置密码！";
		}
	} else {
		$arr['success'] = 0;
		$arr['msg'] = '用户名或密码错误！';
	}
	echo json_encode($arr);
	mysqli_close($sqllink);

}

// 退出
if ($act == 'logout') {
	session_destroy();
	$arr['success'] = 1;
	$arr['url'] = "http://lf.wh820.top";
	echo json_encode($arr);
}

?>