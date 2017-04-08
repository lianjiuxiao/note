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
 *  类名:GoodsAction 后台商品信息控制类
 *  功能:实现后台对商品数据的显示,增删改查等操作
 *  修改时间:2014.1.7 ---weiwei
 */

class GoodsAction extends Action{
	
		/*
		* 函数名:showall
		* 功能:后台显示所有商品信息
		*  @param no
		*  @return void
		*/
		function lists(){
			R('Level/listsgoods'); // 验证权限
			$m = M("goods");

			//导入分页类
			import('ORG.Util.Page');
			$count = $m->count();
			$page = new Page($count,10);

			//修改分页显示配置
			$page->setConfig('header','件商品');
			$page->setConfig('first','第一页');
			$page->setConfig('last','尾页');

			//分页显示输出
			$show = $page->show();
		
			$data = $m->order("selltime desc, id")->where("huishou!=1")->select();
			
			$this->assign("data",$data);	
			$this->assign("show",$show);
			$this->display();
		} 

		/*
		* 函数名:addgood
		* 功能:显示商品添加模板
		*  @param no
		*  @return void
		*/
		function add(){
			//获取商品分类
			$m = M("goods_category");
			$data = $m->order("concat(path,',',id)")->select();
			$i = 0;

			foreach($data as $row){
				$data[$i]['num'] = count(explode(',',$row['path']));
				$i++;
			}
		
			//获取商品规格信息
			$goodtype = M("goods_type");
			$goodvtype = M("goods_vtype");
			$typedata = $goodtype->select();

			foreach($typedata as &$row){
				$row['typevalue'] = $goodvtype->where("typeid=".$row['id'])->select();
			}

			$this->assign("typedata",$typedata);
			$this->assign("data",$data);
			$this->display();
		}

		/*
		* 函数名:insert
		* 功能:获取后台添加商品页面数据并插入商品数据
		*  @param no
		*  @return void
		*/
		function inse(){
		
			R('Level/addgoods'); // 验证权限

			//处理商品规格字段
			//string implode ( string glue, array pieces )
			$arrgtype = $_POST['gtype'];
			$goods_vtype = M("goods_vtype");
			//$map['id']  = array('not in',array('1','5','8'));
			$map['id']  = array('in',$arrgtype);
			//颜色
			$map['typeid'] = 18;
			$colordata = $goods_vtype->where($map)->select();

			foreach ($colordata as $crow) {
				$arrcolor[] = $crow['typevalue'];
			}
			$_POST['color'] = implode('|',$arrcolor);
		
			//尺寸
			$map['typeid'] = 19;
			$sizedata = $goods_vtype->where($map)->select();

			foreach ($sizedata as $crow) {
				$arrsize[] = $crow['typevalue'];
			}

			$_POST['size'] = implode('|',$arrsize);
			$_POST['zuixin'] = 1;
			$arrgcount = $_POST['gcount'];
			$n = count($arrgcount);

			//删除值为零的数组单元
			for($i=0; $i<$n; $i++){
				if(!$arrgcount[$i]){
					unset($arrgcount[$i]);
				}
			}

			$arrgcount = array_values($arrgcount);
			$m = count($arrgtype);

			for($j=0; $j<$m; $j++){
				$arr[$j] = $arrgtype[$j].'-'.$arrgcount[$j];
			}
			
			$_POST['gtype'] = implode(',',$_POST['gtype']);

			//实例化类
			import('ORG.Net.UploadFile'); 
			$upload = new UploadFile();
			$upload->maxSize = 3145728;
			$upload->allowExts = array('jpg','gif','png','jpeg');
			//设置添加商品的，路径
			$upload->savePath = './Public/Uploads/goods/';

			//判断文件上传是否成功
			if(!$upload->upload()){
				//$this->error($upload->getErrorMsg());
			}else{
				$info = $upload->getUploadFileInfo();
			}

			$m = M("goods");
			$m->photo = $info[0]['savename'];


			//获取当前时间戳
			$_POST['selltime'] = time();
			//获取头像图片
			$_POST['pic'] = $m->photo;

			$m->create();
			$result = $m->add();

			//存进商品相册
			$images = M("images");
			$numcount = count($info);
			
			for($i=0; $i<$numcount; $i++){
				$data['gid']= $result;
				$data['pic'] = $info[$i]['savename'];	
				$images->data($data)->add();
			}

			if($result)
			{
				$this->success("添加成功!!!",__URL__."/lists");
			}else{
				$this->error("添加失败!!!");
			}
		}

