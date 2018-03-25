<?php
	session_start();
	$page_title="Admin/User Sign In";
	
	$email=isset($_SESSION['email']) ? ($_SESSION['email']) : "" ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templates.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $page_title; ?> :: C.A Tracker</title>
<!-- InstanceEndEditable -->
<script language="javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" src="functions.js"></script>
<link href="mystyles3.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="heading">
C.A Tracker
</div>

<div id="contents">
    
  <h1><?php echo $page_title; ?></h1>
  
   <?php
		if(isset($_SESSION['message']))
		{
			?>
  <p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
            <?php
			unset($_SESSION['message'], $_SESSION['messagetype']);
		}
	?>
	<!-- InstanceBeginEditable name="myobject" -->
    	 <?php
    if(isset($_SESSION['message']))
	{
		?>
   	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
    <p>
              <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
 ?>
 
        <br />
        <br />
        <br />
        
        <form action="admin_user_sign_in_process.php" method="post" id="myform">
        	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table" style="border:solid 2px #2828ff">
            	<tr>
                	<td>Username:</td>
                    <td><input name="email" type="text" id="email" placeholder=" Enter email address " autocomplete="off"  value="<?php echo $email; ?>"/></td>
                </tr>
                
                <tr>
                	<td>Password:</td>
                    <td><input name="password" type="password" id="password" /></td>
                </tr>
                
                <tr>
                	<td align="center" colspan="2"><input type="button" value="Sign In" onclick="sign_in()" /></td>
                </tr>
                
                <script language="javascript">
					$().ready(
						function()
						{
							$("#email").focus();
						}
					);
					function sign_in()
					{
						if(document.getElementById("email").value=="")
						{
							alert("Please enter your email!");
							document.getElementById("email").focus();
							return null;
						}
						
						if(document.getElementById("password").value=="")
						{
							alert("Please enter your password!");
							document.getElementById("password").focus();
							return null;
						}
						
						document.getElementById("myform").submit();
					}
				</script>
            </table>
        </form>
	<!-- InstanceEndEditable --></div>

<div id="footer">
&copy; <?php echo date("Y"); ?> I-Corporation LTD
</div>
</body>
<!-- InstanceEnd --></html>