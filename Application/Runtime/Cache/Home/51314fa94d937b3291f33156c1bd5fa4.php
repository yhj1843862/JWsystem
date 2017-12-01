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
                <span class="c-red">*</span>编号：
            </label>
            <div class="formControls col-xs-4 col-sm-5">
                <input type="text" class="input-text" id="number" >
            </div>
        </div>

        <div class="row cl">

            <label class="form-label col-xs-4 col-sm-3">
                <span class="c-red">*</span>昵称：
            </label>
            <div class="formControls col-xs-4 col-sm-5">
                <input type="text" class="input-text" id="nickname">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">
                <span class="c-red">*</span>手机号：
            </label>

            <div class="formControls col-xs-4 col-sm-5">
                <input type="text" class="input-text" id="mobile">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">
                <span class="c-red">*</span>身份证号：
            </label>

            <div class="formControls col-xs-4 col-sm-5">
                <input type="text" class="input-text" id="id_card">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">
                <span class="c-red">*</span>邮箱：
            </label>

            <div class="formControls col-xs-4 col-sm-5">
                <input type="text" class="input-text" id="email">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">角色：</label>
            <div class="formControls col-xs-4 col-sm-5">
                <span class="select-box">
                    <select class="select" id="role">
                        <option value="0" selected>请选择角色</option>
                        <?php if(is_array($role_list)): $i = 0; $__LIST__ = $role_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["role_id"]); ?>"><?php echo ($v["role_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
				</span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">籍贯：</label>
            <div class="formControls col-xs-1">
                <span class="select-box">
                    <select class="select area" size="1">
                        <option value="0" selected>请选择城市</option>
                        <?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["area_id"]); ?>"><?php echo ($v["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
				</span>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-4 col-sm-5 col-xs-offset-4 col-sm-offset-3">
                <button id="subBtn" class="btn btn-primary noradius" type="button">&nbsp;&nbsp;提交&nbsp;&nbsp;</button>
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
        //获取地区信息的处理
        get_area('area');

        $('#subBtn').click(function () {
            var role = parseInt($('#role').val());
            if(!role)
            {
                errorAlert('请选择正确的角色',2000);
                return false;
            }
            var areas = document.getElementsByClassName('area');
            var area = parseInt(areas[areas.length-1].value);
            if(area == 0)
            {
                errorAlert('请选择正确的地区',2000);
                return false;
            }
            var nickname = $('#nickname').val();
            var number = $('#number').val();
            var email = $('#email').val();
            var id_card = $('#id_card').val();
            var mobile = $('#mobile').val();

            $.post('',{nickname:nickname,email:email,id_card:id_card,mobile:mobile,role:role,area:area,number:number},function (e) {
                if(e.status)
                {
                    window.location.reload();
                }else {
                    errorAlert(e.info);
                }
            })


        });

    });

    function get_area(domId) {
        $(document).on('change','.'+domId,function(){
            var t = $(this);
            t.parent().parent().nextAll().remove();
            var id = parseInt(t.val());
            if(id == 0)
            {
                return false;
            }
            $.post('<?php echo U("Home/Area/ajax_area_list");?>',{pid:id},function (e) {
                if(e.length)
                {
                    var tmp = '<div class="formControls col-xs-2">' +
                        '                <span class="select-box">' +
                        '                    <select class="select area" size="1">' +
                        '                        <option value="0" selected>请选择地区</option>';
                    for (var i in e)
                    {
                        var j = e[i];
                        tmp += '<option value="'+j.area_id+'">'+j.area_name+'</option>';
                    }
                    tmp += '</select></span></div>';
                    t.parent().parent().after(tmp);
                }
            })

        });
    }
</script>
</body>
</html>