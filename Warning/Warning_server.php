<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-29 01:12:16
 * @version $Id$
 */
include '../config.php';
session_start();
date_default_timezone_set('PRC');

// 查询新消息
if ($_GET['action'] == "Warning_list") {
	$sql_cc = "SELECT *  FROM `msg_info` WHERE `Stu_NO` =" . $_SESSION['User_id'] . " ORDER BY `Msg_DT` DESC";
	global $sqllink;
	$c = mysqli_query($sqllink, $sql_cc);
	$i = 0;
	$arr['success'] = 1;
	while ($row = mysqli_fetch_array($c)) {
		$arr[$i]['Msg_ID'] = $row['Msg_ID'];
		$arr[$i]['Role_ID'] = $row['Role_ID'];
		$arr[$i]['Res_ID'] = $row['Res_ID'];
		$arr[$i]['Res_STATUS'] = $row['Res_STATUS'];
		$arr[$i]['Msg_STATUS'] = $row['Msg_STATUS'];
		$arr[$i]['Msg_DT'] = $row['Msg_DT'];
		$arr[$i]['Msg_Text'] = $row['Msg_TEXT'];
		$i++;
	}
	$arr['length'] = $i;
	echo json_encode($arr);
	mysqli_close($sqllink);
}

// 撤消操作
if ($_GET['action'] == 'cancel') {
	$id = $_GET['id'];
	$Role_ID = $_GET['Role_ID'];
	$Res_STATUS = $_GET['Res_STATUS'] - 1;
	$Msg_ID = $_GET['Msg_ID'];
	$Msg_TEXT = array(
		'CLA' => '认领申请已取消！',
		'CP' => '您发布的信息有人认领了！',
	);

	$sql = array(
		'CLA' => "update `res_info` set `Res_STATUS`=$Res_STATUS,`Res_CLA`=null,`Res_CT`=null where `Res_ID`=$id",
		'CP' => "update `res_info` set `Res_STATUS`=$Res_STATUS where `Res_ID`= $id",
	);

	// 更新消息记录
	$msg = "update `msg_info` set `Res_STATUS`=$Res_STATUS,`Msg_STATUS`=0,`Msg_DT`='" . date('Y-m-d H:i:s') . "',
			`Msg_TEXT`='$Msg_TEXT[$Role_ID]' where `Msg_ID`=$Msg_ID";

	$msg_result = mysqli_query($sqllink, $msg);
	if ($msg_result) {
		$update_result = mysqli_query($sqllink, $sql[$Role_ID]);
		$arr['success'] = 1;
		$arr['id'] = $id;
		$arr['msg'] = "已撤消！";
	} else {
		$arr['success'] = 0;
		$arr['msg'] = "操作失败！";

	}
	echo json_encode($arr);
	mysqli_close($sqllink);
}
// 已被领
if ($_GET['action'] == 'CP_ed') {
	$id = $_GET['id'];
	$Res_STATUS = $_GET['Res_STATUS'] + 1;
	$Msg_ID = $_GET['Msg_ID'] - 1;
	$Msg_TEXT = "您已找回遗失的物品了吗？";
	$sql = "update `res_info` set `Res_STATUS`=$Res_STATUS where `Res_ID`=$id";

	$msg = "update `msg_info` set `Res_STATUS`=$Res_STATUS,`Msg_STATUS`=0,`Msg_DT`='" . date('Y-m-d H:i:s') . "',
			`Msg_TEXT`='$Msg_TEXT' where `Msg_ID`=$Msg_ID";
	try {
		$msg_result = mysqli_query($sqllink, $msg) && mysqli_query($sqllink, $msg);
		if ($msg_result) {
			$update_result = mysqli_query($sqllink, $sql);
			$arr['success'] = 1;
			$arr['id'] = $id;
			$arr['msg'] = "操作成功";
		} else {
			$arr['success'] = 0;
			$arr['msg'] = "操作失败！";

		}
		echo json_encode($arr);
		mysqli_close($sqllink);
	} catch (Exception $e) {
		echo "$e";
	}

}
// 已领
if ($_GET['action'] == 'CLA_ed') {
	$id = $_GET['id'];
	$Role_ID = $_GET['Role_ID'];
	$Res_STATUS = $_GET['Res_STATUS'] - 1;
	$Msg_ID = $_GET['Msg_ID'];
	$Msg_TEXT = array(
		'CLA' => '您已成功找回遗失的物品！',
		'CP' => '您捡到的物品已成功交还给失主！',
	);
	try {
		$sql = "update `res_info` set `Res_STATUS`=3,`Res_CDT`='" . date('Y-m-d H:i:s') . "' where `Res_ID`=" . $id;
		$msg = array(
			'CLA' => "update `msg_info` set `Res_STATUS`=$Res_STATUS,`Msg_STATUS`=0,`Msg_DT`='" . date('Y-m-d H:i:s') . "',
			`Msg_TEXT`='$Msg_TEXT[CLA]' where `Msg_ID`=$Msg_ID",
			'CP' => "update `msg_info` set `Res_STATUS`=$Res_STATUS,`Msg_STATUS`=0,`Msg_DT`='" . date('Y-m-d H:i:s') . "',
			`Msg_TEXT`='$Msg_TEXT[CP]' where `Msg_ID`=$Msg_ID+1",
		);

		$update_result = mysqli_query($sqllink, $sql);
		if ($update_result) {
			$msg_result = mysqli_query($sqllink, $msg['CLA']) && mysqli_query($sqllink, $msg['CP']);
			$arr['success'] = 1;
			$arr['id'] = $id;
			$arr['msg'] = "您的物品已成功认领！";
		} else {
			$arr['success'] = 0;
			$arr['msg'] = "操作失败！";
		}
		echo json_encode($arr);
		mysqli_close($sqllink);
	} catch (Exception $e) {
		echo "$e";
	}
}
?>