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
 *  类名:OrderAction 后台订单信息控制类
 *  功能:实现后台对商城订单数据的显示,增删改查等操作
 *  修改时间:2014.1.7 ---weiwei
 */

class OrderAction extends Action{
	
	
		/*
		* 函数名:lists
		* 功能:显示所有商城订单信息
		*  @param no
		*  @return void
		*/
		function lists(){

			$m = M("order");
			//$data = $m->limit($page->firstRow.','.$page->listRows)->select();
			//获取订单收货人数据
			$address = M("address");
			//order('status desc,id asc')
			//按订单成长的时间排序
			//如果有查询的条件
			if($_POST){

				$uid = $_POST['uid'];
				$sendstatus = $_POST['sendstatus'];
				$times = $_POST['time1'];
				$timee = $_POST['time2'];
				if($_POST['ordernum']){
					$ordernum = $_POST['ordernum'];
					$map['ordernum'] = array('like','%'.$ordernum.'%');
				}
				if($_POST['paytype']){
					$map['paytype'] = $_POST['paytype'];
				}
				
				if($_POST['dilivery_id']){
					$map['dilivery_id'] = $_POST['dilivery_id'];
				}
				
				if($_POST['orderstatus']){
					$map['orderstatus'] = $_POST['orderstatus'];
				}

				if($_POST['paystatus']){
					$map['paystatus'] = $_POST['paystatus'];
				}
				
				if($_POST['sendstatus']){
					$map['sendstatus'] = $sendstatus;
				}
				
				$data = $m->where($map)->order('addtime desc')->select();
			}else{
				$data = $m->order('addtime desc')->select();
			}

			//获取配送方式数据
			$dilivery = M("dilivery");
			$od = M("order_detail");
	
			foreach($data as &$row){
				//收货人姓名
				$row['rname'] = $address->where('id='.$row['receiverid'])->find();
				$row['rname'] = $row['rname']['receiver'];

				//支付方式
				$row['dilivery'] = $dilivery->where("id=".$row['dilivery_id'])->find();
	
				$row['dilivery'] = $row['dilivery']['name'];

				//总共金额subtotal 
				$row['subtotal'] = $od->where("orderid=".$row['id'])->sum("subtotal");
			}

			$this->assign("data",$data);	
			$this->display();
		}

		/*
		* 函数名:query
		* 功能:显示订单查询页面
		*  @param no
		*  @return void
		*/
		function query(){

			//获取支付方式信息
			$pays = M("pays");
			//获取指定字段的数据 $nickname = $User->where('id=3')->getField('nickname');
			//$paydata = $pays->select();
			$paydata = $pays->getField("id,name,pay_key");

			//获取配送方式dilivery_id
			$dilivery = M("dilivery");
			$diliverydata = $dilivery->getField("id,name,yunfei");
			
			//配送方式信息
			$this->assign("diliverydata",$diliverydata);
			//支付方式数据
			$this->assign("paydata",$paydata);

			$this->display();
		}


		/*
		* 函数名:listsq
		* 功能:显示所有商城已经确认的订单信息
		*  @param no
		*  @return void
		*/
		function listsq(){

			$m = M("order");
			//$data = $m->limit($page->firstRow.','.$page->listRows)->select();
			//获取订单收货人数据
			$address = M("address");
			//order('status desc,id asc')
			//按订单成长的时间排序
			$data = $m->where("orderstatus=1 AND paystatus=2 AND sendstatus=2")->order('addtime desc')->select();

			//获取配送方式数据
			$dilivery = M("dilivery");
			$od = M("order_detail");
	
			foreach($data as &$row){
				//收货人姓名
				$row['rname'] = $address->where('id='.$row['receiverid'])->find();
				$row['rname'] = $row['rname']['receiver'];

				//支付方式
				$row['dilivery'] = $dilivery->where("id=".$row['dilivery_id'])->find();
	
				$row['dilivery'] = $row['dilivery']['name'];

				//总共金额subtotal 
				$row['subtotal'] = $od->where("orderid=".$row['id'])->sum("subtotal");
			}
			
			$this->assign("data",$data);	
			$this->assign("show",$show);
			$this->display();
		}


