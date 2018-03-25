<?php 
	session_start();
	
	if(is_uploaded_file($_FILES['picture']['tmp_name']))
	{
		$new_filename="images/" . $_SESSION['current_user_reg_no'] .".jpg";
		move_uploaded_file($_FILES['picture']['tmp_name'], $new_filename);
		
		$_SESSION['message']="Your picture was successfully uploaded.";
		$_SESSION['messagetype']="success";
		header("Location: view_profile.php");
		exit();
	}
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