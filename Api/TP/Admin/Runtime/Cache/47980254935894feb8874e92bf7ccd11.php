<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <title>Unicorn Admin</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="__PUBLIC__/admin/css/bootstrap.min.css" />
        <link rel="stylesheet" href="__PUBLIC__/admin/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="__PUBLIC__/admin/css/unicorn.login.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <body>
        <!-- logot图片 -->
        <div id="logo">
            <img src="__PUBLIC__/admin/img/logo.png" alt="" />
        </div>
        <!-- 登录框 -->
        <div id="loginbox">  
            <!-- 登录表单 开始 -->         
            <form id="loginform" class="form-vertical" action="__APP__/Login/login" method="post" />
                <p>请输入用户名、密码继续</p>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" name="username" placeholder="用户名" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" name="userpwd" placeholder="密码" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link" id="to-recover">忘记密码？</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-inverse" value="登录" /></span>
                </div>
            </form>
            <!-- 登录表单 结束 -->
            <!-- 找回密码表单 开始 -->
            <form id="recoverform" action="__URL__/findpwd" method="post" class="form-vertical" />
                <p>请在下方输入您的邮箱地址，随后我们将发送一封邮件告诉你如何继续操作！</p>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="您的邮箱地址" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link" id="to-login">&lt; 返回继续登录</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-inverse" value="找回" /></span>
                </div>
            </form>
            <!-- 找回密码表单 结束 -->
        </div>
        
        <script src="__PUBLIC__/admin/js/jquery.min.js"></script>  
        <script src="__PUBLIC__/admin/js/unicorn.login.js"></script> 
    </body>
</html>