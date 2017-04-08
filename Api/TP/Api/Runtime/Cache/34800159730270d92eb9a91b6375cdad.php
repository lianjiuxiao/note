<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
	<title>购物车</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- Bootstrap不支持IE的兼容模式，此处使IE浏览器运行最新的渲染模式 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- 响应式布局开启视窗控制 -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- 页面信息 -->
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="四重奏项目组/SC">
	
	<!-- bootstarp css 文件引入 -->
	<link rel="stylesheet" href="__PUBLIC__/index/css/bootstrap.css">
	<link rel="stylesheet" href="__PUBLIC__/index/css/bootstrap-theme.css">
	<!-- // bootstrap css 文件引入 -->

	<!-- 一般 css 文件引入 -->
	<link rel="stylesheet" href="__PUBLIC__/index/css/minified.css">
	<!-- // 一般 css 文件引入 -->

	<!--[if IE 8]>
		<script src="__PUBLIC__/index/js/respond.min.js"></script>
		<script src="__PUBLIC__/index/js/selectivizr-min.js"></script>
	<![endif]-->
	
	<!-- 挂载 jquery.min.js (上线采用)到对象 window 下，若不成功直接加载 -->
	<script>window.jQuery || document.write('<script src="__PUBLIC__/index/js/jquery.min.js"><\/script>');</script>
	
	<!-- // 挂载 jquery.min.js (上线采用)到对象 window 下，若不成功直接加载 -->
	<script src="__PUBLIC__/index/js/modernizr.min.js"></script>
	
	<!-- 挂载bootstrap js 文件 -->
	<script src="__PUBLIC__/index/js/bootstrap.js"></script>
	<!-- // 挂载 bootstarp js 文件 -->
	
	<!-- 挂载 stickUp 顶部悬浮 js 插件 -->
	<script src="__PUBLIC__/index/js/stickUp.min.js"></script>
	<!-- // 挂载 stickUp 顶部悬浮 js 插件 -->
	
	<!-- 特定页面 css -->
	<link rel="stylesheet" href="__PUBLIC__/index/css/innerpage.css">
	<link rel="stylesheet" href="__PUBLIC__/index/css/owl.carousel.css">
	<link rel="stylesheet" href="__PUBLIC__/index/css/owl.theme.css">
	<!-- // 特定页面 css -->

	<!-- 响应式 css 文件 -->
	<link rel="stylesheet" href="__PUBLIC__/index/css/responsive.css">
	<!-- // 响应式 css 文件 -->
</head>
<body>
			
	<!-- PAGE WRAPPER -->
<div id="page-wrapper">

	<!-- 站点头部 -->
	<!-- SITE HEADER 站点页眉 -->
