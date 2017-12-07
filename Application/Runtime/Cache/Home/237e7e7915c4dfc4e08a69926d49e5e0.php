<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="stylesheet" type="text/css" href="/static/ui/ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/static/ui/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/css/style.css"/>

    <title><?php echo ($page_title); ?></title>
    <meta name="keywords" content="网站后台管理系统">
    <meta name="description" content="轻量级扁平化网站后台管理系统，适合中小型CMS后台系统。">
</head>
<style>
    a {
        text-decoration: none;
    }
</style>
<body>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-primary" data-height="300" title="添加学情信息" data-href="<?php echo U('add_user');?>"
               onclick="openPage(this)" href="javascript:;">
                <i class="Hui-iconfont Hui-iconfont-add"></i> 值班学情
            </a>

            <a class="btn btn-danger" title="添加违纪信息" data-width="1200" data-href="<?php echo U('Home/Disorder/add_student');?>"
               onclick="openPage(this)" href="javascript:;">
                <i class="Hui-iconfont Hui-iconfont-add"></i> 违纪情况
            </a>

            <a class="btn btn-warning" data-height="300" title="添加学生问题" data-href="<?php echo U('add_user');?>"
               onclick="openPage(this)" href="javascript:;">
                <i class="Hui-iconfont Hui-iconfont-add"></i> 学生问题
            </a>
        </span>
        <span class="r">
            <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
               href="javascript:location.replace(location.href);" title="刷新">
                <i class="Hui-iconfont Hui-iconfont-huanyipi"></i>
            </a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th>值班日期</th>
                <th>值班人员编号</th>
                <th>姓名</th>
                <th>手机号</th>
                <th>邮箱</th>
                <th>调班</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($plan)): foreach($plan as $k=>$v): ?><tr class="text-c">
                    <td><?php echo ($k); ?></td>
                    <td><?php echo ($v["number"]); ?></td>
                    <td><a><?php echo ($v["nickname"]); ?></a></td>
                    <td><?php echo ($v["mobile"]); ?></td>
                    <td><?php echo ($v["email"]); ?></td>
                    <td>
                        <?php if($v['id_card'] == $user_info['id_card']): ?><a onClick="openPage(this)" data-href="<?php echo U('change_duty',['d'=>$k]);?>" href="javascript:;"
                               title="调班（<?php echo ($k); ?>）">调班</a><?php endif; ?>
                    </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <?php echo ($data["page"]); ?>
    </div>
</div>
<script type="text/javascript" src="/static/ui/lib/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/ui/ui.admin/js/H-ui.admin.js"></script>

</body>
</html>