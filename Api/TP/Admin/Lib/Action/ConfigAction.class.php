<?php 
	/**
	 * 类名 ConfigAction
	 * 功能 网站的基本配置功能
	 */
	class ConfigAction extends Action{

		/**
		 * 函数名：listsConfig
		 * 功能：显示网站基本配置信息
		 */
		function listsConfig(){

			R('Level/listconfig'); 		// 验证权限
			$config = M('webconfig');
			$data = $config->select();  // 查询网站配置信息

			/* 数组重组 */
			foreach($data as $v){
				
				$data[$v['item']] = $v['content'];
			}
			
			$this->assign('config',$data);
			$this->display();
		}

		/**
		 * 函数名：updaConfig
		 * 功能：修改网站基本配置信息
		 */
		function updaConfig(){

			R('Level/saveconfig'); // 验证权限
			$config = M('webconfig');

			// 循环修改配置文件的值
			foreach($_POST as $k => $v){
					
				$num['content'] = $v;
				$r .= $config->where(array('item'=>"$k"))->save($num);
			}

			foreach($_FILES as $v){
				$p .= $v['name']; // 判断之前是否循环过
			}
			
			if(!empty($p)){		 // 判断是否两次失败
				// 调用上传函数
				$pic = $this->uploads();
			}
			
			// 如果上传了文件
			if(!empty($pic)){

				for($i = 0; $i < 5; $i++){ 					// 循环判断 
				
					if(!empty($pic[$i]['key'])){ 			//判断上传文件是否存在

						if($pic[$i]['key'] == 'blicense'){  // 判断是否是营业执照
							$file = 'blicense';
						}
						if($pic[$i]['key'] == 'logo'){ 		// 判断是否是logo
							$file = 'logo';
						}
						if($pic[$i]['key'] == 'goodsimg'){
							$file = 'goodsimg';
						}
						if($pic[$i]['key'] == 'userpic'){
							$file = 'userpic';
						}
						if($pic[$i]['key'] == 'wimg'){
							$file = 'wimg';
						}

						$data = $config->where(array('item'=>$file))->find();
						if(!empty($data['content'])){					  // 判断之前是否有默认图片
							unlink('Public/Uploads/'.$data['content']);	  // 删除原有图片
						}

						$num['content'] = $pic[$i]['savename'];
						$config->where(array('item'=>$file))->save($num); // 写入数据库
					}
				}

				$r = 1; // 使判断是否修改为已修改
			}

			if($r == 0000000){ // 如果为0000000时未修改状态 在循环修改时会返回值r 用来判断是否修改成功
				$this->error('您没有做任何修改');
			}else{
				$this->success('修改成功');
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
			$upload->savePath =  './Public/Uploads/config/';
			

			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				return $upload->getUploadFileInfo();
			}
		}
	}