<header>
<div id="site-header" class="push-up" role="banner">
	<!-- HEADER TOP 页眉顶部 -->
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<!-- CONTACT INFO 联系信息 -->
					<div class="contact-info">
						<i class="iconfont-headphones round-icon"></i>
						<strong><?php echo ($head["cellphone"]); ?></strong>
						<span>(营业时间：09:00 - 22:00)</span>
					</div>
					<!-- // CONTACT INFO 联系信息 -->
				</div>
				<div class="col-xs-12 col-sm-6">
					<ul class="actions unstyled clearfix">
						<li>
							<!-- SEARCH BOX 搜索框 -->
							<div class="search-box">
								<form action="__APP__/Products/products/search" method="post">
									<div class="input-iconed prepend">
										<button class="input-icon"><i class="iconfont-search"></i></button>
										<label for="input-search" class="placeholder">请输入搜索内容…</label>
										<input type="text" name="search" id="input-search" class="round-input full-width" required />
									</div>
								</form>
							</div>
							<!-- // SEARCH BOX 搜索框 -->
						</li>
						<li data-toggle="sub-header" data-target="#sub-cart">
							<!-- SHOPPING CART 购物车-->
							<a href="javascript:void(0);" id="total-cart">
								<i class="iconfont-shopping-cart round-icon"></i>
							</a>
							
							<div id="sub-cart" class="sub-header">
								<div class="cart-header">
									<span>您的购物车当前为空.</span>
									<small><a href="__APP__/Cart/cart">(查看全部)</a></small>
								</div>
								<ul class="cart-items product-medialist unstyled clearfix"></ul>
								<div class="cart-footer">
									<div class="cart-total clearfix">
										<span class="pull-left uppercase">总计</span>
										<span class="pull-right total">￥ 0</span>
									</div>
									<div class="text-right">
										<a href="__APP__/Cart/cart" class="btn btn-default btn-round view-cart">查看购物车</a>
									</div>
								</div>
							</div>
							<!-- // SHOPPING CART 购物车 -->
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		<!-- ADD TO CART MESSAGE 添加到购物车 -->
		<div class="cart-notification">
			<ul class="unstyled"></ul>
		</div>
		<!-- // ADD TO CART MESSAGE 添加到购物车 -->
	</div>
	<!-- // HEADER TOP 头部顶部 -->
	<!-- MAIN HEADER 头部主要部分 -->
	<div class="main-header-wrapper">
		<div class="container">
			<div class="main-header">
				<!-- CURRENCY 用户菜单 -->
				<div class="actions">
					<!-- USER RELATED MENU 用户相关菜单 -->
					<nav id="tiny-menu" class="clearfix">
						<ul class="user-menu" >
							<?php if(empty($_SESSION['Username'])): ?><!-- 登陆成功后此处隐藏并显示用户名，点击可进入用户中心 -->
								<li><a blank-"_blank" href="__APP__/Login/login" style="font-size:13px;">登录</a></li>
							<?php else: ?>
								<li><a blank-"_blank" href="__APP__/Personal/center"><?php echo (session('Username')); ?></a></li><?php endif; ?>
							<!-- 登陆成功后此处隐藏 -->
							<li><a href="__APP__/Register/register" style="font-size:13px;">注册会员</a></li>

							<!-- 清除cookie -->
							<?php if(!empty($_SESSION['Username'])): ?><li><a href="__APP__/Login/loginout" style="font-size:13px;">退出</a></li><?php endif; ?>
						</ul>
					</nav>
					<!-- // USER RELATED MENU 用户相关菜单 -->
				</div>
				<!-- // CURRENCY  用户菜单 -->
				<!-- SITE LOGO 站点 logo -->
				<div class="logo-wrapper">
					<a href="__APP__" class="logo" title="<?php echo ($head["shoptitle"]); ?>">
						<img src="__PUBLIC__/Uploads/config/<?php echo ($head["logo"]); ?>" alt="<?php echo ($head["shoptitle"]); ?>" />
					</a>
				</div>
				<!-- // SITE LOGO 站点 logo -->
				<!-- SITE NAVIGATION MENU 网站导航菜单 -->
				<nav id="site-menu" role="navigation">
					<ul class="main-menu hidden-sm hidden-xs">
						<li class="active">
							<a href="__APP__">首页</a>
						</li>
						<li>
							<a href="__APP__/Products/products">产品列表</a>
						</li>
						<?php if(empty($_SESSION['Username'])): else: ?>
							<li class="dropdown">
								<!-- <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"> -->
								<a href="__APP__/Personal/center">个人中心</a>
								<!-- <b class="caret"></b> 是否显示下拉条 -->
							</li><?php endif; ?>
						<li>
							<a href="__APP__/Cart/cart">购物车</a>
						</li>
						<li>
							<a href="__APP__/Checkout/checkout">结账</a>
						</li>
					</ul>
					
					<!-- MOBILE MENU 手机菜单 -->
						<div id="mobile-menu" class="dl-menuwrapper visible-xs visible-sm" style="z-index:10">
							<button class="dl-trigger"><i class="iconfont-reorder round-icon"></i></button>
							<ul class="dl-menu">
								<li class="active">
									<a href="__APP__">首页</a>
								</li>
						<li>
							<a href="__APP__/Products/products">产品列表</a>
						</li>
						<?php if(empty($_SESSION['Username'])): else: ?>
							<li class="dropdown">
								<!-- <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"> -->
								<a href="__APP__/Personal/center">个人中心</a>
								<!-- <b class="caret"></b> 是否显示下拉条 -->
							</li><?php endif; ?>
						<li>
							<a href="__APP__/Cart/cart">购物车</a>
						</li>
						<li>
							<a href="__APP__/Checkout/checkout">结账</a>
						</li>
							</ul>
						</div>
					<!-- // MOBILE MENU 手机菜单 -->

				</nav>
				<!-- // SITE NAVIGATION MENU 网站导航菜单 -->
			</div>
		</div>
	</div>
	<!-- // MAIN HEADER 页眉主要部分 -->
</header>
<!-- // SITE HEADER 网站页眉-->
		<!-- BREADCRUMB 面包屑导航 -->
		<div class="breadcrumb-container">
			<div class="container">
				<div class="relative">
					<ul class="bc unstyled clearfix">
						<li><a href="#">首页</a></li>
						<li><a href="products.html" class="active">购物车</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- // BREADCRUMB 面包屑导航 -->
		
		<!-- SITE MAIN CONTENT 站点主要内容-->
		<main id="main-content" role="main">
				
			<section class="section">
				<div class="container">
					<!-- 商品信息列表 -->
					<table class="tbl-cart">
						<thead>
							<tr>
								<th>商品名</th>
								<th style="width: 15%;">单价</th>
								<th style="width: 15%;">数量</th>
								<th class="hidden-xs" style="width: 15%;">合计</th>
								<th class="hidden-xs" style="width: 10%;"></th>
							</tr>
						</thead>
						<tbody>
							<tr class="hide empty-cart">
								<td colspan="5" >
									您的购物车为空, 您可以去<a href="__APP__/Products/products">商品列表</a>找您喜欢的商品.
								</td>
							</tr>
						</tbody>
					</table>

					<!-- 使用优惠券 -->
