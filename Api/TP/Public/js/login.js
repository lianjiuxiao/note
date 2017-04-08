/**
* 登录模块jquery 特效
* 建立时间 2014.1.7 ----wei
* 
*/
$(function(){
                      $("#username").focus(function(){
                        	this.value="";
                            $("#checkuser").empty();
                            $("#checkuser").append("<font color='red'>*用户名必须大于6个字符</font>");
                      })

                      $("#username").blur(function(){
                        	var name = this.value;
                             var len = name.length;

                             if(name == ''){
                                   $("#checkuser").empty();
                                   $("#checkuser").append("<font color='red'>用户名不能为空</font>");
                                   return false;
                             }
                             if(len < 6){
                                  $("#checkuser").empty();
                                  $("#checkuser").append("<font color='red'>*用户名必须大于6个字符</font>");
                             }else{
                                  $.get("../../index.php/Login/checkuser/username/"+name,function(data){

                                        $("#checkuser").empty();
                                        $("#checkuser").append(data);
                                   },'json')

                             }    	
                      })

                      $("#userpwd").blur(function(){
                                  var username = $("#username").val();
                                  var userpwd = this.value;
                                  $("#checkpwd").empty();
                     
                                  $.get("../../index.php/Login/checkpwd/username/"+username+"/userpwd/"+userpwd,function(data){
                                        $("#checkpwd").empty();
                                        $("#checkpwd").append("<font color='red'>"+data+"</font>");
                                   },'json')
                                              
                      })

                      $(".code").blur(function(){
                                  var code =  this.value;
        
                                  $.get("../../index.php/Login/checkyan/code/"+code,function(data){
                                          $("#checkcode").empty();
                                          $("#checkcode").append(data);
                                  },'json')
                      })
 })