<?php
	require_once("db_connect.php");
	require_once("time_check.php");
	$page_title="My Profile";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $page_title; ?> :: C.A Tracker</title>
<!-- InstanceEndEditable -->
<script language="javascript" src="scripts/jquery-1.4.2.min.js"></script>
<script language="javascript" src="functions.js"></script>
<link href="mystyles.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="heading">
	C.A Tracker
</div>
<div id="content">
	<?php 
		if(isset($_SESSION['current_user_full_name'],$_SESSION['current_session'],$_SESSION['current_term']) && ( $page_title!="You're almost done" || $page_title!="Congratulations" || $page_title!="Sign In" || $page_title!="Admin/User Sign In"))
		{
			?>
  <p id="information_display" align="right" style="font-size:12px"><b>Signed In:</b><?php echo $_SESSION['current_user_full_name'] ?> (<a href="sign_out.php">Sign Out</a>)<br />
<?php echo $_SESSION['current_term']; ?>,<?php echo $_SESSION['current_session']; ?> <br /> 
 	<?php if(isset($_SESSION['current_user_category']) && ($_SESSION['current_user_category'])=="Student")
	 { 
	 	?>
        	 <b>Target:</b> <?php echo $_SESSION['current_user_target']; ?>
         <?php 
			 }
		  ?>
  	
  </p>
            <?php
		}
	?>
<h1>
    	<?php echo $page_title; ?>
    </h1>
    
     <?php
		if(isset($_SESSION['message']))
		{
			?>
            <p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
            <?php
			unset($_SESSION['message'], $_SESSION['messagetype']);
		}
	?>
  <!-- InstanceBeginEditable name="mycontents" -->
	<p>
  <p align="center"><a href="home.php">Back To Home</a></p>
    <script language="javascript">
		$(document).ready(
			function()
			{
				shade_input_table("data_table");
			}
		);
	</script>
    
   	  <?php
			$select_student=mysql_query("select * from `students` where (email='".$_SESSION['current_user_email']."')");
			if($select_student==FALSE)
			{
				$_SESSION['message']="Error encountered selecting student record!";
				$_SESSION['messagetype']="error";
				header("Location: view_profile.php");
				exit();
			}
			
			$total_select_student=mysql_num_rows($select_student);
			if($total_select_student<=0)
			{
				$_SESSION['message']="Your profile was not found!";
				$_SESSION['messagetype']="error";
				header("Location: view_profile.php");
				exit();
			}
		?>
        
        <br />
  <form action="upload.php" method="post" enctype="multipart/form-data" id="myform">
<p>
        	  <?php $filename="images/". $_SESSION['current_user_reg_no'] .".jpg" ?>
        	  <?php
				if(file_exists($filename)==false)
				{
					$filename="images/no_img.jpg";
				}
			?>
    <p>  <b style="color:#007DFB"><h2><?php echo $_SESSION['current_user_full_name']; ?><br />
       	  </p>
       	  </h2></b>
<p>
        	  
   	  <script language="javascript">
					function upload_picture_click()
					{
						if(document.getElementById("picture").value!="")
						{
							var filename=(document.getElementById("picture").value);
							var mylength=filename.length;
							//alert("filename length = "+ mylength );
							var ext=filename.substr(mylength-4,4);
							
							//alert("filename is "+ filename + ". \n\nExtension is "+ ext );
							ext=ext.toLowerCase();
							//alert("filename is "+ filename + ". \n\nExtension is "+ ext );
							if(ext!=".jpg" && ext!=".JPG")
							{
								alert("You uploaded a '"+ ext +"' file. Please choose a .jpg file to upload!");
								return null;
							}
						}
						else
						{
							alert("Please choose a file before trying to upload!");
							document.getElementById("picture").focus();
							return null;
						}
						
						document.getElementById("myform").submit();
					}
				</script>
    </p>
        
        
        <p><br />
        </p>
<table id="data_table" align="center" cellpadding="10px" cellspacing="1px" style="color:#007DFB">
            <tr>
            		<td>
                    	<img src="<?php echo $filename; ?>" width="300" align="left" /></p>
       	  </h2></b>
          <p>&nbsp;</p>
       	  <p>&nbsp;</p>
       	  <p>&nbsp;</p>
       	  <p>&nbsp;</p>
       	  <p>&nbsp;</p>
       	  <p>&nbsp;</p>
       	  <p>
        	  <input name="picture" type="file" id="picture" />
        	  <input type="hidden" name="MAX_FILE_SIZE" value="9000000000000000" /><br />
        	  <input name="submit" type="submit" id="submit" onclick="upload_picture_click()" value="Upload Picture" />
   	    </p>
                    </td>	
                    <td width="450">Email:  <?php echo $_SESSION['current_user_email']; ?></td>
          </tr>
                
                <tr>	
                    <td width="450">Registration Id:  <?php echo $_SESSION['current_user_reg_no']; ?></td>
                    <td width="315">Sex:  <?php echo $_SESSION['current_user_sex']; ?></td>
                </tr>
                
                <tr>
                    <td width="450">School Name:  <?php echo $_SESSION['current_user_school_name']; ?></td>
                    <td width="315">Class:  <?php echo $_SESSION['current_user_class']; ?></td>
                </tr>
                
                <tr>
                    <td>No Of Subjects Offered:  <?php echo $_SESSION['current_user_no_of_sub']; ?></td>
                    <td>Date Of Birth:  <?php echo $_SESSION['current_user_date_of_birth']; ?></td>
                </tr>
    </table>
    
  <br />
    <br />
  </form>
  </p>
  <!-- InstanceEndEditable --></div>
    <div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
    </div>
</body>
<!-- InstanceEnd --></html>