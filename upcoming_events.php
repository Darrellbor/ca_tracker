<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$main_menu="Events";
	$sub_menu="Upcoming Events";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>
<?php if($main_menu!="") { echo $main_menu; } if($sub_menu!="") { echo " :: ".$sub_menu; } ?> :: C.A Tracker</title>
<!-- InstanceEndEditable -->
<script language="javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" src="functions.js"></script>
<link href="mystyles4.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

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
    
    <div id="menu" align="left">
    
   	    <h4><a href="interactive_center.php">Interactive Center</a></h4>
        <p><a href="upcoming_events.php" <?php if($main_menu=="Events") {echo 'class="active"';} ?>>Events</a></p>
      <p><a href="my_notes.php" <?php if($main_menu=="Notes") {echo 'class="active"';} ?>>Notes</a></p>
      <p><a href="question_board.php" <?php if($main_menu=="Question Center") {echo 'class="active"';} ?>>Question center</a></p>
      
      <?php
	  	if($main_menu=="Events")
		{
			?>
            	<h4><a href="upcoming_events.php">Events</a></h4>
                <p><a href="upcoming_events.php" <?php if($sub_menu=="Upcoming Events") { echo 'class="active"';} ?>>Upcoming Events</a></p>
                <p><a href="saved_events.php" <?php if($sub_menu=="Saved Events") { echo 'class="active"';} ?>>Saved Events</a></p>
                <p><a href="deleted_passed_events.php" <?php if($sub_menu=="Deleted/Passed Events") { echo 'class="active"';} ?>>Deleted/Passed Events</a></p>
                <p><a href="add_new_event.php" <?php if($sub_menu=="Add New Event") { echo 'class="active"';} ?>>Add New Event</a></p>
            <?php
		}
	  ?>
      
      <?php
	  	if($main_menu=="Notes")
		{
			?>
            	<h4><a href="my_notes.php">Notes</a></h4>
                <p><a href="my_notes.php" <?php if($sub_menu=="My Notes") { echo 'class="active"';} ?>>My Notes</a></p>
                <p><a href="add_new_note.php" <?php if($sub_menu=="Add New Note") { echo 'class="active"';} ?>>Add New Note</a></p>
            <?php
		}
	  ?>
      
      <?php
	  	if($main_menu=="Question Center")
		{
			?>
            	<h4><a href="question_board.php">Question Center</a></h4>
                <p><a href="question_board.php"  <?php if($sub_menu=="Question Board") { echo 'class="active"';} ?>>Question Board</a></p>
                <p><a href="my_questions.php"  <?php if($sub_menu=="My Questions") { echo 'class="active"';} ?>>My Questions</a></p>
                <p><a href="add_new_question.php"  <?php if($sub_menu=="Add New Question") { echo 'class="active"';} ?>>Add New Question</a></p>
            <?php
		}
	  ?>
    
    </div>
    
    
    	 <div id="main_contents">
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
    <!-- InstanceBeginEditable name="mycontents" -->
    	<p align="right"><a href="home.php"><input type="button" value="Back To Home" /></a></p>
        <?php
			$select_up_events=mysql_query("select * from `upcoming_events` where (registration_id='".$_SESSION['current_user_reg_no']."')");
			if($select_up_events==FALSE)
			{
				?>
   	<p align="center" class="error">Error encountered selecting upcoming events!</p>
                <?php
			}
		?>
        
        <form method="post" id="myform">
        
        	<?php
					$total_selected_up_events=mysql_num_rows($select_up_events);
					if($total_selected_up_events<=0)
					{
						?>
                        	<p align="center" class="error">Sorry you currently have no upcoming events! <?php echo mysql_error(); ?></p>
                        <?php
						die();
					}
				?>
                
                <br />
                <br />
        	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
            	<tr class="tableheading">
                	<td>Title</td>
                    <td>Description</td>
                    <td>Date Of Event </td>
                </tr>
                	<script language="javascript">
						function delete_event(reg_id,event_code)
						{
							var r=confirm("Deleting event. Click ok to continue");
						
							if(r)
							{
								document.getElementById("myform").action="delete_event.php?reg_id="+reg_id+"&event_code="+event_code;
								document.getElementById("myform").submit();
							}
						}
					</script>
                	
                    
                <?php
					$bgcolor="";
					while($row_selected_up_events=mysql_fetch_assoc($select_up_events))
					{
						 
						if(date("Y-m-d") > $row_selected_up_events['date_of_event'])
						{
							$add_sql=mysql_query("insert into `deleted/passed_events` set registration_id='".$_SESSION['current_user_reg_no']."', event_code='".$row_selected_up_events['event_code']."', title='".$row_selected_up_events['title']."', description='".$row_selected_up_events['description']."', supposed_date_of_event='".$row_selected_up_events['date_of_event']."', message_viability='none'");
							if($add_sql==FALSE)
							{
								$_SESSION['message']="Error encountered adding record ".mysql_error();
								$_SESSION['messagetype']="error";
								exit();
							}
							
								$del_sql=mysql_query("delete from `upcoming_events` where event_code='".$row_selected_up_events['event_code']."'");
								if($del_sql==FALSE)
								{
									$_SESSION['message']="Error encountered deleting record";
									$_SESSION['messagetype']="error";
									exit();
								}
						}
						
						$bgcolor=($bgcolor=="#efefef") ? "#cdcdcd" : "#efefef";
						?>
                        	<tr style="color:#007DFB" bgcolor="<?php echo $bgcolor; ?>">
                            	<td><?php echo $row_selected_up_events['title']; ?><br />
                                	<span class="small"><a href="javascript:void(0)" onclick="delete_event('<?php echo $_SESSION['current_user_reg_no']; ?>','<?php echo $row_selected_up_events['event_code']; ?>')">Delete Event</a></span>
                                </td>
                                <td><?php echo $row_selected_up_events['description']; ?></td>
                                <td><?php echo $row_selected_up_events['date_of_event']; ?></td>
                            </tr>
                        <?php
					}
				?>
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