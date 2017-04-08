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
 *  类名:GoodsAction 后台用户评论信息控制类
 *  功能:实现后台对用户评论数据的显示,增删改查等操作
 *  修改时间:2014.1.7 ---weiwei
 */

class CommentAction extends Action{
	
		/*
		* 函数名:showall
		* 功能:显示所有用户评论信息
		*  @param no
		*  @return void
		*/
		function lists(){
			R('Level/listsgoods'); // 验证权限
			$m = M("comment");

			//$data = $m->where("status=1")->select();
			$data = $m->select();

			//并接评论的商品
			$goods = M("goods");
			foreach($data as &$row){
				$row['gname'] = $goods->where("id=".$row['gid'])->find();
				$row['gname'] = $row['gname']['gname'];
			}
	
			$this->assign("data",$data);	
			$this->display();
		} 
		
		/*
		* 函数名:del
		* 功能:删除用户评论数据(批量删除有待实现)
		*  @param no
		*  @return void
		*/
		function del()
		{
			R('Level/delgoods'); // 验证权限
			$id = trim($_GET['id']);

			$m = M("comment");
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
		* 功能:批量删除，用户评论批量放入回收等操作(批量删除有待实现)
		*  @param no
		*  @return void
		*/

		function caozuo(){

			//(1)批量删除用户评论
			if(isset($_POST['submitd'])){
				//要删除用户评论的id 存入数组中
				$arr = $_POST['all'];
				$map['id'] = array('in',$arr);
				$comment = M("comment");
				//$map['id']  = array('not in',array('1','5','8'));
				//将被删除的图片资源数据
				$result = $comment->where($map)->delete();
		
				//如果批量删除成功
				if($result){
					//批量删除
					$this->success("批量删除成功!!!","__URL__/lists");
				}else{
					$this->error("删除失败!!!");
				}
			}			
		}

		/*
		* 函数名:editgood
		* 功能:显示后台编辑用户评论模板,并转送需要显示的数据
		*  @param no
		*  @return void
		*/
		function upda(){
			//获取用户评论分类数据
			$id = trim($_GET['id']);
			$m = M("comment");
			$data = $m->find($id);
	
			//获取商品的名称
			$goods = M("goods");

			$data['goodname'] = $goods->find($row['gid']);
			$data['goodname'] = $data['goodname']['gname'];
			//获取用户评论信息

			$this->assign("data",$data);
			$this->display();
		}

		/*
		* 函数名:update
		* 功能:编辑后台用户评论数据保存更改
		*  @param no
		*  @return void
		*/
		function update(){
			R('Level/savegoods'); // 验证权限

			//获取要修改的数据id
			$id = trim($_GET['id']);

			//把评论内容字段修改过来
			$_POST['content'] = $_POST['gcontent'];
			$m = M("comment");
			$m->create();
			$result = $m->where("id=$id")->save();
			if($result)
			{
				$this->success($result."数据修改成功",__URL__."/lists");
			}else{
				$this->error("你尚未进行任何修改!!!");
			}
		}

		/*
		* 函数名:issell
		* 功能:设置评论在首页中显示与否
		*  @param no
		*  @return void
		*/

		function issell(){

			$id = $_GET['id'];
			$comment = M("comment");
			//修改字段的值 方法一
			//$User->where('id=5')->data($data)->save(); // 根据条件保存修改的数据
			$cdata = $comment->where("id=$id")->find();
			//如果上架了，改为下架
			if($cdata['status'] == 1){
				$data['status'] = 2;
				$result = $comment->where("id=$id")->data($data)->save();
			//如果下架了改为上架
			}else{
				$data['status'] = 1;
				$result = $comment->where("id=$id")->data($data)->save();
			}

			if($result){
				echo $data['status'];
			}

		}
	
}