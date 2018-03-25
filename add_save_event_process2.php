<?php
	session_start();
	require_once("db_connect.php");
	
		$title=isset($_POST['title']) ? trim($_POST['title']) : "";
		$description=isset($_POST['description']) ? trim($_POST['description']) : "";
		$date_of_event=isset($_POST['date_of_event']) ? trim($_POST['date_of_event']) : "";
		
		$_SESSION['title']="$title";
		$_SESSION['description']="$description";
		$_SESSION['date_of_event']="$date_of_event";
		
		$event_code="Evnt00001";
		$get_event_code=mysql_query("(select * from `upcoming_events` where registration_id='".$_SESSION['current_user_reg_no']."') union (select * from `saved_events` where registration_id='".$_SESSION['current_user_reg_no']."') order by event_code desc");
		if($get_event_code==FALSE)
		{
			$_SESSION['message']="Error encountered selecting event ".mysql_error();
			$_SESSION['messagetype']="error";
			header("Location: add_new_event.php");
			exit();
		}
		if(mysql_num_rows($get_event_code)>0)
		{
			mysql_data_seek($get_event_code,0);
			$row_get_event_code=mysql_fetch_assoc($get_event_code);
			$last_event_code=$row_get_event_code['event_code'];
			
			$last_id=intval(substr($last_event_code,4,5));
			$new_id=strval($last_id+1);
			
			while(strlen($new_id)<5)
			{
				$new_id="0" . $new_id;
			}
			
			$event_code="Evnt" . $new_id;
		}
		
		$save_sql=mysql_query("insert into `saved_events` set registration_id='".$_SESSION['current_user_reg_no']."', event_code='$event_code', title='$title', description='$description', supposed_date_of_event='$date_of_event', message_viability='none'");
		if($save_sql==FALSE)
		{
			$_SESSION['message']="Error encountered saving event! ".mysql_error();
			$_SESSION['messagetype']="error";
			header("Location: add_new_event.php");
			exit();
		}
		
			unset($_SESSION['title'],$_SESSION['description'],$_SESSION['date_of_event']);
			$_SESSION['message']="Your event has been successfully saved!";
			$_SESSION['messagetype']="success1";
			header("Location: add_new_event.php");
			exit();
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