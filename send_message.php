<?php
	require_once("time_check.php");
	$page_title="Send Message";
	
	$friend_full_name=isset($_GET['full_name']) ? trim($_GET['full_name']) : "";
	$friend_email=isset($_GET['email']) ? trim($_GET['email']) : "";
	$friend_reg_id=isset($_GET['reg_id']) ? trim($_GET['reg_id']) : "";
	
	$_SESSION['friend_full_name']="$friend_full_name";
	$_SESSION['friend_email']="$friend_email";
	$_SESSION['friend_reg_id']="$friend_reg_id";
	
	$subject=isset($_SESSION['subject']) ? trim($_SESSION['subject']) : "";
	$message=isset($_SESSION['message']) ? trim($_SESSION['message']) : "";
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
	<p align="right"><a href="home.php">Home</a> | <a href="my_friends.php"> Back To My Friends</a></p>
    <div style="width:500px; background-color:#A3A3A3; color:#fff; text-align:center; padding:10px; border-radius:20px">Recepient: <?php echo $friend_full_name; ?>(<?php echo $friend_email; ?>)</div><br />
   
    <form action="send_message_process.php" method="post" id="myform">
    <table id="data_table" align="center" cellpadding="10px" cellspacing="1px" style="color:#007DFB;">
        	<tr>
            	<td>Subject<br />
                <input name="subject" type="text" id="subject" autocomplete="off" value="<?php echo $subject; ?>" class="width_200" placeholder=" Optional" /></td>
      		</tr>
      
      		<tr>
           	  <td>Message<br />
                <textarea name="message" id="message"><?php echo $message; ?></textarea></td>
     		</tr>
            
            <tr>
            	<td align="center"><input type="button" value="Send" onclick="send_click()" /></td>
            </tr>
        	
        </table>
        
			<script language="javascript">
			
				$(document).ready(
					function()
					{
						document.getElementById("subject").focus();
					}
				);
               function send_click()
			   {
				   if(document.getElementById("message").value=="")
				   {
					   alert("Please make sure your message is not empty when sending");
					   document.getElementById("message").focus();
					   return null;
				   }
				   document.getElementById("myform").submit();
			   }
            </script>
    
    </form>
	<!-- InstanceEndEditable --></div>
    <div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
    </div>
</body>
<!-- InstanceEnd --></html>