<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-22 18:55:45
 * @version $Id$
 */
date_default_timezone_set('PRC');
session_start();
require_once '../config.php';
$act = $_GET['action'];
$Pic_path = "$http/$webroot/Data/Res_pic/";

// 默认公告
if ($act == 'all') {
	$sql = "SELECT  `res_info`.`Res_ID`,`res_class`.`Class_NAME` , `res_info`.`Res_RDT`,`res_info`.`Res_DESC`
	FROM  `res_info`  LEFT JOIN `res_class`  ON `res_info`.`Res_CD` =`res_class`.`Class_CODE`
	WHERE `res_info`.`Res_STATUS` <3 ORDER BY `res_info`.`Res_RDT` DESC ";
	$look_result = mysqli_query($sqllink, $sql);
	$arr = array();
	$i = 0;
	$arr['success'] = 1;
	while ($row = mysqli_fetch_array($look_result)) {
		$arr[$i]['ID'] = $row['Res_ID'];
		$arr[$i]['CLASS'] = $row['Class_NAME'];
		$arr[$i]['RDT'] = $row['Res_RDT'];
		$arr[$i]['DESC'] = $row['Res_DESC'];
		$i++;
	}

	$arr['length'] = $i;
	echo json_encode($arr);
	mysqli_close($sqllink);
}

// 发布/认领 记录
if ($act == 'Rec') {
	$sql = "SELECT * FROM  `res_info`  LEFT JOIN `res_class`  ON `res_info`.`Res_CD` =`res_class`.`Class_CODE`
	WHERE `res_info`.`" . $_GET['role'] . "` =" . $_SESSION['User_id'];
	$look_result = mysqli_query($sqllink, $sql);
	$arr = array();
	$i = 0;
	$arr['success'] = 1;
	while ($row = mysqli_fetch_array($look_result)) {
		$arr[$i]['ID'] = $row['Res_ID'];
		$arr[$i]['CLASS'] = $row['Class_NAME'];
		$arr[$i]['RDT'] = $row['Res_RDT'];
		$arr[$i]['DESC'] = $row['Res_DESC'];
		$i++;
	}
	$arr['length'] = $i;
	echo json_encode($arr);
	mysqli_close($sqllink);
}

// //认领记录
// if ($act == 'Res_CLA') {
// 	$sql = "SELECT * FROM  `res_info`  LEFT JOIN `res_class`  ON `res_info`.`Res_CD` =`res_class`.`Class_CODE`
// 	WHERE `res_info`.`Res_CLA` =" . $_SESSION['User_id'];
// 	$look_result = mysqli_query($sqllink, $sql);
// 	$arr = array();
// 	$i = 0;
// 	$arr['success'] = 1;
// 	while ($row = mysqli_fetch_array($look_result)) {
// 		$arr[$i]['ID'] = $row['Res_ID'];
// 		$arr[$i]['CLASS'] = $row['Class_NAME'];
// 		$arr[$i]['RDT'] = $row['Res_RDT'];
// 		$arr[$i]['DESC'] = $row['Res_DESC'];
// 		$i++;
// 	}

// 	$arr['length'] = $i;
// 	echo json_encode($arr);
// 	mysqli_close($sqllink);
// }

