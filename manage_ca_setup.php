<?php
	session_start();
	require_once("db_connect.php"); 
	
	$update_page_visited=mysql_query("update `page_visited` set visited='yes' where registration_id='".$_SESSION['current_user_reg_no']."'");
	if($update_page_visited==FALSE)
	{
		$_SESSION['message']="Error encountered updating visited status!";
		$_SESSION['messagetype']="error";
		header("Location: manage_ca.php");
		exit();
	}
	
	header("Location: view_classwork.php");
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>