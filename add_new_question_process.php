<?php
	session_start();
	require_once("db_connect.php");
	
	$title=isset($_POST['title']) ? trim($_POST['title']) : "";
	$question=isset($_POST['question']) ? trim($_POST['question']) : "";
	
	$_SESSION['title']="$title";
	$_SESSION['question']="$question";
	
	$date_of_question=date("Y-m-d");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	if($title=="" || $question=="")
	{
		$_SESSION['message']="Please make sure that no fields are empty";
		$_SESSION['messagetype']="error";
		header("Location: add_new_question.php");
		exit();
	}


	$select_question_user_name=mysql_query("select * from `students` where registration_id='".$_SESSION['current_user_reg_no']."'");
	if($select_question_user_name==FALSE)
	{
		$_SESSION['message']="Error encountered selecting users information";
		$_SESSION['messagetype']="error";
		header("Location: add_new_question.php");
		exit();
	}
	
	mysql_data_seek($select_question_user_name,0);
	$row=mysql_fetch_assoc($select_question_user_name);
	$asked_by=$row['full_name'];
	
	$question_id="Ques00001";
	
	$get_question_id=mysql_query("select * from `questions` order by question_id desc");
	if($get_question_id==FALSE)
	{
		$_SESSION['message']="Error encountered selecting questions";
		$_SESSION['messagetype']="error";
		header("Location: add_new_question.php");
		exit();
	}
	
	if(mysql_num_rows($get_question_id)>0)
	{
		mysql_data_seek($get_question_id,0);
		$row_get_question_id=mysql_fetch_assoc($get_question_id);
		$last_question_id=$row_get_question_id['question_id'];
		
		$last_id=intval(substr($last_question_id,4,5));
		$new_id=strval($last_id+1);
		
		while(strlen($new_id)<5)
		{
			$new_id="0" . $new_id;
		}
		
		$question_id="Ques" . $new_id;
	}
	
	
	$insert_question=mysql_query("insert into `questions` set registration_id='".$_SESSION['current_user_reg_no']."',question_id='$question_id',title='$title',question='$question',asked_by='$asked_by',answers='none',answered_by='none',date_of_question='$date_of_question'");
	if($insert_question==FALSE)
	{
		$_SESSION['message']="Error encountered inserting into questions".mysql_error();
		$_SESSION['messagetype']="error";
		header("Location: add_new_question.php");
		exit();
	}
	
	unset($_SESSION['title'],$_SESSION['question']);
	$_SESSION['message']="Your question was successfully added!";
	$_SESSION['messagetype']="success";
	header("Location: add_new_question.php");
	exit();
?>
</body>
</html>