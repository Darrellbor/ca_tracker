<?php
	require_once("db_connect.php");
	require_once("time_check.php");
	$page_title="Answer Question";
	
	$question_id=isset($_GET['question_id']) ? trim($_GET['question_id']) : "";
	$_SESSION['question_id']="$question_id";
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
	<p align="right"><a href="home.php"><input type="button" value="Back To Home" /></a></p>
    	<?php
			$select_questions=mysql_query("select * from `questions` where (question_id='$question_id')");
			if($select_questions==FALSE)
			{
				?>
                	<p class="error">Error encountered selecting questions!</p>
                <?php
			}
			
			$total_selected_questions=mysql_num_rows($select_questions);
			if($total_selected_questions<=0)
			{
				?>
                	<p class="error">No question found!<?php echo mysql_error(); ?></p>
                <?php
				die();
			}
			
			mysql_data_seek($select_questions,0);
			$row_selected_questions=mysql_fetch_assoc($select_questions);
			
			$title=$row_selected_questions['title'];
			$question=$row_selected_questions['question'];
			$answers=$row_selected_questions['answers'];
		?>
        
    <script language="javascript">
	$(document).ready(
		function()
		{
			shade_input_table("data_table");
		}
	);
	</script>
    
    <form action="answer_question_process.php" method="post" id="myform">
   	  <table align="center" cellpadding="10px" cellspacing="1px" id="data_table" style="color:#007DFB">
        	<tr>
            	<td>Title:</td>
                <td><input type="text" value="<?php echo $title; ?>" readonly="readonly" /></td>
            </tr>
            
            <tr>
            	<td>Question:</td>
                <td><textarea rows="5px" readonly="readonly"><?php echo $question; ?></textarea></td>
            </tr>
            
            <tr>
            	<td>Answer:</td>
                <td><textarea rows="5px" name="answer" id="answer"><?php echo $answers; ?></textarea></td>
            </tr>
            
            <tr>
            	<td align="center" colspan="2"><input type="button" value="Submit Answer" onclick="submit_answer_click()" /></td>
            </tr>
            
            <script language="javascript">
				function submit_answer_click()
				{
					if(document.getElementById("answer").value=="")
					{
						alert("Please make sure that an answer is provided before submitting!");
						document.getElementById("answer").focus();
						return null;
					}
					
					document.getElementById("myform").submit();
				}
			</script>
        </table>
    	<p>&nbsp;</p>
    </form>
	<!-- InstanceEndEditable --></div>
    <div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
    </div>
</body>
<!-- InstanceEnd --></html>