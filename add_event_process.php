<?php
	session_start();
	require_once("db_connect.php");
	
	$date_of_event=isset($_POST['date_of_event']) ? trim($_POST['date_of_event']) : "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php
		if(date("Y-m-d") > $date_of_event)
		{
			$_SESSION['message']="Please make sure that the date of your event is not less than today's date!";
			$_SESSION['messagetype']="error";
			header("Location: add_event.php");
			exit();
		}
		
		$insert_up_event=mysql_query("insert into `upcoming_events` set registration_id='".$_SESSION['reg_id']."', event_code='".$_SESSION['event_code']."', title='".$_SESSION['title']."', description='".$_SESSION['description']."', date_of_event='$date_of_event', message_viability='new'");
	if($insert_up_event=FALSE)
	{
		$_SESSION['message']="Error encountered inserting record!";
		$_SESSION['messagetype']="error";
		header("Location: add_events.php");
		exit();
	}
	
	$del_saved_event=mysql_query("delete from `saved_events` where (registration_id='".$_SESSION['reg_id']."' and event_code='".$_SESSION['event_code']."')");
	if($del_saved_event==FALSE)
	{
		$_SESSION['message']="Error encountered deleting record!";
		$_SESSION['messagetype']="error";
		header("Location: add_events.php");
		exit();
	}
		
		unset($_SESSION['reg_id'],$_SESSION['event_code'],$_SESSION['title'],$_SESSION['description'],$_SESSION['supposed_date_of_event']);
		$_SESSION['message']="Your event has successfully been added to your upcoming events";
		$_SESSION['messagetype']="success";
		header("Location: upcoming_events.php");
		exit();
	?>
</body>
</html>