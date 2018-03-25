<?php
	session_start();
	
	unset($_SESSION['current_user_full_name'],$_SESSION['current_term'],$_SESSION['current_session'],$_SESSION['current_user_email'],$_SESSION['current_user_sex'],$_SESSION['current_user_date_of_birth'],$_SESSION['start_time']);

	if(isset($_SESSION['current_user_category']) && ($_SESSION['current_user_category'])=="Student")
	{
		unset($_SESSION['current_user_category'],$_SESSION['current_user_target'],$_SESSION['current_user_school_name'],$_SESSION['current_user_class'],$_SESSION['current_user_no_of_sub'],$_SESSION['current_user_list_of_sub'],$_SESSION['sender_name']);
	}
	
	else 
	{
		unset($_SESSION['current_user_category']);
	}
	
	session_destroy();
	header("Location: index.php");
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