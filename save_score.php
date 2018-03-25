<?php
	session_start();
	require_once("db_connect.php");
	
	$total_subject=isset($_POST['total_subject']) ? trim($_POST['total_subject']) : "";
	$msg="";
	
	for($count_sub=1; $count_sub<=$total_subject; $count_sub++)
	{
		if(isset($_POST['score_id'.$count_sub]))
		{
			$score=$_POST['score'.$count_sub];
			$score_id=$_POST['score_id'.$count_sub];
			$subject=$_POST['subject'.$count_sub];
		}
		$update_sql="update `classwork` set score='$score' where classwork_id='$score_id'";
		$execute_sql=mysql_query($update_sql);
		if($execute_sql==FALSE)
		{
			$msg .= "Error encountered adding score for $subject. ".mysql_error() ."<br/>";
		}
	}
	
	if($msg=="")
	{
		$_SESSION['message']="Your score(s) was successfully saved";
		$_SESSION['messagetype']="success";
		header("Location: view_classwork.php");
		exit();
	}
	else
	{
		$_SESSION['messagetype']="error";
		header("Location: view_classwork.php");
		exit();
	}
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