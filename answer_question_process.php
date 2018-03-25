<?php
	session_start();
	require_once("db_connect.php");
	
	$answer=isset($_POST['answer']) ? trim($_POST['answer']) : "";
	
	$select_user=mysql_query("select * from `students` where (registration_id='".$_SESSION['current_user_reg_no']."')");
	if($select_user==FALSE)
	{
		$_SESSION['message']="Error encountered selecting users records!";
		$_SESSION['messagetype']="error";
		header("Location: answer_question.php");
		exit();
	}
	
	mysql_data_seek($select_user,0);
	$row=mysql_fetch_assoc($select_user);
	
	$answered_by=$row['full_name'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$insert_sql=mysql_query("update `questions` set answers='$answer',answered_by='$answered_by' where (question_id='".$_SESSION['question_id']."')");
	if($insert_sql==FALSE)
	{
		$_SESSION['message']="Error encountered updating record!";
		$_SESSION['messagetype']="error";
		header("Location: answer_question.php");
		exit();
	}
	
		unset($_SESSION['question_id']);
		$_SESSION['message']="Your answer has been submitted!";
		$_SESSION['messagetype']="success";
		header("Location: question_board.php");
		exit();
?>
</body>
</html>