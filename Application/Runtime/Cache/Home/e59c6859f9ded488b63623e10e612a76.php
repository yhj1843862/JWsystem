<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/static/ui/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/static/ui/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/static/ui/ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/static/ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/static/ui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title><?php echo ($page_title); ?></title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-member-add">

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">
                <span class="c-red">*</span>违纪类型：
            </label>
            <div class="formControls col-xs-4 col-sm-7">
                <input type="text" placeholder="请输入违纪类型" class="input-text" id="name">
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-6 col-sm-6 col-xs-offset-4 col-sm-offset-3">
                <button id="subBtn" class="btn btn-primary noradius" type="button">&nbsp;&nbsp;添加违纪类型&nbsp;&nbsp;</button>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-6 col-sm-6 col-xs-offset-4 col-sm-offset-3" id="types">
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><button class="btn btn-danger size-S noradius mr-5" type="button"><?php echo ($v["type_name"]); ?></button><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>


    </form>
</article>

<script type="text/javascript" src="/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/ui/ui.admin/js/H-ui.admin.js"></script>
<script>
    var did = '<?php echo ($did); ?>';
    $(function () {

        $('#subBtn').click(function () {

            var name = $('#name').val();
            if(name.length < 2)
            {
                errorAlert('违纪类型内容过短');
                return ;
            }
            $.post('<?php echo U("add_disorder_type");?>', {name:name, did:did}, function (e) {
                if(e.status)
                {
                    $('#types').append('<button class="btn btn-danger size-S noradius mr-5" type="button">'+name+'</button>');
                    layer.confirm('类型添加成功，是否继续添加？', {
                        btn: ['继续','不了']
                    }, function(index){
                        $('#name').val('').focus();
                        layer.close(index);
                    }, function(){
                        window.parent.location.reload();
                    });
                }else{
                    errorAlert(e.info);
                }
            });

        });

        //双击已经添加过的违纪类型可以达到删除危机类型的目的
    })

</script>
</body>
</html>