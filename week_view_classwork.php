<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	require_once("functions.php");
	$main_menu="Classwork";
	$sub_menu="View Classwork Scores";
	
	$reg_id=isset($_GET['reg_id']) ? trim($_GET['reg_id']) : "";
	$week=isset($_GET['week']) ? trim($_GET['week']) : "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template3.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>
<?php if($main_menu!="") { echo $main_menu; } if($sub_menu!="") { echo " :: ".$sub_menu; } ?>
:: C.A Tracker</title>
<!-- InstanceEndEditable -->
<script language="javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" src="functions.js"></script>
<link href="mystyles6.css" rel="stylesheet" type="text/css" />
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
    
   	    <h4><a href="view_classwork.php">Manage C.A</a></h4>
        <p><a href="view_classwork.php" <?php if($main_menu=="Classwork") {echo 'class="active"';} ?>>Classwork</a></p>
      <p><a href="view_assignment.php" <?php if($main_menu=="Assignment") {echo 'class="active"';} ?>>Assignment</a></p>
      <p><a href="view_test.php" <?php if($main_menu=="Test") {echo 'class="active"';} ?>>Test</a></p>
      
      <?php
	  	if($main_menu=="Classwork")
		{
			?>
            	<h4><a href="view_classwork.php">Classwork</a></h4>
                <p><a href="view_classwork.php" <?php if($sub_menu=="View Classwork Scores") { echo 'class="active"';} ?>>View Classwork Scores</a></p>
                <!--<p><a href="#" <?php if($sub_menu=="Add A New Classwork Score") { echo 'class="active"';} ?>>Add A New Classwork Score</a></p>-->
            <?php
		}
	  ?>
      
      <?php
	  	if($main_menu=="Assignment")
		{
			?>
            	<h4><a href="view_assignment.php">Assignment</a></h4>
                <p><a href="view_assignment.php" <?php if($sub_menu=="View Assignment Scores") { echo 'class="active"';} ?>>View Assignment Scores</a></p>
                <!--<p><a href="#" <?php if($sub_menu=="Add A New Assignment Score") { echo 'class="active"';} ?>>Add A New Assignment Score</a></p>-->
            <?php
		}
	  ?>
      
      <?php
	  	if($main_menu=="Test")
		{
			?>
            	<h4><a href="view_test.php">Test</a></h4>
                <p><a href="view_test.php"  <?php if($sub_menu=="View Test Scores") { echo 'class="active"';} ?>>View Test Scores</a></p>
                <!--<p><a href="#"  <?php if($sub_menu=="Add A New Test Score") { echo 'class="active"';} ?>>Add A New Test Score</a></p>-->
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
    	 <p align="left" style="font-size:14px; color:#007DFB;"><a href="home.php">Home</a>>Manage C.A>Classwork</p><br /> <br />
		 <?php
		 	$select_classwork=mysql_query("select * from `classwork` where registration_id='$reg_id' and week='$week'");
			if($select_classwork==FALSE)
			{
				?>
  				 	<p class="error">Error encountered selecting classwork scores!</p>
                <?php
			}
			
			$select_subjects=mysql_query("select * from `subjects` where registration_id='".$_SESSION['current_user_reg_no']."'");
			if($select_subjects==FALSE)
			{
				?>
                	<p class="error">Error encountered selecting classwork scores! <?php echo mysql_error(); ?></p>
                <?php
				exit();
			}
			
			$total_select_subjects=mysql_num_rows($select_subjects);
			if($total_select_subjects<=0)
			{
				?>
                	<p class="error">No subject record found!</p>
                <?php
				exit();
			}
			
			mysql_data_seek($select_subjects,0);
			$row_selected_subject=mysql_fetch_assoc($select_subjects);
			
			$no_of_subjects=$row_selected_subject['no_of_subjects_offered'];
			$list_of_subjects=$row_selected_subject['list_of_subjects_offered'];
		 ?>
<div style="height:60px; background-color:#F1C7CA; text-align:center; font-weight:bolder; color:#F00; border-left:solid 6px #F00; padding-top:30px; border-radius:6px  ">
         	Note:once a score is entered it cannot be altered or retracted
         </div>
         
         <form action="save_score.php" method="post" id="myform">
         	<p>
         	  <?php
				$total_selected_classwork=mysql_num_rows($select_classwork);
				if($total_selected_classwork<=0)
				{
					 echo create_classwork($week,$list_of_subjects,$reg_id);
				}
				
				else 
				{
					?>
                    	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table" style="color:#007DFB">
                        	<tr class="tableheading">
                            	<td>Subject</td>
                                <td>Score</td>
                            </tr>
                            
                            <?php
								$bg_color="";
								$sub_count=0;
								while($row_selected_classwork=mysql_fetch_assoc($select_classwork))
								{
									$sub_count++;
									$bg_color=($bg_color=="#efefef") ? "#cdcdcd" : "#efefef";
									?>
                                    	<tr bgcolor="<?php echo $bg_color; ?>">
                                       	  <td>
												<?php echo $row_selected_classwork['subject']; ?>
                                              <input name="subject<?php echo $sub_count; ?>" type="hidden" id="subject<?php echo $sub_count; ?>" value="<?php echo $row_selected_classwork['subject']; ?>" />
                                              
                                            </td>
                                            <td>
                                            	<?php
													if($row_selected_classwork['score']<=0)
													{
														for($count_score=0;$count_score<1;$count_score++)
														{
															?>
                                                            	<input type="hidden" value="<?php echo $row_selected_classwork['classwork_id']; ?>" id="score_id<?php echo $sub_count; ?>" name="score_id<?php echo $sub_count; ?>" />
                                                            
														<input name="score<?php echo $sub_count; ?>" type='text' id="score<?php echo $sub_count; ?>" placeholder='0.0' style='width:50px;' autocomplete='off' value="<?php echo $row_selected_classwork['score']; ?>" />
														<?php
														}
													}
													
													else
													{
														echo $row_selected_classwork['score'];
													}
												?>
                                            </td>
                                        </tr>
                                    <?php
								}
							?>
                            <tr> 
                            	<td align="center" colspan="2"><input type="button" value="Save Score" onclick="save_score_click('<?php echo $sub_count; ?>')"  /></td>
                            </tr>
                        </table>
                        <input name="total_subject" type="hidden" id="total_subject" value="<?php echo $sub_count; ?>" />
                    <?php
				}
			?>
       	  </p>
          <script language="javascript">
		  function save_score_click(sub_count)
		  {
				if(document.getElementById("score"+sub_count).value=="")
				{
					alert("Please make sure that a score is entered before saving!");
					document.getElementById("score"+sub_count).focus();
					return null;
				}
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