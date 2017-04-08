/**
* 注册模块jquery 特效
* 建立时间 2014.1.7 ----wei
* 
*/

	$(function(){

                      $("#username").focus(function(){
                           	this.value="";
                                 $("#checkname").empty();
                           	$("#checkname").append("<font color='red'>*用户名必须大于6个字符</font>");
                      })

                      $("#username").blur(function(){

                        	var username = this.value;
                             	var len = username.length;

                             	if(username == ''){
                                   	$("#checkname").empty();
                                   	$("#checkname").append("<font color='red'>用户名不能为空</font>");
                                   	return false;
                            	}

                           	else if(len < 6){
                                  	$("#checkname").empty();
                                 	$("#checkname").append("<font color='red'>*用户名必须大于6个字符</font>");
                                 	return false;
                            	 }else{

                                  	$.get("../../index.php/Register/checkname/username/"+username,function(data){
                                       	 $("#checkname").empty();
                                        	 $("#checkname").append(data);
                                   },'json')

                             	}    	
                      })
                      $("#userpwd").focus(function(){
                      	this.value="";
                                 $("#checkpwd").empty();
                           	$("#checkpwd").append("<font color='red'>*密码必须大于6个字符</font>");
                           	return false;
                      })

                      $("#userpwd").blur(function(){
                                  var userpwd = this.value;
                                  var len = userpwd.length;

                                  if(len < 6){
                                  	$("#checkpwd").empty();
                                  	$("#checkpwd").append("<font color='red'>*密码必须大于6个字符</font>");
                                  	return false;
                                  }else{
                                  	$("#checkpwd").empty();
                                  	$("#checkpwd").append("<font color='green'>密码设置成功!!!</font>");

                                  }                                                                          
                      })

                      $("#ruserpwd").blur(function(){
                      	var ruserpwd = this.value;
                      	var userpwd = $("#userpwd").val();
                      	if(ruserpwd != userpwd){
                      		$("#checkrpwd").empty();
                      		$("#checkrpwd").append("<font color='red'>两次输入密码不一样,请重新输入密码!!!</font>");
                      	}
                      	else{
                      		$("#checkrpwd").empty();
                      		$("#checkrpwd").append("<font color='green'>设置成功!!!</font>");
                      	}	
                      })

                      $("#email").focus(function(){
                      	$("#checkemail").empty();
                      	$("#checkemail").append("<font color='red'>*email 格式 weiwei@qq.com</font>");
                      })

                      $("#email").blur(function(){
                      	var email = this.value;

                      	$.get("../../index.php/Register/checkemail/email/"+email,function(data){
                      		$("#checkemail").empty();
                      		$("#checkemail").append(data);
                      	},'json')



                      })

                      $(".code").blur(function(){
                                  var code =  this.value;

                                  $.get("../../index.php/Register/checkyan/code/"+code,function(data){
                                          $("#checkcode").empty();
                                          $("#checkcode").append(data);
                                  },'json')
                      })
 })