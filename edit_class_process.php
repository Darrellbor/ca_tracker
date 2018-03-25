<?php
	session_start();
	include_once("db_connect.php");
	
	$registration_id=isset($_POST['reg_no']) ?trim($_POST['reg_no']) : "";
	$class=isset($_POST['class']) ?trim($_POST['class']) : "";
	$arm=isset($_POST['arm']) ?trim($_POST['arm']) : "";
	$status=isset($_POST['status']) ?trim($_POST['status']) : "";
	
	$_SESSION['reg_no']="$registration_id";
	$_SESSION['class']="$class";
	$_SESSION['arm']="$arm";
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
	$update_sql=mysql_query("update class set class='$class',arm='$arm'");
	if($update_sql==FALSE)
	{
		$_SESSION['message']="Error encountered updating class records";
		$_SESSION['messagetype']="error";
		header("location: edit_class.php");
		exit();
	}
	else 
	{
		unset($_SESSION['reg_no'],$_SESSION['class'],$_SESSION['arm'],$_SESSION['status']);
		$_SESSION['message']="($registration_id) class records was successfully updated";
		$_SESSION['messagetype']="success";
		header("location: manage_class.php");
		exit();
	}
?>
</body>
</html>