<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$page_title="Edit Class";
	
	$registration_id=isset($_GET['registration_id']) ?trim($_GET['registration_id']) : "";
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
	<p align="center"><a href="manage_class.php">Back to manage class</a> | <a href="home.php">Home</a></p>
    <?php
		$select_class=mysql_query("SELECT * FROM `class` WHERE (registration_id='$registration_id')");
		if($select_class==FALSE)
		{
			?>
   	<p class="error">Error encountered selecting class records! <?php echo mysql_error(); ?></p>
            <?php
			die();
		}
		
		 $total_selected_class=mysql_num_rows($select_class);
		if($total_selected_class<=0)
		{
			?>
   				<p class="error" align="center">No class record found! </p>
            <?php
		}
		
		mysql_data_seek($select_class,0);
		$row_selected_class=mysql_fetch_assoc($select_class);
		
		$registration_id=$row_selected_class['registration_id'];
		$class=$row_selected_class['class'];
		$arm=$row_selected_class['arm'];
		$status=$row_selected_class['status'];
		
		
		
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
    
    <form action="edit_class_process.php" method="post" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
        	<tr>
            	<td><strong>Registration id:</strong></td>
                <td><input name="reg_no" type="text" class="width_200" id="reg_no" autocomplete="off" value="<?php echo $registration_id; ?>" readonly="readonly" /></td>
            </tr>
            <tr>
            	<td><strong>class:</strong></td>
                <td>
                	<select name="class" id="class" class="width_200">
                    	<option value=""></option>
                        <option value="jss1" <?php if($class=='jss1') {echo "selected='selected'"; } ?>>jss1</option>
                        <option value="jss2" <?php if($class=='jss2') {echo "selected='selected'"; } ?>>jss2</option>
                        <option value="jss3" <?php if($class=='jss3') {echo "selected='selected'"; } ?>>jss3</option>
                        <option value="sss1" <?php if($class=='sss1') {echo "selected='selected'"; } ?>>sss1</option>
                        <option value="sss2" <?php if($class=='sss2') {echo "selected='selected'"; } ?>>sss2</option>
                        <option value="sss3" <?php if($class=='sss3') {echo "selected='selected'"; } ?>>sss3</option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td><strong>Arm:</strong></td>
                <td>
                	<select name="arm" id="arm" class="width_200">
                    	<option value=""></option>
                        <option value="junior secondary school"<?php if($arm=='junior secondary school') {echo "selected='selected'";} ?>>junior secondary school</option>
                        <option value="senior secondary school"<?php if($arm=='senior secondary school') {echo "selected='selected'";} ?>>senior secondary school</option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td><strong>Status:</strong></td>
                <td><input name="status" type="text" class="width_200" id="status" autocomplete="off" value="<?php echo $status; ?>" readonly="readonly" /></td>
            </tr>
            <tr>
            	<td align="center" colspan="2"><input type="button" value="Update class record" onclick="update_class_click()" /></td>
            </tr>
            
            <script language="javascript">
				function update_class_click()
				{
					if(document.getElementById("class").value=="")
					{
						alert("Please make sure that the fields are not empty!");
						document.getElementById("class").focus();
						return null;
					}
					
					if(document.getElementById("arm").value=="")
					{
						alert("Please make sure that the fields are not empty!");
						document.getElementById("arm").focus();
						return null;
					}
					
					if(((document.getElementById("class").value=="sss1") || (document.getElementById("class").value=="sss2") || (document.getElementById("class").value=="sss3")) && (document.getElementById("arm").value=="junior secondary school"))
					{
						alert("A senior class cannot be in a junior arm!");
						return null;
					}
					
					if(((document.getElementById("class").value=="jss1") || (document.getElementById("class").value=="jss2") || (document.getElementById("class").value=="jss3")) && (document.getElementById("arm").value=="senior secondary school"))
					{
						alert("A junior class cannot be in a senior arm!");
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