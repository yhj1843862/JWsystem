<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
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
	<header class="navbar-wrapper">
		<div class="navbar navbar-fixed-top">
			<div class="container-fluid cl">
				<a class="logo navbar-logo f-l mr-10 hidden-xs" href="">教务管理系统</a>
				<span class="logo navbar-slogan f-l mr-10 hidden-xs">v0.1</span>
				<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
					<ul class="cl">
						<li><?php echo ($user_info["role_name"]); ?></li>
						<li class="dropDown dropDown_hover">
							<a href="#" class="dropDown_A"><?php echo ($user_info["nickname"]); ?>
								<i class="Hui-iconfont">&#xe6d5;</i>
							</a>
							<ul class="dropDown-menu menu radius box-shadow">
								<li>
									<a href="javascript:;" onClick="myselfinfo()">个人信息</a>
								</li>
								<li>
									<a href="<?php echo U('Home/Sign/logout');?>">退出</a>
								</li>
							</ul>
						</li>
						<li id="Hui-msg">
							<a href="#" title="消息">
								<span class="badge badge-danger">1</span>
								<i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i>
							</a>
						</li>
						<li id="Hui-skin" class="dropDown right dropDown_hover">
							<a href="javascript:;" class="dropDown_A" title="换肤">
								<i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i>
							</a>
							<ul class="dropDown-menu menu radius box-shadow">
								<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
								<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
								<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
								<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
								<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
								<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</header>

<!-- 左边栏 -->
	<aside class="Hui-aside">
		<div class="menu_dropdown bk_2">


			<dl id="menu-product">
				<dt>
					<i class="Hui-iconfont">&#xe60d;</i>
					用户管理
					<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
				</dt>
				<dd>
					<ul>
						<li><a data-href="<?php echo U('Home/User/user_list');?>" data-title="用户列表" href="javascript:void(0)">用户列表</a></li>
						<li><a data-href="<?php echo U('Home/User/add');?>" data-title="添加用户" href="javascript:void(0)">添加用户</a></li>
					</ul>
				</dd>
			</dl>

			<dl id="menu-comments">
				<dt>
					<i class="Hui-iconfont Hui-iconfont-home" ></i>
					院系/专业/班级管理
					<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
				</dt>
				<dd>
					<ul>
						<li><a data-href="<?php echo U('Home/Department/lists');?>" data-title="院系列表" href="javascript:;">院系列表</a></li>
						<li><a data-href="<?php echo U('Home/Profession/lists');?>" data-title="专业管理" href="javascript:void(0)">专业管理</a></li>
				</ul>
			</dd>
		</dl>

			<dl id="menu-admin">
				<dt>
					<i class="Hui-iconfont">&#xe62d;</i>
					地区管理
					<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
				</dt>
				<dd>
					<ul>
						<li>
							<a data-href="<?php echo U('Home/Area/area_list');?>" data-title="地区列表" href="javascript:void(0)">地区列表</a>
						</li>
					</ul>
				</dd>
			</dl>
		</div>
	</aside>

<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active">
					<span title="我的桌面" data-href="welcome.html">我的桌面</span>
					<em></em>
				</li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group">
			<a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;">
				<i class="Hui-iconfont">&#xe6d4;</i>
			</a>
			<a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;">
				<i class="Hui-iconfont">&#xe6d7;</i>
			</a>
		</div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="<?php echo U('Home/Index/welcome');?>"></iframe>
		</div>
	</div>
</section>

<div class="contextMenu" id="Huiadminmenu">
	<ul>
		<li id="closethis">关闭当前 </li>
		<li id="closeall">关闭全部 </li>
	</ul>
</div>

<script type="text/javascript" src="/20171202/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/20171202/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/20171202/static/ui/ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/20171202/static/ui/ui.admin/js/H-ui.admin.js"></script>
</body>
</html>