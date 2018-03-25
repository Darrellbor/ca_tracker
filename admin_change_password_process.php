<?php
	session_start();
	require_once("db_connect.php");
	
	$current_pass=isset($_POST['current_pass']) ? ($_POST['current_pass']) : "";
	$new_pass=isset($_POST['New_pass']) ? ($_POST['New_pass']) : "";
	$re_new_pass=isset($_POST['re_new_pass']) ? ($_POST['re_new_pass']) : "";
	
	$_SESSION['current_pass']="$current_pass";
	$_SESSION['New_pass']="$new_pass";
	$_SESSION['re_new_pass']="$re_new_pass";
	
	if($current_pass=="" || $new_pass=="" || $re_new_pass=="")
	{
		$_SESSION['message']="Please make sure that all passwords are filled!";
		$_SESSION['messagetype']="error";
		header("Location: admin_change_password.php");
		exit();
	}
	
	//check if the information inputed is legit
		$get_user=mysql_query("select * from `users` where (email='".$_SESSION['current_user_email']."' and password='$current_pass')");
		if($get_user==FALSE)
		{
			$_SESSION['message']="Error encountered selecting users information";
			$_SESSION['messagetype']="error";
			header("Location: admin_change_password.php");
			exit();
		}
		
		$total_get_user=mysql_num_rows($get_user);
	
		if($total_get_user<=0)
		{
			$_SESSION['message']="The current password you entered is incorrect!";
			$_SESSION['messagetype']="error";
			header("location: admin_change_password.php");
			exit();
		}
		
		//if we reach this point it means that the current password inputed is legit and we can go ahead to add the new password to the datebase
		if($new_pass==$current_pass)
		{
			$_SESSION['message']="Please make sure that your old password is not the same with the new!";
			$_SESSION['messagetype']="error";
			header("Location: admin_change_password.php");
			exit();
		}
		
		if($new_pass!=$re_new_pass)
		{
			$_SESSION['message']="The new passwords you entered do not match";
			$_SESSION['messagetype']="error";
			header("Location: admin_change_password.php");
			exit();
		}
		
		$insert_password=mysql_query("update `users` set password='$new_pass' where email='".$_SESSION['current_user_email']."'");
		if($insert_password==FALSE)
		{
			$_SESSION['message']="Error encoutered updating users password";
			$_SESSION['messagetype']="error";
			header("Location: admin_change_password.php");
			exit();
		}
		
		$_SESSION['message']="Your password was successfully updated!";
		$_SESSION['messagetype']="success1";
		header("Location: admin_change_password.php");
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