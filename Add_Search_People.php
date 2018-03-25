<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$main_menu="C.A Buddies";
	$sub_menu="Add/Search People";
	
	$search=isset($_SESSION['search']) ? trim($_SESSION['search']) : "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template2.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>
<?php if($main_menu!="") { echo $main_menu; } if($sub_menu!="") { echo " :: ".$sub_menu; } ?>
:: C.A Tracker</title>
<!-- InstanceEndEditable -->
<script language="javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" src="functions.js"></script>
<link href="mystyles5.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
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
                	<td width="255" height="43" class="nav_in"><a href="my_friends.php" <?php if($sub_menu=="My Friends") { echo 'class="active"';} ?>>My Friends</a></td>
                    <td width="333" class="nav_in"><a href="Add_Search_People.php" <?php if($sub_menu=="Add/Search People") { echo 'class="active"';} ?>>Add/Search People</a></td>
                </tr>
            </table>
        </div><br /><br />
        <!-- InstanceBeginEditable name="Mycontents" -->
        	<p align="center"><a href="home.php">Back To Home</a></p>
            <form action="search_results.php" method="post" id="myform">
            <p align="center"> <input name="search" type="text" id="search" placeholder=" Search for people by their names or by their emails" autocomplete="off" value="<?php echo $search; ?>" class="width_200" /></p><p align="center"><input type="button" value="Search" onclick="search_click()" /></p></form>
        <p align="center">&nbsp;</p>
        
        <script language="javascript">
			
				$(document).ready(
					function()
					{
						document.getElementById("search").focus();
					}
				);
               function search_click()
			   {
				   if(document.getElementById("search").value=="")
				   {
					   alert("Your search cannot be empty");
					   document.getElementById("search").focus();
					   return null;
				   }
				   document.getElementById("myform").submit();
			   }
            </script>
    
  <!-- InstanceEndEditable --></div>

<div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
</div>
</body>
<!-- InstanceEnd --></html>
