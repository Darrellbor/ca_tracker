<?php
	session_start();
	require_once("db_connect.php");
	$target=isset($_POST['target']) ? trim($_POST['target']) : "";
	$_SESSION['target']="$target";
	$subject_list=isset($_POST['list_of_subjects_offered']) ? trim($_POST['list_of_subjects_offered']) : "";
	$reg_id=$_SESSION['current_user_reg_no'];
	//die($subject_list);
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$rsql="update `subjects` set list_of_subjects_offered='$subject_list' where (registration_id='$reg_id')";
	//die($rsql);
	$subjects_list=mysql_query($rsql);
	if($subjects_list==FALSE)
	{
		$_SESSION['message']="Error encountered updating subjects record".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: almost_done.php");
		exit();
	}
	
	$target_set=mysql_query("insert into `target` set registration_id='$reg_id',target='$target'");
	if($target_set==FALSE)
	{
		$_SESSION['message']="Error encountered inserting target record";
		$_SESSION['messagetype']="error";
		header("location: almost_done.php");
		exit();
	}
	
	$insert_page_visited=mysql_query("insert into `page_visited` set registration_id='$reg_id',visited='no'");
	if($insert_page_visited==FALSE)
	{
		$_SESSION['message']="Error encountered inserting some record";
		$_SESSION['messagetype']="error";
		header("location: almost_done.php");
		exit();
	}
	
	unset($_SESSION['target'],$_SESSION['subject']);
	
	header("location: finished.php");
?>
</body>
</html>