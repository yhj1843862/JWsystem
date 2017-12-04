<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" type="text/css" href="/20171202/static/ui/ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/20171202/static/ui/ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/20171202/static/ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/20171202/static/ui/ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/20171202/static/ui/ui.admin/css/style.css" />
    
    <title><?php echo ($page_title); ?></title>
    <meta name="keywords" content="网站后台管理系统">
    <meta name="description" content="轻量级扁平化网站后台管理系统，适合中小型CMS后台系统。">
</head>
<body>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a data-href="<?php echo U('Home/User/add');?>" onclick="openPage(this)" title="添加用户" class="btn btn-primary">
                    <i class="Hui-iconfont Hui-iconfont-add"></i> 添加用户</a>

                <a data-href="<?php echo U('Home/User/add_student');?>" onclick="openPage(this)" title="添加学生" class="btn btn-success">
                    <i class="Hui-iconfont Hui-iconfont-add"></i> 添加学生</a>
                <?php if($pid): ?><a class="btn btn-warning" href="javascript:window.history.go(-1);">
                    <i class="Hui-iconfont Hui-iconfont-chexiao"></i> 返回
                </a><?php endif; ?>
            </span>

            <span class="r">
                <a href="" class="btn btn-success radius r" href="javascript:location.replace(location.href);" title="刷新">
                    <i class="Hui-iconfont Hui-iconfont-huanyipi"></i>
                </a>
            </span>
        </div>

        <!-- 列表内容 -->
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                    <tr class="text-c">
                        <th width="25">
                            <input type="checkbox" name="" value="">
                        </th>
                        <th width="80">ID</th>
                        <th width="80">编号</th>
                        <th width="100">姓名</th>
                        <th width="">邮箱</th>
                        <th width="90">手机</th>
                        <th width="150">身份证</th>
                        <th width="40">性别</th>
                        <th width="130">角色</th>
                         <th width="70">地区</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($user_list)): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
                            <th width="25"><input type="checkbox" name="" value=""></th>
                            <td><?php echo ($v["user_id"]); ?></td>
                            <td><?php echo ($v["number"]); ?></td>

                            <td><?php echo ($v["nickname"]); ?></td>
                            <td><?php echo ($v["email"]); ?></td>
                            <td><?php echo ($v["mobile"]); ?></td>
                            <td><?php echo ($v["id_card"]); ?></td>
                            <td class="text-c">
                                <?php if($v['sex']): ?>男 <?php else: ?>女<?php endif; ?>
                            </td>
                            <td><?php echo ($v["role_name"]); ?></td>
                            <td data-id="<?php echo ($v["area"]); ?>" class="area">
                                <span><?php echo ($v["area_name"]); ?></span>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <?php echo ($page); ?>
        </div>
    </div>
<script type="text/javascript" src="/20171202/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171202/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171202/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171202/static/ui/ui.admin/js/H-ui.admin.js"></script>
<script >

    $(function () {
        $('.area').mouseover(function () {
            var j = $(this);
            var id = j.attr('data-id');
            $.post('<?php echo U("Home/Area/ajax_path_info");?>',{id:id},function(e){
                console.log()
                var str = '';
                for (var i in e)
                {
                    str += e[i].area_name + '/';
                }
                //小提示
                str = str.substr(0,str.length-1);
                //layer.tips(str, j.children());
                layer.tips(str, j.children(), { tips: [1, '#5a98de'], time: 10000 });
            })
        });
    })

</script>
</body>
</html>