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
	* 功能：显示订单提交结果，跳转到支付接口
	*/
	class PayAction extends Action {

		//生成订单页面的方法
		function index(){
			
			$order = M('order');
			//订单编号
			/*$dingdan['ordernum'] = $_SESSION['uid'].'a'.time();*/
			$dingdan['ordernum'] = 'M'.date("YmdHim",time());
			//购买数量
			$dingdan['buynum'] = trim($_POST['buynum']);	
		
			//下单时间
			$dingdan['addtime'] = time();
			//订单状态 1:已确认2:未确认 生成订单是状态是2	 
			$dingdan['orderstatus'] = 2;
			 //支付状态 1.已支付 2:未支付
			$dingdan['paystatus'] = 2;
			 //发送货物状态 1:已发货 2:未发货 3:配货中 4:交易确认	
			$dingdan['sendstatus'] = 2;
			//用户下订单时的留言信息，如运送的方式等等
			$dingdan['uremark'] = $_POST['uremark'];
			//订单用户id 通过SESSION 获取
			$dingdan['uid']=$_SESSION['uid'];
			//配送时间再刚下订单的时候为默认为0,还未配送	
			$dingdan['pstime'] = 0;
			//收货人id shouid
			$dingdan['receiverid'] = $_POST['shouid'];

			if(empty($_POST['deliverymethod'])){
				//判断支付的方式选择了没有，没选择的话用默认的
				 //方便起见，默认是支付宝
				$dingdan['paytype'] = 1;						
			}else{
				$dingdan['paytype'] = $_POST['deliverymethod'];
			}
			
			if(empty($_POST['paymethod'])){
				//判断快递配送方式选择与否，无则默认收货方式，默认是邮局
				$dingdan['dilivery_id'] = 2;				
			}else{
				//选择了则为用户选择的方式
				$dingdan['dilivery_id'] = $_POST['paymethod'];
				//transcosts
				$dilivery = M("dilivery");
				$datadilivery = $dilivery->where("id=".$_POST['paymethod'])->find();
			
				$dingdan['transcosts'] = $datadilivery['yunfei'];

			}
			
			//订单总价	
			$dingdan['totalprice'] = trim($_POST['totalprice']); 
			//订单实际价格realprice
			$dingdan['realprice'] = trim($_POST['totalprice']) + $dingdan['transcosts']; 
			//添加生成新的订单
			$result = $order->data($dingdan)->add();

			$jilu['did']  = $result;		    //订单id
			$jilu['time'] = time();  	    //创建时间
			$jilu['content'] = '订单创建';

			//把订单id存进session，跳转后用于显示订单的简单生成信息
			$_SESSION['ordernum'] = $result; 
			
			//向订单商品详情表中插入数据
			$ordersp= M('order_detail');
			$length = count($_POST['goodid']);

			for($i = 0; $i < $length;$i++){
				//商品号
				$dsp['gid'] = $_POST['goodid'][$i];	
				//规格号
				$dsp['gtypeid'] = $_POST['guigeid'][$i];
				//数量
				$dsp['num'] = $_POST['addnum'][$i];
				//商品单价
				$dsp['price']= $_POST['price'][$i];	
				//商品小计
				$dsp['subtotal']= $_POST['xiaoji'][$i]; 
				//订单编号
				$dsp['orderid']  = $result;		       	
				//添加到订单商品详情表里面
				$presult = $ordersp->data($dsp)->add();
			}
			
			if($result){
				//订单提交成功后把购物车里面的商品和订单信息存入
				//到购物车表里，查订单历史记录
				//$carts = M("carts");
				//$User->where('status=0')->delete(); // 删除所有状态为0的用户数据
				//$uid = $_SESSION['uid'];
				//$dresult = $carts->where("uid=1")->delete();
				//redirect('/New/category/cate_id/2', 5, '页面跳转中...')
				//$this->redirect("/Order/index",3, '页面跳转中...');
				$this->success("订单提交成功!!!","pay");
			}else{
				$this->error("订单提交失败!!!");
			}

			/*//用来判断用户的是购物车结算的
			if($_POST['jiesuan']){
				$_SESSION['gw']="";
				$_SESSION['jian']="";
				$_SESSION['jia']="";
			}*/
		
		}
		/**
		 * 显示订单提交结果页面
		 * @return [type] [description]
		 */
		public function pay() {
			//获取提交是的订单id
			$orderid = $_SESSION['ordernum'];
			$order = M("order");
			$odata = $order->where("id=$orderid")->find();

			//获取提交订单的支付方式和配货方式并组装数组
			$pays = M("pays");
			$pdata = $pays->where("id=".$odata['paytype'])->find();
			$odata['payname'] = $pdata['name'];

			$dilivery = M("dilivery");
			$ddata = $dilivery->where("id=".$odata['dilivery_id'])->find();
			$odata['diliveryname'] = $ddata['name'];
			$this->assign("odata",$odata);
			R('Base/header');
			R('Base/footer');
			$this->display();
		}

	}