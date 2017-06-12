<?php 
$ret = array(  
    'name' => isset($_POST['name'])? $_POST['name'] : '',  
    'gender' => isset($_POST['gender'])? $_POST['gender'] : ''  
); 

//如果不加header('Access-Control-Allow-Origin:"*"'),则不能跨域访问!
// 指定允许其他域名访问  
// 测试文件设置为"*",开发时,请指定允许访问的域名
header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:POST');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type');

echo json_encode($ret);
?>