<?php if (!defined('THINK_PATH')) exit();?><!-- 包含顶部 -->
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

<div id="content">
	<!-- 顶部右侧快捷操作按钮 开始 -->
		<div id="content-header">
			<h1>网站设置</h1>
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
			<a href="__APP__" title="返回首页" class="tip-bottom"><i class="icon-home"></i> 首页</a>
			<a href="__URL__/listsConfig" title="返回网站配置" class="tip-bottom"> 网站设置</a>
			<a href="#" class="current"> 配置列表</a>
		</div>
		<!-- 顶部面包屑导航 结束 -->
		<!-- 主体区域 -->
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<!-- 组件盒子 开始 -->
					<div class="widget-box">
					   	<div class="widget-title">
					        <ul class="nav nav-tabs">
					            <li class="active"><a data-toggle="tab" href="#tab1">店铺信息</a></li>
					            <li><a data-toggle="tab" href="#tab2">站点设置</a></li>
					            <li><a data-toggle="tab" href="#tab3">其它配置（预留）</a></li>
					        </ul>
					    </div>
					    <div class="widget-content tab-content">
					    	<!-- 选项卡一 店铺信息 开始 -->
					        <div id="tab1" class="tab-pane active">
								<!-- 编辑表单 -->
								<form action="__URL__/updaConfig" method="post" enctype="multipart/form-data" class="form-horizontal">
									<div class="control-group">
										<label class="control-label">店铺名称：</label>
										<div class="controls"><input type="text" name="shopname" value="<?php echo ($config["shopname"]); ?>" /></div>
									</div>
									<div class="control-group">
										<label class="control-label">店铺标题：</label>
										<div class="controls"><input type="text" name="shoptitle" value="<?php echo ($config["shoptitle"]); ?>" /><span class="help-block">将显示在浏览器标题栏的文字。</span></div>
									</div>
									<div class="control-group">
										<label class="control-label">店铺关键字：</label>
										<div class="controls"><input type="text" name="keywords" value="<?php echo ($config["keywords"]); ?>" /><span class="help-block">以“,”分隔，推荐3-5个。</span></div>
									</div>
									<div class="control-group">
										<label class="control-label">店铺描述：</label>
										<div class="controls">
											<textarea name="description" id="" ><?php echo ($config["description"]); ?></textarea><span class="help-block">突出店铺关键字，推荐150字左右。</span>
										<!-- <input type="text" name="description" value="<?php echo ($config["2"]["content"]); ?>"/> -->
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">管理员邮箱：</label>
										<div class="controls"><input type="text" name="aemail" value="<?php echo ($config["aemail"]); ?>" /></div>
									</div>										
									<div class="control-group">
										<label class="control-label">公司法人姓名：</label>
										<div class="controls"><input type="text" name="shopowner" value="<?php echo ($config["shopowner"]); ?>" /></div>
									</div>
									<div class="control-group">
										<label class="control-label">身份证号：</label>
										<div class="controls"><input type="text" name="idcard" value="<?php echo ($config["idcard"]); ?>" /></div>
									</div>
									<div class="control-group">
										<label class="control-label">电话号码：</label>
										<div class="controls"><input type="text" name="cellphone" value="<?php echo ($config["cellphone"]); ?>" /></div>
									</div>
									<div class="control-group">
										<label class="control-label">微博地址：</label>
										<div class="controls"><input type="text" name="weibo" value="<?php echo ($config["weibo"]); ?>" /></div>
									</div>
									<div class="control-group">
										<label class="control-label">公司地址：</label>
										<div class="controls"><input type="text" name="address" value="<?php echo ($config["address"]); ?>" /></div>
									</div>
									<div class="control-group">
										<label class="control-label">营业执照：</label>
										<div class="controls"><input type="file" name="blicense" /><a href="__PUBLIC__/Uploads/config/<?php echo ($config["blicense"]); ?>" title="点击有惊喜"><?php echo ($config["blicense"]); ?></a></div>
									</div>
									<div class="control-group">
										<label class="control-label">公司所在地：</label>
										<div class="controls"><input type="text" name="caddress" value="<?php echo ($config["caddress"]); ?>" /></div>
									</div>
									<div class="control-group">
										<label class="control-label">网站Logo：</label>
										<div class="controls"><input type="file" name="logo" /><a href="__PUBLIC__/Uploads/config/<?php echo ($config["logo"]); ?>" title="点击有惊喜"><?php echo ($config["logo"]); ?></a></div>
									</div>
									<!-- 提交提交按钮 -->
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">保存</button>
									</div>
								</form>
					        </div>
					        <!-- 选项卡一 店铺信息 结束 -->
					        <!-- 选项卡二 站点设置 开始 -->
					        <div id="tab2" class="tab-pane">
								<!-- 编辑表单 -->
								<form action="__URL__/updaConfig" method="post" enctype="multipart/form-data" class="form-horizontal">
									<div class="control-group">
										<label class="control-label">备案信息：</label>
										<div class="controls"><input type="text" name="icpnum" value="<?php echo ($config["icpnum"]); ?>" /></div>
									</div>
									<div class="control-group">
										<label class="control-label">统计代码：</label>
										<div class="controls"><textarea name="stacode" id="" ><?php echo ($config["stacode"]); ?></textarea></div>
									</div>
									<div class="control-group">
										<label class="control-label">商品默认图片：</label>
										<div class="controls"><input type="file" name="goodsimg" /><a href="__PUBLIC__/Uploads/config/<?php echo ($config["goodsimg"]); ?>" title="点击有惊喜"><?php echo ($config["goodsimg"]); ?></a></div>
									</div>
									<div class="control-group">
										<label class="control-label">用户默认头像：</label>
										<div class="controls"><input type="file" name="userpic" /><a href="__PUBLIC__/Uploads/config/<?php echo ($config["userpic"]); ?>" title="点击有惊喜"><?php echo ($config["userpic"]); ?></a></div>
									</div>
									<div class="control-group">
										<label class="control-label">水印图片：</label>
										<div class="controls"><input type="file" name="wimg" /><a href="__PUBLIC__/Uploads/config/<?php echo ($config["wimg"]); ?>" title="点击有惊喜"><?php echo ($config["wimg"]); ?></a></div>
									</div>	
									<div class="control-group">
										<label class="control-label">水印位置：</label>
										<div class="controls">
											<select style="width: 80px" name="wposition">
												<option value="1" <?php if($config['wposition'] == 1): ?>selected<?php endif; ?> >无</option>
												<option value="2" <?php if($config['wposition'] == 2): ?>selected<?php endif; ?>>左上</option>
												<option value="3" <?php if($config['wposition'] == 3): ?>selected<?php endif; ?>>右上</option>
												<option value="4" <?php if($config['wposition'] == 4): ?>selected<?php endif; ?>>居中</option>
												<option value="5" <?php if($config['wposition'] == 5): ?>selected<?php endif; ?>>左下</option>
												<option value="6" <?php if($config['wposition'] == 6): ?>selected<?php endif; ?>>右下</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">水印透明度：</label>
										<div class="controls"><input type="text" name="walpha" value="<?php echo ($config["walpha"]); ?>" /><span class="help-block">请填写为0-100的整数,如填入80，表示透明度为80％</span></div>
									</div>										
									<div class="control-group">
										<label class="control-label">商品货号前缀：</label>
										<div class="controls"><input type="text" name="gnum_prefix" value="<?php echo ($config["gnum_prefix"]); ?>" /></div>
									</div>
									<div class="control-group">
										<label class="control-label">是否开启新订单提醒：</label>
										<div class="controls">
											<label><input type="radio" name="isnotice" value="1" <?php if($config['isnotice'] == 1): ?>checked="true"<?php endif; ?> /> 是</label>
											<label><input type="radio" name="isnotice" value="2" <?php if($config['isnotice'] == 2): ?>checked="true"<?php endif; ?> /> 否</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">是否开启会员邮箱验证：</label>
										<div class="controls">
											<label><input type="radio" name="isvemail" value="1" <?php if($config['isvemail'] == 1): ?>checked="true"<?php endif; ?> /> 是</label>
											<label><input type="radio" name="isvemail" value="2" <?php if($config['isvemail'] == 2): ?>checked="true"<?php endif; ?> /> 否</label>
										</div>
									</div>
									<!-- 提交提交按钮 -->
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">保存</button>
									</div>
								</form>
					        </div>
					        <div id="tab3" class="tab-pane">This is a Tab Three Content</div>
					    </div>                            
					</div>
					<!-- 组件盒子 结束 -->
				</div>
			</div>

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