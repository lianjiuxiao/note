<?php
// +----------------------------------------------------------------------
// | MSS V1.0 [ 模版商铺系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 四重奏项目组 All rights reserved.
// +----------------------------------------------------------------------
// | Licensed 
// +----------------------------------------------------------------------
// | Author: 
// | Date:   
// +----------------------------------------------------------------------
class IndexAction extends Action {
		Public function verify(){
		    import("ORG.Util.Image");
		    Image::GBVerify();
		}

  	function index(){

    		/**(1)获取商品分类数据，分类类表显示的时候合并显示为两级分类
    		即顶级分类为最大分类，其下面的所有子分类都处理成二级分类显示
    		*/
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

		/**(2)获取购物车商品信息，uid 应该是session存的数据，后期优化
    		*/
		$arr = array();
		$carts = M("carts");
		//获取用户购物车中存的信息
		$cdata= $carts->where("uid=1")->select();

		//将所有在购物车中的商品id存在$arr数组里
		foreach($cdata as $row){
			$arr[] = $row['gid'];
		}

		$goods = M("goods");
		//$map['id']  = array('not in',array('1','5','8'));
		$map['id'] = array('in',$arr);
		//查询id在$arr 中所有商品的信息
		$data = $goods->where($map)->select();

		foreach($data as &$row){
			foreach($cdata as $vo){
				if($vo['gid'] == $row['id']){
					$row['addnum'] = $vo['addnum'];
				}
			}
		}

		/**(3)获取首页掌柜 推荐的商品
    		*/
		$tdata = $goods->where("tuijian=1 AND issell=1")->select();
		
		/**(4)获取新品上架商品
    		*/
		$zdata = $goods->where("zuixin=1 AND issell=1")->select();
		//购物车数据
		$this->assign("data",$data);
		//商品分类类表数据
		$this->assign("gcdata",$gcdata);
		//掌柜 推荐的商品
		$this->assign("tdata",$tdata);
		//新品上架商品
		$this->assign("zdata",$zdata);
		R('Base/header');
		R('Base/footer');
		$this->display();
    }
    function readme() {
    	$this->display();
    }

    function getCartsGoods(){
    	/**获取首页掌柜 推荐的商品*/
    	/*
    	http://api.tp.com/api.php/Index/getCartsGoods
    	*/
    	$goods = M("goods");
		$tdata = $goods->where("tuijian=1 AND issell=1")->select();
		$php_json = json_encode($tdata,true);
		echo $php_json;
    }

    function postParams(){
    	/**获取首页掌柜 推荐的商品*/
    	/*
    	http://api.tp.com/api.php/Index/getCartsGoods
    	*/
    	//$getParams=$_POST;
    	$getParams=$_REQUEST; //不分post和get
		echo json_encode($getParams,true);
    }


    function getParams(){
    	/**获取首页掌柜 推荐的商品*/
    	/*
    	http://api.tp.com/api.php/Index/getCartsGoods
    	*/
    	//$getParams=$_get;
    	$getParams=$_REQUEST; //不分post和get
		echo json_encode($getParams,true);
    }

}
?>