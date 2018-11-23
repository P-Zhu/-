
<?php
// *
// * @authors Zhu Peng (rieeqms@outlook.com)
// * @date    2017-05-11 11:05:05
// * @version $Id$
date_default_timezone_set('PRC');
session_start();
include "../config.php";
include "../Public/sdk/jssdk.php";
include "../Public/Lib/Lib.php";
islogin();

$jssdk = new JSSDK("$appid", "$appsecret");
$signPackage = $jssdk->getSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../Public/Images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="../Public/Images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/Css/weui.min.css"/>F
    <link rel="stylesheet" href="../Public/Css/style.css">
    <link rel="stylesheet" href="../Public/Css/btn.css">
    <link rel="stylesheet" href="../Public/Css/jquery-weui.css">

    <script type="text/javascript" src="../Public/Js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="../Public/Js/getlist.js"></script>

    <title>公告查询</title>

</head>
<body>
  <div class="page__hd">
    <?php Print_Html("Header_Html");?>
  </div>

  <div class="page__bd">
    <div class="bd__header">
        <h3>公告查询</h3>
      <div class="tips"><p>单击列表的标题栏可进行筛选</p></div>
  </div>
    <div class="weui-cells weui-cell-notice-list">
        <div class="weui-cell weui-cell_access item_hd weui-cell-notice-list-btn open-popup" data-target="#filter" id="show_filter">
            <div class="weui-cell__bd item_hd1" style="margin-left: -25px">
                <div><img src="/Public/Images/icon_search.png" width="20px" style="margin-right:20px"></div>
                <p>类型</p>
            </div>
            <div class="weui-cell__bd item_hd1">
                <p>时间</p>
            </div>
            <div class="weui-cell__bd item_hd2">
                <p>描述</p>
            </div>
        </div>
        <div class="item_bd" id="list_bd"> </div>
    </div>
      <!-- 弹出物品详情页-->
    <div id="full" class="weui-popup__container">
      <div class="weui-popup__overlay"></div>
      <div class="weui-popup__modal">
   <!-- 从数据库查询 记录ID 的详细信息，填充详情表格 -->
          <div class="details__bd">
              <div class="bd__header">
                  <h3>物品详情</h3>
              </div>
              <div class="weui-cells weui-cells_form">
                  <div class="weui-cell">
                      <div class="weui-cell__hd">
                          <label for="" class="weui-label">类型</label>
                      </div>
                      <div class="weui-cell__bd">
                           <span class="weui-form-preview__value" id="Res_Class"></span>
                      </div>
                  </div>
                  <div class="weui-cell">
                      <div class="weui-cell__hd">
                          <label for="" class="weui-label">发布时间</label>
                      </div>
                      <div class="weui-cell__bd">
                           <span class="weui-form-preview__value" id="Res_RDT"></span>
                      </div>
                  </div>
                  <div class="weui-cell">
                      <div class="weui-cell__hd">
                          <label for="" class="weui-label">描述</label>
                      </div>
                      <div class="weui-cell__bd">
                           <span class="weui-form-preview__value" id="Res_DESC"></span>
                      </div>
                  </div>
                  <div class="weui-cell">
                      <div class="weui-cell__hd">
                          <label for="" class="weui-label">捡到地点</label>
                      </div>
                      <div class="weui-cell__bd">
                           <span class="weui-form-preview__value" id="Res_P"></span>
                      </div>
                  </div>
                  <div class="weui-cell">
                      <div class="weui-cell__hd">
                          <label for="" class="weui-label">图片</label>
                      </div>
                      <div class="weui-cell__bd">
                          <img src=""  class="weui-form-preview__value pic_details" id="Res_PIC">
                     </div>
                  </div>
                  <div class="weui-cell">
                      <div class="weui-cell__hd">
                          <label for="" class="weui-label">状态</label>
                      </div>
                      <div class="weui-cell__bd">
                           <span class="weui-form-preview__value" id="Res_STATUS"></span>
                      </div>
                  </div>
              </div>
              <span class="weui-btn weui-btn_primary" id="Res_rl">认领</span>
              <span class="weui-btn weui-btn_primary close-popup" >关闭</span>
              <script type="text/javascript" src="../Public/Js/warning.js"></script>
          </div>
      </div>
    </div>
    <div id="rl_success" class="weui-popup__container">
      <div class="weui-popup__overlay"></div>
      <div class="weui-popup__modal">
   <!-- 从数据库查询 记录ID 的详细信息，填充详情表格 -->
          <div class="details__bd">
              <div class="bd__header">
                  <h3>联系方式</h3>
              </div>
              <div class="weui-cell">
                  <div class="weui-cell__hd">
                      <label class="weui-label">发布者电话：</label>
                  </div>
                  <div class="weui-cell__bd">
                      <span id="ANN_TEL"></span>
                  </div>
              </div>
              <div class="ann_content">
              <span>请联系发布人，取回您的物品！</span>
                <span class="weui-btn weui-btn_primary close-popup ann_btn" id="Closs_popup">关闭</span>

              </div>
          </div>
      </div>
    </div>
    <!-- 弹出筛选页-->
    <div id="filter" class="weui-popup__container">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <div class="details__bd">
                <div class="bd__header">
                    <h3>查询条件</h3>
                </div>
                <!-- 从数据库查询物品分类数据 -->
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__hd">
                            <label for="" class="weui-label">类型</label>
                        </div>
                        <div class="weui-cell__bd">
                            <select class="weui-select filter" id="filter_Class" name="ResClass">
                                  <option value="0000">请选择</option>
                            </select>
                        </div>
                    </div>
                    <div class="weui-cell">
                      <div class="weui-cell__hd">
                          <label for="" class="weui-label">开始日期</label>
                      </div>
                      <div class="weui-cell__bd">
                          <input name="StartDATE" id="Start_DATE" class="weui-input filter" type="date" value="" >
                      </div>
                    </div>
                    <div class="weui-cell">
                      <div class="weui-cell__hd">
                          <label for="" class="weui-label">截止日期</label>
                      </div>
                      <div class="weui-cell__bd">
                          <input name="EndtDATE" id="End_DATE" class="weui-input filter" type="date" value="">
                      </div>
                    </div>
                    <div class="weui-btn-area" id="submit">
                        <a class="weui-btn weui-btn_primary close-popup" id="filter_btn">查询</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
    <?php Print_Html("Tabbar_Html");?>
