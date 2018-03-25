<?php
	session_start();
	require_once("db_connect.php");
	
	$email=isset($_POST['email']) ?trim($_POST['email']) : "";
	$full_name=isset($_POST['full_name']) ?trim($_POST['full_name']) : "";
	$password=isset($_POST['password']) ?($_POST['password']) : "";
	$user_category=isset($_POST['user_category']) ?trim($_POST['user_category']) : "";
	$occupation=isset($_POST['occupation']) ?trim($_POST['occupation']) : "";
	$address=isset($_POST['address']) ?trim($_POST['address']) : "";
	$state=isset($_POST['state']) ?trim($_POST['state']) : "";
	$status=isset($_POST['status']) ?trim($_POST['status']) : "";
	$date=date("Y-m-d H:i:s");
	
	$_SESSION['email']="$email";
	$_SESSION['full_name']="$full_name";
	$_SESSION['password']="$password";
	$_SESSION['user_category']="$user_category";
	$_SESSION['occupation']="$occupation";
	$_SESSION['address']="$address";
	$_SESSION['state']="$state";
	$_SESSION['status']="$status";

	if($email=="" || $full_name=="" || $password=="" || $user_category=="" || $occupation=="" || $address=="" || $state=="" || $status=="")
	{
		$_SESSION['message']="Please make sure all fields are selected/entered correctly!";
		$_SESSION['messagetype']="error";
		header("location: add_new_user.php");
		exit();
	}
	
	//check if user already exists
	$check_user=mysql_query("select * from users where (email='$email')");
	if($check_user==FALSE)
	{
		$_SESSION['message']="An error encountered accessing the table users!";
		$_SESSION['messagetype']="error";
		header("location: add_new_user.php");
		exit();
	}
	
	$total_check_user=mysql_num_rows($check_user);
	if($total_check_user>0)
	{
		$_SESSION['message']="There is already a user with the email ($email).please choose another one";
		$_SESSION['messagetype']="error";
		header("location: add_new_user.php");
		exit();
	}
?>

<?php
	$insert_sql=mysql_query("insert into users set email='$email', full_name='$full_name', password='$password',user_category='$user_category',   occupation='$occupation', state='$state', address='$address', status='$status', date_created='$date'");
	if($insert_sql==FALSE)
	{
		$_SESSION['message']="Error encountered adding user!".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: add_new_user.php");
		exit();
	}
	
	else 
	{
		unset($_SESSION['email'], $_SESSION['full_name'], $_SESSION['password'], $_SESSION['user_category'], $_SESSION['occupation'], $_SESSION['state'], $_SESSION['address'], $_SESSION['status']);
		$_SESSION['message']="User ($full_name) has been successfully added";
		$_SESSION['messagetype']="success";
		header("location: manage_users.php");
		exit();
	}
?>