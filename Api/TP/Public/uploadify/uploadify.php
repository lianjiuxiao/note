<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/mss/Public/Uploads/headpic'; // Relative to the root

if (!empty($_FILES)) {
	$id = $_GET['uid'];
	$time = time();
	$pname = substr(md5($_FILES['Filedata']['name']),6);
	$kuozhan = explode('.',$_FILES['Filedata']['name']);
	$num = count($kuozhan);
	$headpic = substr($time,5,11) . $pname . '.' . $kuozhan[$num-1];

	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $headpic;
	
	$link = mysql_connect("localhost","root","1314");
	mysql_select_db('mss');
	mysql_set_charset("utf8");

	$sql = "UPDATE mss_user SET headpic='$headpic' WHERE id=$id";
	mysql_query($sql);
	

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
?>