		/*
		* 函数名:del
		* 功能:删除商品数据(批量删除有待实现)
		*  @param no
		*  @return void
		*/
		function del()
		{
			R('Level/delgoods'); // 验证权限
			$id = trim($_GET['id']);
			$m = M("goods");
			$data = $m->find($id);
			$filename = $data['pic'];
			$result = $m->where("id='$id'")->delete();

			//删除商品后如果商品图像存在，一并删除,以免占用资源
			if(file_exists('Public/Uploads/goods/'.$filename)){

				//删除文件资源函数 bool unlink ( string filename )
				unlink('Public/Uploads/goods/'.$filename);
			}

			if($result)
			{
				$this->success("删除成功",__URL__."/lists");
			}else{
				$this->error("删除失败",__URL__."/lists");
			}
		}

		/*
		* 函数名:caozuo
		* 功能:批量删除，商品批量放入回收等操作(批量删除有待实现)
		*  @param no
		*  @return void
		*/

		function caozuo(){

			//(1)批量删除商品
			if(isset($_POST['submitd'])){
				//要删除商品的id 存入数组中
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
					//删除商品后如果商品图像存在，一并删除,以免占用资源
					if(file_exists('Public/Uploads/goods/'.$row['pic'])){

						//删除文件资源函数 bool unlink ( string filename )
						unlink('Public/Uploads/goods/'.$row['pic']);
					}
					}
				
					//批量删除的时候把商品的图片资源也随带删了
					$this->success("批量删除成功!!!","__URL__/lists");
				}else{
					$this->error("删除失败!!!");
				}
			}

			//(2)批量上下架
			if(isset($_POST['shangjia'])){

				//要上架的商品的id 存入数组中
				$arr = $_POST['all'];
				$map['id'] = array('in',$arr);
				$goods = M("goods");
				$gdata = $goods->where($map)->select();
			
				foreach ($gdata as $row) {
					if($row['issell'] == 1){
						$data['issell'] = 2;
						$result = $goods->where("id=".$row['id'])->data($data)->save();
					//如果下架了改为上架
					}else{
						$data['issell'] = 1;
						$result = $goods->where("id=".$row['id'])->data($data)->save();
					}
				}

				if($result){
					$this->success("批量操作成功!!!","__URL__/lists");
				}else{
					$this->error("批量操作失败!!!");
				}
				
			}
			//(3)批量放入回收站
			if(isset($_POST['submith'])){

				//要回收的商品的id 存入数组中
				$arr = $_POST['all'];
				$map['id'] = array('in',$arr);
				$goods = M("goods");
				$gdata = $goods->where($map)->select();
			
				foreach ($gdata as $row) {
					if($row['huishou'] == 1){
						$data['huishou'] = 2;
						$result = $goods->where("id=".$row['id'])->data($data)->save();
					//如果下架了改为上架
					}else{
						$data['huishou'] = 1;
						$result = $goods->where("id=".$row['id'])->data($data)->save();
					}
				}

				if($result){
					$this->success("批量操作成功!!!","__URL__/lists");
				}else{
					$this->error("批量操作失败!!!");
				}
				
			}
		}

		/*
		* 函数名:editgood
		* 功能:显示后台编辑商品模板,并转送需要显示的数据
		*  @param no
		*  @return void
		*/
		function upda(){
			//获取商品分类数据
			$id = trim($_GET['id']);

			$m = M("goods");
			$data = $m->find($id);
			//处理商品规格字段 array explode ( string separator, string string [, int limit] )
			$data['guige'] = explode(',',$data['gtype']);

			$c = M("goods_category");
			$list = $c->order("concat(path,',',id)")->select();
			$i = 0;

			foreach($list as $row){
				$list[$i]['num'] = count(explode(',',$row['path']));
				$i++;
			}

			//获取商品规格信息
	    		
			$goodtype = M("goods_type");
			$goodvtype = M("goods_vtype");
			$typedata = $goodtype->select();

			foreach($typedata as &$row){
				$row['typevalue'] = $goodvtype->where("typeid=".$row['id'])->select();
			}
		
			$this->assign("typedata",$typedata);
			$this->assign("data",$data);
			$this->assign("list",$list);
			$this->display();
		}

		/*
		* 函数名:update
		* 功能:编辑后台商品数据保存更改
		*  @param no
		*  @return void
		*/
		function update(){
			R('Level/savegoods'); // 验证权限
			//加载文件上传类
			import("ORG.Net.UploadFile");
			//实例化上传类
			$upload = new UploadFile();
			//设置附件上传大小
			$upload->maxSize = 3145728;
			// //设置上传文件名
			// $upload->saveRule = 'SCZ'.uniqid();
			//设置文件上传类型
			$upload->allowExts = array('jpg','png','gif','jpeg');
			//设置附件上传路径
			$upload->savePath = './Public/Uploads/goods/';

			//上传错误提示信息
			if(!$upload->upload()){
				//$this->error($upload->getErrorMsg());
			}else{
				//上传成功.获取成功上传信息
				$info = $upload->getUploadFileInfo();
			}

			//获取要修改的数据id
			$id = trim($_GET['id']);

			//处理商品规格字段
			//string implode ( string glue, array pieces )

			$goods_vtype = M("goods_vtype");
			$arrtype = implode(',',$_POST['gtype']);
			$_POST['gtype'] = $arrtype;

			//$map['id']  = array('not in',array('1','5','8'));
			$map['id']  = array('in',$arrtype);
			//颜色
			$map['typeid'] = 18;
			$colordata = $goods_vtype->where($map)->select();

			foreach ($colordata as $crow) {
				$arrcolor[] = $crow['typevalue'];
			}
			$_POST['color'] = implode('|',$arrcolor);

			//尺寸
			$map['typeid'] = 19;
			$sizedata = $goods_vtype->where($map)->select();

			foreach ($sizedata as $crow) {
				$arrsize[] = $crow['typevalue'];
			}

			$_POST['size'] = implode('|',$arrsize);


			//判断文件是否上传更改，如已经修改，重新赋值为上传的图像
			if(!empty($_FILES['pic']['name'])){
				$user->photo = $info[0]['savename'];
				$_POST['pic'] = $user->photo;
			}
			
			$m = M("goods");
		

			$result = $m->data($_POST)->where("id=$id")->save();
			if($result)
			{
				$this->success($result."数据修改成功",__URL__."/lists");
			}else{
				$this->error("你尚未进行任何修改!!!");
			}
		}

		/*
		* 函数名:issell
		* 功能:设置商品上架与否
		*  @param no
		*  @return void
		*/

		function issell(){

			$id = $_GET['id'];
			$goods = M("goods");
			//修改字段的值 方法一
			//$User->where('id=5')->data($data)->save(); // 根据条件保存修改的数据
			$gdata = $goods->where("id=$id")->find();
			//如果上架了，改为下架
			if($gdata['issell'] == 1){
				$data['issell'] = 2;
				$result = $goods->where("id=$id")->data($data)->save();
			//如果下架了改为上架
			}else{
				$data['issell'] = 1;
				$result = $goods->where("id=$id")->data($data)->save();
			}

			if($result){
				echo $data['issell'];
			}

		}

		/*
		* 函数名:tuijian
		* 功能:设置商品推荐状态
		*  @param no
		*  @return void
		*/

		function tuijian(){

			$id = $_GET['id'];
			$goods = M("goods");
			//修改字段的值 方法一
			//$User->where('id=5')->data($data)->save(); // 根据条件保存修改的数据
			$gdata = $goods->where("id=$id")->find();
			//如果上架了，改为下架
			if($gdata['tuijian'] == 1){
				$data['tuijian'] = 2;
				$result = $goods->where("id=$id")->data($data)->save();
			//如果下架了改为上架
			}else{
				$data['tuijian'] = 1;
				$result = $goods->where("id=$id")->data($data)->save();
			}

			if($result){
				echo $data['tuijian'];
			}

		}

		/*
		* 函数名:tejia
		* 功能:设置商品状态(特价)
		*  @param no
		*  @return void
		*/

		function tejia(){

			$id = $_GET['id'];
			$goods = M("goods");
			//修改字段的值 方法一
			//$User->where('id=5')->data($data)->save(); // 根据条件保存修改的数据
			$gdata = $goods->where("id=$id")->find();
			//如果上架了，改为下架
			if($gdata['status'] == 1){
				$data['status'] = 3;
				$result = $goods->where("id=$id")->data($data)->save();
			//如果下架了改为上架
			}elseif($gdata['status'] == 3){
				$data['status'] = 1;
				$result = $goods->where("id=$id")->data($data)->save();
			}

			if($result){
				echo $data['status'];
			}

		}

		/*
		* 函数名:tuangou
		* 功能:设置商品状态(团购)
		*  @param no
		*  @return void
		*/

		function tuangou(){

			$id = $_GET['id'];
			$goods = M("goods");
			//修改字段的值 方法一
			//$User->where('id=5')->data($data)->save(); // 根据条件保存修改的数据
			$gdata = $goods->where("id=$id")->find();
			//如果上架了，改为下架
			if($gdata['zuixin'] == 1){
				$data['zuixin'] = 2;
				$result = $goods->where("id=$id")->data($data)->save();
			//如果下架了改为上架
			}else{
				$data['zuixin'] = 1;
				$result = $goods->where("id=$id")->data($data)->save();
			}

			if($result){
				echo $data['zuixin'];
			}

		}

		/*
		* 函数名:huishou
		* 功能:将商品放入回收站
		*  @param no
		*  @return void
		*/

		function huishou(){

			$id = $_GET['id'];
			$goods = M("goods");
		
			$data['huishou'] = 1;
			$result = $goods->where("id=$id")->data($data)->save();
		
			if($result){
				$this->success("操作成功!!!",'__URL__/lists');
			}else{
				$this->error("操作失败!!!");
			}

		}		
}