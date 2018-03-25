<?php
	session_start();
	require_once("db_connect.php");
	
	$registration_id=isset($_GET['reg_id']) ? trim($_GET['reg_id']) : "";
	$event_code=isset($_GET['event_code']) ? trim($_GET['event_code']) : ""; 
	
	$_SESSION['reg_id']="$registration_id";
	$_SESSION['event_code']="$event_code";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php
	
		$select_sql=mysql_query("select * from `upcoming_events` where (registration_id='$registration_id' and event_code='$event_code')");
		if($select_sql==FALSE)
		{
			$_SESSION['message']="Error encountered selecting record ".mysql_error();
			$_SESSION['messagetype']="error";
			header("Location: upcoming_events.php");
			exit();
		}
		
		mysql_data_seek($select_sql,0);
		$row_selected_up_events=mysql_fetch_assoc($select_sql);
		
		$add_sql=mysql_query("insert into `deleted/passed_events` set registration_id='".$_SESSION['current_user_reg_no']."', event_code='".$row_selected_up_events['event_code']."', title='".$row_selected_up_events['title']."', description='".$row_selected_up_events['description']."', supposed_date_of_event='".$row_selected_up_events['date_of_event']."', message_viability='none'");
		if($add_sql==FALSE)
		{
			$_SESSION['message']="Error encountered adding record ".mysql_error();
			$_SESSION['messagetype']="error";
			header("Location: upcoming_events.php");
			exit();
		}
							
		$del_sql=mysql_query("delete from `upcoming_events` where event_code='".$row_selected_up_events['event_code']."'");
			if($del_sql==FALSE)
			{
				$_SESSION['message']="Error encountered deleting record";
				$_SESSION['messagetype']="error";
				header("Location: upcoming_events.php");
				exit();
			}
			
			$_SESSION['message']="Your event was successfully deleted";
			$_SESSION['messagetype']="success";
			header("Location: upcoming_events.php");
			exit();
	?>
</body>
</html>