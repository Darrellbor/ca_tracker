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
<link href="../mystyles5.css" rel="stylesheet" type="text/css" />
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
<div id="heading">
	C.A Tracker
</div>

<div id="content">
	<?php 
		if(isset($_SESSION['current_user_full_name'],$_SESSION['current_session'],$_SESSION['current_term']))
		{
			?>
  <p id="information_display" align="right" style="font-size:12px"><b>Signed In:</b><?php echo $_SESSION['current_user_full_name'] ?> (<a href="file:///C|/xampp/htdocs/sign_out.php">Sign Out</a>)<br />
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
    	<div id="nav">
        	<table>
            	<tr>
                	<td width="255" height="43" class="nav_in"><a href="../my_friends.php" <?php if($sub_menu=="My Friends") { echo 'class="active"';} ?>>My Friends</a></td>
                    <td width="333" class="nav_in"><a href="../Add_Search_People.php" <?php if($sub_menu=="Add/Search People") { echo 'class="active"';} ?>>Add/Search People</a></td>
                </tr>
            </table>
        </div><br /><br />
        <!-- TemplateBeginEditable name="Mycontents" -->Put Content Here<!-- TemplateEndEditable --></div>

<div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
</div>
</body>
</html>
