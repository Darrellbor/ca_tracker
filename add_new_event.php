<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$main_menu="Events";
	$sub_menu="Add New Event";
	
	$title=isset($_SESSION['title']) ? trim($_SESSION['title']) : "";
	$description=isset($_SESSION['description']) ? trim($_SESSION['description']) : "";
	$date_of_event=isset($_SESSION['date_of_event']) ? trim($_SESSION['date_of_event']) : "";
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
     <script language="javascript">
		$(document).ready(
			function()
			{
				shade_input_table("data_table");
			}
		);
	
	</script>
    <p align="right"> <a href="home.php"><input type="button" value="Back To Home" /></a></p>
    
    <form action="add_save_event_process.php" method="post" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table" style="color:#007DFB;">
        	<tr>
            	<td>Title:</td>
                <td><input name="title" type="text" id="title" autocomplete="off" value="<?php echo $title; ?>" class="width_200" /></td>
            </tr>
            
            <tr>
            	<td>Description:</td>
                <td><textarea name="description" id="description"><?php echo $description; ?></textarea></td>
            </tr>
            
            <tr>
            	<td>Date Of Event:</td>
                <td><input name="date_of_event" type="text" id="date_of_event" autocomplete="off" value="<?php $date_of_event; ?>" placeholder=" YYYY-MM-DD" class="width_200" /></td>
            </tr>
            
            <tr>
            	<td align="center" colspan="2"><input name="add_button" type="button" id="add_button" onclick="verify_click('add_save_event_process.php')" value="Add New Event" /> <input name="save_button" type="button" id="save_button" onclick="verify_click('add_save_event_process2.php')" value="Save Event" /></td>
            </tr>
        </table>
    	<p>&nbsp;</p>
        
        <script language="javascript">
			function verify_click(action)
			{
				if(document.getElementById("title").value=="")
				{
					alert("Please make sure that the title field is not empty!");
					document.getElementById("title").focus();
					return null;
				}
				
				if(document.getElementById("description").value=="")
				{
					alert("Please make sure that the description field is not empty!");
					document.getElementById("description").focus();
					return null;
				}
				
				if(val_date_click(document.getElementById("date_of_event").value)==false)
				{
					document.getElementById("date_of_event").focus();
					return null;
				}
				
					document.getElementById("myform").action=action;
					document.getElementById("myform").submit();
				
			}
		</script>
    </form>
	<!-- InstanceEndEditable --></div>
   
</div>

<div id="footer">
	&copy; <?php echo date("Y"); ?> I-corporation LTD
</div>
</body>
<!-- InstanceEnd --></html>