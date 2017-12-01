<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" type="text/css" href="/20171127//static/ui/ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/20171127//static/ui/ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/20171127//static/ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/20171127//static/ui/ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/20171127//static/ui/ui.admin/css/style.css" />
    
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
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 辅导员：</label>
            <div class="formControls col-xs-3 col-sm-3">
                <span class="select-box">
                    <select class="select" size="1" id="role">
                        <option value="0" selected>请选择角色</option>
                        <?php if(is_array($role_list)): $i = 0; $__LIST__ = $role_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["role_id"]); ?>"><?php echo ($v["role_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
				</span>
            </div>
            <div class="formControls col-xs-3 col-sm-3">
                <span class="select-box">
                    <select class="select" size="1" id="manager">
                        <option value="0" selected id="choose">请选择辅导员</option>
                    </select>
				</span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 入学/毕业时间：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" onfocus="WdatePicker({ readOnly:true, maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-{%M+2}-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
                -
                <input type="text" onfocus="WdatePicker({ readOnly:true, minDate:'#F{ $dp.$D(\'logmin\')}',maxDate:'{%y+4}-{%M+2}-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-6 col-sm-6 col-xs-offset-4 col-sm-offset-3">
                <button id="subBtn" class="btn btn-primary noradius" type="button">&nbsp;&nbsp;添加&nbsp;&nbsp;</button>
            </div>
        </div>

    </form>
</article>

<script type="text/javascript" src="/20171127//static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171127//static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171127//static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171127//static/ui/ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/static/ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script>
    $(function () {

        $('#role').change(function () {
            var role = $(this).val();
            $.post("<?php echo U('Home/User/ajax_user_list');?>", {role:role}, function (e) {
                var d = e.list;
                if (d.length)
                {
                    var  str = '';
                    for (var i in d)
                    {
                        var f = d[i];
                        str += '<option value="'+f.user_id+'">'+ f.nickname + "("+ f.mobile +")" +'</option>';
                    }
                    $('#choose').nextAll().remove();
                    $('#manager').html($('#manager').html() + str);
                }else {
                    errorAlert('该角色下暂无用户');
                }
            })
        });



        var profession_id = "<?php echo ($profession_id); ?>";

        $('#subBtn').click(function () {
            var number = $('#number').val();
            var name = $('#name').val();
            var logmin = $('#logmin').val();
            var logmax = $('#logmax').val();
            var uid = $('#manager').val();
            $.post('', {n:number, name: name,logmin:logmin,logmax:logmax,uid:uid,pid:profession_id}, function (e) {
                if(e.status)
                {
                    successAlert(e.info);
                    window.parent.location.reload();
                }else {
                    errorAlert(e.info);
                }
            })

        });
    })
</script>
</body>
</html>