<?php
	require_once("time_check.php");
	$page_title="Edit User";
	require_once("db_connect.php");
	
	$email=isset($_GET['email']) ?trim($_GET['email']) : "";
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
    <p align="center"><a href="manage_users.php">Back to manage user</a> | <a href="home.php">Home</a></p>
    <?php
		$select_users=mysql_query("SELECT * FROM `users` WHERE (email='$email')");
		if($select_users==FALSE)
		{
			?>
            	<p align="center" class="error">Error encountered selecting user! <?php echo mysql_error(); ?></p>
            <?php
				die();
		}
		
		$total_selected_user=mysql_num_rows($select_users);
		
		if($total_selected_user<=0)
		{
			?>
            	<p align="center" class="error">No record found!</p>
                <p>
            <?php
			
		}
		
		mysql_data_seek($select_users,0);
		$row_select_users=mysql_fetch_assoc($select_users);
		
		$email=$row_select_users['email'];
		$full_name=$row_select_users['full_name'];
		$password=$row_select_users['password'];
		$user_category=$row_select_users['user_category'];
		$occupation=$row_select_users['occupation'];
		$state=$row_select_users['state'];
		$address=$row_select_users['address'];
		$status=$row_select_users['status'];
		
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
    
    <form action="edit_users_process.php" method="post" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
        	<tr>
            	<td><strong>Email:</strong></td>
                <td><input name="email" type="text" class="width_200" id="email" value="<?php echo $email; ?>" readonly="readonly" autocomplete="off" /></td>
            </tr>
            
            <tr>
            	<td><strong>Full Name:</strong></td>
                <td><input name="full_name" type="text" class="width_200" id="full_name" value="<?php echo $full_name; ?>" autocomplete="off" /></td>
            </tr>
            
            <tr>
            	<td><strong>Password:</strong></td>
                <td><input name="password" type="password" class="width_200" id="password" value="<?php echo $password; ?>" /></td>
            </tr>
            
            <tr>
            	<td><strong>User Category:</strong></td>
                <td><select name="user_category" class="width_200" id="user_category">
                <option value=""></option>
                <option value="Administrative"<?php if($user_category=='Administrative') { echo "selected='selected'";} ?>>Administrative</option>
                <option value="User"<?php if($user_category=='User') { echo "selected='selected'";} ?>>User</option>
                </select>
              </td>
            </tr>
            
            <tr>
            	<td><strong>Occupation:</strong></td>
                <td><input name="occupation" type="text" class="width_200" id="occupation" autocomplete="off" value="<?php echo $occupation; ?>" /></td>
            </tr>
            
            <tr>
            	<td><strong>State:</strong></td>
                <td><input name="state" type="text" class="width_200" id="state" value="<?php echo $state; ?>" autocomplete="off" /></td>
            </tr>
            
            <tr>
            	<td><strong>Address:</strong></td>
                <td><input name="address" type="text" class="width_200" id="address" autocomplete="off" value="<?php echo $address; ?>" /></td>
            </tr>
            
            <tr>
            	<td><strong>Status:</strong></td>
                <td><select name="status" class="width_200" id="status">
                	<option value=""></option>
                    <option value="Active"<?php if($status=='Active') { echo "selected='selected'";} ?>>Active</option>
                    <option value="Inactive"<?php if($status=='Inactive') { echo "selected='selected'";} ?>>Inactive</option>
                </select>
                </td>
            </tr>
            
            <tr>
            	<td colspan="2" align="center"><input name="add_user" type="button" id="add_user" value="Apply Changes" onclick="add_user_click()" /></td>
            </tr>
            
            <script language="javascript">
			function add_user_click()
			{	
					
					if(document.getElementById("full_name").value=="")
					{
						alert("Please make sure you fill in your name!");
						document.getElementById("full_name").focus();
						return null;
					}
					
					if(document.getElementById("password").value=="" || (document.getElementById("password").value).length<8)
					{
						alert("Please fill in a password not less than 8 characters!");
						document.getElementById("password").focus();
						return null;
					}
					
					if(document.getElementById("user_category").value=="")
					{
						alert("Please put a user category!");
						document.getElementById("user_category").focus();
						return null;
					}
					
					if(document.getElementById("occupation").value=="")
					{
						alert("Please fill in your occupation!");
						document.getElementById("occupation").focus();
						return null;
					}
					
					if(document.getElementById("address").value=="")
					{
						alert("Please enter your address");
						document.getElementById("address").focus();
						return null;
					}
					
					if(document.getElementById("state").value=="")
					{
						alert("Please put your state of birth!");
						document.getElementById("state").focus();
						return null;
					}
					
					if(document.getElementById("status").value=="")
					{
						alert("Please choose a status!");
						document.getElementById("status").focus();
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