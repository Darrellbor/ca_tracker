<?php
	session_start();
	require_once("db_connect.php");
	
	$registration_id=isset($_POST['reg_no']) ?trim($_POST['reg_no']) : "";
	$no_sub=isset($_POST['no_of_subjects_offered']) ?trim($_POST['no_of_subjects_offered']) : "";
	$list_sub=isset($_POST['list_sub']) ?trim($_POST['list_sub']) : "";
	$status=isset($_POST['status']) ?trim($_POST['status']) : "";
	
	$_SESSION['reg_no']=$registration_id;
	$_SESSION['no_of_subjects_offered']=$no_sub;
	$_SESSION['list_sub']=$list_sub;
	$_SESSION['status']=$status;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php
		$update_sql=mysql_query("update `subjects` set registration_id='$registration_id', no_of_subjects_offered='$no_sub', list_of_subjects_offered='$list_sub', status='$status' where registration_id=('$registration_id')");
		if($update_sql==FALSE)
		{
			$_SESSION['message']="Error encountered updating subjects record!";
			$_SESSION['messagetype']="error";
			header("location: edit_subjects.php");
			exit();
		}
		else
		{
			unset($_SESSION['reg_no'], $_SESSION['no_of_subjects_offered'], $_SESSION['list_sub'], $_SESSION['status']);
			$_SESSION['message']="Student subject record ($registration_id) was successfully updated!";
			$_SESSION['messagetype']="success1";
			header("location: manage_subjects.php");
			exit();
		}
	?>
</body>
</html>