<?php
	/**
	 * 
	 */
	class LoginAction extends Action {


		/**
		 * 函数名：
		 * 功能：默认显示登录页面
		 * 
		 */
		public function index() {
			$this->display();
		}

		/**
		 * 函数名：
		 * 功能：登录检测等
		 */
		public function login() {

			// 检测用户名、密码
			// echo '登录验证。。。';
			$admin = M('user_admin');
			$user = $admin->where(array('username'=>$_POST['username'],'userpwd'=>md5($_POST['userpwd'])))->find();
			if(!empty($user)){
			
				$_SESSION['id'] 		= $user['id'];						// 写入管理员id到session
				$_SESSION['level'] 		= $user['level'];					// 写入管理员权限到session
				$_SESSION['level']		= explode(',',$_SESSION['level']);	// 分割管理员权限
				$_SESSION['username'] 	= $user['username'];				// 获取管理员用户名
				$time['logintime'] 		= time();							// 获取当前时间写入数据库
				$admin->where(array('id'=>$user['id']))->save($time);
				// 登录成功，显示后台首页
				$this->redirect('Index/index');
			}else{
				$this->error('验证失败');
			}
		}

		/**
		 * 函数名：
		 * 功能：找回密码
		 */
		public function findpwd(){

			$mail = M('mail_template');
			$con = $mail->where()->find();

			$str = $con['content'];
			eval("\$str = \"$str\";");

			import('ORG.Email');				//导入email类
			$data['mailto'] = $_POST['email'];  //收件人
			$data['subject'] = $con['title'];   //邮件标题
			$data['body'] = $str; 				//邮件正文内容

			$mail = new Email();
			$mail->send($data);
				
		}

		/**
		 * 函数名：
		 * 功能：注销登录，跳转到后台登录页面
		 */
		public function logout() {

			// 注销登录
			unset($_SESSION['username']);
			unset($_SESSION['id']);
			unset($_SESSION['level']);
	
			$this->redirect('index');
		}
	}