<?php 
	
	/**
	 * 类名：FriendAction 
	 * 功能：(友情链接管理)
	 */
	class FriendAction extends Action{

		/**
		 * 函数名：lists
		 * 功能：查询链接
		 * @return array 将查询到的数值传给模板
		 */
		function lists(){

			R('Level/listfriend');		// 验证权限
			$friends = M('links');
			$data = $friends->select(); // 查询友情链接

			$this->assign('data',$data);
			$this->display();
		}

		/**
		 * 函数名：upda
		 * 功能：修改友情链接中查询（提供修改的模板）
		 * @param  string $id 要修改的友链的id值
		 * @return array     根据id查询到该友链的内容并赋值给模板
		 */
		function upda($id){

			$id = intval($id);

			$firend = M('links');
			$data = $firend->where(array('id'=>$id))->find(); // 查询指定的友情链接详细内容

			$this->assign('data',$data);
			$this->display();
		}

		/**
		 * 函数名：savel
		 * 功能：修改友链
		 * @return bool 返回是否修改成功
		 */
		function savel(){

			R('Level/savefriend'); // 验证权限
			$id = intval($_POST['id']);

			$firend = M('links');

			if($_FILES['logo']['name']){ // 判断是否上传了logo 如果上传了则调用上传函数

				$lpic = $firend->where(array('id'=>$id))->field('logo')->find(); // 如果修改了logo图片则删除掉原有图片后上传
				unlink('Public/Uploads/Links/'.$lpic['logo']);

				$pic = $this->uploads();
				$_POST['logo'] = $pic[0]['savename'];
			}

			if($firend->where(array('id'=>$id))->save($_POST)){ // 判断是否上传成功
				$this->success('修改成功！', 'lists');
			}else{
				$this->error('修改失败！');
			}
		}

		/**
		 * 函数名：del
		 * 功能：删除友链
		 * @param  int $id 要删除的友链
		 * @return bool     返回是否删除成功
		 */
		function del($id){

			R('Level/delfriend'); // 验证权限
			if(!empty($id)){

				$id = intval($id);
				$firend = M('links');

				$pic = $firend->where(array('id'=>$id))->field('headpic')->find(); // 删除友链时删除友链图片
				if(!empty($pic['logo'])){
					unlink($pic['logo']);
				}

				if($firend->where(array('id'=>$id))->delete()){
					$this->success('删除成功！');
				}else{
					$this->error('删除失败！');
				}
			}
		}

		/**
		 * 函数名：add
		 * 功能：添加友链模板显示
		 */
		function add(){
			
			$this->display();
		}

		/**
		 * 函数名：inse
		 * 功能：添加友链功能
		 * @return bool 返回是否添加成功
		 */
		function inse(){

			R('Level/addfriend'); 		 // 验证权限
			$firend = M('links');

			if($_FILES['logo']['name']){ // 判断是否上传了logo图片
				$pic = $this->uploads();
				$_POST['logo'] = $pic[0]['savename'];
			}

			if($firend->add($_POST)){
				$this->success('添加成功！', 'lists');
			}else{
				$this->error('添加失败！');
			}
		}

		/**
		 * 函数名：uploads
		 * 功能：图片上传函数
		 * @return  array 上传后的文件详细信息
		 */
		function uploads(){

			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			$upload->maxSize  = 314572800;
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath =  './Public/Uploads/Links/';
			

			if(!$upload->upload()) {// 上传错误提示错误信息
				
			}else{// 上传成功 获取上传文件信息
				return $upload->getUploadFileInfo();
			}
		}
	}