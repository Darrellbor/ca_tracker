<?php
	require_once("time_check.php");
	$Page_title="Compose Message";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template4.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $Page_title; ?> :: C.A.Tracker</title>
<!-- InstanceEndEditable -->
<script language="javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" src="functions.js"></script>
<script language="javascript" src="ajax.js"></script>
<link href="mystyle7.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body onload="process()">

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
    	 <?php
		  if($Page_title!="Compose Message")
		  {
			  $select_viability=mysql_query("select * from `messages` where recepient_reg_id='".$_SESSION['current_user_reg_no']."' and message_viability='new'");
			if($select_viability==FALSE)
			{
				$_SESSION['message']="Error encountered selecting message viability";
				$_SESSION['messagetype']="error";
				exit();
			}
			$total_selected_message_viability=mysql_num_rows($select_viability);
		  }
			
		 ?>
    
    
<div id="menu" align="left">
              <h4><a href="inbox.php">Message Hub</a></h4>
              <p><a href="inbox.php" <?php if($Page_title=="Inbox") {echo 'class="active"';} ?>>Inbox<?php if($Page_title!="Compose Message" && $total_selected_message_viability>0) { echo "(".$total_selected_message_viability.")"; } ?></a></p>
              <p><a href="outbox.php" <?php if($Page_title=="Outbox") {echo 'class="active"';} ?>>Outbox</a></p>
              <p><a href="compose_message.php" <?php if($Page_title=="Compose Message") {echo 'class="active"';} ?>>Compose Message</a></p>
         </div>
         
         <div id="main_contents">
            <h1>
                <?php echo $Page_title; ?>
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
            	<br />
            	<!-- InstanceBeginEditable name="mycontents" -->
                	<p align="left" style="font-size:14px; color:#007DFB;"><a href="home.php">Home</a>>Message Hub>Compose Message</p><br /> <br />
                    <form action="compose_message_process.php" method="post" id="myform">
                      	<hr />  <span style="color:#007DFB;">Enter Recepient: <input type="text" id="recepient" placeholder=" Email Address or Registration Id" style="width:350px" autocomplete="off" /></span> <div id="results"></div> <hr />
                    </form>
		   <!-- InstanceEndEditable --></div>
    
</div>

<div id="footer">
	&copy; <?php echo date("Y"); ?> I-corporation LTD
</div>

</body>
<!-- InstanceEnd --></html>