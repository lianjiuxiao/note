<?php 
	/**
	* 类名：BaseAction
	* 功能：网站配置公共类
	*/
	class BaseAction extends Action{
		
		/**
		 * 方法名：header
		 * 功能：网站配置头公共方法
		 */
		function header(){

			$config = M('webconfig');
			$data = $config->select();
			
			/* 数组重组 */
			foreach($data as $v){
				$data[$v['item']] = $v['content'];
			}

			$this->assign('head',$data);
		}

		/**
		 * 方法名：footer
		 * 功能：网站配置公共方法
		 */
		function footer(){

			$config = M('webconfig');
			$links = M('links');
			$data = $config->select();
			$data['links'] = $links->select();

			/* 数组重组 */
			foreach($data as $v){
				$data[$v['item']] = $v['content'];
			}

			$this->assign('foot',$data);
		}
	}