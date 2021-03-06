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
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th>编号</th>
                <th>姓名</th>
                <th>邮箱</th>
                <th>手机号</th>
                <th>身份证号</th>
                <th>性别</th>
                <th width="100">地区</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($user_list)): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
                    <td><?php echo ($v["number"]); ?></td>
                    <td><a href="<?php echo U('Home/Area/area_list',['pid'=>$v['area_id']]);?>"><?php echo ($v["nickname"]); ?></a></td>
                    <td><?php echo ($v["email"]); ?></td>
                    <td><?php echo ($v["mobile"]); ?></td>
                    <td><?php echo ($v["id_card"]); ?></td>
                    <td>
                        <?php if($v['sex']): ?>男
                            <?php else: ?>
                            女<?php endif; ?>
                    </td>
                    <td data-id="<?php echo ($v["area"]); ?>" class="area"><span><i class="Hui-iconfont Hui-iconfont-home"></i></span>
                    </td>

                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <?php echo ($page); ?>
    </div>
</div>
<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui.admin/js/H-ui.admin.js"></script>

<script>
    $(function () {
        $('.area').mouseover(function () {
            var j = $(this);
            var id = j.attr('data-id');
            $.post('<?php echo U("Home/Area/ajax_path_info");?>', {id: id}, function (e) {
                var str = '';
                for (var i in e) {
                    str += e[i].area_name + '/';
                }
                str = str.substr(0, str.length - 1);
                //layer.tips(str, j.children());
                layer.tips(str, j.children(), {tips: [1, '#5a98de'], time: 10000});
            })
        });
    })
</script>
</body>
</html>