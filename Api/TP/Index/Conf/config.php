<?php
return array(
	
	/************************* 数据库设置 *************************/
 	'DB_TYPE'=> 'mysql',             	// 数据库类型
 	'DB_HOST'=> 'localhost',       	 	// 服务器地址
 	'DB_NAME'=> 'loc.wazyb.com',              	// 数据库名称
 	'DB_USER'=> 'root',              	// 用户名
 	'DB_PWD'=> '123456',        	  		// 密码
 	'DB_PORT'=> 3306,        	 	 	// 端口
 	'DB_PREFIX'=> 'mss_', 		  	 	// 数据库表前缀
 	// 'DB_DSN'=>'mysql://root:@localhost:3306/thinkphp', // 使用DSN方式配置数据库信息

 	/************************* 调试设置 *************************/
	//'APP_DEBUG'=> true,		  		 // 开启调试模式
	//'APP_STATUS' => 'debug', 		 //应用调试模式状态			
	//'SHOW_PAGE_TRACE'=> true,	  	 // 显示调试信息  

	/************************* 模版设置 *************************/
	// 'URL_PATHINFO_DEPR'=>'-',	// 修改URL的分隔符
	'TMPL_L_DELIM'=>'<{', 			//修改左定界符
	'TMPL_R_DELIM'=>'}>', 			//修改右定界符
	'DEFAULT_MODULE'=>'Index', //默认模块

	/************************* 缓存设置 *************************/
	 //'ACTION_CACHE_ON' => true,	  //开启缓存
	 //'SQL_DEBUG_LOG' => true,	  	  //sql调试日志
	 //'DATA_CACHE_TYPE'=> 'Memcache',
	 //'MEMCACHE_HOST'=> 'tcp://127.0.0.1:11211',
	 //'DATA_CACHE_TIME'=>'300',
	 //'TMPL_CACHE_ON'=>true,        	  // 是否开启模板编译缓存,设为false则每次都会重新编译
	 // 'TMPL_CACHE_TIME'=>3600,         // 模板缓存有效期 -1 为永久，(以数字为值，单位:秒)
	 //'DATA_CACHE_TYPE'=>'File',  
	 //'DEFAULT_TIMEZONE'=>'PRC'
	 //'RUNTIME_ALLINONE'=>true,  // 开启ALLINONE运行模式
	 //'HTML_CACHE_ON'=>true,        // 默认关闭静态缓存
	 // 'HTML_CACHE_TIME'=>3600,       // 静态缓存有效期
);