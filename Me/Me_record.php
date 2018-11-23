<?php
// *
// * @authors Zhu Peng (rieeqms@outlook.com)
// * @date    2017-05-11 11:05:05
// * @version $Id$
date_default_timezone_set('PRC');
session_start();
require_once "../config.php";
require_once "../Public/sdk/jssdk.php";

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
    <link rel="stylesheet" href="../Public/Css/weui.min.css" />
    <link rel="stylesheet" href="../Public/Css/style.css">
    <link rel="stylesheet" href="../Public/Css/btn.css">
    <link rel="stylesheet" href="../Public/Css/jquery-weui.css">
    <script type="text/javascript" src="../Public/Js/getlist.js"></script>
    <title>记录查询</title>
</head>

<body>
    <div class="record"  id="<?php echo $_GET['action']; ?>">
        <div class="bd__header">
            <h3>记录</h3>
        </div>
        <div class="weui-cells weui-cell-notice-list">
            <div class="weui-cell weui-cell_access item_hd weui-cell-notice-list-btn open-popup" data-target="#filter" id="show_filter">
                <div class="weui-cell__bd item_hd1">
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
            <div id="back" class="weui-btn_primary btn"> 返回 </div>
            <script type="text/javascript" src="./js/Me_nav.js"></script>
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
                                <img src="" class="weui-form-preview__value pic_details" id="Res_PIC">
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
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label for="" class="weui-label" id="PP"></label>
                            </div>
                            <div class="weui-cell__bd">
                                <span class="weui-form-preview__value" id="Res_PP"></span>
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label for="" class="weui-label">电话</label>
                            </div>
                            <div class="weui-cell__bd">
                                <span class="weui-form-preview__value" id="Res_TEL"></span>
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label for="" class="weui-label">认领时间</label>
                            </div>
                            <div class="weui-cell__bd">
                                <span class="weui-form-preview__value" id="Res_CT"></span>
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label for="" class="weui-label">完成时间</label>
                            </div>
                            <div class="weui-cell__bd">
                                <span class="weui-form-preview__value" id="Res_CDT"></span>
                            </div>
                        </div>
                    </div>
                    <span class="weui-btn weui-btn_primary close-popup">关闭</span>
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
                                <input name="StartDATE" id="Start_DATE" class="weui-input filter" type="date" value="">
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
                            <a class="weui-btn weui-btn_primary close-popup" id="filter_btn" role="ANN">查询</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="../Public/Js/jquery-2.1.4.js"></script>
<script type="text/javascript" src="../Public/Js/jquery-weui.js"></script>
<script type="text/javascript" src="../Public/Js/fastclick.js"></script>
<script type="text/javascript" src="../Public/Js/jweixin-1.2.0.js"></script>
<script type="text/javascript" src="./js/Me_record.js"></script>

</html>
