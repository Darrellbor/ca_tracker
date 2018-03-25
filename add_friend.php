<?php
	session_start();
	require_once("db_connect.php");
	
	$friend_full_name=isset($_GET['full_name']) ? trim($_GET['full_name']) : "";
	$friend_email=isset($_GET['email']) ? trim($_GET['email']) : "";
	$friend_reg_id=isset($_GET['reg_id']) ? trim($_GET['reg_id']) : "";
	
	$_SESSION['friend_full_name']="$friend_full_name";
	$_SESSION['friend_email']="$friend_email";
	$_SESSION['friend_reg_id']="$friend_reg_id";
	
	$subject="Friend Request";
	$date_of_message=date("Y-m-d");
	$message_viability="new";
	$sender_visible="yes";
	$recepient_visible="yes";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php
		$message_id="Msg00001";
		$get_message_id=mysql_query("select * from `messages` order by message_id desc");
		if($get_message_id==FALSE)
		{
			$_SESSION['message']="Error encountered sending friend request";
			$_SESSION['messagetype']="error";
			header("Location: search_results.php");
			exit();
		}
		
		if(mysql_num_rows($get_message_id)>0)
		{
			mysql_data_seek($get_message_id,0);
			$row_get_message_id=mysql_fetch_assoc($get_message_id);
			$last_message_id=$row_get_message_id['message_id'];
			
			$last_id=intval(substr($last_message_id,4,5));
			$new_id=strval($last_id+1);
			
			while(strlen($new_id)<5)
			{
				$new_id="0" . $new_id;
			}
			
			$message_id="Msg" . $new_id;
		}
		
		$insert_sql=mysql_query("insert into `messages` set sender_reg_id='".$_SESSION['current_user_reg_no']."',sender_full_name='".$_SESSION['current_user_full_name']."',sender_email='".$_SESSION['current_user_email']."',sender_visible='$sender_visible',message_id='$message_id',subject='$subject',message='".$_SESSION['current_user_full_name']." is requesting to be your friend.',recepient_reg_id='$friend_reg_id',recepient_full_name='$friend_full_name',recepient_email='$friend_email',recepient_visible='$recepient_visible',message_viability='$message_viability',date_of_message='$date_of_message'");
		
		if($insert_sql==FALSE)
		{
			$_SESSION['message']="Error encountered sending friend request";
			$_SESSION['messagetype']="error";
			header("Location: search_friend.php");
			exit();
		}
		
		unset($_SESSION['friend_email'],$_SESSION['friend_full_name'],$_SESSION['friend_reg_id']);
		$_SESSION['message']="Your friend request was successfully sent";
		$_SESSION['messagetype']="success";
		header("Location: Add_Search_People.php");
		exit();
	?>
</body>
</html>