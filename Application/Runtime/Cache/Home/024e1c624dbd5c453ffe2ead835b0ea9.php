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
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-member-add">

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 任课教师：</label>
            <div class="formControls col-xs-3 col-sm-3">
                <span class="select-box">
                    <select class="select" size="1" id="teacher">
                        <option value="0" selected>请选择教师</option>
                        <?php if(is_array($teachers)): $i = 0; $__LIST__ = $teachers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["user_id"]); ?>"><?php echo ($v["nickname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
				</span>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-6 col-sm-6 col-xs-offset-4 col-sm-offset-3">
                <button id="subBtn" class="btn btn-primary noradius" type="button">&nbsp;&nbsp;添加&nbsp;&nbsp;</button>
            </div>
        </div>

    </form>
</article>

<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui.admin/js/H-ui.admin.js"></script>

<script type="text/javascript" src="/20171127/static/ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script>
    $(function () {

        var cid = "<?php echo ($class_id); ?>";
        var sid = "<?php echo ($subject_id); ?>";
        $('#subBtn').click(function () {
            var teacher = parseInt($('#teacher').val());
            if (teacher) {
                $.post('', {cid: cid, sid: sid, tid: teacher}, function (e) {
                    if (e.status) {
                        window.parent.location.reload();
                    } else {
                        errorAlert(e.info);
                    }
                });
            } else {
                errorAlert('请选择正确的教师');
            }


        });


    })
</script>
</body>
</html>