		/*
		* 函数名:listss
		* 功能:显示所有商城已经收款的订单信息
		*  @param no
		*  @return void
		*/
		function listss(){

			$m = M("order");
			//$data = $m->limit($page->firstRow.','.$page->listRows)->select();
			//获取订单收货人数据
			$address = M("address");
			//order('status desc,id asc')
			//按订单成长的时间排序
			$data = $m->where("orderstatus=1 AND paystatus=1 AND sendstatus=2")->order('addtime desc')->select();

			//获取配送方式数据
			$dilivery = M("dilivery");
			$od = M("order_detail");
	
			foreach($data as &$row){
				//收货人姓名
				$row['rname'] = $address->where('id='.$row['receiverid'])->find();
				$row['rname'] = $row['rname']['receiver'];

				//支付方式
				$row['dilivery'] = $dilivery->where("id=".$row['dilivery_id'])->find();
	
				$row['dilivery'] = $row['dilivery']['name'];

				//总共金额subtotal 
				$row['subtotal'] = $od->where("orderid=".$row['id'])->sum("subtotal");
			}
			
			$this->assign("data",$data);	
			$this->assign("show",$show);
			$this->display();
		}


		/*
		* 函数名:listsf
		* 功能:显示所有商城已经发货的订单信息
		*  @param no
		*  @return void
		*/
		function listsf(){

			$m = M("order");
			//$data = $m->limit($page->firstRow.','.$page->listRows)->select();
			//获取订单收货人数据
			$address = M("address");
			//order('status desc,id asc')
			//按订单成长的时间排序
			$data = $m->where("orderstatus=1 AND paystatus=1 AND sendstatus=1")->order('addtime desc')->select();

			//获取配送方式数据
			$dilivery = M("dilivery");
			$od = M("order_detail");
	
			foreach($data as &$row){
				//收货人姓名
				$row['rname'] = $address->where('id='.$row['receiverid'])->find();
				$row['rname'] = $row['rname']['receiver'];

				//支付方式
				$row['dilivery'] = $dilivery->where("id=".$row['dilivery_id'])->find();
	
				$row['dilivery'] = $row['dilivery']['name'];

				//总共金额subtotal 
				$row['subtotal'] = $od->where("orderid=".$row['id'])->sum("subtotal");
			}
			
			$this->assign("data",$data);	
			$this->assign("show",$show);
			$this->display();
		} 

		/*
		* 函数名:listsl
		* 功能:显示所有商城已经成功交易的订单信息
		*  @param no
		*  @return void
		*/
		function listsl(){

			$m = M("order");
			//$data = $m->limit($page->firstRow.','.$page->listRows)->select();
			//获取订单收货人数据
			$address = M("address");
			//order('status desc,id asc')
			//按订单成长的时间排序
			$data = $m->where("orderstatus=1 AND paystatus=1 AND sendstatus=3")->order('addtime desc')->select();
		
			//获取配送方式数据
			$dilivery = M("dilivery");
			$od = M("order_detail");
	
			foreach($data as &$row){
				//收货人姓名
				$row['rname'] = $address->where('id='.$row['receiverid'])->find();
				$row['rname'] = $row['rname']['receiver'];

				//支付方式
				$row['dilivery'] = $dilivery->where("id=".$row['dilivery_id'])->find();
	
				$row['dilivery'] = $row['dilivery']['name'];

				//总共金额subtotal 
				$row['subtotal'] = $od->where("orderid=".$row['id'])->sum("subtotal");
			}
			
			$this->assign("data",$data);	
			$this->assign("show",$show);
			$this->display();
		} 




		/*
		* 函数名:del
		* 功能:删除订单数据(批量删除有待实现)
		*  @param no
		*  @return void
		*/
		function del()
		{
			$id = trim($_GET['id']);
			$m = M("order");
			$result = $m->where("id='$id'")->delete();
			
			if($result)
			{
				$this->success("删除订单成功",__URL__."/lists");
			}else{
				$this->error("删除订单失败");
			}
		}

