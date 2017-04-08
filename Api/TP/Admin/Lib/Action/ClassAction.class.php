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
 *  类名:ClassAction 后台分类分类信息控制类
 *  功能:实现后台对分类分类数据的显示,增删改查等操作
 */

class ClassAction extends Action{
	

		/*
		* 函数名:showall
		* 功能:显示所有分类分类信息
		*  @param no
		*  @return void
		*/
		function lists(){
			R('Level/listsclass'); // 验证权限
			$m = M("goods_category");
			//导入分页类
			import('ORG.Util.Page');
			$count = $m->count();
			$page = new Page($count,10);
			//分页显示输出
			$show = $page->show();
			//多个字段的排序
		
			/*$data = $m->order("concat(path,',',id) asc,ordernum asc")->select();*/
			$data = $m->order(array("concat(path,',',id)"=>'asc','ordernum'=>'asc'))->select();

			//实力化分类对象
			$goods = M("goods");
			$i = 0;
			
			foreach($data as $row){

				//用于显示页面分级显示处理
				$data[$i]['num'] = count(explode(',',$row['path']));
				//统计分类下面所有分类的数量
				$gdata = $goods->where("classid=".$row['id'])->select();
				$data[$i]['goodnum'] = count($gdata);
				$i++;
			}

			$this->assign("cdata",$data);	
			$this->assign("show",$show);
			$this->display();
		} 

		/*
		* 函数名:addclass
		* 功能:显示分类分类添加分类模板
		*  @param no
		*  @return void
		*/
		function add(){
			
			$m = M("goods_category");
			$data = $m->order("concat(path,',',id)")->select();
			$i = 0;
			foreach($data as $row){
				$data[$i]['num'] = count(explode(',',$row['path']));
				$i++;
			}
			$this->assign("data",$data);
			$this->display();
		}

		/*
		* 函数名:insert
		* 功能:获取后台添加分类页面数据并插入数据
		*  @param no
		*  @return void
		*/
		function inse(){
			R('Level/addclass'); // 验证权限
			$sid= $_POST['sid'];
			$class = M("goods_category");
			$sdata = $class->find($sid);

			//如果pid为0，就让它的path也为0
			if($sid==0){
				$path=0;
			}else{
				$path = $sdata['path'].','.$sid;	
			}
			$_POST['path']=$path;
			$class->create();
			$result = $class->add();

			if($result)
			{
				$this->success("添加成功","lists");
			}else{
				$this->error("添加失败");
			}
		}
		/*
		* 函数名:delete
		* 功能:删除分类分类数据(批量删除有待实现)
		*  @param no
		*  @return void
		*/
		
		function del()
		{
			R('Level/delclass'); // 验证权限
			$id = trim($_GET['id']);
			$m = M("goods_category");
			$goods = M("goods");

			//判断分类下面是否有子分类,有则不能删除
			$hresult = $m->where("sid=$id")->find();
			//分类下面有商品
			$gresult = $goods->where("classid=$id")->find();
			if($hresult || $gresult){
			
				//$this->redirect('New/category', array('cate_id' => 2), 5, '页面跳转中...');
				
				$this->error("分类删除失败");
			}
		
			$result = $m->where("id=$id")->delete();
			
			if($result)
			{
				$this->success("分类删除成功",__URL__."/lists");
			}else{
				$this->error("分类删除失败");
			}
		}

		/*
		* 函数名:editclass
		* 功能:显示后台编辑分类分类模板,并转送需要显示的数据
		*  @param no
		*  @return void
		*/
		function upda(){
			
			$id = trim($_GET['id']);
			$class = M("goods_category");
			$data = $class->find($id);
			$list = $class->order("concat(path,',',id)")->select();
			$i = 0;
			foreach($list as $row){
				$list[$i]['num'] = count(explode(',',$row['path']));
				$i++;
			}
			$this->assign("data",$data);
			$this->assign("list",$list);
			$this->display();
		}

