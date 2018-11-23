<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-25 01:14:14
 * @version $Id$
 */
date_default_timezone_set('PRC');
require_once "../config.php";

$act = $_GET['action'];
// 返回
if ($act == 'back') {
	$arr['success'] = 1;
	$arr['html'] = file_get_contents($http . "/Me/Me_nav.php");
	echo json_encode($arr);
}
// 发布记录
if ($act == 'ANN_Record') {
	$arr['success'] = 1;
	$arr['html'] = file_get_contents($http . "/Me/Me_record.php?action=Res_CP");
	echo json_encode($arr);
}
// 领取记录
if ($act == 'CLA_Record') {
	$arr['success'] = 1;
	$arr['html'] = file_get_contents($http . "/Me/Me_record.php?action=Res_CLA");
	echo json_encode($arr);
}
// 修改信息
if ($act == 'update_info') {
	$arr['success'] = 1;
	$arr['html'] = file_get_contents($http . "/Me/update_info.php");
	echo json_encode($arr);

}
// 修改密码
if ($act == 'Reset_pw') {
	$arr['success'] = 1;
	$arr['html'] = file_get_contents($http . "/Me/Me_update_pw.php");
	echo json_encode($arr);
}