		/*
		* 函数名:del
		* 功能:删除订单商品数据
		*  @param no
		*  @return void
		*/
		function delsp()
		{
			$id = trim($_GET['id']);
			$did = trim($_GET['dingdanhao']);

			//删除订单里面的商品
			$ordersp = M("order_detail");
			$spdata = $ordersp->where("id=$id")->find();

			//该商品的总金额
			$totalprice = $spdata['subtotal'];
			
			//删除之后订单里的总金额和实际支付金额也会相应的变化了
			$order = M("order");
			//$User->where('id=5')->setInc('score',3); // 用户的积分加3
			//$User->where('id=5')->setDec('score',5); // 用户的积分减5
			$order->where("id=$did")->setDec('totalprice',$totalprice);
			$order->where("id=$did")->setDec('realprice',$totalprice);
		
			//删除订单详情商品
			$result = $ordersp->where("id='$id'")->delete();
			
			if($result)
			{
				$this->success("删除成功",__URL__."/upda/id/$did");
			}else{
				$this->error("删除失败");
			}
		}

		/*
		* 函数名:editgood
		* 功能:显示后台编辑订单模板,并转送需要显示的数据
		*  @param no
		*  @return void
		*/
		function upda(){

			$id = trim($_GET['id']);
			$did = trim($_GET["did"]);
			$order = M("order");
			$orderdata = $order->where("id=$id")->find();
			
			//订单详细信息
			$ordersp = M("order_detail");
			$orderdata['sp'] = $ordersp->where("orderid=".$orderdata['id'])->select();
			//订单详情里面的订单
			$goods = M("goods");

			foreach($orderdata['sp'] as &$row){
				$row['good'] = $goods->where("id=".$row['gid'])->find();
			}
			
			//订单id
			$this->assign("id",$id);
			//订单号订单详细信息

			$this->assign("data",$orderdata);
			$this->display();
		}


		/*
		* 函数名:update
		* 功能:编辑后台订单数据,并保存更改
		*  @param no
		*  @return void
		*/
		function update(){
	
			//获取要修改的订单数据id
		
			$id = trim($_GET['id']);
		
			$ordersp= M("order_detail");
			$odata = $ordersp->where("orderid=".$id)->select();
			$i = 0;
			$realtotal = 0;

			//改变订单详情表中商品的价格
			foreach($odata as $row){
				$data['price'] = $_POST['price'][$i];
				$data['num'] = $_POST['num'][$i];
				$data['subtotal'] = ($data['price']*$data['num']);
				$realtotal+= $data['subtotal'];
				$result[$i] = $ordersp->where("id=".$_POST['spid'][$i])->data($data)->save();
				$i++;
			}
			
			//改变订单中商品的实际价格
			$order = M("order");
			$dataresult = $order->where("id=$id")->find();
			$map['realprice'] = $realtotal + $dataresult['transcosts'];
			$oresult = $order->where("id=$id")->data($map)->save();
	
			if($result || $oresult)
			{
				$this->success("数据修改成功",__URL__."/upda/id/".$id);
			}else{
				$this->success("修改失败");
			}
		}

		/*
		* 函数名:showsp
		* 功能:显示订单详细信息
		*  @param no
		*  @return void
		*/
		function showsp(){

			$id = $_GET["id"];
			//订单信息组装获取订单支付方式名称,物流名称
			$m = M("order");
			$order = $m->find($id);

			//支付方式名称
			$pays = M("pays");
			$order['payname'] = $pays->where("id=".$order['paytype'])->find();
			$order['payname'] = $order['payname']['name'];

			//物流方式名称
			$dilivery = M("dilivery");
			$order['diliveryname'] = $dilivery->where("id=".$order['dilivery_id'])->find();
			$order['diliveryname'] = $order['diliveryname']['name'];
		

			//订单用户信息
			$user = M("user");
			$userinfo = M("userinfo");
			//$userdata = $user->find($order['uid']);
			//多表查询
			$userdata = $user->table(array("mss_user"=>'user',"mss_userinfo"=>'userinfo'))->where("user.id=userinfo.uid")->find();

			$m = M("order_detail");
			$list = $m->where("orderid='$id'")->select();
			$good = M("goods");
			$i = 0;

			foreach($list as $row){
				
				$data = $good->find($row['gid']);
				unset($data['price']);
				unset($data['id']);
				//合并一个或多个数组 array array_merge ( array array1 [, array array2 [, array ...]] )
				$list[$i] = array_merge($list[$i],$data);
				$i++;
			}
			
			$addr = M("address");
			$adata = $addr->where("id=".$order['receiverid'])->find();
			
			$region = M("region");

			//省
			$redata = $region->where("region_id=".$adata['province'])->find();
			$adata['province1'] = $redata['region_name'];
			//市区
			$redata = $region->where("region_id=".$adata['city'])->find();
			$adata['city1'] = $redata['region_name'];

			//县区
			$redata = $region->where("region_id=".$adata['area'])->find();
			$adata['area1'] = $redata['region_name'];

			
			
			$this->assign("data",$list);
			$this->assign("user",$userdata);
			//订单基本信息
		
			$this->assign("order",$order);
			$this->assign("adata",$adata);
			$this->display();
		}

