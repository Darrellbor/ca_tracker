<?php
	require_once("time_check.php");
	$main_menu="Interactive Center";
	$sub_menu="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>
<?php if($main_menu!="") { echo $main_menu; } if($sub_menu!="") { echo " :: ".$sub_menu; } ?>
:: C.A Tracker</title>
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
    	<p style="color:#007DFB">
        	Welcome to C.A Tracker's interactive center. This center is divided into three broad group majorly the Events,Notes and Question 			Center. The aim of the interactive center as the name implies is a center where you get to interact with the systems major functionalities which includes the ability of a user to add events, such as special birthdays,school events,assignments and project deadlines e.t.c. Apart from adding events, you can also save events which are at a farther date and there is a likely hood for you to forget. <br /> Another important function that the app gives you is the ability for you to add notes such as very important school jotings or private researches which you plan to use in the future.<br /> And finally one of the most important features of this center is yet another center known as the Question center, this center is designed to help users ask delicate questions and get series of answers from many other users, through this act I-corporation hopes that great friends are made as well as helping you discover your capabilities in the academic relm.
            <p align="right" style="color:#007DFB">From I-corporation, bringing you success at its best.</p>
            <br />
            <div align="right">
            	<a href="home.php"> <input align="right" type="button" value="Back To Home"  /></a>
            </div>
        </p>
  <!-- InstanceEndEditable --></div>
   
</div>

<div id="footer">
	&copy; <?php echo date("Y"); ?> I-corporation LTD
</div>
</body>
<!-- InstanceEnd --></html>