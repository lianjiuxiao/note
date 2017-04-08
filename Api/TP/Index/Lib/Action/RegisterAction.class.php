<?php
	// +----------------------------------------------------------------------
	// | MSS V1.0 [ 模版商铺系统 ]
	// +----------------------------------------------------------------------
	// | Copyright (c) 2013-2014 四重奏项目组 All rights reserved.
	// +----------------------------------------------------------------------
	// | Licensed SunChi/LAMP兄弟连
	// +----------------------------------------------------------------------
	// | Author: SC
	// | Date:   1/13/2014 14:32
	// +----------------------------------------------------------------------
	// | Author: GX
	// | Date:   1/15/2014 14:32
	// +----------------------------------------------------------------------
	/**
	* 类名：RegisterAction
	* 功能：实现注册以及注册需要的验证跳转操作
	*/
class RegisterAction extends Action{
		public function register(){
			R('Base/header');
			R('Base/footer');
			$this->display();
		}
	
		/**
		 * 函数名：regist
		 * 功能：用户注册方法
		 * @return [type] [description]
		 */
		function regist(){
			
			$user = M('user');
			$info = M('userinfo');

			// $uname = $user->where(array('username'=>$_POST['username']))->field('username')->find(); // 查询用户名是否被注册
			// $uemail = $user->where(array('email'=>$_POST['email']))->field('email')->find(); // 查询邮箱是否被注册
			// if(empty($uname) && empty($uemail)){

				$_POST['userpwd'] = md5($_POST['userpwd']);
				$_POST['ustatus'] = 2;
				$_POST['regtime'] = time();
				$_POST['regip'] = $_SERVER['REMOTE_ADDR']; 			// 获取ip地址

				$id = $user->add($_POST);                           // 注册user表
				$data['uid'] = $id; 								// 获取用户id
				
				if($id && $info->add($data)){ 						// 注册userinfo表

					$email = M('mail_template');
					$con   = $email->where(array('id'=>1))->find();// 查询邮件模板

					$username = $_POST['username'];                // 发送邮件时的显示的用户名
					$jm = md5($_POST['email']);                    // 邮箱加密验证
					$u = $id;                                      // 用户id

					$str = $con['content'];
					eval("\$str = \"$str\";");                     // 执行邮件模板保证变量正确解析

					import('ORG.Email');                           //导入email类
					$mail = new Email();                           // 实例化email类
					$data['mailto'] = $_POST['email'];             //收件人
					$data['subject'] = $con['title'];              //邮件标题
					$data['body'] = $str;                          //邮件正文内容

					if($mail->send($data)){                        // 判断是否发送成功
						$this->success('注册成功','__APP__/Login/login');
					}else{
						$this->success('注册成功,但发送激活邮件失败','__APP__/Login/login');
					}
				}else{
					$this->error('注册失败');
				}
			// }else{

			// 	$this->error('当前用户名与邮箱已被注册');
			// }
		}

		/**
		 * 函数名：Act
		 * 功能：用户激活URL地址
		 */
		function Act(){

			$user = M('user');
			
			$id = intval($_GET['u']);                                                 // 获取用户的id
			$email = trim($_GET['e']);                                                // 获取MD5加密信息
			$data['ustatus'] = 1;                                                     // 将用户的状态改为正常登陆

			$e = $user->where(array('id'=>$id,'ustatus'=>2))->field('email')->find(); // 查询用户邮箱地址

			if(md5($e['email']) == $email && !empty($e)){                             // 判断加密信息是否正确
				if($user->where(array('id'=>$_GET['u']))->save($data)){
					$this->success('激活成功','__APP__/Index/index');
				}else{
					$this->error('激活失败');
				}
			}else{
				$this->error('参数错误');
			}
		}


		/**
		 * 函数名：verify
		 * 功能：产生验证码
		 */
		function verify(){
   			import("ORG.Util.Image");
    		Image::buildImageVerify(4,1);
		}


		/**
		 * 函数名：ajaxReg
		 * 功能：ajax验证注册数据
		 */
		Public function ajaxReg(){

			$username = trim($_GET['username']);
			$email = trim($_GET['email']);
			$vcode = trim($_GET['vcode']);
			$user = M('user');

			// 用户名验证
			if(!empty($username)){
				
				$condition['username'] = $username;
				$result = $user->where($condition)->find();

				// 如果返回的有数据说明此用户名已存在
				if(count($result)){
					$this->ajaxReturn("UsernameFalse");				
				}else{
					$this->ajaxReturn("UsernameTrue"); 					
				}
				unset($condition);

			}elseif(!empty($email)){

				// 邮箱验证
				$condition['email'] = $email;
				$result = $user->where($condition)->find();

				// 如果返回的有数据说明此邮箱已注册
				if(count($result)){
					$this->ajaxReturn("EmailFalse");				
				}else{
					$this->ajaxReturn("EmailTrue"); 					
				}
				unset($condition);

			}elseif(!empty($vcode)){

				// 注册码验证
				if($_SESSION['verify'] == md5($vcode)) {
   					$this->ajaxReturn("VcodeTrue");
				}else{
					$this->ajaxReturn("VcodeFalse");
				}
			}
		}
	}