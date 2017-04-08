<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo ($head["shoptitle"]); ?>用户注册</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<!-- Bootstrap不支持IE的兼容模式，此处使IE浏览器运行最新的渲染模式 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- 响应式布局开启视窗控制 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- 页面信息 -->
<meta name="keywords" content="<?php echo ($head["keywords"]); ?>">
<meta name="description" content="<?php echo ($head["description"]); ?>">
<meta name="author" content="四重奏项目组/SC">
<!-- Bootstrap 核心 css 文件-->
<link rel="stylesheet" href="__PUBLIC__/index/dist/css/bootstrap.min.css">
<!-- HTML5 支持性检测.js IE8 支持 HTML5 的元素和媒体查询 -->
<!-- 警告: js文件不工作，通过以下方式查看源文件:// -->
<!--[if lt IE 9]>
	<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
	<script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<!-- jquery 以及 bootstrap 核心 js 文件 -->
<script src="__PUBLIC__/index/js/jquery.min.js"></script>
<script src="__PUBLIC__/index/dist/js/bootstrap.min.js"></script>
<style type="text/css">
	.h40px {
			height: 40px;
		}
	.h12px {
			height: 12px;
		}
	.panel {
			padding: 0;
		}
</style>
</head>
<body style="background-color:#F2C4D8;">
	<header>
		<div class="row" style="background-color:#E2E2E2;padding:0;">
			<a href="__APP__/Index/index"><div class="col-md-offset-1 col-md-4" style="background:url(__PUBLIC__/Uploads/config/<?php echo ($head["logo"]); ?>) no-repeat 0% 45%;height:130px;">
			</div></a>
		</div>
	</header>
	<div class="container">
		<div class="h40px"></div>
		<div class="row">
			<div class="panel panel-danger col-md-offset-2 col-md-8">
				<div class="panel-heading">
					<h3 class="panel-title">欢迎注册韩都衣舍</h3>
				</div>
				<div class="panel-body">
					<p>在注册韩都衣舍用户之前请务必详细阅读《用户注册协议》</p>
				</div>
				<div class="h20px"></div>
				<form class="form-horizontal" action="__URL__/regist" method="post">
					<div class="form-group">
						<label class="col-md-3 control-label" name="username" for="username">用户名</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="username" name="username">
						</div>
						<div class="col-md-5 text-left" id="testUser">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-3 col-md-8" id="errorUser"></div>
					</div>
					<div class="clearfix h12px"></div>
					<div class="form-group">
						<label class="col-md-3 control-label" name="userpwd" for="userpwd">密码</label>
						<div class="col-md-4">
							<input type="password" class="form-control" id="userpwd" name="userpwd">
						</div>
						<div class="col-md-5" id="testPwd">
							<!-- <span>密码由字母和数字组成，不能低于6位</span> -->
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-3 col-md-8" id="errorPwd"></div>
					</div>
					<div class="clearfix h12px"></div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="confirmuserpwd">确认密码</label>
						<div class="col-md-4">
							<input type="password" class="form-control" id="confirmuserpwd" name="confirmuserpwd">
						</div>
						<div class="col-md-5" id="testConfirPwd">
							<!-- <span>必须和密码一致</span> -->
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-3 col-md-8" id="errorConfirPwd"></div>
					</div>
					<div class="clearfix h12px"></div>
					<div class="form-group">
						<label class="col-md-3 control-label" name="email" for="email">email</label>
						<div class="col-md-4">
							<input type="email" class="form-control" id="email" name="email">
						</div>
						<div class="col-md-5" id="testEmail">
							<!-- <span>邮箱必须未被注册</span> -->
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-3 col-md-8" id="errorEmail"></div>
					</div>
					<div class="clearfix h12px"></div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="vcode">验证码</label>
						<div class="col-md-3">
							<input type="text" class="form-control" id="vcode" name="vcode">
						</div>
						<div class="col-md-2">
							<img src="__URL__/verify/" onclick="this.src='__URL__/verify/'+Math.round(new Date().getTime()/1000)" title="看不清楚直接点击验证码更换" alt="验证码" style="width:105px;height:32px;vertical-align:middle;">
						</div>
						<div class="col-md-4" id="testVcode">
							<!-- <span>看不清楚直接点击验证码更换</span> -->
						</div>
					</div>
					<div class="clearfix h12px"></div>
					<div class="form-group">
						<div class="col-md-offset-3 col-md-5">
							<div class="row checkbox">
								<div class="col-md-12">
									<label>
						 				<input type="checkbox" name="allow" id="allow" value="1">我已阅读并同意
						 				<button class="btn btn-link btn-xs" data-toggle="modal" data-target="#myModal">用户注册协议</button>
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel">韩都衣舍用户注册协议</h4>
													</div>
													<div class="modal-body" style="line-height:20px;">
														<h4>欢迎您注册韩都衣舍！</h4>
														<p>特别提示：<br/>
														在使用韩都衣舍之前，您应当认真阅读并遵守《韩都衣舍用户协议》（以下简称“本协议”），请您务必审慎阅读、充分理解各条款内容，特别是免除或者限制责任的条款、争议解决和法律适用条款。
														</p>
														<p>免除或者限制责任的条款可能将以加粗字体显示，您应重点阅读。如您对协议有任何疑问的，应向韩都衣舍客服咨询。
														</p>
														<p>当您按照注册页面提示填写信息、阅读并同意本协议且完成全部注册程序后，或您按照激活页面提示填写信息、阅读并同意本协议且完成全部激活程序后，或您以其他韩都衣舍允许的方式实际使用韩都衣舍时，即表示您已充分阅读、理解并接受本协议的全部内容，并与韩都衣舍平台达成协议。</p>
														<p>您承诺接受并遵守本协议的约定， 届时您不应以未阅读本协议的内容或者未获得韩都衣舍对您问询的解答等理由，主张本协议无效，或要求撤销本协议。</p>

														<ul>
														<li>
														1、本协议由您与韩都衣舍平台的经营者共同缔结，本协议具有合同效力。
														韩都衣舍平台的经营者是指法律认可的经营韩都衣舍平台网站的责任主体，韩都衣舍平台网站包括但不限于韩都衣舍网，本协议项下各韩都衣舍平台的经营者可单称或合称为“韩都衣舍”。有关韩都衣舍平台经营者的信息请查看各韩都衣舍平台首页底部公布的公司信息和证照信息。
														</li>
														<li>
														2、除另行明确声明外，韩都衣舍包含任何韩都衣舍及其关联公司提供的基于互联网以及移动网的相关服务，且均受本协议约束。如果您不同意本协议的约定，您应立即停止注册/激活程序或停止使用韩都衣舍。
														</li>
														<li>3、本协议内容包括协议正文、 法律声明、《韩都衣舍规则》及所有韩都衣舍已经发布或将来可能发布的各类规则、公告或通知（以下合称“韩都衣舍规则”或“规则”）。所有规则为本协议不可分割的组成部分，与协议正文具有同等法律效力。</li>

														<li>4、韩都衣舍有权根据需要不时地制订、修改本协议及/或各类规则，并以网站公示的方式进行变更公告，无需另行单独通知您。变更后的协议和规则一经在网站公布后，立即或在公告明确的特定时间自动生效。若您在前述变更公告后继续使用韩都衣舍的，即表示您已经阅读、理解并接受经修订的协议和规则。若您不同意相关变更，应当立即停止使用韩都衣舍。
														</li>
														</ul>									
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
														<button type="button" class="btn btn-primary" data-dismiss="modal">确认</button>
													</div>
												</div>
											</div>
										</div>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix h12px"></div>
					<div class="form-group">
						<div class="col-md-offset-3 col-md-3">
							<input type="submit" class="btn btn-primary btn-sm" name="sub" id="sub" value="注册">
						</div>
					</div>
				</form>
				<div class="h40px"></div>
			</div>
		</div>
	</div>
	<footer>
		<div class="row" style="background-color:#E2E2E2;padding:0;height:100px;">
			<div class="text-center" style="line-height:100px;">
				<p>© 2013-2014 四重奏项目组 All rights reserved.</p>
			</div>
		</div>
	</footer>
