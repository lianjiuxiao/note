<?php 

	/**
	 * 类名：AuserAction.class.php
	 * 功能：对管理员的操作
	 */
	class AuserAction extends Action{

		/**
		 * 函数名：lists
		 * 功能：显示管理员列表
		 */
		function lists(){

			R('Level/listsadmin'); // 验证权限
			$admin = M('user_admin');

			$this->assign('data',$admin->select()); // 将查询到的管理员数据传给模板
			$this->display();
		}

		/**
		 * 函数名：add
		 * 功能：调用添加管理员页面
		 */
		function add(){

			$status = M('user_status');
			$this->assign('data',$status->select()); // 将查询到的权限传给模板
			$this->display();
		}

		/**
		 * 函数名：inse
		 * 功能：插入管理员
		 */
		function inse(){


			R('Level/addadmin'); // 验证权限
			$admin = M('user_admin');

			$_POST['userpwd'] = md5($_POST['userpwd']);   // MD5加密密码
			$_POST['level'] = join(',',$_POST['status']); // 拼接传过来的权限值
			$_POST['addtime'] = time();					  // 设置注册时间
			$_POST['logintime'] = 0;

			if($admin->add($_POST)){
				$this->success('添加成功','lists');
			}else{
				$this->error('添加失败');
			}
		}

		/**
		 * 函数名：upda
		 * 功能：调用修改管理员页面
		 * @param  int $id 管理员id
		 */
		function upda($id){

			$id = intval($id);

			$admin = M('user_admin');
			$status = M('user_status');

			$data = $admin->where(array('id'=>$id))->find(); // 根据用户id查询用户信息
			$statuc = $status->select(); 					 // 查询权限信息
			$static = explode(',',$data['level']);			 // 分割用户的权限至数组
			$i = 0;

			// 遍历数组判断是否拥有该权限并添加一个checked属性
			foreach($statuc as $v){
				foreach($v as $key => $row){
					if($key == 'status'){
						if(in_array($row,$static)){
							
							$statuc[$i]['checked'] = 'checked';
						}
					}
				}
				$i++;
			}

			$this->assign('data',$statuc);
			$this->assign('u',$data);
			$this->display();
		}

		/**
		 * 函数名：edit
		 * 功能：修改管理员资料
		 * @param  int $id 管理员id
		 */
		function edit(){


			R('Level/saveadmin'); // 验证权限
			$id = intval($_POST['id']);

			$admin = M('user_admin');

			if(empty($_POST['userpwd'])){ 						// 判断是否修改了密码
				unset($_POST['userpwd']);
			}else{
				$_POST['userpwd'] = md5($_POST['userpwd']);
			}
			
			$_POST['level'] = join(',',$_POST['status']);	 	// 拼接用户权限

			if($admin->where(array('id'=>$id))->save($_POST)){  // 判断是否成功
				$this->success('修改成功','lists');
			}else{
				$this->error('修改失败');
			}
		}

		/**
		 * 函数名：del
		 * 功能：删除管理员操作
		 * @param  int $id 要删除的管理员的id
		 */
		function del($id){

			
			R('Level/deladmin'); // 验证权限
			$id = intval($id);
			
			$admin = M('user_admin');

			if($id == 1){
				$this->error('您不能删除顶级管理员');
			}

			if($admin->where(array('id'=>$id))->delete()){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}
	}