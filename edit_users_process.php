<?php
	session_start();
	require_once("db_connect.php");
	
	$email=isset($_POST['email']) ? trim($_POST['email']) : "";
	$full_name=isset($_POST['full_name']) ? trim($_POST['full_name']) : "";
	$password=isset($_POST['password']) ? ($_POST['password']) : "";
	$user_category=isset($_POST['user_category']) ? trim($_POST['user_category']) : "";
	$occupation=isset($_POST['occupation']) ? trim($_POST['occupation']) : "";
	$state=isset($_POST['state']) ? trim($_POST['state']) : "";
	$address=isset($_POST['address']) ? trim($_POST['address']) : "";
	$status=isset($_POST['status']) ? trim($_POST['status']) : "";
	
	$_SESSION['email']="$email";
	$_SESSION['full_name']="$full_name";
	$_SESSION['password']="$password";
	$_SESSION['user_category']="$user_category";
	$_SESSION['occupation']="$occupation";
	$_SESSION['state']="$state";
	$_SESSION['address']="$address";
	$_SESSION['status']="$status";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php
		$update_sql=mysql_query("update users set email='$email', full_name='$full_name', password='$password', user_category='$user_category', occupation='$occupation', state='$state', address='$address', status='$status' where email=('$email')");
		if($update_sql==FALSE)
		{
			$_SESSION['message']="Error encountered updating user information!";
			$_SESSION['messagetype']="error";
			header("location: edit_users.php");
			exit();
		}
		
		else
		{
			unset($_SESSION['email'], $_SESSION['full_name'], $_SESSION['password'], $_SESSION['user_category'], $_SESSION['occupation'], $_SESSION			['state'], $_SESSION['address'], $_SESSION['status']);
			$_SESSION['message']="user ($email) record has been successfully updated";
			$_SESSION['messagetype']="success1";
			header("location: manage_users.php");
			exit();
		}
	?>
</body>
</html>