<?php
	session_start();
	require_once("db_connect.php");
	
	$email=isset($_GET['email']) ?trim($_GET['email']) : "";
	
	$_SESSION['email']="$email";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php
		$del_sql=mysql_query("update users set status='Inactive' where email='$email'");
		if($del_sql==FALSE)
		{
			$_SESSION['message']="Error deleting user!";
			$_SESSION['messagetype']="error";
			header("location: manage_users.php");
			exit();
		}
		else
		{
			unset($_SESSION['email']);
			$_SESSION['message']="user ($email) has been successfully deleted";
			$_SESSION['messagetype']="success2";
			header("location: manage_users.php");
			exit();
		}
	?>
</body>
</html>