		/*
		* 函数名:updaj
		* 功能:显示订单详细信息
		*  @param no
		*  @return void
		*/
		function updaj(){
			//获取订单基本信息
			$id = $_GET["id"];
			$m = M("order");
			$order = $m->find($id);

			//获取订单用户基本信息
			$user = M("user");
			$userdata = $user->find($order['uid']);

			//获取订单详情信息
			$m = M("order_detail");
			$list = $m->where("orderid='$id'")->select();
			$good = M("goods");
			$i = 0;

			foreach($list as $row){
				
				$data = $good->find($row['gid']);
				unset($data['id']);
				//合并一个或多个数组 array array_merge ( array array1 [, array array2 [, array ...]] )
				$list[$i] = array_merge($list[$i],$data);
				$i++;
			}

			//获取支付方式信息
			$pays = M("pays");
			//获取指定字段的数据 $nickname = $User->where('id=3')->getField('nickname');
			//$paydata = $pays->select();
			$paydata = $pays->getField("id,name,pay_key");

			//获取配送方式dilivery_id
			$dilivery = M("dilivery");
			$diliverydata = $dilivery->getField("id,name,yunfei");
			
			//配送方式信息
			$this->assign("diliverydata",$diliverydata);
			//支付方式数据
			$this->assign("paydata",$paydata);
			//订单详情信息
			$this->assign("data",$list);
			//订单用户信息
			$this->assign("user",$userdata);
			//订单基本信息

			$this->assign("order",$order);
			$this->display();
		}

		/*
		* 函数名:updatej
		* 功能:显示订单详细基本信息修改
		*  @param no
		*  @return void
		*/
		function updatej(){

			$id = $_GET["id"];
			$order = M("order");
			//判断支付的状态如果是1则生成付款时间
			if($_POST['paystatus'] == 1){
				$_POST['paytime'] = time();
			}

			//判断发货的状态如果是1则生成发货时间
			if($_POST['sendstatus'] == 1){
				$_POST['sendtime'] = time();
			}
		
			$order->create();
			$result = $order->where("id=$id")->save();
			if($result){
				$this->success("操作成功!!","__URL__/showsp/id/".$id);
			}else{
				$this->error("操作失败!!!");
			}
		}

		/*
		* 函数名:updas
		* 功能:显示收货人详细信息
		*  @param no
		*  @return void
		*/
		function updas(){
			$id = $_GET["id"];
			$did = $_GET["did"];
			$addr = M("address");
			$data = $addr->find($id);

			//所在地址province city area
			$region = M("region");
			$pdata = $region->where("region_type=1")->select();


			//省
			$redata = $region->where("region_id=".$data['province'])->find();
			$data['province1'] = $redata['region_name'];
			//市区
			$redata = $region->where("region_id=".$data['city'])->find();
			$data['city1'] = $redata['region_name'];

			//县区
			$redata = $region->where("region_id=".$data['area'])->find();
			$data['area1'] = $redata['region_name'];
	
			//获取省份
			$this->assign("did",$did);
			$this->assign("pdata",$pdata);
			$this->assign("data",$data);
			$this->display();
		}

