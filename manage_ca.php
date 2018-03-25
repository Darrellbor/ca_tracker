<?php
	require_once("time_check.php");
	$page_title="Manage C.A";
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
    <br />
	<div style="text-align:left; width:200px; float:left"><a href="home.php">&larr; Back to home</a></div> <div style="text-align:right; width:200px; float:right"><a href="manage_ca_setup.php">Proceed &rarr;</a></div>
    
    <br />
    <br />
    <p style="color:#007DFB">
    	Welcome to C.A Tracker's manage C.A section. This aspect of C.A Tracker was designed to help you with your assesment tracking and it is the most important aspect of the C.A Tracker app.<br />This aspect is divided into four sections namely classwork,assignment,test and the compiled console, each of this section was designed to perform a specific and very important task. The classwork area allows you to add your claawork scores on each of the subjects you offer every week, so does the assignment and test section. Although the compiled console may seem different it performs almost the same task, it combines your classwork, assignment and test and gives you a detailed presentation of your terms achievement, this section is only visible on completion of the term. 
    </p> <p style="color:#007DFB; text-align:right;">From I-corporation, bringing you success at it's best.</p><br />
  <!-- InstanceEndEditable --></div>
    <div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
    </div>
</body>
<!-- InstanceEnd --></html>