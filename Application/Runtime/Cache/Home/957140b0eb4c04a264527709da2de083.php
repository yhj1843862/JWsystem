<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
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
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-member-add">

        <div class="row cl">

            <label class="form-label col-xs-4 col-sm-3">
                <span class="c-red">*</span> 名称：
            </label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" id="name" >
            </div>
        </div>

        <div class="row cl">

            <label class="form-label col-xs-4 col-sm-3">
                <span class="c-red">*</span> 编号：
            </label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" id="number" >
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">专业介绍：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <textarea class="textarea" id="remark"  placeholder="专业的介绍...10-255个字符" onKeyUp="countStringLength(this,10,255)"></textarea>
                <p class="textarea-numberbar">
                    <em class="textarea-length">0</em>/255
                </p>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-4 col-sm-5 col-xs-offset-4 col-sm-offset-3">
                <button id="subBtn" class="btn btn-primary noradius" type="button">&nbsp;&nbsp;添加&nbsp;&nbsp;</button>
            </div>
        </div>

    </form>
</article>

<script type="text/javascript" src="/20171127/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171127/static/ui/ui.admin/js/H-ui.admin.js"></script>
<script>
    $(function () {
        var department_id = '<?php echo ($department_id); ?>';
        $('#subBtn').click(function () {
            var number = $('#number').val();
            var name = $('#name').val();
            var remark = $('#remark').val();
            if(remark.length > 255 || remark.length < 10)
            {
                errorAlert('专业介绍需要10-255个字符');
                return false;
            }
            $.post('', {n:number, name: name, r:remark, 'department_id':department_id}, function (e) {
                if(e.status)
                {
                    successAlert(e.info);
                    $('#number').val('');$('#name').val('');$('#remark').val('');
                }else {
                    errorAlert(e.info);
                }
            })

        });
    })
</script>
</body>
</html>