<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
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
    a{
        text-decoration:none;
    }
</style>
<body>
<div class="page-container">
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th>值班日期</th>
                <th>编号</th>
                <th>姓名</th>
                <th>手机号</th>
                <th>邮箱</th>
                <th>排序</th>
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
                <td><?php echo ($v["ranking"]); ?></td>
                <td class="pointer change" data-date="<?php echo ($k); ?>">
                    调一下
                </td>
            </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <?php echo ($data["page"]); ?>
    </div>
</div>
<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script>
    $(function () {
        var o = "<?php echo ($o); ?>";
        $('.change').click(function () {
            var i = $(this);
            var n = i.attr('data-date');
            $.post('', {old:o, n:n},function (e) {
                if(e.status)
                {
                    window.parent.location.reload();
                }else{
                    errorAlert(e.info);
                }
            })


        });
    })
</script>
</body>
</html>