<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo ($head["shoptitle"]); ?>商品列表</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- Bootstrap不支持IE的兼容模式，此处使IE浏览器运行最新的渲染模式 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- 响应式布局开启视窗控制 -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- 页面信息 -->
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="四重奏项目组/SC">
	<!-- Bootstrap 核心 css 文件-->
	<link rel="stylesheet" href="__PUBLIC__/index/dist/css/bootstrap.min.css">
	<!-- HTML5 支持性检测.js IE8 支持 HTML5 的元素和媒体查询 -->
	<!-- 警告: js文件不工作，通过以下方式查看源文件:// -->
	<!--[if lt IE 9]>
		<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
		<script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	<!-- bootstrap css 文件引入 -->
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
	
	<!-- 挂载 bootstrap js 文件 -->
	<script src="__PUBLIC__/index/js/bootstrap.js"></script>
	<!-- // 挂载 bootstrap js 文件 -->
	
	<!-- 特定页面 css 文件 -->
	<link rel="stylesheet" href="__PUBLIC__/index/css/jquery.nouislider.css">
	<link rel="stylesheet" href="__PUBLIC__/index/css/isotope.css">
	<link rel="stylesheet" href="__PUBLIC__/index/css/innerpage.css">
	<!-- // 特定页面 css 文件 -->
	
	<!-- 响应式 css 文件 -->
	<link rel="stylesheet" href="__PUBLIC__/index/css/responsive.css">
	<!-- // 响应式 css 文件 -->
</head>
<body class="products-view">
			
	<!-- PAGE WRAPPER -->
<div id="page-wrapper">
		<!-- 引入页眉文件 -->
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
					<ul class="bc push-up unstyled clearfix">
						<li><a href="__APP__/Index/index">首页</a></li>
						<li class="active">产品列表</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- // BREADCRUMB 面包屑导航 -->
		
		<!-- SITE MAIN CONTENT 站点主要内容 -->
		<main id="main-content" role="main">
			<div class="container">
				<div class="row">
					
					<div class="m-t-b clearfix">
						<!-- SIDEBAR 侧边栏 -->
						<aside class="col-xs-12 col-sm-4 col-md-3">
							<section class="sidebar push-up">
							
								<!-- CATEGORIES 产品分类列表 -->
								<section class="side-section bg-white">
									<header class="side-section-header">
										<h3 class="side-section-title text-bold">产品分类</h3>
									</header>
									<div class="side-section-content" style="padding: 0;background: #DFDFDF;">
										<div class="panel-group" id="accordion">
											<?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><div class="panel panel-default" style="border:0;padding:0;">
											   		<div class="panel-heading" style="padding-left:30px;">
											      		<h3 class="panel-title text-bold">
												        	<a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ($value["id"]); ?>">
												          		<?php echo ($value["cname"]); ?>
												        	</a>
											      		</h3>
											    	</div>
											    	<div id="collapse<?php echo ($value["id"]); ?>" class="panel-collapse collapse">
											      		<div class="panel-body" style="padding:0">
