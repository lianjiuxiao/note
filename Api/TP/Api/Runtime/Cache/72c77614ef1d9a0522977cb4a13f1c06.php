<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7 lte9 lte8 lte7" lang="en-US"><![endif]-->
<!--[if IE 8]><html class="ie ie8 lte9 lte8" lang="en-US">	<![endif]-->
<!--[if IE 9]><html class="ie ie9 lte9" lang="en-US"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="noIE" lang="en-US"><!--<![endif]-->
<head>
	<title>商品结算</title>
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

	<!-- GENERAL CSS FILES -->
	<link rel="stylesheet" href="__PUBLIC__/index/css/minified.css">
	<!-- // GENERAL CSS FILES -->
	
	<!--[if IE 8]>
		<script src="js/respond.min.js"></script>
		<script src="js/selectivizr-min.js"></script>
	<![endif]-->
	<!--加载自定义的js文件 
	<script src="__PUBLIC__/js/checkout.js"></script>
	<script src="__PUBLIC__/js/ajax2.js"></script>-->
	<script>window.jQuery || document.write('<script src="__PUBLIC__/index/js/jquery.min.js"><\/script>');</script>
	<script src="__PUBLIC__/index/js/modernizr.min.js"></script>	

	<!-- PARTICULAR PAGES CSS FILES -->
	<link rel="stylesheet" href="__PUBLIC__/index/css/innerpage.css">
	<!-- // PARTICULAR PAGES CSS FILES -->
	<link rel="stylesheet" href="__PUBLIC__/index/css/responsive.css">
