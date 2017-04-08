<?php
	// +----------------------------------------------------------------------
	// | MSS V1.0 [ 模版商铺系统 ]
	// +----------------------------------------------------------------------
	// | Copyright (c) 2013-2014 四重奏项目组 All rights reserved.
	// +----------------------------------------------------------------------
	// | Licensed SunChi/LAMP兄弟连
	// +----------------------------------------------------------------------
	// | Author: SC
	// | Date:   1/13/2014 14:32
	// +----------------------------------------------------------------------
	
	/**
	* 类名：CheckoutAction
	* 功能：结账页面
	*/
	class CheckoutAction extends Action
	{
		public function checkout()
		{
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
				
					//判断分类是否为其子分类，如果是，则并接
					if(in_array($row['id'],$arr)){
						//获取商品分类下的所有商品
						$arrid[] = $vo['id'];
						$row['zclass'][$i] = $vo;
						$i++;
					}
				}
			}


			//如果cookie 里面存有商品信息
			if(!empty($_COOKIE['cart'])){

				//获取购物车信息和购物车中商品的信息
				//购物数据表里面获取商品信息
				/*$arr = array();
				$carts = M("carts");
				$cdata= $carts->where("uid=1")->select();

				foreach($cdata as $row){
					$arr[] = $row['gid'];
				}*/

				//$arr = json_encode($_COOKIE['cart']);
				//获取cookie 中存储的商品信息
				//获取cookie中购物车数据
		    		$str = $_COOKIE['cart'];

		    		//去掉数据中两边的中括号
		    		$str = trim($str,'[');
		    		$str = trim($str,']');
		    		//mix str_replace(mix $search,mix $replace,mix $subject[,int &$num]
		    		//替换掉数据中的\转义字符
		    		$str = str_replace("\\",'',$str);

		    		//$b = html_entity_decode($a);
		    		//$a = htmlentities($str);
				//$str = html_entity_decode($a);
		    	
		    		//分割字符串单元
		    		$arrcart = explode('},',$str);
		    		$num = count($arrcart);
		    		
		    		//由于分割的时候少了} 遍历加上
		    		for($i=0; $i<$num-1; $i++){
		    			$arrcart[$i] = $arrcart[$i].'}';
		    		}
		    	
		    		foreach($arrcart as &$arrrow){
		    			$arrrow = json_decode($arrrow,true);;
		    		}

		    		foreach($arrcart as $row){
					$cartid[] = $row['id'];
				}

		    		//$arr = json_decode($str,true);
				
				$goods = M("goods");
				//$map['id']  = array('not in',array('1','5','8'));
				$map['id'] = array('in',$cartid);
				$gdata = $goods->where($map)->select();

				foreach($gdata as &$row){
					foreach($arrcart as $vo){
						if($vo['id'] == $row['id']){
							$row['addnum'] = $vo['qty'];
						}
					}
				}
			}

			//如果是直接购买
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$goods = M("goods");
				//$map['id']  = array('not in',array('1','5','8'));
				
				$gdata = $goods->where("id=".$id)->select();

				foreach($gdata as &$row){
					$row['addnum'] = $_POST['number'];
				}
			}
			
			//统计购物车里产品的总量,总价格等信息
			//注意处理数据的时候最好不用再使用上面的$row，那样会造成不必要的麻烦
			$tongji = array();
			foreach($gdata as $vo){
				$tongji['totalnum'] += $vo['addnum'];
				$tongji['totalprice'] += $vo['addnum']*$vo['price'];
			}
		
			$this->assign("tongji",$tongji);
			//从session中获取用户id
			$userid = $_SESSION['uid'];

			//获取默认的收货人信息
			$addr = M("address");
			$madata = $addr->where("uid=$userid AND isdefault=1")->find();
			$region = M("region");

			//省
			$redata = $region->where("region_id=".$madata['province'])->find();
			$madata['province1'] = $redata['region_name'];
			//市区
			$redata = $region->where("region_id=".$madata['city'])->find();
			$madata['city1'] = $redata['region_name'];

			//县区
			$redata = $region->where("region_id=".$madata['area'])->find();
			$madata['area1'] = $redata['region_name'];
	
			
			$this->assign("madata",$madata);

			//获取所有用户id为**的收货人信息
		
			
			$adata = $addr->where("uid=".$userid)->select();
			foreach ($adata as &$vrow) {
				//省
				$redata = $region->where("region_id=".$vrow['province'])->find();
				$vrow['province1'] = $redata['region_name'];
				//市区
				$redata = $region->where("region_id=".$vrow['city'])->find();
				$vrow['city1'] = $redata['region_name'];

				//县区
				$redata = $region->where("region_id=".$vrow['area'])->find();
				$vrow['area1'] = $redata['region_name'];
			}

			$this->assign("adata",$adata);

			//获取支付方式数据
			$pays = M("pays");
			$pdata = $pays->where("status=1")->select();

			//获取省份
			//所在地址province city area
			$region = M("region");
			$prodata = $region->where("region_type=1")->select();
			
			//获取省份
			$this->assign("prodata",$prodata);

			//获取配送方式信息
			$dilivery = M("dilivery");
			$ddata = $dilivery->where("status=1")->select();
			//商品列表信息
			$this->assign("gcdata",$gcdata);
			//配送方式信息
			$this->assign("ddata",$ddata);
			//支付方式信息
			$this->assign("pdata",$pdata);
			//准备生产订单的购物车中商品信息和购物车信息
			$this->assign("gdata",$gdata);

			// 获取最新商品信息
			unset($condition);
			$User = M("goods");
			$nlist = $User->order('selltime desc')->limit(0,1)->select();

			// 处理商品名称长度,使固定为8个字符
			foreach($nlist as &$val){
				$val['gname'] = mb_substr($val['gname'], 10, 11, 'utf-8');
			}
			$this->assign("ngoods",$nlist);

			R('Base/header');
			R('Base/footer');
			$this->display();
		}

		//获取地址信息
		function getaddr(){
			$id = $_GET['id'];
			$addr = M('address');
			$arr = $addr->where("id=$id")->find();

			$region = M("region");
			//省
			$redata = $region->where("region_id=".$arr['province'])->find();
			$arr['province1'] = $redata['region_name'];
			//市区
			$redata = $region->where("region_id=".$arr['city'])->find();
			$arr['city1'] = $redata['region_name'];

			//县区
			$redata = $region->where("region_id=".$arr['area'])->find();
			$arr['area1'] = $redata['region_name'];
			$str=json_encode($arr);
			echo $str;
		}

		//获取配送方式
		function peisong(){
			$id = $_GET['id'];
			$dilivery = M('dilivery');
			$arr = $dilivery->where("id=$id")->find();
			$str=json_encode($arr);
			echo $str;
		}

		//获取省
		function getprivince(){
			$region = M('region');
			$arr = $region->where("region_type=1")->select();
			$str=json_encode($arr);
			echo $str;
		}

		//获取城市
		function getcity(){
			$region_id = $_GET['region_id'];
			$region = M('region');
			$arr = $region->where("parent_id=$region_id")->select();
			$str=json_encode($arr);
			echo $str;
		}

		//获取地区
		function getarea(){
			$region_id = $_GET['region_id'];
			$region = M('region');
			$arr = $region->where("parent_id=$region_id")->select();
			$str=json_encode($arr);
			echo $str;
		}

		//添加新的地址
		function addaddr(){
			$_GET['uid'] = $_SESSION['uid'];
			$address = M('address');
			$result = $address->data($_GET)->add();
	
			echo $result;
		}
	}