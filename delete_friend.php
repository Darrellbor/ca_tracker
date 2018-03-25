<?php
	session_start();
	require_once("db_connect.php");
	
	$friend_registration_id=isset($_GET['reg_id']) ? trim($_GET['reg_id']) : "";
	$_SESSION['friend_registration_id']="$friend_registration_id";
	
	$del_main_acc=mysql_query("delete from `friends` where (main_account='".$_SESSION['current_user_reg_no']."' and budd_registration_id='$friend_registration_id')");
	if($del_main_acc==FALSE)
	{
		$_SESSION['message']="Error encountered deleting friend";
		$_SESSION['messagetype']="error";
		header("Location: my_friends.php");
		exit;
	}
	
	$del_budd_acc=mysql_query("delete from `friends` where (main_account='$friend_registration_id' and budd_registration_id='".$_SESSION['current_user_reg_no']."')");
	if($del_budd_acc==FALSE)
	{
		$_SESSION['message']="Error encountered deleting friend";
		$_SESSION['messagetype']="error";
		header("Location: my_friends.php");
		exit;
	}
	
	unset($_SESSION['friend_registration_id']);
	$_SESSION['message']="Your delete was successfull";
	$_SESSION['messagetype']="success2";
	header("Location: my_friends.php");
	exit;
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