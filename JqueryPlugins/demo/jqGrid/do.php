<?php
include_once ("connect.php");
$action = $_GET['action'];
switch ($action) {
	case 'list' : //列表
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
//		$page = 1;
//		$limit = 12;
//		$sidx = 'id';
//		$sord = 'asc';
		if (!$sidx)
			$sidx = 1;

        $where = '';
        $title = uniDecode($_GET['title'],'utf-8');
        if(!empty($title))
            $where .= " and title like '%".$title."%'";
        $sn = uniDecode($_GET['sn'],'utf-8');
        if(!empty($sn))
            $where .= " and sn='$sn'";

		$result = mysql_query("SELECT COUNT(*) AS count FROM products where deleted=0".$where);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$count = $row['count'];
		//echo $count;

		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages)
			$page = $total_pages;
		$start = $limit * $page - $limit;
		if ($start<0) $start = 0;
		$SQL = "SELECT * FROM products WHERE deleted=0".$where." ORDER BY $sidx $sord LIMIT $start , $limit";
		$result = mysql_query($SQL) or die("Couldn t execute query." . mysql_error());

		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i = 0;
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$responce->rows[$i]['id'] = $row[id];
			$opt = "<a href='#'>修改</a>";
			$responce->rows[$i]['cell'] = array (
				$row['sn'],
				$row['title'],
				$row['size'],
				$row['os'],
				$row['charge'],
				$row['price'],
				$opt
			);
			$i++;
		}
		//print_r($responce);
		echo json_encode($responce);
		break;
	case 'add' : //新增
		$pro_title = htmlspecialchars(stripslashes(trim($_POST['pro_title'])));
		$pro_sn = htmlspecialchars(stripslashes(trim($_POST['pro_sn'])));
		$size = htmlspecialchars(stripslashes(trim($_POST['size'])));
		$os = htmlspecialchars(stripslashes(trim($_POST['os'])));
		$charge = htmlspecialchars(stripslashes(trim($_POST['charge'])));
		$price = htmlspecialchars(stripslashes(trim($_POST['price'])));
		if (mb_strlen($pro_title) < 1)
			die("产品名称不能为空");
		$addtime = date('Y-m-d H:i:s');
		$query = mysql_query("insert into products(sn,title,size,os,charge,price,addtime)values('$pro_sn','$pro_title','$size','$os','$charge','$price','$addtime')");
		if (mysql_affected_rows($link) != 1) {
			die("操作失败");
		} else {
			echo '1';
		}

		break;
	case 'del' : //删除
		$ids = $_POST['ids'];
		delAllSelect($ids, $link);
		break;
	case '' :
		echo 'Bad request.';
		break;
}

//批量删除操作
function delAllSelect($ids, $link) {
	if (empty ($ids))
		die("0");
	mysql_query("update products set deleted=1 where id in($ids)");
	if (mysql_affected_rows($link)) {
		echo $ids;
	} else {
		die("0");
	}
}

//处理接收jqGrid提交查询的中文字符串
function uniDecode($str, $charcode) {
	$text = preg_replace_callback("/%u[0-9A-Za-z]{4}/", toUtf8, $str);
	return mb_convert_encoding($text, $charcode, 'utf-8');
}
function toUtf8($ar) {
	foreach ($ar as $val) {
		$val = intval(substr($val, 2), 16);
		if ($val < 0x7F) { // 0000-007F
			$c .= chr($val);
		}
		elseif ($val < 0x800) { // 0080-0800
			$c .= chr(0xC0 | ($val / 64));
			$c .= chr(0x80 | ($val % 64));
		} else { // 0800-FFFF
			$c .= chr(0xE0 | (($val / 64) / 64));
			$c .= chr(0x80 | (($val / 64) % 64));
			$c .= chr(0x80 | ($val % 64));
		}
	}
	return $c;
}
?>