<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link href="/static/ui/ui/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/ui/ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css"/>
    <link href="/static/ui/ui.admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/static/ui/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css"/>

    <title>用户登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <style>
        .noradius {
            border-radius: 0px;
        }
    </style>
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value=""/>
<div class="header"></div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <form class="form form-horizontal" action="" method="post">
            <div class="row cl">
                <label class="form-label col-xs-3">
                    <i class="Hui-iconfont">&#xe60d;</i>
                </label>
                <div class="formControls col-xs-8">
                    <input type="text" name="string" placeholder="手机号/邮箱/编号/身份证号" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input type="password" name="password" placeholder="您的密码" class="input-text size-L">
                </div>
            </div>

            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="" type="submit" class="btn btn-success noradius size-L"
                           value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default noradius size-L"
                           value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="footer">Copyright KCJM</div>
<script type="text/javascript" src="/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/ui/ui/js/H-ui.min.js"></script>

</body>
</html>