<?php
	session_start();
	include_once("db_connect.php");
	
	$registration_id=isset($_POST['reg_no']) ?trim($_POST['reg_no']) : "";
	$school_name=isset($_POST['school_name']) ?trim($_POST['school_name']) : "";
	$status=isset($_POST['status']) ?trim($_POST['status']) : "";
	
	$_SESSION['reg_no']="$registration_id";
	$_SESSION['school_name']="$school_name";
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
	$update_sql=mysql_query("update school set school_name='$school_name' where (registration_id='$registration_id')");
	if($update_sql==FALSE)
	{
		$_SESSION['message']="Error encountered updating student school record!";
		$_SESSION['messagetype']="error";
		header("location: edit_school.php");
		exit();
	}
	else
	{
		unset($_SESSION['registration_id'],$_SESSION['school_name'],$_SESSION['status']);
		$_SESSION['message']="($registration_id) school information has been updated";
		$_SESSION['messagetype']="success";
		header("location: manage_school.php");
		exit();
	}
?>
</body>
</html>