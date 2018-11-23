<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxd49986376d059bcd", "906bdc18e09dcf2b56488f23dd3c67a4");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <meta charset="UTF-8">
  <title>失物招领</title>
</head>
  <body>
  <center><h3>欢迎来到微信jsapi测试界面-V型知识库</h3></center>
     <p>基础接口之判断当前客户端是否支持指定的js接口</p>
     <input type="button" value="checkJSAPI" id="checkJsApi"><br>
      <h3 id="menu-image">图像接口</h3>
      <span class="desc">拍照或从手机相册中选图接口</span><br>
      <button class="btn btn_primary" id="chooseImage">chooseImage</button><br>
      <span class="desc">预览图片接口</span><br>
      <button class="btn btn_primary" id="previewImage">previewImage</button><br>
      <span class="desc">上传图片接口</span><br>
      <button class="btn btn_primary" id="uploadImage">uploadImage</button><br>
      <span class="desc">下载图片接口</span><br>
      <button class="btn btn_primary" id="downloadImage">downloadImage</button><br>
  显示图片<imgalt=""src=""id="faceImg"data-bd-imgshare-binded="1">
  <br>
  <script type="text/javascript">
  wx.config({
    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '${appId}', // 必填，公众号的唯一标识
    timestamp: '${ timestamp}' , // 必填，生成签名的时间戳
    nonceStr: '${ nonceStr}', // 必填，生成签名的随机串
    signature: '${ signature}',// 必填，签名，见附录1
    jsApiList: ['checkJsApi',
                'chooseImage',
                'previewImage',
                 'uploadImage',
                 'downloadImage'
               ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});
wx.ready(function(){
    // 5 图片接口
  // 5.1 拍照、本地选图
  var images = {
    localId: [],
    serverId: []
  };
  document.querySelector('#chooseImage').onclick = function () {
    wx.chooseImage({
      success: function (res) {
        images.localId = res.localIds;
        alert('已选择 ' + res.localIds.length + ' 张图片');
$("#faceImg").attr("src", res.localIds[0]);//显示图片到页面上
      }
    });
  };
  // 5.2 图片预览
  document.querySelector('#previewImage').onclick = function () {
    wx.previewImage({
      current: 'http://www.vxzsk.com/upload//bf04c9b5-5699-421d-900e-3b68bbe58a8920160816.jpg',
      urls: [
        'http://www.vxzsk.com/upload//bf04c9b5-5699-421d-900e-3b68bbe58a8920160816.jpg',
        'http://www.vxzsk.com/upload//bf04c9b5-5699-421d-900e-3b68bbe58a8920160816.jpg',
        'http://www.vxzsk.com/upload//bf04c9b5-5699-421d-900e-3b68bbe58a8920160816.jpg'
      ]
    });
  };
  // 5.3 上传图片
  document.querySelector('#uploadImage').onclick = function () {
    if (images.localId.length == 0) {
      alert('请先使用 chooseImage 接口选择图片');
      return;
    }
    var i = 0, length = images.localId.length;
    images.serverId = [];
    function upload() {
      wx.uploadImage({
        localId: images.localId[i],
        success: function (res) {
          i++;
          //alert('已上传：' + i + '/' + length);
          images.serverId.push(res.serverId);
          if (i < length) {
            upload();
          }
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
    }
    upload();
  };
  // 5.4 下载图片
  document.querySelector('#downloadImage').onclick = function () {
    if (images.serverId.length === 0) {
      alert('请先使用 uploadImage 上传图片');
      return;
    }
    var i = 0, length = images.serverId.length;
    images.localId = [];
    function download() {
      wx.downloadImage({
        serverId: images.serverId[i],
        success: function (res) {
          i++;
          alert('已下载：' + i + '/' + length);
          images.localId.push(res.localId);
          if (i < length) {
            download();
          }
        }
      });
    }
    download();
  };
});
 //初始化jsapi接口 状态
wx.error(function (res) {
  alert("调用微信jsapi返回的状态:"+res.errMsg);
});
 </script>
  </body>
</html>