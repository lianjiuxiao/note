<?php if (!defined('THINK_PATH')) exit();?>		<!-- 包含顶部 -->
		<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Unicorn Admin</title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="__PUBLIC__/admin/css/bootstrap.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/admin/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="__PUBLIC__/admin/css/uniform.css" />
        <link rel="stylesheet" href="__PUBLIC__/admin/css/select2.css" />  	
		<link rel="stylesheet" href="__PUBLIC__/admin/css/unicorn.main.css" />
		<link rel="stylesheet" href="__PUBLIC__/admin/css/unicorn.grey.css" class="skin-color" />
                        <script src="__PUBLIC__/admin/js/jquery.min.js"></script>
                        <script src="__PUBLIC__/admin/js/bootstrap.min.js"></script>
    </head>
	<body>
		<div id="header">
			<h1><a href="./dashboard.html">Unicorn Admin</a></h1>		
		</div>
		<!-- 顶部右侧 个人信息区域 开始 -->
		<div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav btn-group">
                <li class="btn btn-inverse">
                	<a title="" href="#"><i class="icon icon-user"></i> <span class="text">个人资料</span></a></li>
                <li class="btn btn-inverse dropdown" id="menu-messages">
                	<a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle">
                    	<i class="icon icon-envelope"></i> 
                        <span class="text">消息</span> 
                        <span class="label label-important">5</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="sAdd" title="" href="#">新消息</a></li>
                        <li><a class="sInbox" title="" href="#">收件箱</a></li>
                        <li><a class="sOutbox" title="" href="#">发件箱</a></li>
                        <li><a class="sTrash" title="" href="#">垃圾箱</a></li>
                    </ul>
                </li>
                <li class="btn btn-inverse">
                	<a title="" href="#"><i class="icon icon-cog"></i> <span class="text">偏好设置</span></a>
                </li>
                <li class="btn btn-inverse">
                    <a title="" href="__ROOT__"><i class="icon icon-eye-open"></i> <span class="text">查看店铺</span></a>
                </li>
                <li class="btn btn-inverse">
                	<a title="" href="__APP__/Login/logout"><i class="icon icon-share-alt"></i> <span class="text">退出</span></a>
                </li>
            </ul>
        </div>
        <!-- 顶部右侧 个人信息区域 结束 -->
        <!-- 侧边 菜单栏 开始 -->
        <div id="sidebar">
            <a href="#" class="visible-phone"><i class="icon icon-home"></i> 控制面板</a>
            <ul>
                <li class="active" id="index"><a href="__APP__"><i class="icon icon-home"></i> <span>控制面板</span></a></li>
                <li class="submenu" id="user">
                    <a href="#"><i class="icon icon-user"></i> <span>用户管理</span></a>
                    <ul>
                        <li><a href="__APP__/User/lists">会员列表</a></li>
                        <li><a href="__APP__/User/add">添加会员</a></li>
                        <li><a href="__APP__/">会员等级</a></li>
                        <li><a href="__APP__/">会员留言</a></li>
                        <li><a href="__APP__/">……</a></li>
                    </ul>
                </li>
                <li class="submenu" id="role">
                    <a href="#"><i class="icon icon-lock"></i> <span>权限管理</span></a>
                    <ul>
                        <li><a href="__APP__/Auser/lists">管理员列表</a></li>
                        <li><a href="__APP__/Alog/lists">系统操作日志</a></li>
                    </ul>
                </li>
                <li class="submenu" id="goods">
                    <a href="#"><i class="icon icon-shopping-cart"></i> <span>商品管理</span></a>
                    <ul>
                        <li><a href="__APP__/Goods/lists">商品列表</a></li>
                        <li><a href="__APP__/Goods/add">添加商品</a></li>
                        <li><a href="__APP__/Class/lists">商品分类</a></li>
                        <li><a href="__APP__/Goodstype/lists">商品规格</a></li>
                        <li><a href="__APP__/Comment/lists">用户评论</a></li>
                        <li><a href="__APP__/Trash/lists">商品回收站</a></li>
                        <li><a href="__APP__/">……</a></li>
                    </ul>
                </li>
                <li class="submenu" id="order">
                    <a href="#"><i class="icon icon-tag"></i> <span>订单管理</span></a>
                    <ul>
                        <li><a href="__APP__/Order/lists">订单列表</a></li>
                        <li><a href="__APP__/Order/query">订单查询</a></li>
                        <li><a href="__APP__/Order/listsq">确认单</a></li>
                        <li><a href="__APP__/Order/listss">收款单</a></li>
                        <li><a href="__APP__/Order/listsf">发货单</a></li>
                        <li><a href="__APP__/Order/listsl">完成交易单</a></li>
                    </ul>
                </li>
                <li class="submenu" id="tmpl">
                    <a href="#"><i class="icon icon-bookmark"></i> <span>模版管理</span></a>
                    <ul>
                        <li><a href="__APP__/Model/lists">模版列表</a></li>
                        <li><a href="__APP__/Model/set">模版设置</a></li>
                        <li><a href="">在线编辑</a></li>
                        <li><a href="__APP__/Mail/lists">邮件模板</a></li>
                    </ul>
                </li>
                <li id="count"><a href=""><i class="icon icon-signal"></i> <span>报表统计</span></a></li>
                <li id="config"><a href="__APP__/Config/listsConfig"><i class="icon icon-cog"></i> <span>网站设置</span></a></li>
                    <!-- 基本信息、自定义导航、系统公告 ... -->
                <li id="friend"><a href="__APP__/Friend/lists"><i class="icon icon-heart"></i> <span>友情链接</span></a></li>
            </ul>
        </div>
        <!-- 侧边 菜单栏 结束 -->
		

