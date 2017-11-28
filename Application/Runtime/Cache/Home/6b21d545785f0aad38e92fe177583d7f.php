<?php if (!defined('THINK_PATH')) exit();?><head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" type="text/css" href="/20171127/static/ui/ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/20171127/static/ui/ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/20171127/static/ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/20171127/static/ui/ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/20171127/static/ui/ui.admin/css/style.css" />

    <title><?php echo ($page_title); ?></title>
    <meta name="keywords" content="网站后台管理系统">
    <meta name="description" content="轻量级扁平化网站后台管理系统，适合中小型CMS后台系统。">
</head>
<style>
    a{
        text-decoration:none;
    }
</style>
<body>
<div class="page-container">
    <?php if(empty($from)): ?><div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <?php if($did): ?><a class="btn btn-warning" href="javascript:window.history.go(-1);">
                <i class="Hui-iconfont Hui-iconfont-chexiao"></i> 返回
            </a><?php endif; ?>
        </span>
        <span class="r">
            <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
                <i class="Hui-iconfont Hui-iconfont-huanyipi"></i>
            </a>
        </span>
    </div><?php endif; ?>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th>编号</th>
                <th>名称</th>
                <th>介绍</th>
                <th>所属院系</th>
                <th>添加班级</th>
                <th>班级列表</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><?php echo ($v["profession_number"]); ?></td>
                <td><a href="<?php echo U('');?>"><?php echo ($v["profession_name"]); ?></a></td>
                <td><?php echo ($v["profession_remark"]); ?></td>
                <td><a href="<?php echo U('',['id'=>$v['department_id'],'from'=>$from]);?>"><?php echo ($v["department_name"]); ?></a></td>
                <td>
                    <a onClick="openPage(this)" data-height="400" data-href="<?php echo U('Home/Class/add',['id'=>$v['profession_id']]);?>" href="javascript:;" title="添加班级（<?php echo ($v["department_name"]); ?>/<?php echo ($v["profession_name"]); ?>）">
                        <i class="Hui-iconfont Hui-iconfont-add"></i>
                    </a>
                </td>
                <td>
                    <a onClick="openPage(this)" data-width="1200" data-href="<?php echo U('Home/Class/class_list',['id'=>$v['profession_id']]);?>" href="javascript:;" title="班级列表（<?php echo ($v["department_name"]); ?>/<?php echo ($v["profession_name"]); ?>）">
                        <i class="Hui-iconfont Hui-iconfont-list"></i>
                    </a>
                </td>

            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <?php echo ($data["page"]); ?>
    </div>
</div>
<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui.admin/js/H-ui.admin.js"></script>
</body>
</html>