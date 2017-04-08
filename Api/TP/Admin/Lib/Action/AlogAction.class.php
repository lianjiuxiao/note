<?php 
	/**
	 * 类名：AlogAction
	 * 功能：对管理员日志进行操作
	 */
	class AlogAction extends Action{

		/**
		 * 函数名：lists
		 * 功能：输出管理员日志到模板
		 */
		function lists(){
			
			$log = M('admin_log');
			$id = intval(trim($_GET['id']));
			if(empty($id)){										// 判断是否有id值(即查看某个管理员的操作日志)
				if($_SESSION['username'] == 'admin'){			// 判断是否为admin超级管理员
					$data = $log->order('time desc')->select(); // 查找管理员日志
				}else{
					$data = $log->order('time desc')->where(array('userid'=>$_SESSION['id']))->select();
				}
			}else{
				if($_SESSION['username'] == 'admin' || $id == $_SESSION['id']){
					$data = $log->where(array('userid'=>$id))->order('time desc')->select();
				}else{
					$this->error('您没有权限查看其他管理员操作日志');
				}
			}

			$user = M('user_admin');

			// 循环查找用户名
			foreach($data as &$row){
				$row['userid'] = $user->where(array('id'=>$row['userid']))->field('username')->find(); // 获取管理员用户名 
			}

			$this->assign('data',$data);
			$this->display();
		}

		/**
		 * 函数名：del
		 * 功能：删除管理员日志
		 */
		function del(){

			if(!empty($_POST['check'])){			// 判断是否要删除某个日志id
				$check = join(',',$_POST['check']); // 拼接要删除的日志id
			}else{
				$log = M('admin_log');
				$data = $log->field('id')->select();
			
				$i = 0;
				foreach ($data as $v) {				// 数组重组
					$data['check'][$i] = $v['id'];
					$i++;
				}
				
				$check = join(',',$data['check']);  //拼接要删除的日志id
			}

			$log = M('admin_log');
			if($log->where(array('id'=>array('exp','IN('.$check.')')))->delete()){ // 判断是否删除成功
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}

		/**
		 * 函数名：indexlist
		 * 功能：显示最新的五条管理员操作信息(用于后台首页显示)
		 * @return [type] [description]
		 */
		function indexlist(){

			$log = M('admin_log');
			return($log->limit(0,5)->order('time desc')->select());
		}
	}