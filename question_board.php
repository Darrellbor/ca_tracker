<?php
	require_once("db_connect.php");
	require_once("time_check.php");
	$main_menu="Question Center";
	$sub_menu="Question Board";
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
			$select_questions=mysql_query("select * from `questions` order by question_id desc");
			if($select_questions==FALSE)
			{
				$_SESSION['message']="Error encountered selecting questions";
				$_SESSION['messagetype']="error";
				exit();
			}
		?>
        
        <br />
        <form method="post" id="myform">
        
        <?php
			
			$total_selected_questions=mysql_num_rows($select_questions);
			if($total_selected_questions<=0)
			{
				?>
                	<p class="error">Sorry, there are currently no questions on the question board!<?php echo mysql_error();?></p>
                <?php
				die();
			}
		?>
        <h3 align="center" style="color:#007DFB">Welcome to the question board. Here you can view the multitude of questions asked by users from all over the world. You can either give answers to unanswered questions or you could just scan through to gain knowledge based on the questions asked, you also have the liberty to ask questions and get responses to them.</h3>
        <br />
       	  <table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
            	<tr class="tableheading">
                	<td>Title</td>
                    <td>Question</td>
                    <td>Answers</td>
                    <td>Date Of Question</td>
                </tr>
               
                
                <?php
					$bg_color="";
					$count="";
					$counts="";
					while($row_selected_questions=mysql_fetch_assoc($select_questions))
					{
						$count++;
						$counts++;
						$bg_color=($bg_color=="#efefef") ? "#cdcdcd" : "#efefef";
						?>
                            <tr style="color:#007DFB" bgcolor="<?php echo $bg_color; ?>">
                            <td><?php echo $row_selected_questions['title']; ?></td>
                            
                            <td>
                              <div id="question<?php echo $count; ?>"  style="height:50px; overflow:hidden;"><?php echo $row_selected_questions['question']; ?></div>
                                <strong style="float:left"><h5>Asked By: <?php echo $row_selected_questions['asked_by']; ?></h5></strong>
<?php
									$p=$row_selected_questions['question'];
									if(strlen($p)>60)
									{
										?>
                           	  <span class="small" id="more<?php echo $count; ?>"><a onclick="more(<?php echo $count; ?>)" href="javascript:void(0)"><p align="right">More...</p></a></span>
                                <span class="less" id="less<?php echo $count; ?>" style="font-size:12px"><a href="Javascript:void(0)" onclick="less(<?php echo $count; ?>)"><p align="right">Less...</p></a></span>
                                        <?php
									}
								?>
                            </td>
                            
                            <td>
                                <div id="answers<?php echo $counts; ?>"  style="height:50px; overflow:hidden;"><?php echo $row_selected_questions['answers']; ?></div>
                                <script language="javascript">
									function answer_question_click(question_id)
									{
										document.getElementById("myform").action="answer_question.php?question_id="+question_id;
										document.getElementById("myform").submit();
									}
								</script>
                                
                                <?php
									$answer=$row_selected_questions['answers'];
									if($answer=="none")
									{
										?>
                                        	<span class="small" id="no_answer" style="float:left" onclick="answer_question_click('<?php echo $row_selected_questions['question_id']; ?>')"><a href="Javascript:void(0)"><p align="left">Answer Question</p></a></span>
                                        <?php
									}
									
									else
									{
										?>
                                        	<strong style="float:left"><h5>Answered By: <?php echo $row_selected_questions['answered_by']; ?></h5></strong>
<?php
									}
								?>
                                
                                <?php
									$q=$row_selected_questions['answers'];
									if(strlen($q)>100)
									{
										?>
                                        	<span class="small" id="more_text<?php echo $counts; ?>"><a onclick="more_text(<?php echo $counts; ?>)" href="javascript:void(0)"><p align="right">More...</p></a></span>
                                <span class="lesser" id="less_text<?php echo $counts; ?>" style="font-size:12px"><a href="Javascript:void(0)" onclick="less_text(<?php echo $counts; ?>)"><p align="right">Less...</p></a></span>
                                        <?php
									}
								?>
                            </td>
                            
                            <td><?php echo $row_selected_questions['date_of_question']; ?></td>
                        </tr>
                        <?php
					}
					
				?>
                
                <script language="javascript">
					$(document).ready(
					function()
					{
						$(".less").hide();
					}
				 );
				 
					function more(note_index)
					{	
						$("#question"+note_index).css({'height': 'auto','overflow': 'visible'});
						$("#more"+note_index).hide();
						$("#less"+note_index).fadeIn();
		
					}
					
					function less(note_index)
					{
						$("#question"+note_index).css({'height': '50px','overflow': 'hidden'});
						$("#less"+note_index).hide();
						$("#more"+note_index).fadeIn();
					}
					
					
					$(document).ready(
					function()
					{
						$(".lesser").hide();
					}
				 );
				 
					function more_text(note_index)
					{	
						$("#answers"+note_index).css({'height': 'auto','overflow': 'visible'});
						$("#more_text"+note_index).hide();
						$("#less_text"+note_index).fadeIn();
		
					}
					
					function less_text(note_index)
					{
						$("#answers"+note_index).css({'height': '50px','overflow': 'hidden'});
						$("#less_text"+note_index).hide();
						$("#more_text"+note_index).fadeIn();
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