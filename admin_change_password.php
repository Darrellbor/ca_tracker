<?php
	require_once("time_check.php");
	$page_title="Change Password";
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
    <script language="javascript">
		$(document).ready(
			function()
			{
				shade_input_table("data_table");
			}
		);
	</script>
    
    <p align="center"><a href="home.php">Back to Home</a></p>
    	<form action="admin_change_password_process.php" method="post" id="myform">
        	<table id="data_table" align="center" cellpadding="10px" cellspacing="1px">
            	<tr>
                	<td>Enter Current Password:</td>
                    <td><input name="current_pass" type="password" id="current_pass" /></td>
                </tr>
                
                <tr>
                	<td>Enter New Password:</td>
                    <td><input name="New_pass" type="password" id="New_pass" /></td>
                </tr>
                
                <tr>
                	<td>Re-enter New Password:</td>
                    <td><input name="re_new_pass" type="password" id="re_new_pass"/></td>
                </tr>
                
                <tr>
                	<td align="center" colspan="2"><input type="button" value="Update Password" onclick="update_pass_click()" /></td>
                </tr>
            </table>
            	<script language="javascript">
					function update_pass_click()
					{
						if(document.getElementById("current_pass").value=="")
						{
							alert("Please make sure that the field is not empty!");
							document.getElementById("current_pass").focus();
							return null;
						}
						
						if(document.getElementById("New_pass").value=="")
						{
							alert("Please make sure that the field is not empty!");
							document.getElementById("New_pass").focus();
							return null;
						}
						
						if(document.getElementById("re_new_pass").value=="")
						{
							alert("Please make sure that the field is not empty!");
							document.getElementById("re_new_pass").focus();
							return null;
						}
							document.getElementById("myform").submit();
					}
				</script>
        </form>
    </p>
	<!-- InstanceEndEditable --></div>
    <div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
    </div>
</body>
<!-- InstanceEnd --></html>