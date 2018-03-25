<?php
	session_start();
	require_once("db_connect.php");
	
	$message_id=isset($_GET['message_id']) ? trim($_GET['message_id']) : "";
	
	$select_from_friends=mysql_query("select * from `friends` where main_account='".$_SESSION['current_user_reg_no']."' and budd_registration_id='".$_SESSION['sender_reg_id']."'");
	if($select_from_friends==FALSE)
	{
		$_SESSION['message']="Error encountered while selecting friend request.".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: inbox.php");
		exit();
	}
	$total_row=mysql_num_rows($select_from_friends);
	if($total_row>0)
	{
		$_SESSION['message']="Can't perform this action! You are already friends with ".$_SESSION['sender_name'];
		$_SESSION['messagetype']="error";
		header("Location: inbox.php");
		exit();
	}
	
	$del_sql="delete from `messages` where message_id='$message_id'";
	$reject_friend=mysql_query($del_sql);
	if($reject_friend==FALSE)
	{
		$_SESSION['message']="Error encountered rejecting request!";
		$_SESSION['messagetype']="error";
		header("Location: inbox.php");
		exit();
	}
	
	unset($_SESSION['sender_reg_id']);
	$_SESSION['message']=$_SESSION['sender_name']." request rejected succesfully!";
	$_SESSION['messagetype']="success2";
	header("Location: inbox.php");
	exit();
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