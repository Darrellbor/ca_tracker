<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$main_menu="Events";
	$sub_menu="Saved Events";
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
   	<p align="right"> <a href="home.php"><input type="button" align="right" value="Back To Home" /></a></p>
        
        <?php
			$select_saved_events=mysql_query("select * from `saved_events` where registration_id='".$_SESSION['current_user_reg_no']."'");
			if($select_saved_events==FALSE)
			{
				?>
   	<p class="error">Error encountered selecting saved events</p>
                <?php
			}
		?>
        
        <form method="post" id="myform">
        	<?php
				$total_selected_saved_event=mysql_num_rows($select_saved_events);
				if($total_selected_saved_event<=0)
				{
					?>
                    	<p class="error">Sorry you have no saved events. <?php echo mysql_error(); ?></p>
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
                <td>Supposed Date Of Event</td>
            </tr>
            
            <script language="javascript">
				function add_event_click(reg_id,event_code)
				{
					var r=confirm("Adding event to your list of upcoming events. Click ok to continue.");
					if(r)
					{
						document.getElementById("myform").action="add_saved_event.php?reg_id="+reg_id+"&event_code="+event_code;
						document.getElementById("myform").submit();
					}
				}
			</script>
            
            <?php
				$bg_color="";
				while($row_selected_saved_events=mysql_fetch_assoc($select_saved_events))
				{
					$bg_color=($bg_color=="#efefef") ? "#cdcdcd"  : "#efefef";
					?>
                    	<tr style="color:#007DFB" bgcolor="<?php echo $bg_color; ?>">
                        	<td><?php echo $row_selected_saved_events['title']; ?> <br />
                            	<span class="small"><a href="Javascript:void(0)" onclick="add_event_click('<?php echo $_SESSION['current_user_reg_no']; ?>','<?php echo $row_selected_saved_events['event_code']; ?>')">Add Event</a></span>
                            </td>
                            <td><?php echo $row_selected_saved_events['description']; ?></td>
                            <td><?php echo $row_selected_saved_events['supposed_date_of_event']; ?></td>
                        	
                        </tr>
                    <?php
				}
			?>
            </table>
        </form>
	<!-- InstanceEndEditable --></div>
   
</div>

<div id="footer">
	&copy; <?php echo date("Y"); ?> I-corporation LTD
</div>
</body>
<!-- InstanceEnd --></html>