</head>
<body>
<script>
		$(function(){
			var session = $("#session").val();
			if(session){
					$("#unlogin").show();
					$("#islogin").hide();
			}else{
				   $("#unlogin").hide();
			}
			
			$("#cart_update").click(function(){
					var url = "__APP__/Cart/cart";
					location.href = url;
			})

			$("#qiehuan").click(function(){

						var flag = 0;

						if(flag == 0){
								$("#dizhi").slideToggle(600);
								$("#dizhi2").slideToggle(600);
						}else{
								$("#dizhi").slideToggle(600);
								$("#dizhi2").slideToggle(600);
						}
			})

			$('#saveaddr').click(function(){
 					  var flag1 = 0;
 					  //$("input[name='newsletter']").attr("checked", true);
					  var id = $(".zdizhi:checked").val();

						if(flag1 == 0){
								$("#dizhi2").toggle(1000);
								$("#dizhi").toggle(1000);
						}else{
								$("#dizhi2").toggle(1000);
								$("#dizhi").toggle(1000);
						}

						//如果存在
						if(id){
							  var url = "__URL__/getaddr/id/"+id;

								$.get(url,function(data){
								var receiver = data.receiver;
								var province = data.province1;
								var city = data.city1;
								var area = data.area1;
								var street = data.street;
								var email = data.email;
								var tel = data.tel;
								var mobile = data.mobile;
							   var postcode = data.postcode;

							   $("#mreceiver").val(receiver);
							   $("#maddr").val(province+city+area+street);
							   $("#memail").val(email);
							   $("#mtel").val(tel);
							   $("#mmobile").val(mobile);
							   $("#mpostcode").val(postcode);
							  },'json');

								//改变shuoid的值
								$("input[name='shouid']").val(id);
							 
						}else{
								var receiver = $("#receiver").val();
							   var province = $("#province").val();
								var city = $("#city").val();
								var area = $("#area").val();
								var street = $("#street").val();
								var email = $("#email").val();
								var tel = $("#tel").val();
								var mobile = $("#mobile").val();
							   var postcode = $("#postcode").val();

							  var url = "__URL__/addaddr";

								$.get(url,{receiver:receiver,province:province,city:city,area:area,street:street,email:email,tel:tel,mobile:mobile,postcode:postcode},function(data){
												  var id = data;
												  var url = "__URL__/getaddr/id/"+id;

													$.get(url,function(data){
																var receiver = data.receiver;
																var province = data.province1;
																var city = data.city1;
																var area = data.area1;
																var street = data.street;
																var email = data.email;
																var tel = data.tel;
																var mobile = data.mobile;
															   var postcode = data.postcode;

															   $("#mreceiver").val(receiver);
															   $("#maddr").val(province+city+area+street);
															   $("#memail").val(email);
															   $("#mtel").val(tel);
															   $("#mmobile").val(mobile);
															   $("#mpostcode").val(postcode);
												  },'json');

													$("input[name='shouid']").val(id);
					 			});
						}	
							   
						

						
			});

			$(".zdizhi").click(function(){
	
						var id = $(this).val();
						var url = "__URL__/getaddr/id/"+id;

						$("#receiver").attr("disabled",true);
					   $("#street").attr("disabled",true);
					   $("#email").attr("disabled",true);
					   $("#tel").attr("disabled",true);
					   $("#mobile").attr("disabled",true);
					   $("#postcode").attr("disabled",true);
						$("#province").attr("disabled",true);
						//隐藏
						$("#city").attr("disabled",true);
					   $("#area").attr("disabled",true);

						$.get(url,function(data){
								var receiver = data.receiver;
								var province = data.province1;
								var city = data.city1;
								var area = data.area1;
								var street = data.street;
								var email = data.email;
								var tel = data.tel;
								var mobile = data.mobile;
							   var postcode = data.postcode;

							   $("#receiver").val(receiver);
							   //$("ul li:first-child")
							   //$("select option:selected")
							   $("#province option:selected").html(province);
							   $("#city option:selected").html(city);
							   $("#area option:selected").html(area);
							   $("#street").val(street);
							   $("#email").val(email);
							   $("#tel").val(tel);
							   $("#mobile").val(mobile);
							   $("#postcode").val(postcode);

						},'json');

			})

			//地址省份province
			//获取市
			$("#province").change(function(){

				    var region_id = $(this).val();
				    var url = "__URL__/getcity/region_id/"+region_id;
					 $("#city").empty();
					 $("#area").empty();
				    var obj = $(this);
					 $.get(url,function(data){
					 				for(var i in data){
					 			
					 						$("#city").append('<option value="'+data[i].region_id+'">'+data[i].region_name+'</option>');
					 				}
							
					 },'json');
			})

			$("#city").change(function(){
				
				    var region_id = $(this).val();
				    var url = "__URL__/getarea/region_id/"+region_id;
				    var obj = $(this);
					 $.get(url,function(data){
					 				for(var i in data){
					 						
					 						$("#area").append('<option value="'+data[i].region_id+'">'+data[i].region_name+'</option>');
					 				}
							
					 },'json');
			})

			$("#zdizhi2").click(function(){
						$("#receiver").val("");
					   $("#street").val("");
					   $("#email").val("");
					   $("#tel").val("");
					   $("#mobile").val("");
					   $("#postcode").val("");

					   $("#receiver").attr("disabled",false);
					   $("#street").attr("disabled",false);
					   $("#email").attr("disabled",false);
					   $("#tel").attr("disabled",false);
					   $("#mobile").attr("disabled",false);
					   $("#postcode").attr("disabled",false);


					   $("#province").attr("disabled",false);
					   $("#city").attr("disabled",false);
					   $("#area").attr("disabled",false);
			
			})

			//未登录用户点击 继续
			//转为注册或者登录
			$("#userregister").click(function(){
					if($('input:radio[name="customer"]:checked').val() == 'login')
					{
						var url = "__APP__/Login/login";
					}
					else
					{
						var url = "__APP__/Register/register";
					}
					location.href = url;
			})

			//用户登录
			$("#userlogin").click(function(){
					 
					 var username = $("#username").val();
					 var userpwd = $("#userpwd").val();
					 $.ajax({
			   			type: "get",
			   			url: "__APP__/Login/loginVerify/username/"+username+"/userpwd/"+userpwd,
			   			success: function(msg){ 
			   				location.href = window.location.href ;
			   			}
				})
					
					 
			})

			//支付方式paymethod

			$(".peisong").click(function(){

					var id = $(this).val();
					var url = "__URL__/peisong/id/"+id;

					$.get(url,function(data){

								var yunfei = data.yunfei;
								$(".peisongfei").html(yunfei);
								var atotalprice = $(".atotalprice").html();
								var count= atotalprice*1+1*yunfei;
								$(".atotalprice").html(count);
							
					},'json');
			})

		})		
