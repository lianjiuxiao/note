<?php 

	/**
	 * 类名：MailAction
	 * 功能：邮件发送系统
	 */
	class MailAction extends Action{

		/**
		 * 函数名：lists
		 * 功能：邮件模板列表
		 */
		function lists(){
			R('Level/listsmail'); // 权限验证
			$email = M('mail_template');

			$this->assign('data',$email->select());
			$this->display();
		}

		/**
		 * 函数名：add
		 * 功能：添加邮件模板
		 */
		function add(){
			
			$this->display();
		}

		/**
		 * 函数名：inse
		 * 功能：插入邮件模板数据
		 */
		function inse(){

			R('Level/addmail'); // 权限验证
			$email = M('mail_template');

			if($email->add($_POST)){
				$this->success('添加成功','lists');
			}else{
				$this->error('添加失败');
			}
		}

		/**
		 * 函数名：upda
		 * 功能：修改邮件模板内容
		 * @param  int $id 邮件模板id值
		 */
		function upda($id){

			
			$id = intval($id);
			$email = M('mail_template');

			$this->assign('data',$email->where(array('id'=>$id))->find());
			$this->display();
		}

		/**
		 * 函数名：edit
		 * 功能：修改邮件模板到数据库
		 * @param  int $id 邮件模板id
		 */
		function edit(){

			R('Level/savemail'); // 权限验证
			
			$id = intval($_POST['id']);

			$email = M('mail_template');

			if($email->where(array('id'=>$id))->save($_POST)){
				$this->success('修改成功','lists');
			}else{
				$this->error('修改失败');
			}
		}

		/**
		 * 函数名：del
		 * 功能：删除邮件模板至数据库
		 * @param  int $id 邮件模板id
		 */
		function del($id){

			R('Level/delmail'); // 权限验证
			$id = intval($id);

			$email = M('mail_template');

			if($email->where(array('id'=>$id))->delete()){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}

		/**
		 * 函数名：send
		 * 功能：调用多人发送模板
		 */
		function send(){

			R('Level/sendmail'); // 权限验证
			$user = M('user');
			$data = $user->where(array('ustatus'=>'2'))->select();

			$this->assign('data', $data);
			$this->display();
		}

		/**
		 * 函数名：sends
		 * 功能：发送多人邮件
		 */
		function sends(){
	
			$user = M('user');
			if(empty($_POST['sendsid'])){ 				 // 判断是否为全部发送	
				$data = $user->field('email')->select(); // 查询所有用户email地址
			}else{
				$uid = join(',',$_POST['sendsid']);
				$data = $user->where(array('id'=>array('exp','IN('.$uid.')')))->field('email')->select(); //查询指定的用户email
			}

			$i = 0;
			foreach($data as $v){
				$_POST['sendsid'][$i] = $v['email']; 		// 数组重组邮箱地址
				$i++;
			}

			$id = intval($_POST['id']);

			$email = M('mail_template');
			$con = $email->where(array('id'=>$id))->find(); // 查询邮件模板

			import('ORG.Email');//导入email类
			$mail = new Email();

			$num = count($_POST['sendsid']);
			for($i = 0;$i < $num;$i++){

				$data['mailto'] = $_POST['sendsid'][$i]; //收件人
				$data['subject'] = $con['title']; 		 //邮件标题
				$data['body'] = $con['content']; 		 //邮件正文内容

				
				$r += $mail->send($data);				 // 失败为0成功为1
			}

			// 以上循环使用了+=如果有一条以上成功则为1以上的值，如果全部成功值则为要发送的邮箱数
			if($num == $r){
				$this->success('全部发送成功');
			}elseif($r > 1){
				$this->success('部分发送成功');
			}elseif($r == 0){
				$this->error('全部发送失败');
			}
			
		}

		/**	
		 * 函数名：getback
		 * 功能：后台找回密码(未完待续)
		 */
		function getback(){
			

			import('ORG.Email');				//导入email类
			$data['mailto'] = $mailto; 			//收件人
			$data['subject'] = $con['title']; 	//邮件标题
			$data['body'] = $str; 				//邮件正文内容

			$mail = new Email();
			$mail->send($data);
		}
	}