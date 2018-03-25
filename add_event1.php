<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$page_title="Add Event";
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
	<p align="right">
    	<a href="deleted_passed_events.php"><input type="button" value="Back To Deleted/Passed Events" /></a>  <a href="home.php"><input type="button" value="Back To Home" /></a>
       
    </p>
    
    <script language="javascript">
	$(document).ready(
		function()
		{
			shade_input_table("data_table");
		}
	);
	</script>
    
    <br />
    <br />
    <form action="add_event_process1.php" method="post" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" style="color:#007DFB" id="data_table">
        	<tr>
            	<td>Title:</td>
                <td><input name="title" type="text" id="title" autocomplete="off" value="<?php echo $_SESSION['title']; ?>" readonly="readonly" /></td>
            </tr>
            
            <tr>
            	<td>Description:</td>
                <td><textarea name="description" cols="23px" rows="6px" readonly="readonly" id="description"><?php echo $_SESSION['description']; ?></textarea></td>
            </tr>
            
            <tr>
            	<td>Date Of Event:</td>
                <td><input name="date_of_event" type="text" id="date_of_event" autocomplete="off" value="<?php echo $_SESSION['supposed_date_of_event']; ?>" placeholder=" YYYY-MM-DD" /></td>
            </tr>
            
            <tr>
            	<td align="center" colspan="2"><input type="button" value="Add Event" onclick="add_event()" /></td>
            </tr>
        </table>
        
        <script language="javascript">
			function add_event()
			{
				if(document.getElementById("title").value=="")
				{
					alert("Please make sure that the title field is not empty!");
					document.getElementById("title").focus();
					return null;
				}
				
				if(document.getElementById("description").value=="")
				{
					alert("Please make sure that the description field is not empty!");
					document.getElementById("description").focus();
					return null;
				}
				
				if(val_date_click(document.getElementById("date_of_event").value)==false)
				{
					document.getElementById("date_of_event").focus();
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