		/*
		* 函数名:updas
		* 功能:显示购货人详细信息
		*  @param no
		*  @return void
		*/
		function updag(){
			$id = $_GET["id"];
			$addr = M("address");
			$data = $addr->find($id);
			$this->assign("data",$data);
			$this->display();
		}


		/*
		* 函数名:updates
		* 功能:显示收货人详细基本信息修改
		*  @param no
		*  @return void
		*/
		function updates(){

			$id = $_GET["id"];
			$did = $_GET['did'];
			$addr = M("address");
			$addr->create();
			$result = $addr->where("id=$id")->save();

			if($result){
				$this->success("操作成功!!","__URL__/showsp/id/".$did);
			}else{
				$this->error("操作失败!!!");
			}
		}


		/*
		* 函数名:caozuo
		* 功能:批量删除，订单批量放入回收等操作(批量删除有待实现)
		*  @param no
		*  @return void
		*/

		function caozuo(){

			//(1)批量删除订单
			if(isset($_POST['submitd'])){
				//要删除订单的id 存入数组中
				$arr = $_POST['all'];
				$map['id'] = array('in',$arr);
				$order = M("order");
				
				$result = $order->where($map)->delete();
		
				//如果批量删除成功
				if($result){

					$this->success("批量删除成功!!!","__URL__/lists");
				}else{
					$this->error("删除失败!!!");
				}
			}

		}


		/*
		* 函数名:queren
		* 功能:确认订单
		*  @param no
		*  @return void
		*/

		function queren(){
			$id = $_GET['id'];
			$order = M("order");
			//确认订单
			$data['orderstatus'] = 1;
			$result = $order->where("id=$id")->data($data)->save();

			if($result){

				$this->success("操作成功!!!","__URL__/showsp/id/".$id);
			}else{
				$this->error("操作失败!!!");
			}
			

		}

		/*
		* 函数名:uqueren
		* 功能:取消确认订单
		*  @param no
		*  @return void
		*/

		function uqueren(){
			$id = $_GET['id'];
			$order = M("order");
			//取消确认订单
			$data['orderstatus'] = 2;
			$result = $order->where("id=$id")->data($data)->save();

			if($result){

				$this->success("操作成功!!!","__URL__/showsp/id/".$id);
			}else{
				$this->error("操作失败!!!");
			}
			

		}

		/*
		* 函数名:fukuan
		* 功能:订单付款
		*  @param no
		*  @return void
		*/

		function fukuan(){
			$id = $_GET['id'];
			$order = M("order");
			//订单付款
			$data['paystatus'] = 1;
			$result = $order->where("id=$id")->data($data)->save();

			//付款了之后商品的库存减商品数量
			$order_detail = M("order_detail");
			$odata = $order_detail->where("orderid=$id")->select();
			$goods = M("goods");

			foreach ($odata as $row) {
				//$User->where('id=5')->setDec('score',5); // 用户的积分减5

				$goodresult = $goods->where("id=".$row['gid'])->find();
				$map['gtotal'] = $goodresult['gtotal']-$row['num'];
				$goods->where("id=".$row['gid'])->data($map)->save();
			}
			

			if($result){

				$this->success("操作成功!!!","__URL__/showsp/id/".$id);
			}else{
				$this->error("操作失败!!!");
			}
			

		}

		/*
		* 函数名:fahuo
		* 功能:订单付款
		*  @param no
		*  @return void
		*/

		function fahuo(){
			$id = $_GET['id'];
			$order = M("order");
			//订单付款
			$data['sendstatus'] = 1;
			$result = $order->where("id=$id")->data($data)->save();

			if($result){

				$this->success("操作成功!!!","__URL__/showsp/id/".$id);
			}else{
				$this->error("操作失败!!!");
			}
			

		}

		/*
		* 函数名:wancheng
		* 功能:订单完成交易
		*  @param no
		*  @return void
		*/

		function wancheng(){
			$id = $_GET['id'];
			$order = M("order");
			//完成交易
			$data['sendstatus'] = 3;
			$result = $order->where("id=$id")->data($data)->save();

			if($result){

				$this->success("操作成功!!!","__URL__/showsp/id/".$id);
			}else{
				$this->error("操作失败!!!");
			}
			
		}
							
}