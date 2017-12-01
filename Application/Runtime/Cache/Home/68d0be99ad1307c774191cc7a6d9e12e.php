<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" type="text/css" href="/20171127//static/ui/ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/20171127//static/ui/ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/20171127//static/ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/20171127//static/ui/ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/20171127//static/ui/ui.admin/css/style.css" />
    
    <title><?php echo ($page_title); ?></title>
    <meta name="keywords" content="网站后台管理系统">
    <meta name="description" content="轻量级扁平化网站后台管理系统，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal" enctype="multipart/form-data" id="form-member-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">附件：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <span class="btn-upload form-group">
				<input class="input-text upload-url" type="text" name="uploadfile" readonly nullmsg="请添加附件！" style="width:400px">
				<a href="javascript:void(0);" class="btn btn-primary upload-btn">
                    <i class="Hui-iconfont">&#xe642;</i> 浏览文件
                </a>
				<input type="file" multiple name="xls" class="input-file">
				</span>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-4 col-sm-5 col-xs-offset-4 col-sm-offset-3">
                <input type="hidden" name="class_id" value="<?php echo ($class_id); ?>">
                <button id="subBtn" class="btn btn-primary noradius" type="submit">&nbsp;&nbsp;提交&nbsp;&nbsp;</button>
            </div>
        </div>

    </form>
</article>
<script type="text/javascript" src="/20171127//static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171127//static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171127//static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171127//static/ui/ui.admin/js/H-ui.admin.js"></script>
</body>
</html>