// 公告筛选
if ($act == 'filter') {
	$filter = array(
		'res_class' => stripslashes(trim($_POST['filter_Class'])),
		'Start_DATE' => stripslashes(trim($_POST['Start_DATE'])),
		'End_DATE' => stripslashes(trim($_POST['End_DATE'])),
	);

	$role = $_GET['role'];
	if ($role == 'any') {
		//公告筛选
		if ($filter['res_class'] == "0000") {
			$sql = "SELECT * FROM  `res_info`  LEFT JOIN `res_class`  ON `res_info`.`Res_CD` =`res_class`.`Class_CODE`
		WHERE `Res_RDT` BETWEEN '$filter[Start_DATE]' AND '$filter[End_DATE]' AND `Res_STATUS` <3 ORDER BY `res_info`.`Res_RDT` DESC ";
		} else {
			$sql = "SELECT  *	FROM  `res_info`  LEFT JOIN `res_class`  ON `res_info`.`Res_CD` =`res_class`.`Class_CODE`
		WHERE `Res_RDT` BETWEEN '$filter[Start_DATE]' AND '$filter[End_DATE]' AND `Res_CD` LIKE '$filter[res_class]' AND `Res_STATUS` <3 ORDER BY `res_info`.`Res_RDT` DESC ";
		}
	} elseif ($role == 'ANN') {
		//发布筛选
		if ($filter['res_class'] == "0000") {
			$sql = "SELECT * FROM  `res_info`  LEFT JOIN `res_class`  ON `res_info`.`Res_CD` =`res_class`.`Class_CODE`
		WHERE `Res_RDT` BETWEEN '$filter[Start_DATE]' AND '$filter[End_DATE]' AND `Res_CP` =" . $_SESSION['User_id'];
		} else {
			$sql = "SELECT  *	FROM  `res_info`  LEFT JOIN `res_class`  ON `res_info`.`Res_CD` =`res_class`.`Class_CODE`
		WHERE `Res_RDT` BETWEEN '$filter[Start_DATE]' AND '$filter[End_DATE]' AND `Res_CD` LIKE '$filter[res_class]' AND `Res_CP` =" . $_SESSION['User_id'];
		}

	} elseif ($role == 'CLA') {
		// 认领筛选
		if ($filter['res_class'] == "0000") {
			$sql = "SELECT * FROM  `res_info`  LEFT JOIN `res_class`  ON `res_info`.`Res_CD` =`res_class`.`Class_CODE`
		WHERE `Res_RDT` BETWEEN '$filter[Start_DATE]' AND '$filter[End_DATE]' AND`Res_CLA` =" . $_SESSION['User_id'];
		} else {
			$sql = "SELECT  *	FROM  `res_info`  LEFT JOIN `res_class`  ON `res_info`.`Res_CD` =`res_class`.`Class_CODE`
		WHERE `Res_RDT` BETWEEN '$filter[Start_DATE]' AND '$filter[End_DATE]' AND `Res_CD` LIKE '$filter[res_class]' AND `Res_CLA` =" . $_SESSION['User_id'];
		}
	}

	$look_result = mysqli_query($sqllink, $sql);
	$arr = array();
	$i = 0;
	$arr['success'] = 1;
	while ($row = mysqli_fetch_array($look_result)) {
		$arr[$i]['ID'] = $row['Res_ID'];
		$arr[$i]['CLASS'] = $row['Class_NAME'];
		$arr[$i]['RDT'] = $row['Res_RDT'];
		$arr[$i]['DESC'] = $row['Res_DESC'];
		$i++;
	}
	$arr['length'] = $i;
	echo json_encode($arr);
	mysqli_close($sqllink);
}

// 物品详情
if ($act == 'details') {
	$sql = "SELECT `res_info`.*,`res_class`.`Class_NAME`,`Stu_TEL`
			FROM `res_info`
			LEFT JOIN `res_class` ON `res_info`.`Res_CD`= `res_class`.`Class_CODE`
			LEFT JOIN `user_stu` on `res_info`.`Res_CP`= `user_stu`.`Stu_NO`
			WHERE `res_info`.`Res_ID`= " . $_GET['id'];
	$look_result = mysqli_query($sqllink, $sql);
	try {
		$arr['success'] = 1;
		while ($row = mysqli_fetch_array($look_result)) {
			$arr['ID'] = $row['Res_ID'];
			$arr['CLASS'] = $row['Class_NAME'];
			$arr['RDT'] = $row['Res_RDT'];
			$arr['DESC'] = $row['Res_DESC'];
			$arr['CP'] = $row['Res_CP'];
			$arr['TEL'] = $row['Stu_TEL'];
			$arr['P'] = $row['Res_P'];
			$arr['PIC'] = $Pic_path . $row['Res_PIC'] . ".jpg";
			$arr['STAUTS'] = $row['Res_STATUS'];
			$arr['CLA'] = $row['Res_CLA'];
			$arr['CDT'] = $row['Res_CDT'];
		}
		echo json_encode($arr);
		mysqli_close($sqllink);
	} catch (Exception $e) {
		echo "$e";
	}
}

