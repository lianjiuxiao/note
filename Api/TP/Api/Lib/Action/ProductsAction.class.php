<?php
	// +----------------------------------------------------------------------
	// | MSS V1.0 [ 模版商铺系统 ]
	// +----------------------------------------------------------------------
	// | Copyright (c) 2013-2014 四重奏项目组 All rights reserved.
	// +----------------------------------------------------------------------
	// | Licensed SunChi/LAMP兄弟连
	// +----------------------------------------------------------------------
	// | Author: SC
	// | Date:   1/13/2014 16:32
	// +----------------------------------------------------------------------
	
	/**
	* 类名：ProductsAction
	* 功能：商品列表显示, 细化到最小分类
	*/
	class ProductsAction extends Action {

		public function products() {
			
			//分类列表操作
			// 取出sid为0的所有分类存入数组$clsss
			$data = M("goods_category");
			$dgoods = M("goods");
			$class = array();
			$condition['sid'] = 0;
			$condition['isshow'] = 1;
			$class = $data->where($condition)->select();


			// 取出所有sid为上一个数组中id的数据的分类信息存入$class['i']中
			// 取出所有商品classid为sid的商品，统计总数
			foreach($class as $key=>$value) {

				$condition['sid'] = $value['id'];

				// 务必注意此处数组的存入方式
				$class[$key]['part'] = $data->where($condition)->select();
				unset($condition['sid']);

				// 取出classid为sid的商品统计总数
				foreach($class[$key]['part'] as &$svalue) {

					$condition['classid'] = $svalue['id'];
					$svalue['goodsCount'] = $dgoods->where($condition)->count();
					unset($condition['classid']);
				}

			}

			$this->assign("class",$class);


			// // 查找商品所属的分类，并将分类id和分类名称以'id-cname'的形式存入查出的数组中以dcategory命名，作为所属分类的标识
			// // 筛选条件的变量处理方式：
			// // 将颜色存入dcolors中以'|'分割不同颜色，将售价存入price中，将尺码存入size中

			/*---------------------- thinkPHP原版关于分页类的实现() -------------------*/

			// 此分页的不足：
			// 	1. 无法使用框架样式
			// 	2. 前台页面不能实现动态刷新
			
			// 判断查询数据条件
			// 	1. 使用全文搜索产生的数据集 search
			// 	2. 使用a标签链接通过小分类id产生的数据集 scl
			// 	3. 直接点击导航栏产品列表输出所有商品信息 all
			// 	4. 从首页进入打折专区

			if ($_POST['search']) {	
				
				$sea = $_POST['search'];
				$condition['gname|gdescription'] = array('like', "%$sea%"); 
			}elseif($_GET['_URL_'][2] == 'search') {
				
				$sea = $_GET['_URL_'][3];
				$condition['gname|gdescription'] = array('like', "%$sea%");
			}elseif($_GET['_URL_'][2] == 'scl') {
				
				$condition['classid'] = $_GET['_URL_'][3];
			}elseif($_GET['_URL_'][2] == 'all') {

				$condition['id'] = array('gt', -1);
			}elseif($_GET['_URL_'][2] == 'sale') {

				$condition['status'] = $_GET['_URL_'][3];
			}elseif($_GET['_URL_'][2] == 'new') {

				$condition['zuixin'] = $_GET['_URL_'][3];
			}else{
				$condition['id'] = array('gt', -1);
			}

			//商品上下架
			$condition['issell'] = 1;
			// 将取到的信息保存在session中，暂解决post传参无法处理的问题
			// $_SESSION['cond'] = $condition;

			$User = M('goods'); 										// 实例化User对象
			import('ORG.Util.Page');									// 导入分页类
			$count      = $User->where($condition)->count();			// 查询满足要求的总记录数
			$Page       = new Page($count,9);							// 实例化分页类 传入总记录数和每页显示的记录数
			
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $User->where($condition)->limit($Page->firstRow.','.$Page->listRows)->select();
			
			unset($condition);											// 清空查询条件

			foreach($list as &$value) 
			{	
				$condition['id'] = $value['classid'];
				$data_all = array();
				$data_all = $data->where($condition)->select();

				// 将商品描述中的所有图片全部清空，只保留文字描述
				$str = $value['gdescription'];
				$preg = "/(<img).*?(>)/";
				$replace = "";
				$value['gdescription'] = preg_replace($preg, $replace, $str);

				// 处理商品原价信息，当原价不大于售价时置为0
				if($value['mprice'] <= $value['price']){
					$value['mprice'] = 0;
				}

				//取得所在分类的id-类名
				$value['dcategory'] = $data_all[0]['id'].'-'.$data_all[0]['cname'];
			}

			unset($condition);									// 清空查询条件

			// 销量榜单，查询销量最高的商品
			$condition['tuijian'] = 1;
			$hlist = $User->where($condition)->order('gstotal desc')->limit(0,3)->select();
			
			// 处理商品名称长度,使固定为10个字符
			foreach($hlist as &$val){
				$val['gname'] = mb_substr($val['gname'], 4, 10, 'utf-8');
			}

			// 查询最新上架商品信息
			$nlist = $User->order('selltime desc')->limit(0,2)->select();

			// 处理商品名称长度,使固定为8个字符
			foreach($nlist as &$val){
				$val['gname'] = mb_substr($val['gname'], 10, 11, 'utf-8');
			}
			
			$this->assign('hgoods', $hlist);					// 赋值数据集
			$this->assign('ngoods', $nlist);
			$this->assign('goods', $list);						

			/* 分页设置 */
			$Page->setConfig('prev', '<i class="iconfont-angle-left pageico" id="first"></i>');
 			$Page->setConfig('next', '<i class="iconfont-angle-right pageico"></i>');
			$Page->setConfig('theme', '%upPage%   %linkPage% %downPage%');

			$show       = $Page->show();						// 分页显示输出
			$this->assign('page',$show);						// 赋值分页输出
			R('Base/header');
			R('Base/footer');
			/*--------------------- // thinkPHP原版关于分页类的实现 -------------------*/

			$this->display();
		}


		function product() {
			//获取商品详细信息
			$id = $_GET['id'];
			$good = M("goods");
			$gdata = $good->find($id);

			// 使上传的图片按宽度 100% 输出
			$str = $gdata['gdescription'];
			$preg = "/(<img)/";
			$replace = '<img style="width:100%"';
			$gdata['gdescription'] = preg_replace($preg, $replace, $str);
			$str = $gdata['gdescription'];

			// 修改图片路径(后期需修改)
			$pregi = "/(localhost)/";
			$replacei= '192.168.130.47';
			$gdata['gdescription'] = preg_replace($pregi, $replacei, $str);

			// 取得商品规格和颜色
			$gsize = explode("|", $gdata['size']);
			$gcolor = explode("|", $gdata['color']);

			// 处理商品原价信息，当原价不大于售价时置为0
			if($gdata['mprice'] <= $gdata['price']){
				$gdata['mprice'] = 0;
			}
			// 将商品规格拆分存入数组

			//获取商品分类数据，分类类表显示的时候合并显示为两级分类
	    		//即顶级分类为最大分类，其下面的所有子分类都处理成二级分类显示
	    	
	    		$arrid = array();
			$gclass = M("goods_category");
			//获取顶级分类
			$gcdata = $gclass->where("sid=0")->select();
			//获取所有分类数据
			$all = $gclass->select();

			//重装顶级分类数组,将其下面的所有子级分类都存在其['zclass']数组单元，方面前台遍历
			foreach($gcdata as &$row){
				$i = 0;
				foreach($all as $vo){
					//array explode ( string separator, string string [, int limit] )
					$arr = array();
					//以,为标识分割字符串成数组
					$arr = explode(',',$vo['path']);
				
					//判断分类是否为其子分类，如果是，则拼接
					if(in_array($row['id'],$arr)){
						//获取商品分类下的所有商品
						$arrid[] = $vo['id'];
						$row['zclass'][$i] = $vo;
						$i++;
					}
				}
			}

			//获取商品规格信息
			$goodtype = M("goods_type");
			$typedata = $goodtype->select();

			//获取用户评论信息
			$comment = M("comment");
			$cdata = $comment->where("gid=$id")->select();
			$user = M("user");

			foreach($cdata as &$vo){
				$vo['pic'] = $user->where("id=".$vo['user_id'])->find();
				$vo['pic'] = $vo['pic']['headpic'];
			}
			
			// 获取热销爆款信息
			$tdata = $good->where("tuijian=1")->select();

			//获取商品缩略图信息、
			unset($condition);
			$condition['gid'] = $id;
			$img = M("images");
			$limgs = $img->where($condition)->limit(1,3)->select();

			$this->assign("dimgs",$limgs);
			$this->assign("cdata",$cdata);
			$this->assign("typedata", $typedata);
			$this->assign("gsize", $gsize);
			$this->assign("gcolor", $gcolor);
			$this->assign("tdata", $tdata);
			$this->assign("gdata",$gdata);
			$this->assign("gcdata",$gcdata);
			R('Base/header');
			R('Base/footer');
			$this->display();
		}
	}

?>