<!-- 					<div class="pull-left coupon m-b">
						<div class="input-group">
							<label for="apply-coupon" class="placeholder">Enter Your Coupon Code</label>
							<input type="text" id="apply-coupon" name="coupon" class="form-control" required />
							<span class="input-group-btn">
								<button class="btn btn-primary">使用优惠券</button>
							</span>
						</div>
					</div> -->
					
					<div class="shopcart-total pull-right clearfix">
<!-- 						<div class="cart-subtotal text-xs m-b-sm clearfix">
							<span class="pull-left">小计:</span>
							<span class="pull-right">￥1050.00</span>
						</div> -->
						<div class="cart-total text-bold m-b-lg clearfix">
							<span class="pull-left">共计:</span>
							<span class="pull-right">￥1050.00</span>
						</div>
						<div class="text-center">
							<a class="btn btn-primary btn-round uppercase" href="__APP__/Checkout/checkout">继续购物</a>
							<a class="btn btn-round btn-default uppercase" href="__APP__/Checkout/checkout">进入结算中心</a>

						</div>
					</div>
					
				</div>
			</section>
			

			<!-- RELATED PRODUCTS 相关商品-->
			<section class="section visible-items-4">
				<div class="container">
					<div class="row">
						<header class="section-header clearfix col-sm-offset-3 col-sm-6">
							<h3 class="section-title">您可能感兴趣的</h3>
							<p class="section-teaser">韩都衣舍，随您挑选您感兴趣的商品</p>
						</header>
						
						<div class="clearfix"></div>
											<!-- BEGIN CAROUSEL 开始旋转木马 -->
					<div id="featured-products" class="add-cart" data-product=".product" data-thumbnail=".entry-media .thumb" data-title=".entry-title > a" data-url=".entry-title > a" data-price=".entry-price > .price">
					
						<div class="owl-controls clickable center">
							<div class="owl-buttons">
								<div class="owl-prev"><i class="iconfont-angle-left"></i></div>
								<div class="owl-next"><i class="iconfont-angle-right"></i></div>
							</div>
						</div>
						
						<div class="owl-carousel owl-theme" data-visible-items="4" data-navigation="true" data-lazyload="true">
							<!-- 掌柜推荐商品遍历部分开始-->
							<?php if(is_array($tdata)): foreach($tdata as $key=>$vo): ?><div class="product" data-product-id="<?php echo ($vo["id"]); ?>">
									<div class="entry-media">
										<img data-src="__PUBLIC__/Uploads/goods/<?php echo ($vo["pic"]); ?>" alt="" class="lazyOwl thumb"/>
										<div class="hover">
											<a href="__APP__/Products/product/id/<?php echo ($vo["id"]); ?>" class="entry-url"></a>
											<ul class="icons unstyled">
												<li>
													<div class="circle ribbon ribbon-sale">热销</div>
												</li>
												<li>
													<a href="__PUBLIC__/Uploads/goods/<?php echo ($vo["pic"]); ?>" class="circle" data-toggle="lightbox"><i class="iconfont-search"></i></a>
												</li>
												<li>
													<a href="__PUBLIC__/index/#" class="circle add-to-cart"><i class="iconfont-shopping-cart"></i></a>
												</li>
											</ul>
								        </div>
									</div>
									<div class="entry-main">
										<h5 class="entry-title">
											<a href="__PUBLIC__/Products/product/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["gname"]); ?></a>
										</h5>
										<div class="entry-price">
											<strong class="accent-color price">￥<?php echo ($vo["price"]); ?></strong>
										</div>
									</div>
								</div><?php endforeach; endif; ?>
							<!-- 掌柜推荐商品遍历部分结束-->
						</div>
							
					</div>
					<!-- // END CAROUSEL 结束旋转木马 -->
					
					</div>
				</div>
			</section>
			<!-- // RELATED PRODUCTS -->
			
		</main>
		<!-- // SITE MAIN CONTENT -->
		<!-- 站点页脚 -->
			<!-- SITE FOOTER 网站页脚 -->