<!-- ////////////////////////////////////////// 顶部 ///////////////////////////// -->

		<!-- 后台颜色切换  -->
<!-- 		<div id="style-switcher">
			<i class="icon-arrow-left icon-white"></i>
			<span>Style:</span>
			<a href="#grey" style="background-color: #555555;border-color: #aaaaaa;"></a>
			<a href="#blue" style="background-color: #2D2F57;"></a>
			<a href="#red" style="background-color: #673232;"></a>
		</div> -->
		
		<div id="content">
        	<!-- 顶部右侧快捷操作按钮 开始 -->
			<div id="content-header">
				<h1>控制面板</h1>
				<div class="btn-group">
					<a class="btn btn-large tip-bottom" title="订单管理"><i class="icon-file"></i></a>
					<a class="btn btn-large tip-bottom" title="用户管理"><i class="icon-user"></i></a>
					<a class="btn btn-large tip-bottom" title="评论管理"><i class="icon-comment"></i><span class="label label-important">5</span></a>
					<a class="btn btn-large tip-bottom" title="购物车管理"><i class="icon-shopping-cart"></i></a>
				</div>
			</div>
            <!-- 顶部右侧快捷操作按钮 结束 -->
            <!-- 顶部面包屑导航 开始 -->
			<div id="breadcrumb">
				<a href="#" title="返回首页" class="tip-bottom"><i class="icon-home"></i> 首页</a>
				<a href="#" class="current">控制面板</a>
			</div>
            <!-- 顶部面包屑导航 结束 -->
			<div class="container-fluid">
            	<!-- 顶部站点统计 大图标 开始 -->
				<div class="row-fluid">
						<ul class="stat-boxes">
							<li>
								<div class="left peity_bar_good">
									<span>2,4,9,7,12,10,12</span>+20%
								</div>
								<div class="right">
									<strong>36094</strong>访问
								</div>
							</li>
							<li>
								<div class="left peity_bar_neutral">
									<span>20,15,18,14,10,9,9,9</span>0%
								</div>
								<div class="right">
									<strong><?php echo ($stat["user"]); ?></strong>用户
								</div>
							</li>
							<li>
								<div class="left peity_bar_bad">
									<span>3,5,9,10,12,20,80</span>-50%
								</div>
								<div class="right">
									<strong><?php echo ($stat["order"]); ?></strong>订单
								</div>
							</li>
							<li>
								<div class="left peity_line_good">
									<span>12,6,9,23,14,10,17</span>+70%
								</div>
								<div class="right">
									<strong><?php echo ($stat["order"]); ?></strong>订单
								</div>
							</li>
						</ul>
					</div>	
				</div>
                <!-- 顶部站点统计 大图标 结束 -->
                <!--  -->
				<div class="row-fluid">
					<div class="span12">
