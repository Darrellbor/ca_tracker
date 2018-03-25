<?php
	session_start();
	require_once("db_connect.php");
	
	$full_name=isset($_POST['full_name']) ?trim($_POST['full_name']) : "";
	$email=isset($_POST['email']) ?trim($_POST['email']) : "";
	$password=isset($_POST['password']) ?($_POST['password']) : "";
	$sex=isset($_POST['sex']) ?trim($_POST['sex']) : "";
	$date_of_birth=isset($_POST['date_of_birth']) ?trim($_POST['date_of_birth']) : "";
	$school_name=isset($_POST['school_name']) ?trim($_POST['school_name']) : "";
	$class=isset($_POST['class']) ?trim($_POST['class']) : "";
	$no_of_subjects_offered=isset($_POST['no_of_subjects_offered']) ?trim($_POST['no_of_subjects_offered']) : "";
	$date_of_account_creation=date("Y-m-d H:i:s");
	
	$_SESSION['full_name']="$full_name";
	$_SESSION['email']="$email";
	$_SESSION['password']="$password";
	$_SESSION['sex']="$sex";
	$_SESSION['date_of_birth']="$date_of_birth";
	$_SESSION['school_name']="$school_name";
	$_SESSION['class']="$class";
	$_SESSION['no_of_subjects_offered']="$no_of_subjects_offered";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	if($full_name=="" || $email=="" || $password=="" || $sex=="" || $date_of_birth=="" || $school_name=="" || $class=="" || $no_of_subjects_offered=="")
	{
		$_SESSION['message']="Please make sure no field empty!";
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}
	
	//check if the student user exists
	$check_student_user=mysql_query("SELECT * FROM `students` WHERE (email='$email')");
	if($check_student_user==FALSE)
	{
		$_SESSION['message']="Error encountered accessing student user records! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
		
	}
	
	$total_check_student_user=mysql_num_rows($check_student_user);
	if($total_check_student_user>0)
	{
		$_SESSION['message']="There exists a user with the email address ($email). Please choose another email address!";
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}
	
	$registration_id="Reg001";
	
	$get_registration_id=mysql_query("select * from `students` order by registration_id desc");
	if($get_registration_id==FALSE)
	{
		$_SESSION['message']="Error encountered accessing registrations.".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}
	if(mysql_num_rows($get_registration_id)>0)
	{
		mysql_data_seek($get_registration_id,0);
		$row_get_registration_id=mysql_fetch_assoc($get_registration_id);
		$last_registration_id=$row_get_registration_id['registration_id'];
		
		$last_id=intval(substr($last_registration_id,3,5));
		$new_id=strval($last_id+1);
		
		while(strlen($new_id)<5)
		{
			$new_id="0" . $new_id;
		}
		
		$registration_id="Reg" . $new_id;
	}
?>

<?php


	if($class=="Jss1" || $class=="Jss2" || $class=="Jss3")
	{
		$class_arm="junior secondary school";
	}
	
	if($class=="Sss1" || $class=="Sss2" || $class=="Sss3")
	{
		$class_arm="senior secondary school";
	}
	
	$insert_class=mysql_query("insert into `class` set registration_id='$registration_id', class='$class', arm='$class_arm', status='Active'");
	if($insert_class==FALSE)
	{
		$_SESSION['message']="Error encountered adding class records. ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}
	

	$insert_school=mysql_query("insert into `school` set registration_id='$registration_id', school_name='$school_name', status='Active'");
	if($insert_school==FALSE)
	{
		$_SESSION['message']="Error encountered inserting student school information! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}
	
	$insert_subjects=mysql_query("insert into `subjects` set registration_id='$registration_id', no_of_subjects_offered='$no_of_subjects_offered', status='Active'");
	if($insert_subjects==FALSE)
	{
		$_SESSION['message']="Error encountered inserting student subjects information! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}
	
	$insert_sql=mysql_query("insert into `students` set email='$email', registration_id='$registration_id', full_name='$full_name', sex='$sex', date_of_birth='$date_of_birth', password='$password', school_name='$school_name', class='$class', no_of_subjects_offered='$no_of_subjects_offered', user_category='Student', status='Active', date_of_account_creation='$date_of_account_creation'");
	if($insert_sql==FALSE)
	{
		$_SESSION['message']="Error encountered adding your information into the network. ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}
	
		
	$check_data=mysql_query("select * from `class` where (registration_id='$registration_id')");
	$check_data2=mysql_query("select * from `subjects` where (registration_id='$registration_id')");
	$check_data4=mysql_query("select * from `students` where (registration_id='$registration_id')");
	$check_data5=mysql_query("select * from `term`");
	mysql_data_seek($check_data,0);
	mysql_data_seek($check_data2,0);
	mysql_data_seek($check_data4,0);
	mysql_data_seek($check_data5,0);
	$row=mysql_fetch_assoc($check_data);
	$row2=mysql_fetch_assoc($check_data2);
	$row4=mysql_fetch_assoc($check_data4);
	$row5=mysql_fetch_assoc($check_data5);
	
	$_SESSION['current_user_email']=$row4['email'];
	$_SESSION['current_user_sex']=$row4['sex'];
	$_SESSION['current_user_date_of_birth']=$row4['date_of_birth'];
	$_SESSION['current_user_school_name']=$row4['school_name'];
	$_SESSION['current_user_class']=$row['class'];
	$_SESSION['current_user_full_name']=$row4['full_name'];
	$_SESSION['current_user_reg_no']=$row['registration_id'];
	$_SESSION['current_user_no_of_sub']=$row2['no_of_subjects_offered'];
	$_SESSION['current_user_category']=$row4['user_category'];
	$_SESSION['current_term']=$row5['current_term'];
	$_SESSION['start_time']=time();
	
	
	unset($_SESSION['full_name'],$_SESSION['email'],$_SESSION['password'],$_SESSION['sex'],$_SESSION['date_of_birth'],$_SESSION['school_name'],$_SESSION['class'],$_SESSION['no_of_subjects_offered']);
	
	header("location: almost_done.php");
?>
</body>
</html>