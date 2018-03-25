<?php
	session_start();
	require_once("db_connect.php");
	
	$current_term=isset($_POST['term_value']) ? trim($_POST['term_value']) : "";
	$_SESSION['term_value']="$current_term";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$rql="update `term` set current_term='$current_term'";
	$terms=mysql_query($rql);
	if($terms==FALSE)
	{
		$_SESSION['message']="Error encountered inserting term record";
		$_SESSION['messagetype']="error";
		header("Location: manage_term.php");
		exit();
	}
	
	unset($_SESSION['term_value']);
	
	$_SESSION['message']="Term successfully updated!";
	$_SESSION['messagetype']="success";
	header("Location: manage_term.php");
	exit();
?>
</body>
</html>