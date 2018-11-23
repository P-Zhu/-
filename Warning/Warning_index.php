<?php
/**
 *
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-11 16:21:31
 * @version $Id$
 */
date_default_timezone_set('PRC');
session_start();
include "../config.php";
include '../Public/Lib/Lib.php';
islogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../Public/Images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="../Public/Images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新消息</title>
    <link rel="stylesheet" href="../Public/Css/weui.min.css"/>
    <link rel="stylesheet" href="../Public/Css/style.css">
    <link rel="stylesheet" href="../Public/Css/btn.css">
    <link rel="stylesheet" href="../Public/Css/jquery-weui.css">
	</head>

<body>
    <div class="page__hd">
        <?php Print_Html("Header_Html")?>
    </div>
    <div>
        <div class="container">
        </div>
        <!-- 弹出物品详情页-->
        <script type="text/javascript" src="../Public/Js/warning.js"></script>
        <div id="full" class="weui-popup__container">
            <div class="weui-popup__overlay"></div>
            <div class="weui-popup__modal">
                <!-- 从数据库查询 记录ID 的详细信息，填充详情表格 -->
                <div class="details__bd">
                    <div class="bd__header">
                        <p id="D_hd">您已成功提交认领申请：</p>
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
                    <span class="weui-btn weui-btn_primary close-popup opt" status_id="3" style="display: none;">已领</span>
                    <span class="weui-btn weui-btn_primary close-popup opt" status_id="2" style="display: none;">已被领</span>
                    <span class="weui-btn weui-btn_primary close-popup opt" status_id="1" style="display: none;">撤消</span>
                    <span class="weui-btn weui-btn_primary close-popup" onclick="checkNewWarning();">关闭</span>
                </div>
            </div>
        </div>
        <script src="../Public/Js/jquery-2.1.4.js"></script>
        <script src="../Public/Js/fastclick.js"></script>
        <script>
        $(function() {
            FastClick.attach(document.body);
        });
        </script>
    </div>
    <?php Print_Html("Tabbar_Html")?>
</body>
<script type="text/javascript" src="Warning.js"></script>
        <script src="../Public/Js/jquery-weui.js"></script>

</html>