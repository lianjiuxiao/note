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
 *  类名:GoodsAction 模版信息控制类
 *  功能:实现后台对模版的显示,增删和切换操作
 */
class ModelAction extends Action{
	
		/*
		* 函数名:set
		* 功能:执行模版切换信息输出
		*/
		Public function set(){
			$this->display();
		}

		/*
		* 函数名:list
		* 功能:模版列表信息输出
		*/
		Public function lists(){

			$model = M('model');
			$result = $model->order('id desc')->select();

			$this->assign('data',$result);
			$this->display();
		}

		/**
		 * 函数名：del
		 *功能：删除指定模板
		 */
		Public function del($id){

			$id = intval(trim($id));


			$model = M('model');

			if($model->where(array('id'=>$id))->delete()){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}

		/*
		* 函数名:add
		* 功能:添加主题模版
		*/
		Public function add(){
			$this->display();
		}

		/*
		* 函数名:setModel
		* 功能:修改配置项，执行模版切换
		*/
		Public function setModel(){
			
			$model = $_POST['model'];

			// 对配置文件进行操作，修改配置项DEFAULT_MODULE，切换默认模版
			$file = "./Index/Conf/config.php";
			$tstr = file_get_contents($file);				
			$pattern = "/'DEFAULT_MODULE(.*?)*,/";
			// echo preg_match($pattern,$tstr,$arr);
			// echo $arr[0];
			$replacement = "'DEFAULT_MODULE'=>'".$model."',";
			$content = preg_replace($pattern, $replacement, $tstr);
			$fp = fopen($file,'w');
			fwrite($fp,$content);
			fclose($fp);

			//模版切换提示信息
			if($content){
			    
			    $dirs = array('Index/Runtime/');
			  	@mkdir('Runtime',0777,true);
			  	//清理缓存
			  	foreach($dirs as $value) {
			   		$this->rmdirr($value);
			  	}
			    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
			    $this->success('模版切换成功,缓存清除成功', 'set');
			} else {
			    
			    //错误页面的默认跳转页面是返回前一页，通常不需要设置
			    $this->error('模版切换失败，请重新切换', 'set');
			}

		}

		/*
		* 函数名:rmdir
		* 功能:清除指定目录的缓存文件
		*/
		Public function rmdirr($dirname) {
			if (!file_exists($dirname)) {
		   		return false;
		  	}
		 	if (is_file($dirname) || is_link($dirname)) {
		  		return unlink($dirname);
		  	}
		  	$dir = dir($dirname);
		  	if($dir){
		   		while (false !== $entry = $dir->read()) {
					if ($entry == '.' || $entry == '..') {
			 			continue;
					}
				//递归
					$this->rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
		   		}
		  	}
		  	$dir->close();
		 	return rmdir($dirname);
		}
}