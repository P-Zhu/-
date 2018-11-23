<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-27 13:52:30
 * @version $Id$
 */
date_default_timezone_set('PRC');
/**
 * 邮件发送类
 * 支持发送纯文本邮件和HTML格式的邮件，可以多收件人，多抄送，多秘密抄送，带附件的邮件
 * 需要的php扩展，sockets和Fileinfo。
 * @example
 * $mail = new MySendMail();
 * $mail->setServer("XXXXX", "XXXXX@XXXXX", "XXXXX"); 设置smtp服务器
 * $mail->setFrom("XXXXX"); 设置发件人
 * $mail->setReceiver("XXXXX"); 设置收件人，多个收件人，调用多次
 * $mail->setCc("XXXX"); 设置抄送，多个抄送，调用多次
 * $mail->setBcc("XXXXX"); 设置秘密抄送，多个秘密抄送，调用多次
 * $mail->setMailInfo("test", "<b>test</b>"); 设置邮件主题、内容
 * $mail->sendMail(); 发送
 */

/**************************** Test ***********************************/
// $mail = new MySendMail();
// $mail->setServer("smtp.163.com", "rieeqyx@163.com", "Zhupeng_163");
// $mail->setFrom("rieeqyx@163.com");
// $mail->setReceiver("185417081@qq.com");
// //$mail->setReceiver("XXXXX@XXXXX");
// // $mail->setCc("XXXXX@XXXXX");
// // $mail->setCc("XXXXX@XXXXX");
// // $mail->setBcc("XXXXX@XXXXX");
// // $mail->setBcc("XXXXX@XXXXX");
// // $mail->setBcc("XXXXX@XXXXX");
// $mail->setMailInfo("test", "<b>test</b>", "11.txt");
// $mail->sendMail();
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

	<title>找回密码</title>
    </head>

<body>
    <div class="page__hd">
	<?php Print_HTML("Header_Html")?>

	</div>
    <div class="page__bd" id="content">
        <div class="bd__header">
            <h3>找回密码</h3>
        </div>
        <form accept="" method="post">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell weui-cell_vcode">
                    <div class="weui-cell__hd">
                        <label class="weui-label">学号</label>
                    </div>
                    <div class="weui-cell__bd">
    	                <input name="Stu_NO" id="ID_Stu_NO" class="weui-input" type="number" maxlength="10" placeholder="请输入10位数字的学号">
                   </div>
                </div>
                <div class="weui-cell weui-cell_vcode">
                    <div class="weui-cell__hd">
                        <label class="weui-label">E-mail</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input name="Stu_EMAIL" id="ID_Stu_EMAIL" class="weui-input" type="email" value="" placeholder="请输入E-mail">
                    </div>
                </div>
            </div>
        </form>
	    <div id="reset_pw" class="weui-btn_primary btn"> 找回密码 </div>
	    <div id="back" class="weui-btn_primary btn"> 返回 </div>
    </div>
      <?php Print_Html("Footer_Html")?>

</body>
    <script type="text/javascript" src="../Public/Js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="../Public/Js/CheckData.js"></script>
</html>
