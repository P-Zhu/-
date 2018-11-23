<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-06-02 20:27:31
 * @version $Id$
 */
date_default_timezone_set('PRC');
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
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

	<title>激活帐号</title>
    </head>

<body>
    <div class="page__hd">
	<?php Print_HTML("Header_Html")?>

	</div>
    <div class="page__bd" id="content">
        <div class="bd__header">
            <h3>激活帐号</h3>
        </div>
        <div class="bd__header">
            <p class="Active_p">
<?php
$check_result = mysqli_fetch_array(mysqli_query($sqllink, "SELECT Stu_STATUS FROM user_stu WHERE Stu_NO =" . $_GET['id']));
// echo substr("185417081", 0, 2) . preg_replace('/([\d\w+_-]{0,100})@/', '***@', '185dd41fds7081@qq.com');
if (!strcasecmp($check_result['Stu_STATUS'], $_GET['str'])) {
	mysqli_query($sqllink, "update User_Stu set Stu_STATUS=null WHERE Stu_NO =" . $_GET['id']);
	echo "<br/>您的帐号已激活，请通过微信重新登录系统！";
	// header("Refresh:5;url=http://wx.myeit.site");
}
?>
   			</p>
        </div>
	<a href="/">
	<div id="login" class="weui-btn_primary btn"  style="vertical-align: inherit;overflow: hidden;width: 100px;margin: 20px auto;">
  	<font style="vertical-align: inherit;"> 登录 </font>
      </div>
    </a>
 </div>

      <?php Print_Html("Footer_Html")?>

</body>
    <script type="text/javascript" src="../Public/Js/jquery-2.1.4.js"></script>
</html>
