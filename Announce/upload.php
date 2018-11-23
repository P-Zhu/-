<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-21 15:32:30
 * @version $Id$
 */
date_default_timezone_set('PRC');
session_start();
require_once "$WebDir/config.php";

$Res_info = array(
	"Res_Class" => stripslashes(trim($_POST['Res_Class'])),
	"Res_RDT" => date('Y-m-d H:i:s'),
	"Res_DESC" => stripslashes(trim($_POST['Res_DESC'])),
	"Res_CP" => $_SESSION['User_id'],
	"Res_P" => stripslashes(trim($_POST['Res_P'])),
	"serverId" => stripslashes(trim($_POST['serverId'])),
	"access_token" => stripslashes(trim($_POST['access_token'])));
if ($Res_info['Res_Class'] == '1001') {
	$Res_info["Res_DESC"] = '卡号:' . stripslashes(trim($_POST['Card_NO'])) . '&姓名:' . stripslashes(trim($_POST['Card_NAME']));
}
$targetName = date('Y-m-d') . date('H:i:s') . rand(1000, 9999) . ".jpg";
$targetName = preg_replace("/(-)|(:)/", "", $targetName);
//文件名重复性检测
while (file_exists($save_path)) {
	$targetName = date('Y-m-d') . date('H:i:s') . rand(1000, 9999) . ".jpg";
	$targetName = preg_replace("/(-)|(:)/", "", $targetName);
}

$Res_pic = array(
	"save_path" => "../Data/Res_pic/" . $targetName,
	"get_url" => "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$Res_info['access_token']}&media_id={$Res_info['serverId']}",
);
$arr['success'] = 0;
$arr['msg'] = "error:0001";
// $serverId = stripslashes(trim($_POST['serverId']));
// $access_token = stripslashes(trim($_POST['access_token']));
// $serverId = "cJiQc0Bhz43toLwSH_cAaQtk_93-BQGgqGjUxCmDlOjnnQnW70tTRDU_5JO7yqDA";
// $access_token = "nIvdnuxkcE4AqJplR6c2EtaYsHGMIu9aRNe2-HYsd0vO2qE2_n-BjKtV4yVzdxbC7Oqy1P6Rumb3M8aCCiW7uAt5HiHTIKy6lgO0Er2wwM0KJLcABACBD";
$pic_data = file_get_contents($Res_pic['get_url']);
file_put_contents($Res_pic['save_path'], $pic_data);
if (file_exists($Res_pic['save_path'])) {
	//物品信息写入数据库
	$sql = "insert `".$db_name."`.`res_info`(`Res_CD`,`Res_RDT`,`Res_DESC`,`Res_CP`,`Res_P`,`Res_PIC`,`Res_STATUS`) values($Res_info[Res_Class],'$Res_info[Res_RDT]','$Res_info[Res_DESC]','$Res_info[Res_CP]','$Res_info[Res_P]','$targetName','0')";
	$check_result = mysqli_query($sqllink, $sql);

	$arr['success'] = 1;
	$arr['msg'] = "上传成功";


} else {
	$arr['success'] = 0;
	$arr['msg'] = "上传失败";
}

// mysqli_free_result($check_result);
mysqli_close($sqllink);
echo json_encode($arr);
?>