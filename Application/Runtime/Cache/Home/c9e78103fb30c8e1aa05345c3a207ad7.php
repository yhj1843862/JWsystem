<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="stylesheet" type="text/css" href="/static/ui/ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/static/ui/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/static/ui/ui.admin/css/style.css"/>

    <title><?php echo ($page_title); ?></title>
    <meta name="keywords" content="网站后台管理系统">
    <meta name="description" content="轻量级扁平化网站后台管理系统，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-member-add">

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">
                <span class="c-red">*</span>搜索用户：
            </label>
            <div class="formControls col-xs-4 col-sm-7">
                <input type="text" placeholder="请输入用户姓名" class="input-text" id="name">
            </div>
        </div>

        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
                <thead>
                <tr class="text-c">
                    <th>编号</th>
                    <th>姓名</th>
                    <th>邮箱</th>
                    <th>手机号</th>
                    <th>班级</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="list"></tbody>
            </table>
            <?php echo ($page); ?>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">
                <span class="c-red">*</span>违纪人员列表：
            </label>
            <div class="formControls col-xs-4 col-sm-7" id="ls">

            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-6 col-sm-6 col-xs-offset-4 col-sm-offset-3">
                <button id="subBtn" class="btn btn-primary noradius" type="button">&nbsp;&nbsp;添加违纪人员&nbsp;&nbsp;</button>
            </div>
        </div>

    </form>
</article>

<script type="text/javascript" src="/static/ui/lib/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/ui/ui.admin/js/H-ui.admin.js"></script>

<script>
    var users = [];
    var did = '<?php echo ($did); ?>'
    $(function () {
        /**
         * 搜索用户
         */
        $('#name').keyup(function () {
            var i = $(this);
            var name = i.val();
            $.post('<?php echo U("Home/User/ajax_student_list");?>',{name:name},function (e) {
                var ls = e.list;
                if(ls.length)
                {
                    var str = '';
                    for (var j in ls)
                    {
                        var tmp = ls[j];
                        str += '<tr class="text-c">' +
                            '<td>'+tmp.number+'</td>' +
                            '<td>'+tmp.nickname+'</td>' +
                            '<td>'+tmp.email+'</td>' +
                            '<td>'+tmp.mobile+'</td>' +
                            '<td>'+tmp.department_name+'/'+tmp.profession_name+'/'+tmp.class_name+'</td>' +
                            '<td class="c-red pointer" data-name="'+tmp.nickname+'" data-id="'+tmp.user_id+'">违纪</td>' +
                            '</tr>';
                    }
                    $('#list').html(str);
                }else{
                    $('#list').html('');
                }
            });
        });

        /**
         * 记录违纪人员
         */
        $(document).on('click','.pointer',function () {
            var i = $(this);
            var id = parseInt(i.attr('data-id'));
            var allow = 1;
            users.forEach(function (v,k,arr) {
                if(v == id){
                    errorAlert('该学生已被添加');
                    allow = 0;
                    return false;
                }
            });
            if(allow)
            {
                $('#ls').html($('#ls').html() + '<button type="button" class="btn btn-danger size-MINI noradius ml-5">'+i.attr('data-name')+'</button>');
                users.push(id);
            }
        });

        /**
         * 提交违纪人员
         */
        $('#subBtn').click(function () {

            $.post("",{did:did, users:users},function (e) {
                if(e.status)
                {
                    layer.confirm('是否继续添加违纪类型？', {
                        btn: ['继续','不了']
                    }, function(){
                        window.location.href = e.url;
                    }, function(){
                        window.parent.location.reload();
                    });

                }else {
                    errorAlert(e.info);
                }
            });
        });


    })

</script>
</body>
</html>