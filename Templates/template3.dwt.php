<?php
	$main_menu="";
	$sub_menu="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>
<?php if($main_menu!="") { echo $main_menu; } if($sub_menu!="") { echo " :: ".$sub_menu; } ?>
:: C.A Tracker</title>
<!-- TemplateEndEditable -->
<script language="javascript" src="../scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" src="../functions.js"></script>
<link href="../mystyles6.css" rel="stylesheet" type="text/css" />
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
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
      <p><a href="../view_assignment.php" <?php if($main_menu=="Assignment") {echo 'class="active"';} ?>>Assignment</a></p>
      <p><a href="../view_test.php" <?php if($main_menu=="Test") {echo 'class="active"';} ?>>Test</a></p>
      
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
            	<h4><a href="../view_assignment.php">Assignment</a></h4>
                <p><a href="../view_assignment.php" <?php if($sub_menu=="View Assignment Scores") { echo 'class="active"';} ?>>View Assignment Scores</a></p>
                <!--<p><a href="#" <?php if($sub_menu=="Add A New Assignment Score") { echo 'class="active"';} ?>>Add A New Assignment Score</a></p>-->
            <?php
		}
	  ?>
      
      <?php
	  	if($main_menu=="Test")
		{
			?>
            	<h4><a href="../view_test.php">Test</a></h4>
                <p><a href="../view_test.php"  <?php if($sub_menu=="View Test Scores") { echo 'class="active"';} ?>>View Test Scores</a></p>
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
    <!-- TemplateBeginEditable name="mycontents" -->Put Content Here<!-- TemplateEndEditable --></div>
   
</div>

<div id="footer">
	&copy; <?php echo date("Y"); ?> I-corporation LTD
</div>
</body>
</html>