</script>
			
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
	
		<!-- BREADCRUMB -->
		<div class="breadcrumb-container">
			<div class="container">
				<div class="relative">
					<ul class="bc unstyled clearfix">
						<li><a href="#">首页</a></li>
						<li class="active">结算中心</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- // BREADCRUMB -->

		<!-- SITE MAIN CONTENT -->
		<main id="main-content" role="main">
		
			<div class="container">
				<div class="row">
					
					<div class="m-t-b clearfix">
						<!-- SIDEBAR -->
						<aside class="col-xs-12 col-sm-4 col-md-3">
							<section class="side-section">
								<h3 class="uppercase text-bold"><span class="text-xs">站内地图</span></h3>
								
								<ul class="nav nav-tabs nav-stacked">
									<li><a href="__APP__">店铺首页</a></li>															
									<li><a href="">关于店铺</a></li>															
									<li><a href="__APP__/Products/products/sale/3">近期活动</a></li>															
									<li><a href="__APP__/Products/products/all">商品列表</a></li>															
									<li><a href="">联系我们</a></li>															
								</ul>
							</section>
								
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
						</aside>
						<!-- // SIDEBAR -->

						<form action="__APP__/Pay/index" method="post">
						<section class="col-xs-12 col-sm-8 col-md-9">
							<div class="panel-group checkout" id="checkout-collapse">
								<div class="panel panel-default" id="islogin">
									<div class="panel-heading">
										<h4 class="panel-title"><a data-toggle="collapse" data-parent="#checkout-collapse" href="#checkout-collapse1"><span class="step">01</span>个人信息</a></h4>
									</div>
									<div id="checkout-collapse1" class="panel-collapse collapse in">
										<div class="panel-body">
											<div class="row">
												<div class="col-xs-12 col-sm-6">
														<fieldset>
															<legend class="title">如果你是新买家</legend>
															<div class="inner">
																<p>请选择以下选项：</p>
																<div class="form-account">
																	<div class="radio">
																		<input type="radio" name="customer" id="radio-register" class="prettyCheckable" value="regesiter" checked="checked" data-label="注册本站会员" />
																	</div>
																	<div class="radio">
																		<input type="radio" name="customer" id="radio-login" class="prettyCheckable" value="login" data-label="使用第三方登录" />
																	</div>
																</div>
																<p class="light-color">亲!<br/>注册韩都衣舍用户购买商品有更多的优惠哦!</p>
																<div class="space20 clearfix"></div>
																<input type="hidden" value="checkout" name="checkout">
																<input type="button" class="btn btn-default btn-round uppercase padder" id="userregister" value="继续">
															</div>
														</fieldset>
												</div>
												<div class="space40 visible-xs"></div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-horizontal">
														<fieldset>
															<legend class="title">已注册会员</legend>
															<div class="inner">
																<p>请输入用户名和密码登录</p>
																<div class="form-login">
																	<div class="form-group stylish-input">
																		<label for="inputEmail" class="col-xs-12 col-sm-3 control-label required">用户名：</label>
																		<div class="col-lg-7">
																			<input type="text" class="form-control" id="username">
																		</div>
																	</div>
																	<div class="form-group stylish-input">
																		<label for="inputPassword" class="col-xs-12 col-sm-3 control-label required">密码：</label>
																		<div class="col-lg-7">
																			<input type="password" class="form-control" id="userpwd">
																			<a href="__APP__/Personal/center" class="help-block">忘记密码？</a>
																		</div>
																	</div>
																</div>
																	<input type="button" id="userlogin" class="btn btn-primary btn-round padder" value="登录"/>
															</div>
														</fieldset>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
				
						<div class="unlogin" id="unlogin">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#checkout-collapse" href="#checkout-collapse2">
												<span class="step">02</span>
												商品列表（描述、小计等）
											</a>
										</h4>
									</div>
									<div id="checkout-collapse2" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="form-horizontal" role="form">
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-6" style="width:800px;">
														<table border="1" width="800">	
															<tr>
																<th>商品名称</th>
																<th>商品图片</th>
																<th>商品属性</th>
																<th>市场价</th>
																<th>本店价	</th>
																<th>购买数量</th>
																<th>小计</th>
															</tr>
									
															<?php if(is_array($gdata)): foreach($gdata as $key=>$vo): ?><!--商品id-->
																<input type="hidden" name="goodid[]" value="<?php echo ($vo["id"]); ?>">						
																<!--货品id-->
																<input type="hidden" name="guigeid[]" value="<?php echo ($vo["gtypeid"]); ?>">
																<!--商品货品的数量-->	
																<input type="hidden" name="addnum[]" value="<?php echo ($vo["addnum"]); ?>">
																<!--商品货品的价格-->	
																<input type="hidden" name="price[]" value="<?php echo ($vo["price"]); ?>">
																<!--商品货品的小计-->
																<input type="hidden" name="xiaoji[]" value="<?php echo ($vo['price']*$vo['addnum']); ?>">
		
																	<tr>
																     <td><a href="__APP__/Products/product/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["gname"]); ?> </td>
																     <td><a href="__APP__/Products/product/id/<?php echo ($vo["id"]); ?>"><img src="__PUBLIC__/Uploads/goods/<?php echo ($vo["pic"]); ?>" width="50"/></a></td>
																     <td></td>
																     <td><?php echo ($vo["mprice"]); ?></td>
																     <td><?php echo ($vo["price"]); ?></td>
																     <td><?php echo ($vo["addnum"]); ?></td>
																     <td><?php echo ($vo['price']*$vo['addnum']); ?></td>
																	</tr><?php endforeach; endif; ?>
														</table>

														 <!-- 提交表单商品信息开始 -->
														 <!-- 购物车购买的商品总数量-->																
														 <!-- 提交表单商品信息结束 -->
													</div>
												</div>
								
												<input type="button" class="btn btn-primary" id="cart_update" title="去购物车重新选择" value="修改"/>
											</div>
										</div>
									</div>
								</div>


								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#checkout-collapse" href="#checkout-collapse3">
												<span class="step">03</span>
												收货人信息
											</a>
										</h4>
									</div>
									<div id="checkout-collapse3" class="panel-collapse collapse">

									<!-- 收货人主体部分开始-->
										<div class="panel-body" id="dizhi" style='display:block;'>
											<div class="form-horizontal" role="form">
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-6">
														<div class="form-group stylish-input">
															<label for="inputFirstname" class="col-sm-4 col-lg-4 control-label required">姓名</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="mreceiver" value="<?php echo ($madata["receiver"]); ?>" style="width:400px;" readonly/>
															</div>
														</div>
														<div class="form-group stylish-input">
															<label for="inputLastname" class="col-sm-4 col-lg-4 control-label required">地址</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="maddr" value="<?php echo ($madata["province1"]); echo ($madata["city1"]); echo ($madata["area1"]); echo ($madata["street1"]); ?>"  style="width:400px;" readonly/>
															</div>
														</div>

														<div class="form-group stylish-input">
															<label for="inputEmail2" class="col-sm-4 col-lg-4 control-label required">E-Mail</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="memail" value="<?php echo ($madata["email"]); ?>"  style="width:400px;" readonly/>
															</div>
														</div>
														
														<div class="form-group stylish-input">
															<label for="inputPhone" class="col-sm-4 col-lg-4 control-label required">电话号码</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="mtel" value="<?php echo ($madata["tel"]); ?>" style="width:400px;" readonly/>
															</div>
														</div>
														<div class="form-group stylish-input">
															<label for="inputFax" class="col-sm-4 col-lg-4 control-label">手机号</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="mmobile" value="<?php echo ($madata["mobile"]); ?>" style="width:400px;" readonly/>
															</div>
														</div>
														<div class="form-group stylish-input">
															<label for="inputCompany" class="col-sm-4 col-lg-4 control-label">邮编</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="mpostcode" value="<?php echo ($madata["postcode"]); ?>" style="width:400px;" readonly/>
															</div>
														</div>
													</div>
												</div>
												<div class="space20 clearfix"></div>
												<input type="button" class="btn btn-primary" title="修改默认收货地址" id="qiehuan" value="修改"/>
											</div>
										</div>

										 <!-- 提交表单收获人信息开始 -->	
										 <input type="hidden" id="session" value="<?php echo (session('uid')); ?>"/>
										 <!-- 收货人id-->
										 <input type="hidden" name="shouid" value="<?php echo ($madata["id"]); ?>"/>
										 <!-- 收货人id-->
										 <input type="hidden" name="buynum" value="<?php echo ($tongji["totalnum"]); ?>"/>
										 <input type="hidden" name="totalprice" value="<?php echo ($tongji["totalprice"]); ?>"/>
										 
										 <!-- 提交表单收货人信息结束 -->

										<!--收货表单信息 开始-->
										 <div class="panel-body" id='dizhi2' style="display:none">
										 <!-- 常用收货地址开始 -->
										   <div class="prompt_4 m_10" >
													<strong>常用收货地址</strong>
													<ul class="addr_list" style="list-style:none">
														<?php if(is_array($adata)): foreach($adata as $key=>$row): ?><li>
																	<label>
																	<input  class="zdizhi" name="addr" type="radio" value="<?php echo ($row["id"]); ?>" <?php if($row["isdefault"] == 1): ?>checked<?php endif; ?>/>
																	<?php echo ($row["receiver"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($row["province1"]); ?> <?php echo ($row["city1"]); ?> <?php echo ($row["area1"]); ?> <?php echo ($row["street"]); ?>
																	</label>
																</li><?php endforeach; endif; ?>
														     <li>
															<label><input type='radio' name="addr" id="zdizhi2" value='' />其他收货地址</label>
														    </li>
													</ul>
												</div>

											<!-- 常用收货地址结束 -->
											<div class="form-horizontal" role="form">
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-6">
												<div class="form-group stylish-input" style="width:620px;">
															<label for="inputFirstname" class="col-sm-4 col-lg-4 control-label required">姓名</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="receiver" value="<?php echo ($madata["receiver"]); ?>" name="receiver" disabled/>
															</div>
												</div>

												<div class="form-group stylish-input" style="width:620px;">
													<label for="inputFirstname" class="col-sm-4 col-lg-4 control-label required">省份</label>
													<div class="col-sm-8 col-lg-8">
								
														<select id="province" name="province" style="width:100px;border:#CCCCCC 1px solid;" disabled>
															<?php if(is_array($prodata)): foreach($prodata as $key=>$vo): ?><option value="<?php echo ($vo["region_id"]); ?>" <?php if($vo['region_id'] == $madata['province']): ?>selected<?php endif; ?>><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; ?>
													 </select>

														<select  id="city" name="city" style="width:130px;border:#CCCCCC 1px solid;" disabled>
																<option value="<?php echo ($madata["city"]); ?>"><?php echo ($madata["city1"]); ?></option>
														</select>

														<select id="area" style="width:145px;border:#CCCCCC 1px solid;" disabled>
																<option  value="<?php echo ($madata["area"]); ?>"><?php echo ($madata["area1"]); ?></option>
														</select>
													</div>
												</div>

													<div class="form-group stylish-input" style="width:620px;">
															<label for="inputEmail2" class="col-sm-4 col-lg-4 control-label required">街道</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="street" value="<?php echo ($madata["street"]); ?>" disabled/>
															</div>
														</div>
												
														<div class="form-group stylish-input" style="width:620px;">
															<label for="inputEmail2" class="col-sm-4 col-lg-4 control-label required">E-Mail</label>
															<div class="col-sm-8 col-lg-8">
																<input type="email" class="form-control" id="email" value="<?php echo ($madata["email"]); ?>" disabled/>
															</div>
														</div>

														<div class="form-group stylish-input" style="width:620px;">
															<label for="inputPhone" class="col-sm-4 col-lg-4 control-label required">电话号码</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="tel" value="<?php echo ($madata["tel"]); ?>" disabled/>
															</div>
														</div>
														<div class="form-group stylish-input" style="width:620px;">
															<label for="inputFax" class="col-sm-4 col-lg-4 control-label">手机号</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="mobile" value="<?php echo ($madata["mobile"]); ?>" disabled/>
															</div>
														</div>
														<div class="form-group stylish-input" style="width:620px;">
															<label for="inputCompany" class="col-sm-4 col-lg-4 control-label">邮编</label>
															<div class="col-sm-8 col-lg-8">
																<input type="text" class="form-control" id="postcode" value="<?php echo ($madata["postcode"]); ?>" disabled/>
															</div>
														</div>
													</div>
											
												</div>
												<div class="space20 clearfix"></div>
												<button type="button" class="btn btn-primary" title="修改默认收货地址" id="saveaddr">保存收货人地址</button>
											</div>
										</div>
										<!--收货表单信息 结束-->									
						<!-- 收货人主体部分结束-->
								</div>
							</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#checkout-collapse" href="#checkout-collapse4">
												<span class="step">04</span>
												支付方式
											</a>
										</h4>
									</div>
									<div id="checkout-collapse4" class="panel-collapse collapse">
										<div class="panel-body">
										<table border="1" width="">
											<div class="paymethod" role="form">
												<tr>
												<th width="100">名称</th>
												<th width="100">图像</th>
												<th>描述</th>
												</tr>
												<?php if(is_array($pdata)): foreach($pdata as $key=>$vo): ?><tr>
												<div class="form-group stylish-input">
													<td>
													<input type="radio" class="prettyCheckable" name="deliverymethod" data-label="<?php echo ($vo["name"]); ?>" value="<?php echo ($vo["id"]); ?>" <?php if($vo["id"] == 1): ?>checked<?php endif; ?>/>
													</td>
													<td><img src="__PUBLIC__/Uploads/pays/<?php echo ($vo["pay_logo"]); ?>" width="60"></td>
													<td>
													<p><?php echo ($vo["descr"]); ?></p>
													</td>
												</div>
												</tr><?php endforeach; endif; ?>
												
											</div>
											</table>
										</div>
									</div>
								</div>
	
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#checkout-collapse" href="#checkout-collapse5">
												<span class="step">05</span>
												物流和配送方式
											</a>
										</h4>
									</div>
									<div id="checkout-collapse5" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="paymethod" role="form">
											<table border="1">
														<tr>
														<th width="300">配送名称</th>
														<th>描述</th>
														</tr>
											  <?php if(is_array($ddata)): foreach($ddata as $key=>$row): ?><div class="form-group stylish-input">
													<tr>
														<td>
															<input type="radio" class="peisong" name="paymethod" value="<?php echo ($row["id"]); ?>" <?php if($row["id"] == 2): ?>checked<?php endif; ?>/>
															<?php echo ($row["name"]); ?>
														</td>
														<td>
															<?php echo ($row["description"]); ?>
														</td>
													</tr>
												</div><?php endforeach; endif; ?>
												</table>
											</div>
										</div>
									</div>
								</div>

								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#checkout-collapse" href="#checkout-collapse6">
												<span class="step">06</span>
												订单留言
											</a>
										</h4>
									</div>
									<div id="checkout-collapse6" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="paymethod" role="form">
						
												<div class="form-group stylish-input">
													订单附言:<input type="text" name="uremark" size="50"/>
												</div>

											</div>
										</div>
									</div>
								</div>

								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#checkout-collapse" href="#checkout-collapse7">
												<span class="step">07</span>
												结算信息
											</a>
										</h4>
									</div>
									<div id="checkout-collapse7" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-xs-12 col-sm-6 pull-right center-sm">
													<table class="shop-summary">
														<tr>
															<th>小计：</th>
															<td>￥<?php echo ($tongji["totalprice"]); ?></td>
														</tr>
														<tr>
															<th>配送费用 (+<font class="peisongfei">11.00</font>)：</th>
															<td>￥<font class="peisongfei">11.00</font></td>
														</tr>
														<tr class="total">
															<th>应付金额：</th>
															<td >￥<?php echo ($tongji['totalprice']); ?>+<font class="peisongfei">11.00</font></td>
														</tr>
														<tr>
															<th>				
															<input type="submit" class="btn btn-default btn-round uppercase" value="确认，提交订单"/>
															</th>
															<td>
															<a href="#" class="btn btn-primary btn-round uppercase">继续购物</a>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							</div>

						</section>
						</form>
						
					</div>
				
				</div>
			</div>
		
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

<!-- Essential Javascripts -->
<script src="__PUBLIC__/index/js/minified.js"></script>
<!-- // Essential Javascripts -->

<!-- Particular Page Javascripts -->
<script src="__PUBLIC__/index/js/products.js"></script>
<!-- // Particular Page Javascripts -->
</body>
</html>