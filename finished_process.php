<?php
	session_start();
	include_once("db_connect.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$registration_id=$_SESSION['current_user_reg_no'];
	$check_data2=mysql_query("select * from `subjects` where (registration_id='$registration_id')");
	$check_data3=mysql_query("select * from `target` where (registration_id='$registration_id') ");
	$check_data5=mysql_query("select * from `session`");
	mysql_data_seek($check_data2,0);
	mysql_data_seek($check_data3,0);
	mysql_data_seek($check_data5,0);
	$row2=mysql_fetch_assoc($check_data2);
	$row3=mysql_fetch_assoc($check_data3);
	$row5=mysql_fetch_assoc($check_data5);
	
	$_SESSION['current_user_list_of_sub']=$row2['list_of_subjects_offered'];
	$_SESSION['current_user_target']=$row3['target'];
	$_SESSION['current_session']=$row5['current_session'];
	
	header("Location: home.php");
?>
</body>
</html>