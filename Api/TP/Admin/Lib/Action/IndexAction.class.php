<?php
	/**('后台登录页面');
	 * 
	 */
	class IndexAction extends Action {

		Public function verify(){
		    import("ORG.Util.Image");
		    Image::GBVerify();
		}


		/**
		 * 函数名：
		 * 功能：
		 */
	    public function index(){
	    	/* 判断是否登录或session过期 */
	    	if(empty($_SESSION['id'])){
	    		$this->display('Login/index');
	    	}else{
	    	
	    	
	    	/* 系统信息 */
		    $sys_info['os']            = PHP_OS;
		    $sys_info['ip']            = $_SERVER['SERVER_ADDR'];
		    $sys_info['web_server']    = $_SERVER['SERVER_SOFTWARE'];
		    $sys_info['php_ver']       = PHP_VERSION;
		   // $sys_info['mysql_ver']     = $mysql_ver;

		$lastmonday = strtotime("last Monday");
		$lastsunday = strtotime("last Sunday");

		/* 统计信息 */
		$user = M('user');
		$stat['user'] = $user->where('ustatus=1')->count();
		$stat['lastuser'] = $user->where(array('regtime'=>array('between',array($lastmonday,$lastsunday))))->count();
		$order = M('order');
		$stat['order'] = $order->count();
		$stat['complete'] = $order->where('paystatus=3')->count();
		$stat['imperfect'] = $order->where(array('paystatus'=>array('not in',array('3'))))->count();
		$goods = M('goods');
		$stat['goods'] = $goods->count();

		$this->assign('stat',$stat);
		$this->assign('log',R('Alog/indexlist'));
		$this->assign('sysinfo', $sys_info);
	    	$this->display();
	    	}
	    	
	    }

		/**
		 * 函数名：logout
		 * 功能：退出后台管理面板，跳转到后台登录页面
		 */
	    public function logout() {

	    	// 退出操作
	    //	echo '退出登录';

	    	// 成功退出，显示后台登录页面

	    	unset($_SESSION['status']);
	    	unset($_SESSION['level']);
	    	$this->redirect('Login/index');

	    }
	
}