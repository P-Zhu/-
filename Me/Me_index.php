<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-11 16:01:52
 * @version $Id$
 */
date_default_timezone_set('PRC');
session_start();

require_once "../config.php";
require_once "../Public/sdk/jssdk.php";
require_once "../Public/Lib/Lib.php";
islogin();

$jssdk = new JSSDK("$appid", "$appsecret");
$signPackage = $jssdk->getSignPackage();
$access_token = $jssdk->getAccessToken();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="icon" href="../Public/Images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="../Public/Images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/Css/weui.min.css" />
    <link rel="stylesheet" type="text/css" href="../Public/Css/style.css">
    <link rel="stylesheet" href="../Public/Css/btn.css">
    <script type="text/javascript" src="../Public/Js/jquery-2.1.4.js"></script>

    <script type="text/javascript" src="../Public/Js/CheckData.js"></script>
    <title>个人管理</title>
</head>

<body>
    <div class="page__hd">
        <?php Print_Html("Header_Html")?>
    </div>
    <div class="page__bd" id="content">
        <div class="page grid">
            <div class="weui-grids">
                <span href="javascript:;" class="weui-grid" id="ANN_Record">
                    <div class="weui-grid__icon">
                        <img src="../Public/Images/cj.png" alt="">
                    </div>
                    <p class="weui-grid__label">发布记录</p>
                </span>
                <span href="javascript:;" class="weui-grid" id="CLA_Record">
                    <div class="weui-grid__icon">
                        <img src="../Public/Images/icon_cal.png" alt="">
                    </div>
                    <p class="weui-grid__label">领取记录</p>
                </span>
                <span href="javascript:;" class="weui-grid" id="update_info">
                    <div class="weui-grid__icon">
                        <img src="../Public/Images/ts.png" alt="">
                    </div>
                    <p class="weui-grid__label">修改信息</p>
                </span>
                <span href="javascript:;" class="weui-grid" id="Reset_pw">
                    <div class="weui-grid__icon">
                        <img src="../Public/Images/pw.png" alt="">
                    </div>
                    <p class="weui-grid__label">修改密码</p>
                </span>
                <span href="javascript:;" class="weui-grid" id="logout">
                    <div class="weui-grid__icon">
                        <img src="../Public/Images/logout.png" alt="">
                    </div>
                    <p class="weui-grid__label">退出</p>
                </span>
            </div>
            <script type="text/javascript" src="./js/Me_nav.js"></script>
        </div>
    </div>
  <?php Print_Html("Tabbar_Html")?>
</body>
<script src="../Public/Js/jweixin-1.2.0.js"></script>

<script>


  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"]; ?>',
    timestamp: '<?php echo $signPackage["timestamp"]; ?>',
    nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
    signature: '<?php echo $signPackage["signature"]; ?>',
    jsApiList: [
        // 所有要调用的 API 都要加到这个列表中
        "previewImage"
    ]
});
wx.error(function(res) {
    alert(res.errMsg);
});

//创建数组存储上传图片的localIds/serverId
var imagesID = new Array();
wx.ready(function() {
    // 在这里调用 API

    //预览图片
    document.getElementById("Res_PIC").onclick = function() {
        wx.previewImage({
            current: '', // 当前显示图片的http链接
            urls: [$("#Res_PIC").attr("src")] // 需要预览的图片http链接列表
        });
    }
});
</script>
</html>