</body>
<script src="../Public/Js/jquery-2.1.4.js"></script>
<script src="../Public/Js/jquery-weui.js"></script>
<script src="../Public/Js/fastclick.js"></script>
<script>
    // alert("单击列表的标题栏可进行筛选");
    function str_desc(str) {
      var st = str.split("&")[0].substring(0,6)+'*';
      if(typeof(str.split("&")[1])!="undefined"){
        st+='<br/>'+str.split("&")[1];
      }
      return st;
    }


    $(function() {
        FastClick.attach(document.body);
    });
    $.ajax({
      // replace(/&/g, '<br/>')
          type: "POST",
          url: "look.php?action=all",
          dataType: "json",
          data: {},
          success: function(json) {
              if (json.success == 1) {
              for(var i=0; i<json.length; i++){
                 $("#list_bd").append('<a onClick="handleEvent(this.id)" id='+json[i].ID +' class="weui-cell weui-cell_access item weui-cell-notice-list-item open-popup" data-target="#full" ><div class="weui-cell__bd item_hd1"><p>'+ json[i].CLASS+'</p></div><div class="weui-cell__bd item_hd1"><p>'+json[i].RDT.substr(0,10)+'</p></div><div class="weui-cell__bd item_hd2" ><p><p>'+str_desc(json[i].DESC)+'</p></div></a>');
                }
              }
          }
      });