</body>
</html>
<script>
	// 注册表单动态验证
	$(function(){

		// 验证用户名
		$("#username").blur(function(){ 								// 文本框鼠标焦点消失事件

			var reg = /^[a-zA-Z\_]{1}[0-9a-zA-Z\_]{5,19}/;
			var str = $("#username").val();
			if(str=="")
			{
				$("#testUser").html("<font color=red>用户名不能为空!</font>");
				$("#errorUser").html("");
			}
			else if(!reg.test(str))										// 正则判定用户名格式
			{
				$("#testUser").html(str+" <font color=red> 不符合格式!</font>");
				$("#username").val("");
				$("#errorUser").html("<font color=grey>用户名由字母、字母、下划线组成、且不能以数字开头、至少六位、至多20位.</font>");
			}
			else
			{
				// ajax请求数据
				$.ajax({
			   		type: "get",
			   		url: "__URL__/ajaxReg?username="+$("#username").val(),
			   		success: function(msg){
			     		if(msg=='UsernameFalse')
			     		{
			     			$("#testUser").html($("#username").val()+"<font color=red> 已被注册！</font>");
			     			$("#username").val("");
			     			$("#errorUser").html("");
			     		}
			     		if(msg=='UsernameTrue')
			     		{
			     			$("#testUser").html("恭喜您!<font color=blue> "+$("#username").val()+" </font>可以使用!");
			     			$("#errorUser").html("");
			     		}
			   		}
				});
			}
		})
	
		// 密码验证
		$("#userpwd").blur(function(){
			var reg = /^[0-9a-zA-Z]{6,20}/;
			var str = $("#userpwd").val();
			if(str=="")
			{
				$("#testPwd").html("<font color=red>密码不能为空!</font>");
				$("#errorPwd").html("");
			}
			else if(!reg.test(str))										// 正则判定用户名格式
			{
				$("#testPwd").html(" <font color=red>密码不符合格式!</font>");
				$("#userpwd").val("");
				$("#errorPwd").html("<font color=grey>密码由数字和字母组成、至少6位、至多20位.</font>");
			}else{
				$("#testPwd").html("");
				$("#errorPwd").html("");
			}
		})

		// 确认密码验证
		$("#confirmuserpwd").blur(function(){
			var str = $("#confirmuserpwd").val();
			var strp = $("#userpwd").val();
			if(str == "")
			{
				$("#testConfirPwd").html("<font color=red>确认密码不能为空!</font>");
				$("#errorConfirPwd").html("");
			}
			else if(strp == "")
			{
				$("#testConfirPwd").html("<font color=red>密码不能为空!</font>");
			}
			else if(str != strp)										// 正则判定用户名格式
			{
				$("#testConfirPwd").html(" <font color=red>两次密码输入不一致!</font>");
				$("#confirmuserpwd").val("");
			}else{
				$("#testConfirPwd").html("");
			}
		})

		// 邮箱验证
		$("#email").blur(function(){ 									// 文本框鼠标焦点消失事件

			var reg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;
			var str = $("#email").val();
			if(str=="")
			{
				$("#testEmail").html("<font color=red>邮箱不能为空!</font>");
				$("#errorEmail").html("");
			}
			else if(!reg.test(str))										// 正则判定用户名格式
			{
				$("#testEmail").html(str+" <font color=red> 不符合邮箱格式!</font>");
				$("#email").val("");
			}
			else
			{
				// ajax请求数据
				$.ajax({
			   		type: "get",
			   		url: "__URL__/ajaxReg?email="+$("#email").val(),
			   		success: function(msg){
			     		if(msg == 'EmailFalse')
			     		{
			     			$("#testEmail").html($("#email").val()+"<font color=red> 已被使用!</font>");
			     			$("#emai").val("");
			     		}
			     		if(msg == 'EmailTrue')
			     		{
			     			$("#testEmail").html("<font color=blue> "+$("#email").val()+" </font>可以使用!");
			     		}
			   		}
				});
			}
		})

		// 验证码验证
		$("#vcode").blur(function(){ 
			var str = $("#vcode").val();
			if(str=="")
			{
				$("#testVcode").html("<font color=red>请输入验证码!</font>");
			}
			else
			{
				// ajax请求数据
				$.ajax({
			   		type: "get",
			   		url: "__URL__/ajaxReg?vcode="+$("#vcode").val(),
			   		success: function(msg){
			     		if(msg == 'VcodeFalse')
			     		{
			     			$("#testVcode").html("<font color=red>输入错误!</font>");
			     			$("#vcode").val("");
			     		}
			     		if(msg == 'VcodeTrue')
			     		{
			     			$("#testVcode").html("<font color=blue>输入正确!</font>");
			     		}
			   		}
				});
			}
		})

		// 提交数据前验证
		// 各输入框是否为空，是否接收协议 $('input[name="allow"]:checked').val()
		$("#sub").bind("click",function(event){

			// 取得需要检测对象的值	
		   	var stru  = $("#username").val()
		   	var strp  = $("#userpwd").val()
		   	var strcp = $("#confirmuserpwd").val(); 
		   	var stre  = $("#email").val();
		   	var strv  = $("#vcode").val();
		   	var strck = $('input[name="allow"]:checked').val();

		   	// 判断不提交条件
		   	// 所有文本框不能为空、复选框必须被选中

		   	if(stru && strp && strcp && stre && strv && strck){

		   	}
		  	else
		   	{
		   		alert("请将信息填写完整");
		   		// event.preventDefault();  //阻止默认行为 ( 表单提交 )
		   		return false;
		   	}

		})
	})
		// 用户名格式   由字母，数字，下划线组成，至少六位，至多20位，不能以数字开头 
		// var reg = /^[a-zA-Z\_]{1}[0-9a-zA-Z\_]{5,19}/;
		// 密码格式 	由数字和字母组成、且不能以数字开头、至少6位、至多20位,.
		// var reg = /^[a-zA-Z]{1}[0-9a-zA-Z]{5,19}/;
		// 邮箱格式	
		// var reg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;
</script>