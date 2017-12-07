<?php if (!defined('THINK_PATH')) exit();?><html>
<script src="/20171127/static/ui/ui.admin/js/H-ui.admin.js"></script>

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
                <th>介绍</th>
                <th>选课</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c" data-id="<?php echo ($v["subject_id"]); ?>">
                    <td><?php echo ($v["subject_number"]); ?></td>
                    <td><a href=""><?php echo ($v["subject_name"]); ?></a></td>
                    <td><?php echo ($v["subject_remark"]); ?></td>
                    <?php if($v['selected']): if($v['necessary']): ?><td class="cancel c-warning pointer">必修</td>
                            <?php else: ?>
                            <td class="cancel c-primary pointer">选修</td><?php endif; ?>
                        <?php else: ?>
                        <td class="cancel"></td><?php endif; ?>
                    <td>
                        <button type="button" class="btn btn-primary size-MINI noradius elective">选修</button>
                        <button type="button" class="btn btn-warning size-MINI noradius necessary">必修</button>
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
<script>
    $(function () {
        var pid = "<?php echo ($pid); ?>";

        //添加选修操作
        $('.elective').click(function () {
            var i = $(this);
            var id = i.parent().parent().attr('data-id');
            $.post('', {id: id, pid: pid, type: 0}, function (e) {
                if (e.status) {
                    i.parent().prev().html('选修').removeClass('c-warning').addClass('c-primary pointer');
                    i.addClass('disabled');
                    i.next().addClass('disabled');
                } else {
                    errorAlert(e.info);
                }
            });

        });


        //添加必修的操作
        $('.necessary').click(function () {
            var i = $(this);
            var id = i.parent().parent().attr('data-id');
            $.post('', {id: id, pid: pid, type: 1}, function (e) {
                if (e.status) {
                    i.parent().prev().html('必修').removeClass('c-primary').addClass('c-warning pointer');
                    i.addClass('disabled');
                    i.prev().addClass('disabled');
                } else {
                    errorAlert(e.info);
                }
            });


        });

        $('.cancel').dblclick(function () {
            var i = $(this);
            layer.confirm('取消选课会删除掉本专业已添加的任课信息', {
                btn: ['确定', '取消'] //按钮
            }, function (index) {
                var id = i.parent().attr('data-id');
                $.post('<?php echo U("delete_subject");?>', {id: id, pid: pid}, function (e) {
                    if (e.status) {
                        i.html('');
                        i.next().children().removeClass('disabled');
                    } else {
                        errorAlert(e.info);
                    }
                });
                layer.close(index);
            });

        });


    })
</script>
</body>
</html>