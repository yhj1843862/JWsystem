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
    <div class="cl pd-5 bg-1 bk-gray mt-20">
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
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th>编号</th>
                <th>名称</th>
                <th>入学时间</th>
                <th>毕业时间</th>
                <th>班级人数</th>
                <th>辅导员</th>
                <th>班级人员管理</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><?php echo ($v["class_number"]); ?></td>
                <td><a href="<?php echo U('');?>"><?php echo ($v["class_name"]); ?></a></td>
                <td><?php echo ($v["start_time"]); ?></td>
                <td><?php echo ($v["end_time"]); ?></td>
                <td><?php echo ($v["student_num"]); ?></td>
                <td><?php echo ($v["nickname"]); ?> ( <?php echo ($v["mobile"]); ?> )</td>
                <td>
                    <a onClick="openPage(this)" data-width="1200" data-height="500" data-href="<?php echo U('Home/Class/class_student_list',['id'=>$v['class_id']]);?>" href="javascript:;" title="学生列表 （<?php echo ($v["class_name"]); ?>）">
                    <i class="Hui-iconfont Hui-iconfont-list"></i>
                    </a>
                    <a onClick="openPage(this)" data-width="1200" data-height="600" data-href="<?php echo U('Home/User/import_student',['id'=>$v['class_id']]);?>" href="javascript:;" title="导入学生信息 （<?php echo ($v["class_name"]); ?>）">
                        <i class="Hui-iconfont Hui-iconfont-daoru"></i>
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