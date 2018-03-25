<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$main_menu="Notes";
	$sub_menu="My Notes";
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
    	<p align="right"> <a href="home.php"><input type="button" value="Back To Home" /></a></p>
        
        <?php
			$select_my_notes=mysql_query("select * from `notes` where registration_id='".$_SESSION['current_user_reg_no']."'");
			if($select_my_notes==FALSE)
			{
				?>
   					<p class="error">Error encountered selecting notes</p>
                <?php
			}
		?>
        
        <form action="my_notes.php" method="post" id="myform">
        	
            <?php
				$total_selected_notes=mysql_num_rows($select_my_notes);
				if($total_selected_notes<=0)
				{
					?>
                    	<p align="center" class="error">Sorry, you currently have no saved notes. <?php echo mysql_error(); ?></p>
                    <?php
					die();
				}
			?>
            
            <br />
            <br />
            
          <table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
            
            	<tr class="tableheading">
                	<td>Title</td>
                    <td>Note</td>
                </tr>
                
                <?php
					$bg_color="";
					$count="";
					while($row_selected_notes=mysql_fetch_assoc($select_my_notes))
					{
						$count++;
						$bg_color=($bg_color=="#efefef") ? "#cdcdcd" : "#efefef";
						?>
							<tr style="color:#007DFB" bgcolor="<?php echo $bg_color; ?>">
                            	<td><?php echo $row_selected_notes['title']; ?></td>
                              <td>
                                <div id="note<?php echo $count; ?>" style="height:50px; overflow:hidden; text-overflow:ellipsis;"><?php echo $row_selected_notes['note']; ?></div>
                                
                                <?php
									$p=$row_selected_notes['note'];
									
									if(strlen($p)>152)
									{
										?>
                                        	<span class="small" id="more<?php echo $count; ?>"><a onclick="more(<?php echo $count; ?>)" href="javascript:void(0)"><p align="right">More...</p></a></span>
                                <span class="less" id="less<?php echo $count; ?>" style="font-size:12px"><a href="Javascript:void(0)" onclick="less(<?php echo $count; ?>)"><p align="right">Less...</p></a></span>
                                        <?php
									}
								?>
                              </td>
                            </tr>
                        <?php
					}
				?>
            </table>
            <p>&nbsp;</p>
        </form>
       
         <script language="javascript">
		 $(document).ready(
		 	function()
			{
				$(".less").hide();
			}
		 );
		 
			function more(note_index)
			{	
				$("#note"+note_index).css({'height': 'auto','overflow': 'visible'});
				$("#more"+note_index).hide();
				$("#less"+note_index).fadeIn();

			}
			
			function less(note_index)
			{
				$("#note"+note_index).css({'height': '50px','overflow': 'hidden'});
				$("#less"+note_index).hide();
				$("#more"+note_index).fadeIn();
			}
		</script>
    <!-- InstanceEndEditable --></div>
   
</div>

<div id="footer">
	&copy; <?php echo date("Y"); ?> I-corporation LTD
</div>
</body>
<!-- InstanceEnd --></html>