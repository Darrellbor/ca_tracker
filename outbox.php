<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	require_once("functions.php");
	$Page_title="Outbox";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template4.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $Page_title; ?> :: C.A.Tracker</title>
<!-- InstanceEndEditable -->
<script language="javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" src="functions.js"></script>
<script language="javascript" src="ajax.js"></script>
<link href="mystyle7.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body onload="process()">

<div id="heading">
	C.A Tracker
</div>

<div id="contents">
	<?php 
		if(isset($_SESSION['current_user_full_name'],$_SESSION['current_session'],$_SESSION['current_term']))
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
    	 <?php
		  if($Page_title!="Compose Message")
		  {
			  $select_viability=mysql_query("select * from `messages` where recepient_reg_id='".$_SESSION['current_user_reg_no']."' and message_viability='new'");
			if($select_viability==FALSE)
			{
				$_SESSION['message']="Error encountered selecting message viability";
				$_SESSION['messagetype']="error";
				exit();
			}
			$total_selected_message_viability=mysql_num_rows($select_viability);
		  }
			
		 ?>
    
    
<div id="menu" align="left">
              <h4><a href="inbox.php">Message Hub</a></h4>
              <p><a href="inbox.php" <?php if($Page_title=="Inbox") {echo 'class="active"';} ?>>Inbox<?php if($Page_title!="Compose Message" && $total_selected_message_viability>0) { echo "(".$total_selected_message_viability.")"; } ?></a></p>
              <p><a href="outbox.php" <?php if($Page_title=="Outbox") {echo 'class="active"';} ?>>Outbox</a></p>
              <p><a href="compose_message.php" <?php if($Page_title=="Compose Message") {echo 'class="active"';} ?>>Compose Message</a></p>
         </div>
         
         <div id="main_contents">
            <h1>
                <?php echo $Page_title; ?>
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
            	<br />
            	<!-- InstanceBeginEditable name="mycontents" -->
                	<p align="left" style="font-size:14px; color:#007DFB;"><a href="home.php">Home</a>>Message Hub>Outbox</p><br /> <br />
                    <?php
						$select_messages2=mysql_query("select * from `messages` where sender_reg_id='".$_SESSION['current_user_reg_no']."' order by message_id desc");
						if($select_messages2==FALSE)
						{
							$_SESSION['message']="Error encountered selecting messages";
							$_SESSION['messagetype']="error";
							exit();
						}
						
						$total_selected_message2=mysql_num_rows($select_messages2);
						if($total_selected_message2<=0)
						{
							?>
								<p class="error">Sorry, but you currently don't have any messages! <?php echo mysql_error(); ?></p>
							<?php
							die();
						}
					?>
                    
                    <style>
						#data_table a{
							color:#007DFB;
							text-decoration:none;	
						}
						
						#message{
							
							height:22px;
							overflow:hidden; 
							text-overflow:ellipsis;
						}
					</style>
                     <form method="post" id="myform">
                     	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table" style="color:#007DFB;">
                        	<tr class="tableheading">
                            	<td colspan="3">Outbox</td>
                            </tr>
                            
                            <?php
								$bg_color="";
								while($row_selected_messages=mysql_fetch_assoc($select_messages2))
								{	
									if($row_selected_messages['subject']!="Friend Request")
									{
										if($row_selected_messages['sender_visible']=="yes")
										{
											$bg_color=($bg_color=="#efefef") ? "#cdcdcd" : "#efefef";
											?>
                                            	<tr id="outbox" bgcolor="<?php echo $bg_color; ?>">
                                                	<td><a href="Javascript:void(0)" onclick="outbox_click('<?php echo $row_selected_messages['date_of_message']; ?>','<?php echo $row_selected_messages['recepient_full_name']; ?>','<?php echo $row_selected_messages['subject']; ?>','<?php echo $row_selected_messages['message']; ?>')"><?php echo $row_selected_messages['recepient_full_name']; ?></a>
                                                    <span class="small">
                                           	 <p style="color:#2424FF; text-decoration:underline;"> <a href="Javascript:void(0)" onclick="delete_click('<?php echo $row_selected_messages['message_id']; ?>')">Delete</a> </p> </span>
                                                    </td>
                                                    <td><a href="Javascript:void(0)" onclick="outbox_click('<?php echo $row_selected_messages['date_of_message']; ?>','<?php echo $row_selected_messages['recepient_full_name']; ?>','<?php echo $row_selected_messages['subject']; ?>','<?php echo $row_selected_messages['message']; ?>')"><?php echo $row_selected_messages['subject']; ?>-<?php echo $row_selected_messages['message']; ?></a></td>
                                                    <td><a href="Javascript:void(0)" onclick="outbox_click('<?php echo $row_selected_messages['date_of_message']; ?>','<?php echo $row_selected_messages['recepient_full_name']; ?>','<?php echo $row_selected_messages['subject']; ?>','<?php echo $row_selected_messages['message']; ?>')"><?php echo $row_selected_messages['date_of_message']; ?></a></td>
                                                </tr>
                                            <?php
										}
									}
								}
							?>
                            <script language="javascript">
								function outbox_click(date_of_message,recepient_full_name,subject,message)
								{
									document.getElementById("myform").action="outbox_view.php?date_of_message="+date_of_message+"&recepient_full_name="+recepient_full_name+"&subject="+subject+"&message="+message;
									document.getElementById("myform").submit();
								}
								
								function delete_click(message_id)
								{
									var r=confirm("Deleting message... Click ok to continue!");
									if(r)
									{
										document.getElementById("myform").action="delete_outbox.php?message_id="+message_id;
										document.getElementById("myform").submit();
									}
									
								}
							</script>
                        </table>
                        <p>&nbsp;</p>
                </form>
           <!-- InstanceEndEditable --></div>
    
</div>

<div id="footer">
	&copy; <?php echo date("Y"); ?> I-corporation LTD
</div>

</body>
<!-- InstanceEnd --></html>