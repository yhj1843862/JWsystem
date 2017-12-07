<?php if (!defined('THINK_PATH')) exit();?><script src="../../../../static/ui/ui.admin/js/H-ui.admin.js"></script>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="stylesheet" type="text/css" href="/20171127/static/ui/ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/20171127/static/ui/ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/20171127/static/ui/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/20171127/static/ui/ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/20171127/static/ui/ui.admin/css/style.css"/>

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
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th>编号</th>
                <th>学科名称</th>
                <th>任课教师</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
                    <td><?php echo ($v["subject_number"]); ?></td>
                    <td><a href=""><?php echo ($v["subject_name"]); ?></a></td>
                    <td>
                        <?php if(empty($v['number'])): ?><a onClick="openPage(this)"
                               data-href="<?php echo U('Home/Class/set_teacher',['sid'=>$v['subject_id'],'cid'=>$v['class_id']]);?>"
                               href="javascript:;" title="添加任课教师 （ <?php echo ($v["subject_name"]); ?> )" data-height="300">
                                <i class="Hui-iconfont Hui-iconfont-user-add"></i>
                            </a>
                            <?php else: ?>
                            <?php echo ($v["nickname"]); ?>（ <?php echo ($v["mobile"]); ?> ）<?php endif; ?>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <?php echo ($data["page"]); ?>
    </div>
</div>
<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui.admin/js/H-ui.admin.js"></script>

</body>
</html>