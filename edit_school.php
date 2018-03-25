<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$page_title="Edit School";
	
	$registration_id=isset($_GET['registration_id']) ?trim($_GET['registration_id']) : "Active";
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
	<p align="center"><a href="manage_school.php">Back to manage school</a> | <a href="home.php">Home</a></p>
    <?php
		$select_school=mysql_query("SELECT * FROM `school` WHERE (registration_id='$registration_id')");
		if($select_school==FALSE)
		{
			?>
   	<p class="error">Error encountered selecting school <?php echo mysql_error(); ?></p>
            <?php
			die();
		}
		
		$total_selected_school=mysql_num_rows($select_school);
		if($total_selected_school<=0)
		{
			?>
            	<p class="error">No student school record found!</p>
            <?php
		}
		
		mysql_data_seek($select_school,0);
		$row_selected_school=mysql_fetch_assoc($select_school);
		
		$registration_id=$row_selected_school['registration_id'];
		$school_name=$row_selected_school['school_name'];
		$status=$row_selected_school['status'];
		
		
    
	?>
    
     <?php 
	if(isset($_SESSION['message']))
	{
		?>
        	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
        <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
 ?>
 
  <script language="javascript">
	$(document).ready(
		function()
		{
			shade_input_table("data_table");
		}
	);
	</script>
    
    <form action="edit_school_process.php" method="post" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
        	<tr>
            	<td><strong>Registration id:</strong></td>
                <td><input name="reg_no" type="text" class="width_200" id="reg_no" autocomplete="off" value="<?php echo $registration_id; ?>" readonly="readonly"  /></td>
            </tr>
            <tr>
            	<td><strong>School name:</strong></td>
                <td><input name="school_name" type="text" class="width_200" id="school_name" autocomplete="off" value="<?php echo $school_name; ?>" /></td>
            </tr>
            <tr>
            	<td><strong>Status:</strong></td>
                <td><input name="status" type="text" class="width_200" id="status" autocomplete="off" value="<?php echo $status; ?>" readonly="readonly"  /></td>
            </tr>
            <tr>
            	<td align="center" colspan="2"><input type="button" value="Update school record" onclick="update_school_click()" /></td>
            </tr>
            
            <script language="javascript">
				function update_school_click()
				{
					if(document.getElementById("school_name").value=="")
					{
						alert("Please make sure all fields are filled!");
						document.getElementById("school_name").focus();
						return null;
					}
					
					document.getElementById("myform").submit();
				}
			</script>
        </table>
    </form>
	<!-- InstanceEndEditable --></div>
    <div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
    </div>
</body>
<!-- InstanceEnd --></html>