		/*
		* 函数名:update
		* 功能:编辑后台分类分类数据
		*  @param no
		*  @return void
		*/
		function update(){

			R('Level/saveclass'); // 验证权限
			//获取要修改的数据id
			$id = trim($_GET['id']);
			$sid = trim($_POST['sid']);
			$class = M("goods_category");
			$zdata = $class->find($id);
			$sdata = $class->find($sid);

			//选择顶级分类
			if($sid == 0){
				$_POST['path'] = 0;
			}
			//不选择，即选择跟现在是一样的
			elseif($sid == $id){
				$_POST['path'] = $zdata['path'];
			//选择其它的分类
			}else{
				$_POST["path"] = $sdata["path"].','.$sid;
			}

			//path=父类的path+','+父类的id
			$class->create();
			$result = $class->where("id=$id")->save();

			if($result)
			{
				$this->success($result."分类修改成功",__URL__."/lists");
			}else{
				$this->success("分类修改失败");
			}
		}

		/*
		* 函数名:zupda
		* 功能:显示转移商品分类页面
		*  @param no
		*  @return void
		*/
		function zupda(){
			R('Level/saveclass'); // 验证权限
			$id = trim($_GET['id']);
			$class = M("goods_category");
			$data = $class->find($id);
			$list = $class->order("concat(path,',',id)")->select();
			$i = 0;
			foreach($list as $row){
				$list[$i]['num'] = count(explode(',',$row['path']));
				$i++;
			}

			$this->assign("id",$id);
			$this->assign("data",$data);
			$this->assign("list",$list);
			$this->display();
			
		}

		/*
		* 函数名:update
		* 功能:编辑后台分类分类数据
		*  @param no
		*  @return void
		*/
		function zupdate(){

			R('Level/saveclass'); // 验证权限
			//获取要修改的数据id
			$id = trim($_POST['id']);
			$zid = trim($_POST['zid']);
			
			$goods = M("goods");
			//$User->where('id=5')->data($data)->save(); // 根据条件保存修改的数据
			$data['classid'] = $zid;
			$result = $goods->where("classid=$id")->data($data)->save();

			if($result)
			{
				$this->success($result."个商品转移成功!!!",__URL__."/lists");
			}else{
				$this->success("转移商品失败!!!");
			}
		}


		/*
		* 函数名:mdel
		* 功能:批量删除，分类批量放入回收等操作(批量删除有待实现)
		*  @param no
		*  @return void
		*/

		function caozuo(){

			R('Level/saveclass'); // 验证权限
			//(1)批量删除分类
			if(isset($_POST['submitd'])){
				//要删除分类的id 存入数组中
				$arr = $_POST['all'];

				$map['id'] = array('in',$arr);
				$gclass = M("goods_category");
				//$map['id']  = array('not in',array('1','5','8'));
				//$User->where('status=0')->delete(); // 
				
				//删除所有状态为0的用户数据
				$result = $gclass->where($map)->delete();
		
				//如果批量删除成功
				if($result){
				
					$this->success("批量删除成功!!!","__URL__/lists");
				}else{
					$this->error("删除失败!!!");
				}
			}
		}

		/*
		* 函数名:isshow
		* 功能:设置分类首页显示状态
		*  @param no
		*  @return void
		*/

		function isshow(){
			R('Level/saveclass'); // 验证权限
			$id = $_GET['id'];
			$gc = M("goods_category");
			//修改字段的值 方法一
			//$User->where('id=5')->data($data)->save(); // 根据条件保存修改的数据
			$gcdata = $gc->where("id=$id")->find();
			//如果显示状态，改为不显示
			if($gcdata['isshow'] == 1){
				$data['isshow'] = 2;
				$result = $gc->where("id=$id")->data($data)->save();
			//如果下架了改为上架
			}else{
				$data['isshow'] = 1;
				$result = $gc->where("id=$id")->data($data)->save();
			}

			if($result){
				echo $data['isshow'];
			}

		}

}