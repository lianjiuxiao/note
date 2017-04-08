<?php 
	/**
	 * 类名：userModel
	 * 功能：用户model类
	 */
	class userModel extends RelationModel{


		/**
		 * 函数名：addu
		 * 功能：添加用户至数据库
		 * @return bool 返回是否添加成功
		 */
		function addu(){

			// 自动完成
			$auto = array ( 
				array('userpwd','md5',1,'function') , // 对password字段在新增的时候使md5函数处理
				array('regtime','time',1,'function'), // 对regtime字段在新增的时候time函数处理
				array('regip',$_SERVER['REMOTE_ADDR'],1,'string'), // 对ip地址使用全局变量填充
			);
	
			$create = $this->auto($auto)->create();
			$id = $this->add();

			return $id;
			
		}

		/**
		 * 类名：edit
		 * 功能：修改用户信息
		 * @return bool 判断是否修改成功
		 */
		function edit(){

			$id = intval($_POST['id']);
			
			unset($_POST['realname']);
			unset($_POST['idcard']);
			unset($_POST['cellphone']);
			unset($_POST['sex']);
			unset($_POST['birthday']);
			unset($_POST['year']);
			unset($_POST['month']);
			unset($_POST['day']);
			unset($_POST['province']);
			unset($_POST['county']);
			unset($_POST['city']);

			if($this->where(array('id'=>$id))->save($_POST)){
				return true;
			}else{
				return false;
			}
		}

	}