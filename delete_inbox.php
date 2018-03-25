<?php
	session_start();
	require_once("db_connect.php");
	
	$message_id=isset($_GET['message_id']) ? trim($_GET['message_id']) : "";
	
	$update_sql="update `messages` set recepient_visible='no' where message_id='$message_id'";
	$delete_message=mysql_query($update_sql);
	if($delete_message==FALSE)
	{
		$_SESSION['message']="Error encountered deleting message!";
		$_SESSION['messagetype']="error";
		header("Location: inbox.php");
		exit();
	}
		$_SESSION['message']="Message successfully deleted";
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