<footer class="page-footer">
	
	<!-- WIDGET AREA 小部件区域 -->
	<div class="widgets">
	
		<!-- FIRST ROW 第一行 -->
		<div class="section">
			<div class="container">
				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-3">
						<section class="widget widget-menu">
							<h5 class="widget-title">联系方式</h5>
							<div class="widget-content">
								<ul class="menu iconed-list unstyled">
									<li>
										<span class="list-icon"><i class="round-icon iconfont-map-marker"></i></span>
										<div class="list-content"><?php echo ($foot["address"]); ?></div>
									</li>
									<li>
										<span class="list-icon"><i class="round-icon iconfont-phone"></i></span>
										<div class="list-content"><?php echo ($foot["cellphone"]); ?></div>
									</li>
									<li>
										<span class="list-icon"><i class="round-icon iconfont-envelope-alt"></i></span>
										<div class="list-content"><?php echo ($foot["aemail"]); ?></div>
									</li>
									<li>
										<span class="list-icon"><i class="round-icon iconfont-weibo"></i></span>
										<div class="list-content"><?php echo ($foot["weibo"]); ?></div>
									</li>
								</ul>
							</div>
						</section>
					</div>

					<div class="col-xs-12 col-sm-6 col-md-4">
						<section class="widget widget-text">
							<h5 class="widget-title">关于本店</h5>
							<div class="widget-content">
								<p>本店是韩都衣舍旗下女装品牌HSTYLE—韩风时尚女装。</p>
								<p>以产品"款式多、更新快、性价比高"而迅速赢得都市时尚人群信赖。</p>
								<p>韩都衣舍目标销售对象为都市时尚人群，公司旗下有超过500人的专业时尚设计师团队，并在韩国拥有分公司，同1000余家时尚品牌公司保持着紧密的、全方位的合作关系。
								</p>
							</div>
						</section>
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<section class="widget widget-text">
							<h5 class="widget-title">营业时间</h5>
							<div class="widget-content">
								<p>周一 - 周五 :-------------------------8:00 -- 22:00</p>
								<p>周六 - 周日 :-------------------------9:00 -- 24:00</p>
								<br/>
								<p>全年365天营业，节假日不休息，韩都衣舍期待您的光临！</p>
							</div>
						</section>
					</div>
					
					<div class="space40 visible-sm clearfix"></div>
					
					<div class="col-xs-12 col-sm-6 col-md-2">
						<section class="widget widget-menu">
							<h5 class="widget-title">友情链接</h5>
							<div class="widget-content">
								<ul class="menu iconed-menu unstyled">
									<?php if(is_array($foot["links"])): foreach($foot["links"] as $key=>$v): ?><li><a href="<?php echo ($v["url"]); ?>"><i class="iconfont-circle-blank menu-icon"></i><?php echo ($v["lname"]); ?></a></li><?php endforeach; endif; ?>
								</ul>
							</div>
						</section>
					</div>
					
				</div>
			</div>
		</div>
		<!-- // FIRST ROW 第一行 -->
		
	</div>
	<!-- // WIDGET AREA 小部件区域 -->
	
	<div class="footer-sub">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
				<!-- 此处预留,项目审核前屏蔽	SC -->
<!-- 					<div class="footer-links center-xs clearfix">
						<ul class="unstyled">
							<li><a href="./Index/Tpl/Index/#">统计代码</a></li>
							<li><a href="./Index/Tpl/Index/#">常见问题</a></li>
							<li><a href="./Index/Tpl/Index/#">加入我们</a></li>
						</ul>
					</div>
					<div class="space10"></div> -->
					<div class="copyright center-xs">
						<p>© 2013-2014 四重奏项目组 All rights reserved.</p>
					</div>
				</div>
				
				<div class="space40 visible-xs"></div>
				
				<div class="col-xs-12 col-sm-6">
					<div class="pull-right">
							<span class="uppercase">可选付款类型&emsp;</span>
							<a href="./Index/Tpl/Index/#"><img src="__PUBLIC__/index/img/visacard.png" alt="" width="40" /></a>
							<a href="./Index/Tpl/Index/#"><img src="__PUBLIC__/index/img/mastercard.png" alt="" width="40" /></a>
							<a href="./Index/Tpl/Index/#"><img src="__PUBLIC__/index/img/paypal.png" alt="" width="40" /></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</footer>
<!-- // SITE FOOTER 站点尾部 -->
		
</div>
<!-- // PAGE WRAPPER -->

<!-- Essential Javascripts 基本的 js 文件 -->
<script src="__PUBLIC__/index/js/minified.js"></script>
<!-- // Essential Javascripts 基本的 js 文件 -->

<!-- Particular Page Javascripts 特定页面 js 文件 -->
<script src="__PUBLIC__/index/js/products.js"></script>
<script src="__PUBLIC__/index/js/owl.carousel.js"></script>
<!-- // Particular Page Javascripts 特定页面 js 文件 -->
	
</body>
</html>