<?php
	session_start();
	require_once("db_connect.php");
	
	$title=isset($_POST['title']) ? trim($_POST['title']) : "";
	$note=isset($_POST['note']) ? trim($_POST['note']) : "";
	
	$_SESSION['title']="$title";
	$_SESSION['note']="$note";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	if($title=="" || $note=="")
	{
		$_SESSION['message']="Please make sure that no fields are empty";
		$_SESSION['messagetype']="error";
		header("Location: add_new_note.php");
		exit();
	}
	
	$note_code="Note00001";
	
	$get_note_code=mysql_query("select * from `notes` order by note_code desc");
	if($get_note_code==FALSE)
	{
		$_SESSION['message']="Error encountered selecting notes";
		$_SESSION['messagetype']="error";
		header("Location: add_new_note.php");
		exit();
	}
	
	if(mysql_num_rows($get_note_code)>0)
	{
		mysql_data_seek($get_note_code,0);
		$row_get_note_code=mysql_fetch_assoc($get_note_code);
		$last_note_code=$row_get_note_code['note_code'];
		
		$last_id=intval(substr($last_note_code,4,5));
		$new_id=strval($last_id+1);
		
		while(strlen($new_id)<5)
		{
			$new_id="0" . $new_id;
		}
		
		$note_code="Note" . $new_id;
	}
	
	$insert_sql=mysql_query("insert into `notes` set registration_id='".$_SESSION['current_user_reg_no']."', note_code='$note_code', title='$title', note='$note'");
	if($insert_sql==FALSE)
	{
		$_SESSION['message']="Error encountered inserting into notes";
		$_SESSION['messagetype']="error";
		header("Location: add_new_note.php");
		exit();
	}
	
	unset($_SESSION['title'],$_SESSION['note']);
	$_SESSION['message']="Your note has been successfully added";
	$_SESSION['messagetype']="success1";
	header("Location: add_new_note.php");
	exit();
?>
</body>
</html>