// 发布、认领记录的物品详情
if ($act == 'Rec_Details') {
	$id = $_GET['id'];
	$Role_ID = $_GET['Role_ID'];
	$Msg_ID = $_GET['Msg_ID'];

	// 标记已查看新消息
	$Msg_readed = "update `msg_info` set `Msg_STATUS`=1 where `Msg_ID`=" . $Msg_ID;

	// 查询物品详情
	$sql = "SELECT `res_info`.*,`Stu_NO` as PP,`Stu_TEL`,`res_class`.`Class_NAME`
	  FROM `res_info`
	  LEFT JOIN `res_class` ON `res_class`.`Class_CODE`=`res_info`.`Res_CD`
	  LEFT JOIN `user_stu` ON `user_stu`.`Stu_NO`= `res_info`.`" . $Role_ID . "`
	  WHERE `Res_ID`= " . $id;
	try {
		$Msg_look = mysqli_query($sqllink, $Msg_readed);
		$look_result = mysqli_query($sqllink, $sql);
		$arr['success'] = 1;
		while ($row = mysqli_fetch_array($look_result)) {
			$arr['ID'] = $row['Res_ID'];
			$arr['CLASS'] = $row['Class_NAME'];
			$arr['RDT'] = $row['Res_RDT'];
			$arr['DESC'] = $row['Res_DESC'];
			$arr['P'] = $row['Res_P'];
			$arr['PIC'] = $Pic_path . $row['Res_PIC'] . ".jpg";
			$arr['STAUTS'] = $row['Res_STATUS'];
			$arr['PP'] = $row['PP'];
			$arr['TEL'] = $row['Stu_TEL'];
			$arr['CT'] = $row['Res_CT'];
			$arr['CDT'] = $row['Res_CDT'];
		}
		echo json_encode($arr);
		mysqli_close($sqllink);
	} catch (Exception $e) {
		echo $e;
	}

}

// 认领的处理
if ($act == 'Res_rl') {
	$id = $_GET['id'];
	$Res_CP = $_GET['CP'];
	$Text = array(
		'CLA' => '您已成功提交认领申请！',
		'CP' => '您发布的信息有人认领了！',
	);

	$sql = "update `res_info` set `Res_STATUS`=1,`Res_CLA`=" . $_SESSION['User_id'] . ",`Res_CT`='" . date('Y-m-d H:i:s') . "' where `Res_ID`=" . $id;
	$msgCLA = "insert `msg_info`(`Stu_NO`,`Role_ID`,`Res_ID`,`Res_STATUS`,`Msg_STATUS`,`Msg_DT`,`Msg_TEXT`)
			values(" . $_SESSION['User_id'] . ",'CLA',$id,1,0,'" . date('Y-m-d H:i:s') . "','$Text[CLA]')";

	$msgCP = "insert `msg_info`(`Stu_NO`,`Role_ID`,`Res_ID`,`Res_STATUS`,`Msg_STATUS`,`Msg_DT`,`Msg_TEXT`)
			values(" . $Res_CP . ",'CP',$id,1,0,'" . date('Y-m-d H:i:s') . "','$Text[CP]')";
	$check_result = mysqli_fetch_array(mysqli_query($sqllink, "SELECT Res_CP FROM res_info WHERE Res_ID =$id"));
	if ($check_result['Res_CP'] == $_SESSION['User_id']) {
		$arr['success'] = 0;
		$arr['msg'] = "不能认领自己发布的物品！";
	} else {
		$msg_result = mysqli_query($sqllink, $msgCLA) && mysqli_query($sqllink, $msgCP);
		if ($msg_result) {
			$update_result = mysqli_query($sqllink, $sql);
			$arr['success'] = 1;
			$arr['id'] = $id;
			$arr['msg'] = "认领成功！";
		} else {
			$arr['success'] = 0;
			$arr['msg'] = "认领失败！";

		}

	}
	echo json_encode($arr);
	mysqli_close($sqllink);
}
?>