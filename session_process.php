<?php
	session_start();
	require_once("db_connect.php");
	
	$enter=isset($_POST['enter']) ?trim($_POST['enter']) : "";
	$_SESSION['enter']="$enter";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$update_sql=mysql_query("update session set current_session='$enter'");
	if($update_sql==FALSE)
	{
		$_SESSION['message']="Error changing session! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: manage_session.php");
		exit();
	}
	else 
	{
		unset($_SESSION['enter']);
		$_SESSION['message']="Session successfully changed!";
		$_SESSION['messagetype']="success";
		header("location: manage_session.php");
		exit();
	}
?>
</body>
</html>