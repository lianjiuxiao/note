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
	/************************* 模版设置 *************************/
	// 'URL_PATHINFO_DEPR'=>'-',	// 修改URL的分隔符
	'TMPL_L_DELIM'=>'<{', 			//修改左定界符
	'TMPL_R_DELIM'=>'}>', 			//修改右定界符
	'DEFAULT_MODULE'     => 'Index', //默认模块
	);