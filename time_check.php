<?php
	session_start();
	
	$start_time=isset($_SESSION['start_time']) ? ($_SESSION['start_time']) : "60000000000000000000";
	$now_time=time();
	
	if(isset($_SESSION['current_user_category']) && ($_SESSION['current_user_category'])=="Student")
	{
			if(abs($now_time-$start_time)>(30*60))
			{
				$_SESSION['message']="Your session has expired! Please sign in again ";
				$_SESSION['messagetype']="error";
				header("Location: sign_in.php");
				exit();
			}
	}
	else
	{
			if(abs($now_time-$start_time)>(30*60))
			{
				$_SESSION['message']="Your session has expired! Please sign in again ";
				$_SESSION['messagetype']="error";
				header("Location: admin_user_sign_in.php");
				exit();
			}
	}
	
	
	$_SESSION['start_time']=time();
?>
