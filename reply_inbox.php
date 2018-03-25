<?php
	session_start();
	require_once("db_connect.php");
	$subject=isset($_GET['subject']) ? trim($_GET['subject']) : "";
	$message=isset($_GET['message']) ? trim($_GET['message']) : "";
	$date_of_message=date("Y-m-d");
	$message_viability="new";
	$sender_visible="yes";
	$recepient_visible="yes";
	
	if($subject!="")
	{
		$_SESSION['subject']="$subject";
	}
	$_SESSION['message']="$message";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php
		if($subject=="")
		{
			$subject="No Subject";
		}
		
		$message_id="Msg00001";
		$get_message_id=mysql_query("select * from `messages` order by message_id desc");
		if($get_message_id==FALSE)
		{
			$_SESSION['message']="Error encountered selecting messages";
			$_SESSION['messagetype']="error";
			header("Location: inbox.php");
			exit();
		}
		
		if(mysql_num_rows($get_message_id)>0)
		{
			mysql_data_seek($get_message_id,0);
			$row_get_message_id=mysql_fetch_assoc($get_message_id);
			$last_message_id=$row_get_message_id['message_id'];
			
			$last_id=intval(substr($last_message_id,4,5));
			$new_id=strval($last_id+1);
			
			while(strlen($new_id)<5)
			{
				$new_id="0" . $new_id;
			}
			
			$message_id="Msg" . $new_id;
		}
		
		$insert_sql=mysql_query("insert into `messages` set sender_reg_id='".$_SESSION['current_user_reg_no']."',sender_full_name='".$_SESSION['current_user_full_name']."',sender_email='".$_SESSION['current_user_email']."',sender_visible='$sender_visible',message_id='$message_id',subject='$subject',message='$message',recepient_reg_id='".$_SESSION['sender_reg_id']."',recepient_full_name='".$_SESSION['sender_name']."',recepient_email='".$_SESSION['sender_email']."',recepient_visible='$recepient_visible',message_viability='$message_viability',date_of_message='$date_of_message'");
		if($insert_sql==FALSE)
		{
			$_SESSION['message']="Error encountered sending reply ".mysql_error();
			$_SESSION['messagetype']="error";
			header("Location: inbox.php");
			exit();
		}
		
		unset($_SESSION['subject'],$_SESSION['message'],$_SESSION['sender_reg_id'],$_SESSION['sender_name'],$_SESSION['sender_email']);
		$_SESSION['message']="Your message was successfully sent";
		$_SESSION['messagetype']="success";
		header("Location: inbox.php");
		exit();
	?>
</body>
</html>