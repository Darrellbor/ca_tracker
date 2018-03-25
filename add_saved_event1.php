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
	$select_sql=mysql_query("select * from `deleted/passed_events` where (registration_id='$registration_id' and event_code='$event_code')");
	if($select_sql==FALSE)
	{
		$_SESSION['message']="Error encoutered selecting events!";
		$_SESSION['messagetype']="error";
		header("Location: deleted_passed_events.php");
		exit();
	}
	
	mysql_data_seek($select_sql,0);
	$row=mysql_fetch_assoc($select_sql);
	$_SESSION['title']=$row['title'];
	$_SESSION['description']=$row['description'];
	$_SESSION['supposed_date_of_event']=$row['supposed_date_of_event'];
	if(date("Y-m-d") > $row['supposed_date_of_event'])
	{
		$_SESSION['message']="Please make sure that the date of your event is not less than today's date!";
		$_SESSION['messagetype']="error";
		header("Location: add_event1.php");
		exit();
	}
	
	
	$insert_up_event=mysql_query("insert into `upcoming_events` set registration_id='$registration_id', event_code='$event_code', title='".$row['title']."', description='".$row['description']."', date_of_event='".$row['supposed_date_of_event']."', message_viability='new'");
	if($insert_up_event=FALSE)
	{
		$_SESSION['message']="Error encountered inserting record!";
		$_SESSION['messagetype']="error";
		header("Location: deleted_saved_events.php");
		exit();
	}
	
	$del_saved_event=mysql_query("delete from `deleted/passed_events` where (registration_id='$registration_id' and event_code='$event_code')");
	if($del_saved_event==FALSE)
	{
		$_SESSION['message']="Error encountered deleting record!";
		$_SESSION['messagetype']="error";
		header("Location: deleted_passed_events.php");
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