// <!-- 获取触发事件对象的 Details -->
    function handleEvent(e){
        $("#Res_rl").hide();
        $.ajax({
          type: "POST",
          url: "look.php?action=details&id="+e,
          dataType: "json",
          data: {},
          success: function(json) {
              if (json.success == 1) {
                $("#Res_Class").html(json.CLASS);
                $("#Res_RDT").html(json.RDT);
                $("#Res_DESC").html(json.DESC.replace(/&/g, '<br/>'));
                $("#Res_P").html(json.P);
                $("#Res_PIC").attr('src',json.PIC);
                switch(json.STAUTS){
                  case '0': $("#Res_STATUS").html("待领");
                  break;
                  case '1': $("#Res_STATUS").html("认领中");
                  break;
                  case '2': $("#Res_STATUS").html("待确认");
                  break;
                  case '3': $("#Res_STATUS").html("已领");
                  break;
                }
                if(json.STAUTS==0){
                  $("#Res_rl").show();
                }
                $("#Res_rl").attr({'Res_ID':json.ID,'ANN_TEL':json.TEL});
                $("#Res_rl").attr('CP',json.CP);
              }
          }
      });
    }
    $('#Res_rl').on('click', function () {
        $.ajax({
          type: "POST",
          url: "look.php?action=Res_rl&id="+$("#Res_rl").attr('Res_ID')+"&CP="+$("#Res_rl").attr('CP'),
          dataType: "json",
          data: {},
          success: function(json) {
              if (json.success == 1) {
                alert(json.msg);
                //从列表页移除认领成功的项目
                $("a[id='"+json.id+"']").remove();
                $("#rl_success").attr('style','block');
                $("#rl_success").toggleClass('weui-popup__container--visible');
                $("#ANN_TEL").html($("#Res_rl").attr('ANN_TEL'));
                checkNewWarning();
              }else{
                alert(json.msg);
                return ;
              }
          }
      });
      AddNewWarning();
    });

   $("#close-popup").on('click',function () {
           $("#rl_success").toggleClass('weui-popup__container--visible');
    });

    $('#show_filter').on('click', function () {
        $.ajax({
          type: "POST",
          url: "../Public/Lib/getlist.php?action=filter&role=any",
          dataType: "json",
          data: {},
          success: function(json) {
              if (json.success == 1) {
                $("#filter_Class").html(json.list);
              }
          }
      });
    });
    $('#filter_btn').on('click', function () {
        $.ajax({
          type: "POST",
          url: "look.php?action=filter&role=any",
          dataType: "json",
          data: {
              "filter_Class": $("#filter_Class").val(),
              "Start_DATE": $("#Start_DATE").val(),
              "End_DATE": $("#End_DATE").val()+' 23:59:59'
          },
          success: function(json) {
              if (json.success == 1) {
              $("#list_bd").empty();
              if(json.length){
                for(var i=0; i<json.length; i++){
                   $("#list_bd").append('<a onClick="handleEvent(this.id)" id='+json[i].ID +' class="weui-cell weui-cell_access item weui-cell-notice-list-item open-popup" data-target="#full" ><div class="weui-cell__bd item_hd1"><p>'+ json[i].CLASS+'</p></div><div class="weui-cell__bd item_hd1"><p>'+json[i].RDT.substr(0,10)+'</p></div><div class="weui-cell__bd item_hd2" ><p><p>'+json[i].DESC.replace(/&/g, '<br/>')+'</p></div></a>');
                   }
                 }else{
                  $("#list_bd").append("没有找到相关信息");
                 }
             }
           }
      });
    });

    //初始化时间控件
    var now = new Date() ;

    var nowYear = now.getFullYear() ; //年
    var nowMonth = now.getMonth()+1<10?"0"+(now.getMonth()+1):now.getMonth() ; //月
    var nowDay = now.getDate()<10?"0"+now.getDate():now.getDate() ; //日期

    // var nowHour = now.getHours()<10?"0"+now.getHours():now.getHours() ; //时
    // var nowMinute = now.getMinutes()<10?"0"+now.getMinutes():now.getMinutes() ; //分

    var nowDate = nowYear+"-"+nowMonth+"-"+nowDay ;
    // var nowTime = nowHour+":"+nowMinute;

    $("#Start_DATE,#End_DATE").val(nowDate);
    // $("#nowTime").val(nowTime) ;
</script>


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
    wx.error(function(res){
        alert(res.errMsg);
    });

  //创建数组存储上传图片的localIds/serverId
    var imagesID= new Array();
  wx.ready(function () {
    // 在这里调用 API

      //预览图片
    document.getElementById("Res_PIC").onclick=function(){
        wx.previewImage({
            current: '', // 当前显示图片的http链接
            urls: [$("#Res_PIC").attr("src")] // 需要预览的图片http链接列表
        });
    }
  });

</script>
</html>
