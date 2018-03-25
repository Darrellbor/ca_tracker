<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$page_title="Edit Subjects";
	
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
	<p align="center"><a href="manage_subjects.php">Back to manage subjects</a> | <a href="home.php">Home</a></p>
    <?php
		$select_subjects=mysql_query("SELECT * FROM `subjects` WHERE (registration_id='$registration_id')");
		if($registration_id==FALSE)
		{
			?>
            	<p class="error">Error encountered selecting subject record! <?php echo mysql_error(); ?></p>
            <?php
			die();
		}
		
		$total_selected_subjects=mysql_num_rows($select_subjects);
		if($total_selected_subjects<=0)
		{
			?>
            	<p class="error">No record found!</p>
			<?php
		}
		
		mysql_data_seek($select_subjects,0);
		$row_select_subjects=mysql_fetch_assoc($select_subjects);
		
		$registration_id=$row_select_subjects['registration_id'];
		$no_sub=$row_select_subjects['no_of_subjects_offered'];
		$list_sub=$row_select_subjects['list_of_subjects_offered'];
		$status=$row_select_subjects['status'];
		
		
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
    
    <form action="edit_subjects_process.php" method="post" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
        	<tr>
            	<td><strong>Registration id:</strong></td>
                <td><input name="reg_no" type="text" class="width_200" id="reg_no" autocomplete="off" value="<?php echo $registration_id; ?>" readonly="readonly" /></td>
            </tr>
            
            <tr>
            	<td><strong>No of subject offered:</strong></td>
                <td><input name="no_of_subjects_offered" type="text" class="width_200" id="no_of_subjects_offered" value="<?php echo $no_sub; ?>" autocomplete="off"   /></td>
            </tr>
            
            <tr>
            	<td><strong>List of subject offered:</strong></td>
                <td><textarea name="list_sub" id="list_sub" cols="23px" rows="5px"><?php echo $list_sub; ?></textarea></td>
            </tr>
            
            <tr>
            	<td><strong>Status:</strong></td>
                <td><input name="status" type="text" class="width_200" id="status" value="<?php echo $status; ?>" autocomplete="off" readonly="readonly" /></td>
            </tr>
            
            <tr>
            	<td align="center" colspan="2"><input type="button" value="Update subject record" onclick="edit_subject_click()" /></td>
            </tr>
            
            <script language="javascript">
				function edit_subject_click()
				{
					if(document.getElementById("no_of_subjects_offered").value=="")
					{
						alert("please make sure that the no of subjects is filled appropriately!");
						document.getElementById("no_of_subjects_offered").focus();
						return null;
					}
					
					if(document.getElementById("list_sub").value=="")
					{
						alert("please make sure that the list of subjects is filled appropriately!");
						document.getElementById("list_sub").focus();
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