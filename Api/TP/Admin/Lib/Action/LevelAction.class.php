<?php 
	
	/**
	 * 类名：LevelAction
	 * 功能：判断权限与记录管理员的相关操作
	 */
	class LevelAction extends Action{

		/**
		 * 判断是否已登陆后台
		 */
		function status(){
			if(empty($_SESSION['id'])){
				$this->display('Login/index');exit;
			}
		}

		/**
		 * 功能：管理管理员查看用户列表
		 */
		function listuser(){
			$this->status(); // 调用判断是否登录

			if(!in_array('1',$_SESSION['level'])){ // 判断是否拥有该权限
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log'); // 如果有该权限将其操做写入数据库
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'查看了用户列表';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员修改用户
		 */
		function saveuser(){
			$this->status();

			if(!in_array('2',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'修改了用户'.$_POST['username'];
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员添加用户
		 */
		function adduser(){
			$this->status();

			if(!in_array('3',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'添加了用户';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}


		/**
		 * 功能：管理管理员删除用户
		 */
		function deluser(){
			$this->status();

			if(!in_array('4',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				$user = M('user');
				$username = $user->where(array('id'=>$_GET['id']))->field('username')->find();

				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'删除了用户'.$username['username'];
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员批量删除用户
		 */
		function delsuser(){
			$this->status();

			if(!in_array('1',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				$user = M('user');
				$username = $user->where(array('id'=>$_GET['id']))->field('username')->find();

				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'批量删除了用户';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员查看网站配置
		 */
		function listconfig(){
			$this->status();

			if(!in_array('5',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'查看了网站配置';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员修改网站配置
		 */
		function saveconfig(){
			$this->status();

			if(!in_array('6',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'修改了网站配置';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员查看友情链接
		 */
		function listfriend(){
			$this->status();

			if(!in_array('7',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'查看了友情链接列表';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}
		/**
		 * 功能：管理管理员添加友情链接
		 */
		function addfriend(){
			$this->status();

			if(!in_array('8',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'添加了友情链接'.$_POST['lname'];
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员删除友情链接
		 */
		function delfriend(){
			$this->status();

			if(!in_array('9',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				$link = M('links');
				$linkname = $link->where(array('id'=>$_GET['id']))->find();
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'删除了友情链接'.$linkname['lname'];
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员修改友情链接
		 */
		function savefriend(){
			$this->status();

			if(!in_array('10',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'修改了友情链接'.$_POST['lname'];
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员查看商品列表
		 */
		function listsgoods(){
			$this->status();

			if(!in_array('11',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'查看了商品列表';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}
		
		/**
		 * 功能：管理管理员修改商品
		 */
		function savegoods(){
			$this->status();

			if(!in_array('12',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'修改了商品';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员删除商品
		 */
		function delgoods(){
			$this->status();

			if(!in_array('13',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'删除了商品';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员添加商品
		 */
		function addgoods(){
			$this->status();

			if(!in_array('14',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'添加了商品';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员查看分类列表
		 */
		function listsclass(){
			$this->status();

			if(!in_array('15',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'查看了分类列表';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员修改分类
		 */
		function saveclass(){
			$this->status();

			if(!in_array('16',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'修改了分类';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员删除分类
		 */
		function delclass(){
			$this->status();

			if(!in_array('17',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'删除了分类';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员添加分类
		 */
		function addclass(){
			$this->status();

			if(!in_array('18',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'添加了分类';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员查看商品规格列表
		 */
		function liststype(){
			$this->status();

			if(!in_array('22',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'查看了商品规格列表';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员修改商品规格
		 */
		function savetype(){
			$this->status();

			if(!in_array('21',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'修改了商品规格';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员删除商品规格
		 */
		function deltype(){
			$this->status();

			if(!in_array('20',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'删除了商品规格';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员添加商品规格
		 */
		function addtype(){
			$this->status();

			if(!in_array('19',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'添加了商品规格';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员查看订单列表
		 */
		function listsorder(){
			$this->status();

			if(!in_array('23',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'查看了订单列表';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员修改订单详情
		 */
		function saveorder(){
			$this->status();

			if(!in_array('25',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'修改了订单详情';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员删除订单
		 */
		function delorder(){
			$this->status();

			if(!in_array('24',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'删除了订单';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员查看管理员列表
		 */
		function listsadmin(){
			$this->status();

			if(!in_array('26',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'查看了管理员列表';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}
		
		/**
		 * 功能：管理管理员删除其他管理员
		 */
		function deladmin(){
			$this->status();

			if(!in_array('24',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				$admin = M('user_admin');
				$user = $admin->where(array('id'=>$_GET['id']))->field('username')->find();
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'删除管理员'.$user['username'];
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}
		
		/**
		 * 功能：管理管理员添加管理员
		 */
		function addadmin(){
			$this->status();

			if(!in_array('24',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'添加了管理员';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}
		
		/**
		 * 功能：管理管理员编辑管理员
		 */
		function saveadmin(){
			$this->status();

			if(!in_array('24',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				$admin = M('user_admin');
				$user = $admin->where(array('id'=>$_POST['id']))->field('username')->find();
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'编辑了管理员'.$user['username'];
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员邮件查看
		 */
		function listsmail(){
			$this->status();

			if(!in_array('30',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'查看了邮件模板列表';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员编辑邮件模板
		 */
		function savemail(){
			$this->status();

			if(!in_array('31',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'编辑了邮件模板';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员删除邮件模板
		 */
		function delmail(){
			$this->status();

			if(!in_array('32',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'删除了邮件模板';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}

		/**
		 * 功能：管理管理员增加邮件模板
		 */
		function addmail(){
			$this->status();

			if(!in_array('33',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'增加了邮件模板';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}


		/**
		 * 功能：管理管理员发送邮件
		 */
		function sendmail(){
			$this->status();

			if(!in_array('34',$_SESSION['level'])){
				$this->error('权限不足');exit;
			}else{
				$log = M('admin_log');
				
				$data['userid'] = $_SESSION['id'];
				$data['time'] = time();
				$data['loginfo'] = '管理员'.$_SESSION['username'].'发送了邮件';
				$data['userip'] = $_SERVER['REMOTE_ADDR'];
				$log->add($data);
			}
		}
	}
