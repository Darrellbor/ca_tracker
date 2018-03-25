<?php
	session_start();
	
	$target_dir="images/";
	$target_file=$target_dir . basename($_FILES["picture"]["name"]);
	$uploadOk=1;
	$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
	
	//check if image file is an actual image or a fake image
	if(isset($_POST['submit']))
	{
		$check=getimagesize($_FILES["picture"]["tmp_name"]);
		if($check!==false)
		{
			$_SESSION['message']="File is an image- " . $check['mime'] . ".";
			$_SESSION['messagetype']="success";
			header("Location: view_profile.php");
			exit();
			$uploadOk=1;
		}
		else
		{
			$_SESSION['message']="File is not an image.";
			$_SESSION['messagetype']="error";
			header("Location: view_profile.php");
			exit();
			$uploadOk=0;
		}
	}
	
	//check if file already exists 
	if(file_exists($target_file))
	{
		$_SESSION['message']="Sorry file already exists!";
		$_SESSION['messagetype']="error";
		header("Location: view_profile.php");
		exit();
		$uploadOk=0;
	}
	
	//check file size
	if($_FILES["picture"]["size"] > 9000000000000)
	{
		$_SESSION['message']="Sorry your file is too large!";
		$_SESSION['messagetype']="error";
		header("Location: view_profile.php");
		exit();
		$uploadOk=0;
	}
	
	//allow certain file formats
	if($imageFileType!="jpg" && $imageFileType!="png" && $imageFileType!="jpeg" && $imageFileType!="gif")
	{
		$_SESSION['message']="Sorry only JPEG, PNG & GIF files are allowed.";
		$_SESSION['messagetype']="error";
		header("Location: view_profile.php");
		exit();
		$uploadOk=0;
	}
	
	//check if $uploadOk is set to 0 by an error
	if($uploadOk==0)
	{
		$_SESSION['message']="Sorry your file was not uploaded.";
		$_SESSION['messagetype']="error";
		header("Location: view_profile.php");
		exit();
	}
	
	//if everything is ok,try to upload file 
	else 
	{
		if(move_uploaded_file($_FILES["picture"]["tmp_name"],$target_file))
		{
			$_SESSION['message']="The file ".basename($_FILES["picture"]["name"])." has been uploaded.";
			$_SESSION['messagetype']="success";
			header("Location: view_profile.php");
			exit();
		}
		else
		{
			$_SESSION['message']="Sorry an error occurred while uploading your file.";
			$_SESSION['messagetype']="error";
			header("Location: view_profile.php");
			exit();
		}
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