<!-- 														<ul style="list-style:none outside none">
																<?php if(is_array($value['part'])): $i = 0; $__LIST__ = $value['part'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$svalue): $mod = ($i % 2 );++$i;?><li>
																		<a href="__URL__/products/scl/<?php echo ($svalue['id']); ?>">
																			<?php echo ($svalue['cname']); ?>
																		</a>
																	</li><?php endforeach; endif; else: echo "" ;endif; ?>
															</ul> -->
															<ul class="list-group">
																<?php if(is_array($value['part'])): $i = 0; $__LIST__ = $value['part'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$svalue): $mod = ($i % 2 );++$i;?><li class="list-group-item" style="border:0;padding-left:45px">
																    	<span class="badge"><?php echo ($svalue['goodsCount']); ?></span>
																    	<a href="__URL__/products/scl/<?php echo ($svalue['id']); ?>" class="text-muted">
																			<?php echo ($svalue['cname']); ?>
																		</a>
																  	</li><?php endforeach; endif; else: echo "" ;endif; ?>
															</ul>
											      		</div>
											    	</div>
											  	</div><?php endforeach; endif; else: echo "" ;endif; ?>
										</div>
									</div>
										<!-- <ul id="category-list" class="vmenu unstyled"> -->
											<!-- <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>-->
												<!-- <li> -->
													<!-- input的id由$value.path和$value.id以'-'拼接构成作为标签的惟一标识 -->
													<!-- data-label是分类的名称,data-lavelPosition控制相对checkbox框显示位置 -->
													<!-- value值和商品的data-category相对应构成选择筛选对应条件 -->
													<!-- <input type="checkbox" id="check-0-<?php echo ($value["id"]); ?>" class="prettyCheckable" data-label="<?php echo ($value["cname"]); ?>" data-labelPosition="right" value="<?php echo ($value["id"]); ?>-<?php echo ($value["cname"]); ?>" />
													<ul>
														<?php if(is_array($value['part'])): $i = 0; $__LIST__ = $value['part'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$svalue): $mod = ($i % 2 );++$i;?><li>
																<input type="checkbox" id="check-0-<?php echo ($svalue["sid"]); ?>-<?php echo ($svalue["id"]); ?>" class="prettyCheckable" data-label="<?php echo ($svalue["cname"]); ?>" data-labelPosition="right" value="<?php echo ($svalue["id"]); ?>-<?php echo ($svalue["cname"]); ?>"/>
															</li><?php endforeach; endif; else: echo "" ;endif; ?>
													</ul>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul> -->
								</section>
								<!-- // CATEGORIES 产品分类列表 -->
								
								<!-- PRODUCT FILTER 产品筛选-->
								<section class="side-section bg-white">
									<header class="side-section-header">
										<h3 class="side-section-title text-bold">筛选条件</h3>
									</header>
									
									<!-- PRICE RANGE SLIDER 价格范围滑块 -->
									<div id="filter-by-price" class="side-section-content">
										<h4 class="side-section-subheader">价格区间</h4>
										<div class="range-slider-container">
											<div class="range-slider" data-min="0" data-max="1000" data-step="10" data-currency="￥"></div>
											<div class="range-slider-value clearfix">
												<span>价格: &ensp;</span>
												<span class="min"></span>
												<span class="max"></span>
											</div>
										</div>
									</div>
									<!-- // PRICE RANGE SLIDER 价格范围滑块 -->
									
									<!-- FILTER BY SIZE 尺寸选择-->
									<div id="filter-by-size" class="side-section-content">
										<h4 class="side-section-subheader">尺寸规格</h4>
										<ul class="inline-li li-m-lg text-center unstyled">
											<li>
												<a href="#" class="round-icon" data-toggle="tooltip" data-title="X-S"><small>XS</small></a>
												<input type="checkbox" class="filter-checkbox filter-size" value="XS" />
											</li>
											<li>
												<a href="#" class="round-icon" data-toggle="tooltip" data-title="S"><small>S</small></a>
												<input type="checkbox" class="filter-checkbox filter-size" value="S" />
											</li>
											<li>
												<a href="#" class="round-icon" data-toggle="tooltip" data-title="M"><small>M</small></a>
												<input type="checkbox" class="filter-checkbox filter-size" value="M" />
											</li>
											<li>
												<a href="#" class="round-icon" data-toggle="tooltip" data-title="L"><small>L</small></a>
												<input type="checkbox" class="filter-checkbox filter-size" value="L" />
											</li>
											<li>
												<a href="#" class="round-icon" data-toggle="tooltip" data-title="X-L"><small>XL</small></a>
												<input type="checkbox" class="filter-checkbox filter-size" value="XL" />
											</li>
											<li>
												<a href="#" class="round-icon" data-toggle="tooltip" data-title="XX-L"><small>XXL</small></a>
												<input type="checkbox" class="filter-checkbox filter-size" value="XXL" />
											</li>
										</ul>
									</div>
									<!-- // FILTER BY SIZE 尺寸选择 -->
									
									<!-- FILTER BY COLOR 颜色选择 -->
									<div id="filter-by-color" class="side-section-content">
										<h4 class="side-section-subheader">挑选颜色</h4>
										<ul class="inline-li li-m-sm text-center unstyled">
											<li>
												<a href="#" class="round-icon color-box" data-toggle="tooltip" data-title="黑色" style="background: #000;"></a>
												<input type="checkbox" class="filter-checkbox filter-color" value="黑色" />
											</li>
											<li>
												<a href="#" class="round-icon color-box" data-toggle="tooltip" data-title="白色" style="background: #fff; border-color: #acacac;"></a>
												<input type="checkbox" class="filter-checkbox filter-color" value="白色" />
											</li>
											<li>
												<a href="#" class="round-icon color-box" data-toggle="tooltip" data-title="绿色" style="background: #60bd0d;"></a>
												<input type="checkbox" class="filter-checkbox filter-color" value="绿色" />
											</li>
											<li>
												<a href="#" class="round-icon color-box" data-toggle="tooltip" data-title="红色" style="background: #ff5757;"></a>
												<input type="checkbox" class="filter-checkbox filter-color" value="红色" />
											</li>
											<li>
												<a href="#" class="round-icon color-box" data-toggle="tooltip" data-title="蓝色" style="background: #0d9abd;"></a>
												<input type="checkbox" class="filter-checkbox filter-color" value="蓝色" />
											</li>
											<li>
												<a href="#" class="round-icon color-box" data-toggle="tooltip" data-title="棕色" style="background: #c57313;"></a>
												<input type="checkbox" class="filter-checkbox filter-color" value="棕色" />
											</li>
											<li>
												<a href="#" class="round-icon color-box" data-toggle="tooltip" data-title="紫色" style="background: #a613c5;"></a>
												<input type="checkbox" class="filter-checkbox filter-color" value="紫色" />
											</li>
											<li>
												<a href="#" class="round-icon color-box" data-toggle="tooltip" data-title="银白色" style="background: #e5e5e8;"></a>
												<input type="checkbox" class="filter-checkbox filter-color" value="银白色" />
											</li>
											<li>
												<a href="#" class="round-icon color-box" data-toggle="tooltip" data-title="花纹色" style="background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAAHklEQVQIW2NkYGD4D8QgwAgjMASgCiAqwcqgACwAAIrDBAOqGrGNAAAAAElFTkSuQmCC');"></a>
												<input type="checkbox" class="filter-checkbox filter-color" value="花纹色" />
											</li>
										</ul>
									</div>
									<!-- // FILTER BY COLOR 颜色选择 -->
								</section>
								<!-- // PRODUCT FILTER 产品筛选 -->
								
								<!-- 热销商品榜单 -->
								<section class="side-section bg-white">
									<header class="side-section-header">
										<h3 class="side-section-title text-bold">热销商品</h3>
									</header>
									<div class="side-section-content">
										<ul class="product-medialist li-m-t unstyled clearfix">
											<?php if(is_array($hgoods)): foreach($hgoods as $key=>$value): ?><li>
												<div class="item clearfix">
													<a href="__PUBLIC__/Uploads/goods/<?php echo ($value["pic"]); ?>" data-toggle="lightbox" class="entry-thumbnail">
														<img src="__PUBLIC__/Uploads/goods/<?php echo ($value["pic"]); ?>" alt="<?php echo ($value["title"]); ?>" />
													</a>
													<h5 class="entry-title"><a href="__APP__/Products/product/id/<?php echo ($value["id"]); ?>" ><?php echo ($value["gname"]); ?>...</a></h5>
													<h4 class="entry-title">销量： <?php echo ($value["gstotal"]); ?></h4>
													<span class="entry-price accent-color">￥<?php echo ($value["price"]); ?></span>
												</div>
											</li><?php endforeach; endif; ?>
										</ul>
									</div>
								</section>
								<!-- // 热销商品榜单 -->
								
								<!-- 最近上架 -->
								<div class="promo inverse-background" style="background: url('__PUBLIC__/Uploads/goods/<?php echo ($ngoods[0]['pic']); ?>') no-repeat; background-size: 100% auto;">
									<div class="inner text-center np">
										<div class="ribbon">
											<h6 class="nmb">最近上架</h6>
											<div class="space10"></div>
											<h5 class="text-semibold uppercase nmb">
												<?php echo ($ngoods[0]['gname']); ?>
											</h5>
											<div class="space10"></div>
											<a href="__APP__/Products/product/id/<?php echo ($ngoods[0]['id']); ?>" class="with-icon prepend-icon"><i class="iconfont-caret-right"></i><span> 就去购</span></a>
										</div>
									</div>
								</div>
								<!-- // 最近上架 -->
								
							</section>
						</aside>
						<!-- // SIDEBAR 工具条 -->
						<section class="col-xs-12 col-sm-8 col-md-9">
							
							<section class="products-wrapper">
								<!-- DISPLAY MODE - NUMBER OF ITEMS TO BE DISPLAY - PAGINATION 显示模式:待显示的产品数量 / 页码 -->
								<header class="products-header">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-6 center-xs">
											<!-- DISPLAY MODE 显示模式-->
											<ul class="unstyled inline-li li-m-r-l-sm pull-left">
												<li><a class="round-icon active" href="#" data-toggle="tooltip" data-layout="grid" data-title="网格模式"><i class="iconfont-th"></i></a></li>
												<li><a class="round-icon" href="#" data-toggle="tooltip" data-layout="list" data-title="列表模式"><i class="iconfont-list"></i></a></li>
											</ul>
											<!-- // DISPLAY MODE 显示模式-->
											
										</div>
										<div class="space30 visible-xs"></div>
										<!-- PAGINATION 页码 -->

										<div class="col-xs-12 col-sm-12 col-md-6 center-xs">
											<ul class="paginator li-m-r-l pull-right">
											<?php echo ($page); ?>
											</ul>
										</div>
										<script>
											/* 修改上一页、下一页样式 */
											$('.pageico').parent().attr('class', 'round-icon');
											/* 修改当前页样式 */
											$('.current').attr('style', 'color: #FA6F57;');
										</script>
										<!-- // PAGINATION 页码 -->
									</div>
								</header>
								<!-- // DISPLAY MODE - NUMBER OF ITEMS TO BE DISPLAY - PAGINATION  显示模式:待显示的产品数量 / 页码 -->
								
								<!-- PRODUCT LAYOUT 产品布局显示 -->
								<div class="products-layout grid m-t-b add-cart" data-product=".product" data-thumbnail=".entry-media .thumb" data-title=".entry-title > a" data-url=".entry-title > a" data-price=".entry-price > .price">
									
									<!-- data-product-id使用商品id，data-cdategory直接使用所属分类cname -->
									<!-- data-brand，data-price，data-colors，data-size，分别表示品牌，价格，颜色，尺寸，暂时不用 -->
									<!-- 在img中直接输出上传图片的地址即可 -->
									<?php if(is_array($goods)): foreach($goods as $key=>$value): ?><div class="product" data-product-id="<?php echo ($value["id"]); ?>" data-price="<?php echo ($value["price"]); ?>" data-colors="<?php echo ($value["color"]); ?>" data-size="<?php echo ($value["size"]); ?>">
											<div class="entry-media">
											<img data-src="__PUBLIC__/Uploads/goods/<?php echo ($value["pic"]); ?>" alt="" class="lazyLoad thumb" width="400" height="533" />
											<div class="hover">
												<a href="__APP__/Products/product/id/<?php echo ($value["id"]); ?>" class="entry-url"></a>
												<ul class="icons unstyled">
													<!-- 此处采用switch进行判断输出 -->
													<li>
													<?php if($value["tuijian"] == 1): ?><div class="circle ribbon ribbon-sale">热销</div>
													<?php elseif($value["zuixin"] == 1): ?>
														<div class="circle ribbon ribbon-new">新品</div>
													<?php elseif($value["status"] == 3): ?>
														<div class="circle ribbon ribbon-sale">特价</div><?php endif; ?>
													</li>
													<li>
														<!-- 看大图的地址和菜单输出地址相同 -->
														<a href="__PUBLIC__/Uploads/goods/<?php echo ($value["pic"]); ?>" class="circle" data-toggle="lightbox"><i class="iconfont-search"></i></a>
													</li>
													<li>
														<a href="#" class="circle add-to-cart"><i class="iconfont-shopping-cart"></i></a>
													</li>
												</ul>
											</div>
											</div>
											<div class="entry-main">
												<h5 class="entry-title">
													<a href="__APP__/Products/product/id/<?php echo ($value["id"]); ?>"><?php echo ($value["gname"]); ?></a>
												</h5>
												<div class="entry-description visible-list">
													<p><?php echo ($value["gdescription"]); ?></p>
												</div>
												<div class="entry-price">
													<?php if($value["mprice"] > 0): ?><s class="entry-discount">￥ <?php echo ($value["mprice"]); ?></s><?php endif; ?>
													<strong class="accent-color price">￥ <?php echo ($value["price"]); ?></strong>
												</div>
												<div class="entry-links clearfix text-left">
													<span>规格：<?php echo ($value["size"]); ?></span><br/>
													<span>颜色：<?php echo ($value["color"]); ?></span><br/>
												</div>
											</div>
										</div><?php endforeach; endif; ?>
								</div>
								<!-- // PRODUCT LAYOUT 产品布局显示 -->
							</section>
							
						</section>
					</div>
					
				</div>
			</div>
		</main>
		<!-- // SITE MAIN CONTENT 网站主要内容 -->
		<!-- 引入页脚文件 -->
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
<!-- // PAGE WRAPPER 页面封装 -->

<!-- Essential Javascripts 基本的 js 文件 -->
<script src="__PUBLIC__/index/js/minified.js"></script>
<!-- // Essential Javascripts 基本的 js 文件 -->

<!-- Particular Page Javascripts 特定页面的 javascripts -->
<script src="__PUBLIC__/index/js/jquery.nouislider.js"></script>
<script src="__PUBLIC__/index/js/jquery.isotope.min.js"></script>
<script src="__PUBLIC__/index/js/products.js"></script>
<!-- // Particular Page Javascripts 特定页面的 javascripts -->
</body>
</html>