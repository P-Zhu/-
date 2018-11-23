<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-11 14:43:28
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
    <link rel="stylesheet" href="../Public/Css/weui.min.css"/>
    <link rel="stylesheet" href="../Public/Css/style.css">
    <link rel="stylesheet" href="../Public/Css/btn.css">

    <script type="text/javascript" src="../Public/Js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="../Public/Js/getlist.js"></script>
    <title>招领登记</title>
    <script type="text/javascript">
        getReslist();
    </script>
    </head>
<body>
<div class="page__hd">
<?php Print_Html("Header_Html");?>
</div>
    <div>
    </div>
<div class="page__bd">
    <div class="bd__header">
        <h3>招领登记</h3>
    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">类型</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" id="Res_Class" name="ResClass">
                      <option value="0000">请选择</option>
                </select>
            </div>
        </div>
        <div class="weui-cell" name="desc">
            <div class="weui-cell__hd">
                <label class="weui-label">描述</label><br/>
            </div>
            <div class="weui-cell__bd">
                <textarea id="Res_DESC" class="weui-textarea" placeholder="请简单描述下招领的物品特征……" rows="3"></textarea>
            </div>
        </div>
        <div class="weui-cell div_hidden" name="card">
            <div class="weui-cell__hd">
                <label class="weui-label ">卡号</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="number" name="CardNO" id="Card_NO" value="" placeholder="填写卡片的卡号……">
            </div>
        </div>
        <div class="weui-cell div_hidden" name="card">
            <div class="weui-cell__hd">
                <label class="weui-label">姓名</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="CardNAME" id="Card_NAME" value="" placeholder="填写卡面的姓名……">
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">捡到地点</label>
            </div>
            <div class="weui-cell__bd">
                <input name="RessP" id="Res_P" class="weui-input" type="text" value="" placeholder="填写捡到物品的地点……">
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label  class="weui-label">上传图片</label>
            </div>
            <div class="weui-cell__bd img_btn" id="camera_btn">
                <img src="../Public/Images/icon_camera.png" alt="上传图片">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label  class="weui-label">图片预览</label>
            </div>
            <div class="weui-cell__bd img_btn" id="show">
                <img src="" id="showpic" style="height: 100px;">
            </div>
        </div>
        <p id="imgid"></p>
        <div class="weui-btn-area" id="submit">
            <a class="weui-btn weui-btn_primary" >发布</a>
        </div>
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
      "chooseImage",
      "previewImage",
      "uploadImage",
      "downloadImage"
    ]
  });
    wx.error(function(res){
        alert(res.errMsg);
    });

  //创建数组存储上传图片的localIds/serverId
    var imagesID= new Array();
  wx.ready(function () {
    // 在这里调用 API
    document.getElementById("camera_btn").onclick=function(){
      //选择编辑图片接口
      wx.chooseImage({
        count: 1, // 默认9
        sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
        sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
        success: function (res) {
            imagesID['localIds'] = res.localIds.toString(); // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
            document.getElementById('showpic').src = imagesID['localIds'];   //图片显示
            //必须做一下mediaId的设定，否则将会无法在安卓端得到微信上传功能的触发
        }
     });
    }
      //预览图片
    document.getElementById("showpic").onclick=function(){
        wx.previewImage({
            current: '', // 当前显示图片的http链接
            urls: [imagesID['localIds']] // 需要预览的图片http链接列表
        });
    }

    //动态切不同类型物品的信息填写模块
    $("#Res_Class").change(function(){
        if ($("#Res_Class").val().replace(/ /g, '') == "1001") {
            $("div[name='card']").toggleClass("div_hidden");
            $("div[name='desc']").toggleClass("div_hidden");
        }else{
            $("div[name='card']").addClass("div_hidden");
            $("div[name='desc']").removeClass("div_hidden");

            // $("div[name='card']").class("div_hidden");
            // $("div[name='desc']").toggleClass("div_hidden");
        }
        // $(this).css("background-color","#FFFFCC");
    });

    //提交处理
    document.getElementById("submit").onclick=function(){
        //填写内容的合法性检测
        if ($("#Res_Class").val().replace(/ /g, '') == "0000") {
            alert("请选择物品类型！");
            $("#Res_Class").focus();
            return false;
        }else{
            if ($("#Res_Class").val().replace(/ /g, '') == "1001"){
                if($("#Card_NO").val().replace(/ /g, '') == ""){
                    alert("请填写卡号！");
                    $("#Card_NO").focus();
                    return false;
                }
                if($("#Card_NAME").val().replace(/ /g, '') == ""){
                    alert("请填写卡片面上的姓名，如若求知请填“不详”！");
                    $("#Card_NAME").focus();
                    return false;
                }
            }else{
                if($("#Res_DESC").val().replace(/ /g, '') == "") {
                    alert("请简单地描述下发布的物品特征！");
                    $("#Res_DESC").focus();
                    return false;
                }
            }
               if ($("#Res_P").val().replace(/ /g, '') == "") {
                alert("请填写捡到物品的地点！");
                $("#Res_P").focus();
                return false;
            }
        }



       //上传图片接口
        wx.uploadImage({
            localId: imagesID['localIds'], // 需要上传的图片的本地ID，由chooseImage接口获得
            isShowProgressTips: 1, // 默认为1，显示进度提示
            success: function (res) {
              imagesID['serverId'] = res.serverId.toString(); // 返回图片的服务器端ID
              // document.getElementById("imgid").innerHTML=imagesID['serverId'];
              $.ajax({
                type: "POST",
                url: "upload.php",
                dataType: "json",
                data:{
                    "Res_Class":$("#Res_Class").val().replace(/ /g, ''),
                    "Res_DESC":$("#Res_DESC").val(),
                    "Card_NO":$("#Card_NO").val().replace(/ /g, ''),
                    "Card_NAME":$("#Card_NAME").val().replace(/ /g, ''),
                    "Res_P":$("#Res_P").val().replace(/ /g, ''),
                    "serverId":imagesID['serverId'],
                    "access_token":'<?php echo "$access_token"; ?>',
                },
                success: function(json) {
                    if (json.success == 1) {
                    alert(json.msg);
                    window.location.href="Announce_index.php?action=Announc";
                    }
                    else{
                      alert(json.msg);
                      return false;
                    }
                }
                });
           },
           fail:function(res){
            alert("请选择图片！");
           }
        });
    }
  });

</script>
</html>