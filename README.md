Lost-and-Found
==============

# 安装

## 1、创建网站目录，克隆文件

## 2、配置数据信息，并从db.sql导入数据

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$host = "localhost";
$db_user = "wx_lf_db";
$db_pass = "wx_lf_db";
$db_name = "wx_lf_db";
$timezone = "Asia/Shanghai";
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

## 3、配置config.php
```

// ****************
//微信公众号配置
// ******************
$appid = "";
$appsecret = "";

// ****************
//邮件服务器配置微
// ******************
$SMTP_Sersers = "smtp.qq.com";
$Email_Account = "*@qq.com";
$Email_Passwd = "*";

$http = "http://lf.wh820.top/";
$RootDir = $_SERVER['DOCUMENT_ROOT'];
$webroot = "/";

$host = "localhost";
$db_user = "wx_lf_db";
$db_pass = "wx_lf_db";
$db_name = "wx_lf_db";
$timezone = "Asia/Shanghai";

$sqllink = mysqli_connect($host, $db_user, $db_pass, $db_name);
mysqli_query($sqllink, "SET names UTF8");

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone); //北京时间
```

## 4、完成
## 5、部分界面

<div class="pic_list">
<img src="./media/6e198855ed77bd283fcc1f65ef480ba3.png">
<img src="./media/1627aab9337b5f6aac9e31afb0430e36.png">
<img src="./media/feafb82a4586edb34a584a415b0151da.png">

<img src="./media/2462483e1694363518547f7328735dd6.png">
<img src="./media/54efa006d72b406d57e2f479e5803fc1.png">

<img src="./media/ae7c006d9700121f1cb9d0a886193748.png">
<img src="./media/d0bc21a708eb6cfa296bc119241e490d.png">
<img src="./media/ec9367aeba4dbcd558b5ef4b90b91ee6.png">
<img src="./media/efa81c0f7958116d9ada531fb6d16143.png">
<img src="./media/1a5cdf4ce6606ed9f8a0436a3f734045.png">
<img src="./media/fb7bda16294bf8eb61c01bfc597310fc.png">
<img src="./media/fd8d24e7d773bd2ad97604f8ad6bca5a.png">

</div>
