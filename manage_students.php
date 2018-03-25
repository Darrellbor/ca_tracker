<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$page_title="Manage Students";
	
	$status=isset($_GET['status']) ?trim($_GET['status']) : "Active";
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
	<p align="center"><a href="home.php">Home</a></p>
    <?php
		$select_students=mysql_query("SELECT * FROM `students` WHERE(status='$status')");
		if($select_students==FALSE)
		{
			?>
            	<p align="center" class="error">Error encountered accessing students table! <?php echo mysql_error(); ?></p>
            <?php
			die();
		}
		
	?>
    
    <form method="post" id="myform">
    		<p align="center">&nbsp; </p>
        <p align="center">
        	<b>Status: </b>
            <select name="status" id="status" onchange="status_change()">
            	<option value="Active" <?php if($status=="Active") { echo "selected='selected'";} ?>>Active</option>
                <option value="Inactive" <?php if($status=="Inactive") { echo "selected='selected'";} ?>>Inactive</option>
            </select>
      </p>
      <script language="javascript">
			function status_change()
			{
				document.getElementById("myform").action="manage_students.php?status="+document.getElementById("status").value;
				document.getElementById("myform").submit();
			}
		</script>
        <hr />
        
         <?php 
		 
		 $total_selected_students=mysql_num_rows($select_students);
		if($total_selected_students<=0)
		{
			?>
   				<p class="error" align="center">No student record found! <?php echo mysql_error(); ?></p>
            <?php
			die();
		}
		
	if(isset($_SESSION['message']))
	{
		?>
        	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
        <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
 ?>
 <br />
 
 		<table align="center" cellpadding="10px" cellspacing="1px">
        	<tr align="center" class="tableheading">
            	<td>Email</td>
                <td>Registration Id</td>
                <td>Full Name</td>
                <td>Sex</td>
                <td>Date Of Birth</td>
                <td>School Name</td>
                <td>class</td>
                <td>No Of Subjects Offered</td>
                <td>Status</td>
                <td>Date Of Account Creation</td>
            </tr>
                        <script language="javascript">
				function delete_students_click(email,reg_no)
				{
					var r=confirm("Deleting record... Click ok to continue");
					if(r)
					{
						document.getElementById("myform").action="delete_student.php?email="+email+"&reg_no="+reg_no;
						document.getElementById("myform").submit();
					}
				}
			</script>
            
           <?php
		   $bg_color="";
		   	while($row_selected_students=mysql_fetch_assoc($select_students))
			{
				$bg_color=($bg_color=="#efefef") ? "#cdcdcd" : "#efefef";
				?>
                	<tr bgcolor="<?php echo $bg_color; ?>">
                    	<td><?php echo $row_selected_students['email']; ?><br />
                        	<span class="small"> <a href="edit_students.php?email=<?php echo $row_selected_students['email']; ?>">Edit</a> 
                            <?php 
                            	if($status=="Active")
								{
									?>
                            		| <a href="Javascript:void(0)" onclick="delete_students_click('<?php echo $row_selected_students['email']; ?>','<?php echo $row_selected_students['registration_id']; ?>')">Delete</a></span>
                             		<?php
								}
							 ?>
                        </td>
                        <td><?php echo $row_selected_students['registration_id']; ?></td>
                        <td><?php echo $row_selected_students['full_name']; ?></td>
                        <td><?php echo $row_selected_students['sex']; ?></td>
                        <td><?php echo $row_selected_students['date_of_birth']; ?></td>
                        <td><?php echo $row_selected_students['school_name']; ?></td>
                        <td><?php echo $row_selected_students['class']; ?></td>
                        <td><?php echo $row_selected_students['no_of_subjects_offered']; ?></td>
                        <td><?php echo $row_selected_students['status']; ?></td>
                        <td><?php echo $row_selected_students['date_of_account_creation']; ?></td>
                    </tr>
                <?php
			}
		   ?>
        </table>
    </form>
	<!-- InstanceEndEditable --></div>
    <div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
    </div>
</body>
<!-- InstanceEnd --></html>