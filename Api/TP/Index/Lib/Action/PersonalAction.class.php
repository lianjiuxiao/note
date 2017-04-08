<?php
// +----------------------------------------------------------------------
// | MSS V1.0 [ 模版商铺系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 四重奏项目组 All rights reserved.
// +----------------------------------------------------------------------
// | Licensed GengXin/LAMP兄弟连
// +----------------------------------------------------------------------
// | Author: GX
// | Date:   1/14/2014 16:32
// +----------------------------------------------------------------------
	/**
	 * 类名：PersonalAction
	 * 功能：用户个人中心
	 */
	class PersonalAction extends Action{

		/**
		 * 函数名：center
		 * 功能：调用个人基本信息修改页面
		 * @return [type] [description]
		 */
		function center(){

			if(empty($_SESSION['uid'])){
				$this->error('您还没有登录，请先登陆','__APP__/Login/login');
			}
			
			$user 	= M('user');
			$info 	= M('userinfo');
			$addr 	= M('address');
			$order 	= M('order');
			$goods = M('goods');
			$config = M('webconfig');
			$type 	= M('goods_vtype');
			$ordersp= M('order_detail');

			$data['user'] 		= $user->where(array('id'=>$_SESSION['uid']))->find();
			$data['info'] 		= $info->where(array('uid'=>$_SESSION['uid']))->find();
			$data['webconfig']  	= $config->where(array('item'=>'gnum_prefix'))->find();
			$data['address'] 	= $addr->where(array('uid'=>$_SESSION['uid']))->select();
			$data['order'] 		= $order->where(array('uid'=>$_SESSION['uid']))->select();

			$data['bir'] 	= explode('-',$data['info']['birthday']);					// 获取生日
			$data['city'] 	= explode('-',$data['info']['city']);					// 获取居住地
			$data['ureal'] 	= $data['info']['realname']?'readonly':"name='realname'";		// 判断真实姓名是否存在
			$data['idcn'] 	= $data['info']['idcard']?'':"name='idcard'";				// 判断身份证是否存在
			$data['creal'] 	= $data['info']['idcard']?'readonly':'';
			
			/* 判断性别默认值 */
			if($data['info']['sex'] == 1){
				$data['info']['sexa'] = 'checked';
			}else{
				$data['info']['sexa'] = '';
			}
			if($data['info']['sex'] == 2){
				$data['info']['sexb'] = 'checked';
			}else{
				$data['info']['sexb'] = '';
			}
			if($data['info']['sex'] == 3){
				$data['info']['sexc'] = 'checked';
			}else{
				$data['info']['sexc'] = '';
			}

			// 获取用户附加信息真实姓名长度
			$num = strlen($data['info']['realname']);
			$nums = floor(($num/3)-1);
			$data['cname'] = '';
			for($i = 0;$i < $nums;$i++){
				$data['cname'] .= '*'; // 分割姓名替换成*
			}

			// 循环订单
			$i = 0;
			foreach($data['order'] as $v){
				
				switch ($data['order'][$i]['paystatus']) {
					case 1:
						$data['order'][$i]['pstatus'] = '已付款';
						break;
					case 2:
						$data['order'][$i]['pstatus'] = '未付款';
						break;
					default:
						$data['order'][$i]['pstatus'] = '订单异常';
						break;
				}

				if($data['order'][$i]['pstatus'] == '已付款'){
					if($data['order'][$i]['sendstatus'] == 1){
						$data['order'][$i]['pstatus'] = '已发货';
					}
				}

				$n = 0;
				$data['ordersp'] = $ordersp->where(array('orderid'=>$v['id']))->field('id,gid')->select(); // 查询循环到的订单附表数量
				foreach($data['ordersp'] as $row){
					$data['order'][$i]['ordersp'][$n] = $ordersp->where(array('id'=>$row['id']))->field('num,gtypeid')->find(); // 获取订单附表信息
					$data['order'][$i]['ordersp'][$n]['goods'] = $goods->where(array('id'=>$row['gid']))->field('pic,gname,id,price')->find(); // 查询订单附表下的商品信息
					foreach($data['order'][$i]['ordersp'][$n]['goods'] as $value){
						// 获取商品规格信息
						$data['type'] = $type->where(array('id'=>array('exp','IN('.$data['order'][$i]['ordersp'][$n]['gtypeid'].')')))->field('typevalue')->select();

						foreach($data['type'] as $t){
							$data['order'][$i]['ordersp'][$n]['type'] = $t['typevalue'];
						}
					}
					$n++;
				}

				$i++;
			}

			//获取省份
			//所在地址province city area
			$region = M("region");
			$prodata = $region->where("region_type=1")->select();
			
			//获取省份
			$this->assign("prodata",$prodata);

			R('Base/header');
			R('Base/footer');
			$this->assign('data',$data);
			$this->display();
		}

		/**
		 * 方法名：order
		 * 功能：订单详情页
		 */
		function order($id){

			$id = intval(trim($id));

			$order 	 = M('order');
			$address = M('address');
			$good    = M('goods');
			$ordersp = M('order_detail');

			echo $id.'|'.$_SESSION['uid'];

			$data['order'] = $order->where(array('id'=>$id,'uid'=>$_SESSION['uid']))->find(); // 取出订单信息并判断用户是否登录
			$data['order']['ordersp'] = $ordersp->where(array('orderid'=>$data['order']['id']))->field('id,gid,num')->select();
			if(empty($data['order']) && empty($_SESSION['uid'])){
				$this->error('页面不存在');
			}
			$data['address'] = $address->where(array('id'=>$data['order']['receiverid']))->find();
			
			// 循环查询订单内商品信息与订单附表信息
			$i = 0;
			foreach($data['order']['ordersp'] as $v){

				$data['goods'][$i] = $good->where(array('id'=>$v['gid']))->field('id,pic,gname,price')->find();
				$data['goods'][$i]['order'] = $ordersp->where(array('id'=>$v['id']))->field('num')->find();
				$data['goods'][$i]['money'] = $data['goods'][$i]['price']*$data['order']['ordersp'][$i]['num'];
				$i++;
			}

			// 判断订单当前状态
			if(empty($data['order']['paytime'])){
				$data['order']['paytime'] = '未支付';
			}else{
				$data['order']['paytime'] = date('Y-m-d H:i:s',$data['order']['paytime']);
			}
			if(empty($data['order']['sendtime'])){
				$data['order']['sendtime'] = '未发货';
			}else{
				$data['order']['sendtime'] = date('Y-m-d H:i:s',$data['order']['sendtime']);
			}
			if(empty($data['order']['endtime'])){
				$data['order']['endtime'] = '未完成';
			}else{
				$data['order']['endtime'] = date('Y-m-d H:i:s',$data['order']['endtime']);
			}

			// 判断订单当前状态
			if($data['order']['endtime'] == '未完成'){
				$data['status'] = '未完成';
				if($data['order']['sendtime'] == '未发货'){
					$data['status'] = '未发货';
					if($data['order']['paytime'] == '未支付'){
						$data['status'] = '未支付';
					}
				}
			}

			// dump($data);
			
			R('Base/header');
			R('Base/footer');
			$this->assign('data',$data);
			$this->display();
		}

		/**
		 * 函数名：saveinfo
		 * 功能：修改个人扩展信息
		 * @return bool 判断是否修改成功
		 */
		function saveinfo(){
			
			$user = M('user');
			$info = M('userinfo');
			$region = M('region');

			$province = $region->where(array('region_id'=>$_POST['province']))->field('region_name')->find();
			$city = $region->where(array('region_id'=>$_POST['city']))->field('region_name')->find();
			$county = $region->where(array('region_id'=>$_POST['county']))->field('region_name')->find();

			// 判断是否上传了头像
			if(!empty($_FILES['headpic']['name'])){
				
				$lpic = $user->where(array('id'=>$_SESSION['uid']))->field('headpic')->find();
				if($lpic != 'headpic.gif'){								// 判断原头像是否为默认头像
					unlink("Public/Uploads/headpic/".$lpic['headpic']); 				// 删除原有头像
				}
				$pic = $this->uploads();
				$_POST['headpic'] = $pic[0]['savename'];
			}

			$_POST['birthday'] = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
			$_POST['city'] = $province['region_name'].'-'.$city['region_name'].'-'.$county['region_name'];	 // 拼接居住地
			
			
			if($info->where(array('uid'=>$_SESSION['uid']))->save($_POST) | $user->where(array('id'=>$_SESSION['uid']))->save($_POST)){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}

		/**
		 * 函数名：saveuser
		 * 功能：修改个人基本信息
		 * @return [type] [description]
		 */
		function saveuser(){

			$user = M('user');

			if($_POST['luserpwd'] && $_POST['userpwd']){

				$lpwd = $user->where(array('id'=>$_SESSION['uid']))->field('userpwd')->find(); // 获取用户原密码
				
				if($lpwd['userpwd'] == md5($_POST['luserpwd'])){		// 判断原密码是否匹配成功
					if(md5($_POST['userpwd']) != $lpwd['userpwd']){ 	// 判断原密码是否与要修改密码相同
						$_POST['userpwd'] = md5($_POST['userpwd']);
					}else{
						$this->error('修改密码与原密码相同');
					}
				}else{
					$this->error('原密码错误');
				}
			}

			if($user->where(array('id'=>$_SESSION['uid']))->save($_POST)){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}

		/**
		 * 函数名：addressList
		 * 功能：收货地址管理列表
		 * @return [type] [description]
		 */
		function addressList(){

			$addr = M('address');
			$data = $addr->where(array('uid'=>$_SESSION['uid']))->select();



			$this->assign('data',$data);
			$this->display();
		}

		/**
		 * 函数名：addressAdd
		 * 功能：收货地址添加
		 * @return [type] [description]
		 */
		function addressAdd(){

			$addr = M('address');
			$region = M('region');

			$province = $region->where(array('region_id'=>$_POST['province']))->field('region_name')->find();
			$city = $region->where(array('region_id'=>$_POST['city']))->field('region_name')->find();
			$county = $region->where(array('region_id'=>$_POST['area']))->field('region_name')->find();

			$_POST['province'] = $province['region_name'];
			$_POST['city'] = $city['region_name'];
			$_POST['area'] = $county['region_name'];

			$num = count($addr->where(array('uid'=>$_SESSION['uid']))->select()); // 计算当前已存收货地址数量
			$_POST['uid'] = $_SESSION['uid'];

			if($num < 10){
				if($addr->add($_POST)){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error('您已保存10个收货地址,您可以修改收货地址');
			}
		}

		/**
		 * 函数名：addressFind
		 * 功能：单个收货地址
		 * @return [type] [description]
		 */
		function addressFind(){

			$id = trim(intval($_GET['id']));

			$addr = M('address');
			
			$result = $addr->where(array('id'=>$id))->find();
			$this->ajaxReturn($result);
		}

		/**
		 * 函数名：addressSave
		 * 功能：收货地址修改
		 * @return [type] [description]
		 */
		function addressSave(){

			$id = trim(intval($_POST['id']));

			$addr = M('address');
			
			if($addr->where(array('id'=>$id,'uid'=>$_SESSION['uid']))->save()){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}

		/**
		 * 函数名：addressDel
		 * 功能：收货地址删除
		 * @return [type] [description]
		 */
		function addressDel($id){

			$id = trim(intval($id));

			$addr = M('address');

			if($addr->where(array('id'=>$id,'uid'=>$_SESSION['uid']))->delete()){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}

		/**
		 * 函数名：addressDef
		 * 功能：修改默认收货地址
		 * @param  int $id 要修改的收货地址的id
		 * @return [type]     [description]
		 */
		function addressDef($id){

			$id = trim(intval($id));

			$addr = M('address');
			$data = $addr->where(array('uid'=>$_SESSION['uid'],'isdefault'=>1))->find();
			if(!empty($data)){

				$save['isdefault'] = 2;
				$addr->where(array('uid'=>$_SESSION['uid'],'isdefault'=>1))->save($save);				
			}

			$save['isdefault'] = 1;
			if($addr->where(array('uid'=>$_SESSION['uid'],'id'=>$id))->save($save)){
				$this->success('设置成功');
			}else{
				$this->error('设置失败');
			}
		}

		/**
		 * 函数名：addCollect
		 * 功能：添加收藏
		 * @param int $gid 要收藏的商品id
		 */
		function addCollect($gid){

			if(empty($_SESSION['uid'])){		// 判断是否登录
				$this->error('请登录');
			}

			$data['uid'] = $_SESSION['uid'];		// 获取用户id
			$data['gid'] = intval(trim($gid));	// 获取商品id
			$data['addtime'] = time();		// 获取当前时间

			$collect = M('collect');
			
			if($collect->add($data)){		// 判断是否添加成功
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
		}

		/**
		 * 函数名：delCollect
		 * 功能：删除收藏
		 * @param int $cid 要删除的收藏id
		 */
		function delCollect($cid){

			if(empty($_SESSION['uid'])){	// 判断是否登录
				$this->error('请登录');
			}

			$uid = $_SESSION['uid'];

			$collect = M('collect');
			
			$con = $collect->where(array('id'=>$cid,'uid'=>$uid))->select();	// 获取当前收藏id是否属于当前登录用户的收藏
			if(!empty($con)){

				if($collect->where(array('id'=>$cid,'uid'=>$uid))->delect()){	// 判断是否删除成功
					$this->success('删除成功');
				}else{
					$this->error('删除失败');
				}
			}else{
				$this->error('参数错误');
			}
		}

		/**
		 * 函数名:phoneverify
		 * 功能：保存发送的手机验证码
		 */
		function phoneverify(){

			$verify = intval(trim($_GET['verify']));

			$_SESSION['verify'] = $verify;
		}

		/**
		 * 函数名:isVerify
		 * 功能:判断手机验证码是否正确
		 */
		function isVerify(){

			$verify = intval(trim($_GET['verify']));
			if($_SESSION['verify'] == $verify){
				$this->ajaxReturn('true');
			}else{
				$this->ajaxReturn('false');
			}
		}

		/**
		 * 函数名:getprivince
		 * 功能:获取省份
		 */
		function getprivince(){
			$region = M('region');
			$arr = $region->where("region_type=1")->select();
			$str=json_encode($arr);
			echo $str;
		}

		/**
		 * 函数名:getcity
		 * 功能:获取城市名
		 */
		function getcity(){
			$region_id = $_GET['region_id'];
			$region = M('region');
			$arr = $region->where("parent_id=$region_id")->select();
			$str=json_encode($arr);
			echo $str;
		}

		/**
		 * 函数名:getarea
		 * 功能:获取城镇
		 */
		function getarea(){
			$region_id = $_GET['region_id'];
			$region = M('region');
			$arr = $region->where("parent_id=$region_id")->select();
			$str=json_encode($arr);
			echo $str;
		}

		
		/**
		 * 函数名：uploads
		 * 功能：图片上传函数
		 * @return  array 上传后的文件详细信息
		 */
		function uploads(){

			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			$upload->maxSize  = 314572800;
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath =  './Public/Uploads/headpic/';
			

			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				return $upload->getUploadFileInfo();
			}
		}
	}