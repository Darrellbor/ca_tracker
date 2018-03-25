<?php
	session_start();
	require_once("db_connect.php");
	
	$email=isset($_POST['email']) ? trim($_POST['email']) : "";
	$password=isset($_POST['password']) ? ($_POST['password']) : "";
	
	$_SESSION['email']=$email;
	
	if($email=="" || $password=="")
	{
		$_SESSION['message']="Invalid username or password";
		$_SESSION['messagetype']="error";
		header("Location: sign_in.php");
		exit();
	}
	
	$check_student=mysql_query("SELECT * FROM `students` WHERE (email='$email' and password='$password')");
	if($check_student==FALSE)
	{
		$_SESSION['message']="Error occured assessing students record" .mysql_error();
		$_SESSION['messagetype']="error";
		header("Location: sign_in.php");
		exit();
	}
	
	$total_student=mysql_num_rows($check_student);
	if($total_student<=0)
	{
		$_SESSION['message']="Invalid username or password";
		$_SESSION['messagetype']="error";
		header("Location: sign_in.php");
		exit();
	}
	
	mysql_data_seek($check_student,0);
	$row=mysql_fetch_assoc($check_student);
	
	if($row['status']!="Active")
	{
		$_SESSION['message']="Your account is inactive, plaease contact the system administrator!";
		$_SESSION['messagetype']="error";
		header("location: sign_in.php");
		exit();
	}
	
	$_SESSION['current_user_reg_no']=$row['registration_id'];
	$registration_id=$_SESSION['current_user_reg_no'];
	
	$check_data1=mysql_query("select * from `class` where (registration_id='$registration_id')");
	$check_data2=mysql_query("select * from `subjects` where (registration_id='$registration_id')");
	$check_data4=mysql_query("select * from `term`");
	$check_data3=mysql_query("select * from `target` where (registration_id='$registration_id') ");
	$check_data5=mysql_query("select * from `session`");
	mysql_data_seek($check_data1,0);
	mysql_data_seek($check_data2,0);
	mysql_data_seek($check_data4,0);
	mysql_data_seek($check_data3,0);
	mysql_data_seek($check_data5,0);
	$row2=mysql_fetch_assoc($check_data2);
	$row3=mysql_fetch_assoc($check_data3);
	$row4=mysql_fetch_assoc($check_data4);
	$row1=mysql_fetch_assoc($check_data1);
	$row5=mysql_fetch_assoc($check_data5);
	
	$_SESSION['current_user_email']=$row['email'];
	$_SESSION['current_user_sex']=$row['sex'];
	$_SESSION['current_user_date_of_birth']=$row['date_of_birth'];
	$_SESSION['current_user_school_name']=$row['school_name'];
	$_SESSION['current_user_class']=$row1['class'];
	$_SESSION['current_user_full_name']=$row['full_name'];
	$_SESSION['current_user_no_of_sub']=$row2['no_of_subjects_offered'];
	$_SESSION['current_user_category']=$row['user_category'];
	$_SESSION['current_term']=$row4['current_term'];
	$_SESSION['current_user_list_of_sub']=$row2['list_of_subjects_offered'];
	$_SESSION['current_user_target']=$row3['target'];
	$_SESSION['current_session']=$row5['current_session'];
	$_SESSION['start_time']=time();
	
	unset($_SESSION['email']);
	
	header("Location: home.php");
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