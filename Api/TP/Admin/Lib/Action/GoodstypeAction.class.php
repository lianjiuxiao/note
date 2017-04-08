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
 *  类名:ClassAction 后台规格规格信息控制类
 *  功能:实现后台对规格规格数据的显示,增删改查等操作
 */

class GoodstypeAction extends Action{
		

		/*
		* 函数名:showall
		* 功能:显示所有规格规格信息
		*  @param no
		*  @return void
		*/
		function lists(){
			R('Level/liststype');
			$type = M("goods_type");
			$class = M("goods_category");
		
			//多表查询方法一 $Model->Table(array('think_user'=>'user','think_group'=>'group'))->where('status>1')->select();
			//$data = $type->order("concat(path,',',id)")->select();
			//$data = $type->table(array('mss_goods_type'=>'goods_type','mss_goods_category'=>'goods_category'))->where("goods_type.classid=goods_category.id")->select();
			//多表查询方法二
			$tdata = $type->select();

			foreach($tdata as &$row){
				//$row['cname'] = $class->find($row['cid']);
				//$User->where('id=1')->field('id,name,email')->find(); 
				//$row['cname'] = $class->where('id='.$row['id'])->field("cname")->find();
				//$row['cname'] = $class->field('cname')->find($row['cid']);
				$cname = $class->find($row["classid"]);
				$row['cname'] = $cname['cname'];
			}
		
			$this->assign("data",$tdata);	
			$this->assign("show",$show);
			$this->display();
		} 

		/*
		* 函数名:addclass
		* 功能:显示规格规格添加规格模板
		*  @param no
		*  @return void
		*/
		function add(){

			//规格无限规格处理
			$m = M("goods_category");
			$data = $m->order("concat(path,',',id)")->select();

			foreach($data as &$row){
				$row['num'] = count(explode(',',$row['path']));
			}
	
			//规格无限规格处理
			$type = M("goods_type");
			$tdata = $type->order("concat(spath,',',id)")->select();
	
			foreach($tdata as &$row){
				$row['num'] = count(explode(',', $row['spath']));
			}

			$this->assign("data",$data);
			$this->assign("tdata",$tdata);
			$this->display();
		}

		/*
		* 函数名:insert
		* 功能:获取后台添加规格页面数据并插入数据
		*  @param no
		*  @return void
		*/
		function inse(){
			R('Level/addtype');
			$typesid= $_POST['typesid'];
			$type= M("goods_type");
			$vtype = M("goods_vtype");
			//添加规格名
			$type->create();
			$result = $type->add();
			//添加规格值
			$typevalue = $_POST["typevalue"];
			$num = count($typevalue);
			$data['typeid'] = $result;

			for($i=0; $i<$num; $i++)
			{
				$data['typevalue'] =$typevalue[$i];
				$vresult = $vtype->data($data)->add();
			}

			if($result && $vresult)
			{
				$this->success("添加成功","lists");
			}else{
				$this->error("添加失败");
			}
		}
		/*
		* 函数名:del
		* 功能:删除规格规格数据(批量删除有待实现)
		*  @param no
		*  @return void
		*/
		
		function del()
		{	
			R('Level/deltype');
			$id = trim($_GET['id']);
			$m = M("goods_type");
			$gv = M("goods_vtype");

			$result = $m->where("id=$id")->delete();
			//删除规格的时候把规格的值也一同删除了
			$vresullt = $gv->where("typeid=$id")->delete();
			
			if($result || $vresult)
			{
				$this->success("删除成功",__URL__."/lists");
			}else{
				$this->error("删除失败");
			}
		}

		/*
		* 函数名:delv
		* 功能:删除规格规格值
		*  @param no
		*  @return void
		*/
		
		function delv(){
			$id = $_GET['id'];
			$gv = M("goods_vtype");
			$result = $gv->where("id=$id")->delete();
		}

		/*
		* 函数名:editclass
		* 功能:显示后台编辑规格规格模板,并转送需要显示的数据
		*  @param no
		*  @return void
		*/
		function upda(){
			
			$id = trim($_GET['id']);
			$type = M("goods_type");
			$vtype= M("goods_vtype");
			$class = M("goods_category");
			$tdata = $type->find($id);
			$cname = $class->where("id=".$tdata['classid'])->find();
			$tdata['cname'] = $cname['cname'];
			$vdata = $vtype->where("typeid=".$tdata['id'])->select();
						
			$this->assign("data",$tdata);
			$this->assign("vdata",$vdata);
			$this->display();
		}

		/*
		* 函数名:update
		* 功能:编辑后台规格规格数据
		*  @param no
		*  @return void
		*/
		function update(){
			R('Level/savetype');
			$typeid= $_GET['id'];
			$type= M("goods_type");
			$vtype = M("goods_vtype");
			//保存规格名
			$type->create();
			$result = $type->where("id=".$typeid)->save();

			//保存规格值
			$typevalue = $_POST["typevalue"];
			$typevid = $_POST["vid"];
			$num = count($typevalue);
			$data['typeid'] = $typeid;

			for($i=0; $i<$num; $i++)
			{
				$data['typevalue'] =$typevalue[$i];
				//如果id存在则为要修改的
				if($typevid[$i]){
					$vresult[$i] = $vtype->data($data)->where("id=".$typevid[$i])->save();
				//不存在则为修改后增加的
				}else{
					//$User->data($data)->add();
					$vresult[$i] = $vtype->data($data)->add();

				}
				
			}

			if($result || $vresult)
			{
				$this->success("操作成功","__URL__/lists");
			}else{
				$this->error("操作失败");
			}
		}

		/*
		* 函数名:mdel
		* 功能:批量删除，规格批量放入回收等操作(批量删除有待实现)
		*  @param no
		*  @return void
		*/

		function caozuo(){

			//(1)批量删除规格
			if(isset($_POST['submitd'])){
				//要删除规格的id 存入数组中
				$arr = $_POST['all'];
				$map['id'] = array('in',$arr);
				$mapt['typeid'] = array('in',$arr);
				$type = M("goods_type");
				//$map['id']  = array('not in',array('1','5','8'));
				//$User->where('status=0')->delete(); // 

				//删除所有状态为0的用户数据
				$result = $type->where($map)->delete();

				//删除规格后连同规格所包含的所有值也一并删除了
				$vtype = M("goods_vtype");
				$tresult = $vtype->where($mapt)->delete();
				
				//如果批量删除成功
				if($result || $tresult){
					//批量删除的时候把规格的图片资源也随带删了
					$this->success("批量删除成功!!!","__URL__/lists");
				}else{
					$this->error("删除失败!!!");
				}
			}

		}

}