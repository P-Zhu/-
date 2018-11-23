<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-17 00:05:23
 * @version $Id$
 */
date_default_timezone_set('PRC');
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";

$act = $_GET['action'];

switch ($act) {
case 'ResClass':
	$sqlstr = mysqli_query($sqllink, "SELECT * FROM  `res_class` where 1");
	$arr['list'][0] = '<option value="0000">请选择</option>';
	break;

case 'filter':
	$sqlstr = mysqli_query($sqllink, "SELECT * FROM  `res_class` where 1");
	$arr['list'][0] = '<option value="0000">全部</option>';
	break;

case 'Clist':
	$sqlstr = mysqli_query($sqllink, "SELECT * FROM  `stu_college` where 1");
	$arr['list'][0] = '<option value="0000">请选择</option>';
	break;

default:
	# code...
	break;
}

$arr['success'] = 1;
$i = 1;
// $arr['htmllist'] = '<option value="0000">请选择学院</option>';
while ($list = mysqli_fetch_array($sqlstr)) {
	$arr['list'][$i++] = '<option value="' . $list[0] . '">' . $list[1] . '</option>';
	# code...
}
// echo $arr[4];
echo json_encode($arr);
mysqli_close($sqllink);