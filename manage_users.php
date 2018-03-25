<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$page_title="Manage Users";
	
	$status=isset($_GET['status']) ? trim($_GET['status']) : "Active";
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
	<p align="center"><a href="home.php">Home</a> | <a href="add_new_user.php">Add new user</a></p>
    <?php
		$select_users=mysql_query("SELECT * FROM `users` WHERE(status='$status')");
		if($select_users==FALSE)
		{
			die("Error encountered selecting users! ".mysql_error());
		}
		
		
	?>
    
    </p>
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
				document.getElementById("myform").action="manage_users.php?status="+document.getElementById("status").value;
				document.getElementById("myform").submit();
			}
		</script>
        <hr />
        
         <?php 
		 $total_selected_users=mysql_num_rows($select_users);
		if($total_selected_users<=0)
		{
			?>
   	<p class="error">No user record found!<?php echo mysql_error() ?></p>
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
        	<tr class="tableheading" align="center">
            	<td>Email</td>
                <td>Full Name</td>
                <td>User Category</td>
                <td>Occupation</td>
                <td>State</td>
                <td>Address</td>
                <td>Status</td>
                <td>Date Created</td>
            </tr>
            <script language="javascript">
				function delete_user_click(email)
				{
					var r=confirm("Deleting record... Click ok to continue");
					if(r)
					{
						document.getElementById("myform").action="delete_user.php?email="+email;
						document.getElementById("myform").submit();
					}
				}
			</script>
            
            <?php
				$bg_color="";
				while($row_selected_user=mysql_fetch_assoc($select_users))
				{
					$bg_color=($bg_color=="#efefef") ? "#cdcdcd" : "#efefef";
					?>
                    <tr bgcolor="<?php echo $bg_color; ?>">
                    	<td><?php echo $row_selected_user['email']; ?><br />
                        	<span class="small"> <a href="edit_users.php?email=<?php echo $row_selected_user['email']; ?>">Edit</a>  
                            <?php
                            if($status=="Active")
                            {
								?>
                           		| <a href="Javascript:void(0)" onclick="delete_user_click('<?php echo $row_selected_user['email']; ?>')">Delete</a>
                                 <?php
                            }
							?>
                            </span>
                        </td>
                        <td><?php echo $row_selected_user['full_name']; ?></td>
                        <td><?php echo $row_selected_user['user_category']; ?></td>
                        <td><?php echo $row_selected_user['occupation']; ?></td>
                        <td><?php echo $row_selected_user['state']; ?></td>
                        <td><?php echo $row_selected_user['address']; ?></td>
                        <td><?php echo $row_selected_user['status']; ?></td>
                        <td><?php echo $row_selected_user['date_created']; ?></td>
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