<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$page_title="Home";
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
    	<h2 id="welcome_message">WELCOME <b><?php if(isset($_SESSION['current_user_full_name'])) { echo $_SESSION['current_user_full_name']; } ?>!</b></h2>
	<p>
    	<?php
			$select_page_visited=mysql_query("select * from `page_visited` where registration_id='".$_SESSION['current_user_reg_no']."'");
			if($select_page_visited==FALSE)
			{
				?>
					<p align="center" class="error">Error encountered selecting page record! <?php echo mysql_error(); ?></p>
				<?php
					die();
			}
			
			$row_selected_page=mysql_fetch_assoc($select_page_visited);
			
			$visited=$row_selected_page['visited'];
			
		?>
    <script language="javascript">
		$(document).ready(
		function()
			{
				shade_input_table("data_table")
			}
		);
	</script>
    
     <?php
		if(isset($_SESSION['message']))
		{
			?>
   	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
            <?php
			unset($_SESSION['message'], $_SESSION['messagetype']);
		}
	?>
    
  		<table align="center" cellpadding="40px" cellspacing="10px" id="data_table">
        	<?php 
				if(isset($_SESSION['current_user_category']) && $_SESSION['current_user_category']=="Administrative")
				{
					?>
                    	<tr>
                        	<td><a href="manage_users.php?status=Active"><img src="images/user too.jpg" width="30" /></a>  
            				 <a href="manage_users.php?status=Active">Manage Users</a></td>
                             
                             <td><a href="manage_students.php?status=Active"><img src="images/mstu .jpg" width="30" /></a>
           					 <a href="manage_students.php?status=Active">Manage Students</a></td>
                             
                             <td><a href="manage_subjects.php?status=Active"><img src="images/mstud.jpg" width="30" /></a>
            				 <a href="manage_subjects.php?status=Active">Manage Subjects</a></td>
                        </tr>
                        
                        <tr>
                        	<td><a href="manage_session.php"><img src="images/mt.jpg" width="30" /></a>
            				<a href="manage_session.php">Manage Session</a></td>
                            
                            <td><a href="manage_term.php"><img src="images/mplan .jpg" width="30" />
           					Manage Term</a></td>
                            
                            <td><a href="manage_class.php?status=Active"><img src="images/mclass .jpg" width="30" /></a>
            				<a href="manage_class.php?status=Active">Manage Class</a></td>
                        </tr>
                        
                        <tr>
                        	<td><a href="manage_school.php?status=Active"><img src="images/mschool .jpg" width="30" /></a>
            				<a href="manage_school.php?status=Active">Manage School</a></td>
                            
                            <td><a href="admin_change_password.php"><img src="images/mses.jpg" width="30" />
           					Change Password</a></td>
                            
                            <td><a href="sign_out.php"><img src="images/exit .jpg" width="30" />
            				sign Out</a></td>
                        </tr>
                    <?php
				}
			?>
        	
            
            <?php
				if(isset($_SESSION['current_user_category']) && $_SESSION['current_user_category']=="User")
				{
					?>
                    	<tr>
                        	 <td><a href="manage_students.php?status=Active"><img src="images/mstu .jpg" width="30" /></a>
           					 <a href="manage_students.php?status=Active">Manage Students</a></td>
                             
                              <td><a href="manage_subjects.php?status=Active"><img src="images/mstud.jpg" width="30" /></a>
            				 <a href="manage_subjects.php?status=Active">Manage Subjects</a></td>
                             
                             <td><a href="manage_class.php?status=Active"><img src="images/mclass .jpg" width="30" /></a>
            				<a href="manage_class.php?status=Active">Manage Class</a></td>
                        </tr>
                        
                        <tr>
                        	<td><a href="manage_school.php?status=Active"><img src="images/mschool .jpg" width="30" /></a>
            				<a href="manage_school.php?status=Active">Manage School</a></td>
                            
                            <td><a href="admin_change_password.php"><img src="images/mses.jpg" width="30" />
            				Change Password</a></td>
                            
                            <td><a href="sign_out.php"><img src="images/exit .jpg" width="30" />
            				sign Out</a></td>
                        </tr>
                    <?php
				}
			?>
 			
            
            <?php
				if(isset($_SESSION['current_user_category']) && $_SESSION['current_user_category']=="Student")
				{
					?>
                    	<tr align="center">
                        	<td bgcolor="#F7F7F7">
                            </td>
        					<td align="center"><a href="view_profile.php"><img src="images/eke.jpg" width="30" />
            				View Profile</a></td>
		 			    </tr>
                        
                        <tr>
                        	<td><?php
								if($visited=="no")
								{
									?>
                                    	 <a href="manage_ca.php"><img src="images/ca3.jpg" width="30" />
         								 Manage C.A</a>
<?php
								}
								
								else
								{
									?>
                                    	 <a href="view_classwork.php"><img src="images/ca3.jpg" width="30" />
         					             Manage C.A</a><?php
								}
							?>
                       </td>
        	
            				<td><a href="inbox.php"><img src="images/image3s.jpg" width="30" />
       				    Message Hub</a></td>
                            
                            <td><a href="my_friends.php"><img src="images/buddy.jpg" width="30" />
            				C.A Buddies</a></td>
                        </tr>
                        
                        <tr>
                        	<td><a href="interactive_center.php"><img src="images/images.jpg" width="30" />
   							Interactive Center</a></td>
                            
                            <td><a href="change_password.php"><img src="images/mses.jpg" width="30" />
            				Change Password</a></td>
        
                            <td><a href="sign_out.php"><img src="images/exit .jpg" width="30" />
                            sign Out</a></td>
                        </tr>
                    <?php
				}
			?>
            
    </table>
    </p>
	<!-- InstanceEndEditable --></div>
    <div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
    </div>
</body>
<!-- InstanceEnd --></html>