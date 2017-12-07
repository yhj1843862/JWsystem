<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/static/ui/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/static/ui/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/static/ui/ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/static/ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/static/ui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title><?php echo ($page_title); ?></title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<style>
    a{
        text-decoration:none;
    }
</style>
<body>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-danger" title="添加违纪" data-href="<?php echo U('Home/Disorder/add_student');?>" onclick="openPage(this)" href="javascript:;">
                <i class="Hui-iconfont Hui-iconfont-add"></i> 添加违纪
            </a>
            <?php if(!empty($start) || !empty($end)): ?><a class="btn btn-warning" href="<?php echo U('Home/Disorder/lists');?>">
                <i class="Hui-iconfont Hui-iconfont-chexiao"></i> 返回
            </a><?php endif; ?>
            <form method="get" action="" style="display: inline">
            <input type="text" onfocus="WdatePicker({ readOnly:true, maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-{%M+2}-%d\'}' })" id="logmin" value="<?php echo ($start); ?>" name="start" class="input-text Wdate" style="width:120px;">
                -
                <input type="text" onfocus="WdatePicker({ readOnly:true, minDate:'#F{ $dp.$D(\'logmin\')}',maxDate:'{%y+4}-{%M+2}-%d' })" id="logmax" value="<?php echo ($end); ?>" name="end" class="input-text Wdate" style="width:120px;">
                <button class="btn btn-primary noradius Hui-iconfont Hui-iconfont-search2" type="submit">搜索</button>
            </form>
        </span>
        <span class="r">
            <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
                <i class="Hui-iconfont Hui-iconfont-huanyipi"></i>
            </a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th>编号</th>
                <th class="text-l">违纪内容</th>
                <th>违纪时间</th>
                <th>违纪人员</th>
                <th>违纪类型</th>
                <th>添加违纪人员</th>
                <th>添加违纪类型</th>
                <th>添加附件</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><?php echo ($v["id"]); ?></td>
                <td class="text-l"><?php echo ($v["remark"]); ?></td>
                <td><?php echo ($v["disorder_time"]); ?></td>
                <td>
                    <?php if(is_array($v["users"])): $i = 0; $__LIST__ = $v["users"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="mr-5"><?php echo ($vo["nickname"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
                </td>
                <td>
                    <?php if(is_array($v["types"])): $i = 0; $__LIST__ = $v["types"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="mr-5"><?php echo ($vo["type_name"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
                </td>
                <td>
                    <a class="btn btn-secondary size-S" title="添加违纪信息" data-href="<?php echo U('Home/Disorder/add_student_2',['id'=>$v['id']]);?>" onclick="openPage(this)" href="javascript:;">
                    <i class="Hui-iconfont Hui-iconfont-add"></i>
                    </a>
                </td>
                <td>
                    <a class="btn btn-secondary size-S" title="添加违纪信息" data-href="<?php echo U('Home/Disorder/add_student_3',['id'=>$v['id']]);?>" onclick="openPage(this)" href="javascript:;">
                    <i class="Hui-iconfont Hui-iconfont-add"></i>
                    </a>
                </td>
                <td>
                    <a class="btn btn-secondary size-S" title="添加附件" data-href="<?php echo U('Home/Disorder/add_attachment',['id'=>$v['id']]);?>" onclick="openPage(this)" href="javascript:;">
                        <i class="Hui-iconfont Hui-iconfont-upload"></i>
                    </a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <?php echo ($data["page"]); ?>
    </div>
</div>
<script type="text/javascript" src="/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/ui/ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/static/ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
</body>
</html>