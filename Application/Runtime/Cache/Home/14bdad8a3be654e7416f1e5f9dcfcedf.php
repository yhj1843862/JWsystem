<?php if (!defined('THINK_PATH')) exit();?><head>
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
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-primary" title="添加顶级地区" data-href="<?php echo U('Home/Area/add');?>" onclick="openPage(this)"
               href="javascript:;">
                <i class="Hui-iconfont Hui-iconfont-add"></i> 添加顶级地区
            </a>
            <?php if($pid): ?><a class="btn btn-warning" href="javascript:window.history.go(-1);">
                <i class="Hui-iconfont Hui-iconfont-chexiao"></i> 返回
            </a><?php endif; ?>
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
                <th>ID</th>
                <th>地区名称</th>
                <th>添加下级地区</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
                    <td><?php echo ($v["area_id"]); ?></td>
                    <td><a href="<?php echo U('Home/Area/area_list',['pid'=>$v['area_id']]);?>"><?php echo ($v["area_name"]); ?></a></td>
                    <td class="f-14 td-manage">
                        <a onClick="openPage(this)" data-href="<?php echo U('Home/Area/add',['id'=>$v['area_id']]);?>"
                           href="javascript:;" title="添加下级地区">
                            <i class="Hui-iconfont Hui-iconfont-add"></i>
                        </a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui.admin/js/H-ui.admin.js"></script>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/20171127/static/ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/laypage/1.2/laypage.js"></script>
</body>
</html>