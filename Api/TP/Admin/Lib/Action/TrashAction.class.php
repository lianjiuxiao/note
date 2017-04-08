<?php
// +----------------------------------------------------------------------
// | MSS V1.0 [ 模版商铺系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 四重奏项目组 All rights reserved.
// +----------------------------------------------------------------------
// | Licensed SunQiang/SunChi/QinWei/GengXin/LAMP兄弟连
// +----------------------------------------------------------------------
// | Author: SQ
// | Date: 12/29/2013 23:55
// +----------------------------------------------------------------------

/**
 *  类名:GoodsAction 后台回收站回收站信息控制类
 *  功能:实现后台对回收站数据的显示,增删改查等操作
 */

class TrashAction extends Action{
	
		/*
		* 函数名:lists
		* 功能:显示所有回收站商品信息
		*  @param no
		*  @return void
		*/
		function lists(){
			R('Level/listsgoods'); // 验证权限
			$m = M("goods");
			$data = $m->where("huishou=1")->select();
			$this->assign("data",$data);	
			$this->display();
		} 

		
		/*
		* 函数名:del
		* 功能:删除回收站数据(批量删除有待实现)
		*  @param no
		*  @return void
		*/
		function del()
		{
			R('Level/delgoods'); // 验证权限
			$id = trim($_GET['id']);
			$m = M("goods");
			$result = $m->where("id=$id")->delete();

			if($result)
			{
				$this->success("删除成功",__URL__."/lists");
			}else{
				$this->error("删除失败",__URL__."/lists");
			}
		}

		/*
		* 函数名:caozuo
		* 功能:批量删除，回收站批量放入回收等操作(批量删除有待实现)
		*  @param no
		*  @return void
		*/

		function caozuo(){

			//(1)批量删除回收站
			if(isset($_POST['submitd'])){
				//要删除回收站的id 存入数组中
				$arr = $_POST['all'];
				$map['id'] = array('in',$arr);
				$goods = M("goods");
				//$map['id']  = array('not in',array('1','5','8'));
				//$User->where('status=0')->delete(); // 
				//将被删除的图片资源数据
				$gdata = $goods->where($map)->select();
		
				//删除所有状态为0的用户数据
				$result = $goods->where($map)->delete();
		
				//如果批量删除成功
				if($result){
	
					foreach ($gdata as $row) {
					//删除回收站后如果回收站图像存在，一并删除,以免占用资源
					if(file_exists('Public/Uploads/goods/'.$row['pic'])){

						//删除文件资源函数 bool unlink ( string filename )
						unlink('Public/Uploads/goods/'.$row['pic']);
					}
					}
				
					//批量删除的时候把回收站的图片资源也随带删了
					$this->success("批量删除成功!!!","__URL__/lists");
				}else{
					$this->error("删除失败!!!");
				}
			}
		}

		/*
		* 函数名:back
		* 功能:回收站商品还原操作
		*  @param no
		*  @return void
		*/

		function back(){

			$id = $_GET['id'];
			$goods = M("goods");
			$data['huishou'] = 2;
			$result = $goods->where("id=$id")->data($data)->save();
		
			if($result){
				$this->success("商品还原成功!!!",'__URL__/lists');
			}else{
				$this->error("操作失败!!!");
			}

		}	
}