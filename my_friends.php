<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$main_menu="C.A Buddies";
	$sub_menu="My Friends";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template2.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>
<?php if($main_menu!="") { echo $main_menu; } if($sub_menu!="") { echo " :: ".$sub_menu; } ?>
:: C.A Tracker</title>
<!-- InstanceEndEditable -->
<script language="javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" src="functions.js"></script>
<link href="mystyles5.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="heading">
	C.A Tracker
</div>

<div id="content">
	<?php 
		if(isset($_SESSION['current_user_full_name'],$_SESSION['current_session'],$_SESSION['current_term']))
		{
			?>
  <p id="information_display" align="right" style="font-size:12px"><b>Signed In:</b><?php echo $_SESSION['current_user_full_name'] ?> (<a href="file:///C|/xampp/htdocs/sign_out.php">Sign Out</a>)<br />
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
    
    <?php
				if($main_menu!="")
				{
					?>
                    	<h1><?php echo $main_menu; ?></h1>
                    <?php
				}
			?>
            
            <?php
				if($sub_menu!="")
				{
					?>
                    	<h2><?php echo $sub_menu; ?></h2>
                    <?php
				}
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
    <br />
    	<div id="nav">
        	<table>
            	<tr>
                	<td width="255" height="43" class="nav_in"><a href="my_friends.php" <?php if($sub_menu=="My Friends") { echo 'class="active"';} ?>>My Friends</a></td>
                    <td width="333" class="nav_in"><a href="Add_Search_People.php" <?php if($sub_menu=="Add/Search People") { echo 'class="active"';} ?>>Add/Search People</a></td>
                </tr>
            </table>
        </div><br /><br />
        <!-- InstanceBeginEditable name="Mycontents" -->
        	<p align="center"><a href="home.php">Back To Home</a></p>
            <?php
				$select_my_friends=mysql_query("select * from `students` where registration_id in (select budd_registration_id from `friends` where main_account='".$_SESSION['current_user_reg_no']."')");
				if($select_my_friends==FALSE)
				{
					?>
       	<p class="error">Error encountered selecting my friend list!</p>
                    <?php
				}
			?>
            
            <form method="post" id="myform">
            	<?php 
					$total_selected_friends=mysql_num_rows($select_my_friends);
					if($total_selected_friends<=0)
					{
						?>
                        	<p class="error">You currently have no friend on your friend list <?php echo mysql_error(); ?></p>
                        <?php
						die();
					}
				?>
                
              <table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
                	<tr class="tableheading">
                        <td colspan="2">Friends</td>
                    </tr>
                    
                    <?php
						$bg_color="";
						$count="";
						while($row_selected_friends=mysql_fetch_assoc($select_my_friends))
						{
							$bg_color=($bg_color=="#efefef") ? "#cdcdcd" : "#efefef";
							$filename="images/" . $row_selected_friends['registration_id'] .".jpg";
							$count++;
							if(file_exists($filename)==false)
							{
								$filename="images/no_img.jpg";
							}
							?>
                            	<tr bgcolor="<?php echo $bg_color; ?>" style="color:#007DFB;">
                                	<td align="center"><img width="120" src="<?php echo $filename; ?>" /></td>
                                    <td><b><a href="Javascript:void(0)" style="color:#007DFB;" onclick="full_name_click('<?php echo $count; ?>')"><?php echo $row_selected_friends['full_name']; ?></a></b>
                                    	<p style="font-size:14px">Email: <?php echo $row_selected_friends['email']; ?>, Sex: <?php echo $row_selected_friends['sex']; ?>, School: <?php echo $row_selected_friends['school_name']; ?>, Class/Level: <?php echo $row_selected_friends['class']; ?></p>
                                    <span class="small" id="links<?php echo $count; ?>">
                                        <p align="left"><a href="Javascript:void(0)" onclick="send_message('<?php echo $row_selected_friends['full_name']; ?>',' <?php echo $row_selected_friends['email']; ?>','<?php echo $row_selected_friends['registration_id']; ?>')">Send Message</a> <a href="javascript:void(0)" onclick="delete_friend('<?php echo $row_selected_friends['registration_id']; ?>')">Delete Friend</a> </p> <p align="right"><a href="javascript:void(0)" onclick="hide_click('<?php echo $count; ?>')">Hide</a></p></span>
                                    </td>
                                </tr>
                            <?php
						}
					?>
                </table>
                
                <script language="javascript">
					$(document).ready(
						function()
						{
							$(".small").hide();
						}
					);
					
					function full_name_click(index)
					{
						$("#links"+index).fadeIn('slow');
					}
					
					function hide_click(index)
					{
						$("#links"+index).fadeOut('fast');
					}
					
					function send_message(full_name,email,reg_id)
					{
						document.getElementById("myform").action="send_message.php?full_name="+full_name+"&email="+email+"&reg_id="+reg_id;
						document.getElementById("myform").submit();
					}
					
					function delete_friend(reg_id)
					{
						var r=confirm("Are you sure that you want to delete this friend from your friends list. By deleting this friend you would no longer appear on their friends list. Click ok to proceed!");
						if(r)
						{
							document.getElementById("myform").action="delete_friend.php?reg_id="+reg_id;
							document.getElementById("myform").submit();
						}
					}
                </script>
                <p>&nbsp;</p>
            </form>
  <!-- InstanceEndEditable --></div>

<div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
</div>
</body>
<!-- InstanceEnd --></html>