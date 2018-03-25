<?php
	session_start();
	require_once("db_connect.php");
	
	$email=isset($_GET['email']) ? trim($_GET['email']) : "";
	$registration_id=isset($_GET['reg_no']) ?trim($_GET['reg_no']) : "";
	
	$_SESSION['email']="$email";
	$_SESSION['registration_id']="$registration_id";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php
	
		$del_subjects=mysql_query("update subjects set status='Inactive' where (registration_id='$registration_id')");
		if($del_subjects==FALSE)
		{
			$_SESSION['message']="Error deleting subject record! ".mysql_error();
			$_SESSION['messagetype']="error";
			header("location: manage_students.php");
			exit();
		}
		
		$del_class=mysql_query("update class set status='Inactive' where (registration_id='$registration_id')");
		if($del_class==FALSE)
		{
			$_SESSION['message']="Error encountered deleting class records! ".mysql_error();
			$_SESSION['messagetype']="error";
			header("location: manage_students.php");
			exit();
		}
		
		$del_sql=mysql_query("update students set status='Inactive' where email='$email'");
		if($del_sql==FALSE)
		{
			$_SESSION['message']="Error deleting student! " .mysql_error();
			$_SESSION['messagetype']="error";
			header("location: manage_students.php");
			exit();
		}
		else
		{
			unset($_SESSION['email'],$_SESSION['registration_id']);
			$_SESSION['message']="student ($email) has been successfully deleted";
			$_SESSION['messagetype']="success2";
			header("location: manage_students.php");
			exit();
		}
	?>
</body>
</html>