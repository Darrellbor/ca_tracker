<?php
	session_start();
	require_once("db_connect.php");
	
	$sender_reg_id=isset($_GET['sender_reg_id']) ? trim($_GET['sender_reg_id']) : "";
	
	$select_from_friends=mysql_query("select * from `friends` where main_account='".$_SESSION['current_user_reg_no']."' and budd_registration_id='$sender_reg_id'");
	if($select_from_friends==FALSE)
	{
		$_SESSION['message']="Error encountered while selecting friend request.".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: inbox.php");
		exit();
	}
	$total_row=mysql_num_rows($select_from_friends);
	if($total_row>0)
	{
		$_SESSION['message']="Can't perform this action! You are already friends with ".$_SESSION['sender_name'];
		$_SESSION['messagetype']="error";
		header("Location: inbox.php");
		exit();
	}
	
	$buddy_id="Budd00001";
	$get_buddy_id=mysql_query("select * from `friends` order by buddy_id desc");
	if($get_buddy_id==FALSE)
	{
		$_SESSION['message']="Error encountered while processing friend request.".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: inbox.php");
		exit();
	}
	if(mysql_num_rows($get_buddy_id)>0)
	{
		mysql_data_seek($get_buddy_id,0);
		$row_get_buddy_id=mysql_fetch_assoc($get_buddy_id);
		$last_buddy_id=$row_get_buddy_id['buddy_id'];
		
		$last_id=intval(substr($last_buddy_id,4,5));
		$new_id=strval($last_id+1);
		
		while(strlen($new_id)<5)
		{
			$new_id="0" . $new_id;
		}
		$buddy_id="Budd" . $new_id;
	}
	
	$insert1_sql="insert into `friends` set main_account='".$_SESSION['current_user_reg_no']."',buddy_id='$buddy_id',budd_registration_id='$sender_reg_id'";
	$execute1_sql=mysql_query($insert1_sql);
	if($execute1_sql==FALSE)
	{
		$_SESSION['message']="Error encountered while processing friend request. ";
		$_SESSION['messagetype']="error";
		header("Location: inbox.php");
		exit();
	}
	
		$buddy_id2="Budd00001";
	$get_buddy_id2=mysql_query("select * from `friends` order by buddy_id desc");
	if($get_buddy_id2==FALSE)
	{
		$_SESSION['message']="Error encountered while processing friend request.".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: inbox.php");
		exit();
	}
	if(mysql_num_rows($get_buddy_id2)>0)
	{
		mysql_data_seek($get_buddy_id2,0);
		$row_get_buddy_id2=mysql_fetch_assoc($get_buddy_id2);
		$last_buddy_id2=$row_get_buddy_id2['buddy_id'];
		
		$last_id2=intval(substr($last_buddy_id2,4,5));
		$new_id2=strval($last_id2+1);
		
		while(strlen($new_id2)<5)
		{
			$new_id2="0" . $new_id2;
		}
		$buddy_id2="Budd" . $new_id2;
	}
	
	$insert2_sql="insert into `friends` set main_account='$sender_reg_id',buddy_id='$buddy_id2',budd_registration_id='".$_SESSION['current_user_reg_no']."'";
	$execute2_sql=mysql_query($insert2_sql);
	if($execute2_sql==FALSE)
	{
		$_SESSION['message']="Error encountered while processing friend request2. ".mysql_error();
		$_SESSION['messagetype']="error";
		header("Location: inbox.php");
		exit();
	}
	
	$_SESSION['message']="You are now friends with ".$_SESSION['sender_name'];
	$_SESSION['messagetype']="success";
	unset($_SESSION['sender_reg_id']);
	header("Location: inbox.php");
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