<!-- 						<div class="alert alert-info">
							欢迎使用 <strong>Unicorn Admin 主题</strong>。
							<a href="#" data-dismiss="alert" class="close">×</a>
						</div> -->
                        <!-- 组件盒子 站点统计 -->
						<div class="widget-box">
                        	<!-- 标题 -->
							<div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>站点统计</h5><div class="buttons"><a href="#" class="btn btn-mini"><i class="icon-refresh"></i> 刷新</a></div></div>
                            <!-- 内容 -->
							<div class="widget-content">
								<div class="row-fluid">
                                <!-- 左侧信息区 -->
								<div class="span4">
									<ul class="site-stats">
										<li><i class="icon-user"></i> <strong><?php echo ($stat["user"]); ?></strong> <small>总用户数</small></li>
										<li><i class="icon-arrow-right"></i> <strong><?php echo ($stat["lastuser"]); ?></strong> <small>名新注册用户（上周）</small></li>
										<li class="divider"></li>
										<li><i class="icon-shopping-cart"></i> <strong><?php echo ($stat["goods"]); ?></strong> <small>件商品</small></li>
										<li><i class="icon-tag"></i> <strong><?php echo ($stat["complete"]); ?></strong> <small>条已完成交易</small></li>
										<li><i class="icon-repeat"></i> <strong><?php echo ($stat["imperfect"]); ?></strong> <small>条未完成订单</small></li>
									</ul>
								</div>
                                <!-- 右侧图表区 -->
								<div class="span8">
									<div class="chart"></div>
								</div>	
								</div>						
							</div>
						</div>					
					</div>
				</div>
                <!-- 下部组件 -->
				<div class="row-fluid">
					<!-- -->
					<div class="span6">
						<div class="widget-box">
							<!-- 标题 -->
							<div class="widget-title"><span class="icon"><i class="icon-comment"></i></span><h5>操作动态</h5></div>
							<!-- 内容部分 开始 -->
							<div class="widget-content nopadding">
								<?php if(is_array($log)): foreach($log as $key=>$v): echo ($v["loginfo"]); ?><br /><?php endforeach; endif; ?>
							</div>
							<!-- 内容部分 结束-->
						</div>
					</div>
					<!-- -->
					<div class="span6">
						<div class="widget-box">
							<!-- 标题 -->
							<div class="widget-title"><span class="icon"><i class="icon-comment"></i></span><h5>系统信息</h5></div>
							<!-- 内容部分 开始 -->
							<div class="widget-content nopadding">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td>服务器操作系统：</td>
											<td><?php echo ($sysinfo["os"]); ?>&nbsp;<?php echo ($sysinfo["ip"]); ?></td>
										</tr>
										<tr>
											<td>Web 服务器：</td>
											<td><?php echo ($sysinfo["web_server"]); ?></td>
										</tr>
										<tr>
											<td>PHP 版本：</td>
											<td><?php echo ($sysinfo["php_ver"]); ?></td>
										</tr>
										<tr>
											<td>MySQL 版本：</td>
											<td>5.0.51b-community-nt-log</td>
										</tr>
										<tr>
											<td>ThinkPHP 版本：</td>
											<td><?php echo (THINK_VERSION); ?></td>
										</tr>
										<tr>
											<td>MSS 版本：</td>
											<td>V1.0</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- 内容部分 结束-->
						</div>
					</div>
				</div>
					
	<!--//////////////////////////////////////////////  底部 //////////////////////////////////-->

		<!-- 包含底部 -->
					
            <!-- 页面底部版权 -->
			<div class="row-fluid">
				<div id="footer" class="span12">
					Copyright &copy; 2014 <span class="label label-important">四重奏项目组</span> All Rights Reserved. 
				</div>
			</div>
		</div>
	</div>


	<!-- 加载相关JS文件 -->
    <script src="__PUBLIC__/admin/js/excanvas.min.js"></script>
    <script src="__PUBLIC__/admin/js/jquery.ui.custom.js"></script>
    <script src="__PUBLIC__/admin/js/jquery.uniform.js"></script>
    <script src="__PUBLIC__/admin/js/select2.min.js"></script>
    <script src="__PUBLIC__/admin/js/jquery.dataTables.min.js"></script>
    <script src="__PUBLIC__/admin/js/jquery.flot.min.js"></script>
    <script src="__PUBLIC__/admin/js/jquery.flot.resize.min.js"></script>
    <script src="__PUBLIC__/admin/js/jquery.peity.min.js"></script>
    <script src="__PUBLIC__/admin/js/unicorn.js"></script>
    <script src="__PUBLIC__/admin/js/unicorn.tables.js"></script>
    <script src="__PUBLIC__/admin/js/unicorn.dashboard.js"></script>

    <script>
        // 侧边菜单栏，高亮当前模块 样式设置
    
        // 去除之前的样式
        $("li[class='active']").removeClass("active");
        // 高亮当前样式
        $("li[id='<?php echo (strtolower(MODULE_NAME)); ?>']").addClass("active");
    </script>

</body>
</html>