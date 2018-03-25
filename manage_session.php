<?php
	require_once("time_check.php");
	include_once("db_connect.php");
	$page_title="Manage Session";
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
	<p>   
    <?php
		$select_session=mysql_query("SELECT * FROM `session`");
		if($select_session==FALSE)
		{
			?>
            	<p class="error">Error encountered selecting session <?php echo mysql_error(); ?></p>
            <?php
			die();
		}
		
		$total_select_session=mysql_num_rows($select_session);
		if($total_select_session<=0)
		{
			?>
            	<p align="center" class="error">No session found! </p>
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
      
   	<p><br />
    <p id="session">
    <?php
		
		while($row_selected_session=mysql_fetch_assoc($select_session))
		{
			?>
            	 <strong>Current Session:</strong> <?php echo $row_selected_session['current_session']; ?></p>
            <?php
		}
	?>
    
    </p>
    
    
    <p>
   	<form action="session_process.php" method="post" id="myform">
       	<table id="data_tables">
           	<tr>
               	<td><strong>Enter New Session: </strong></td>
                <td><input name="enter" type="text" id="enter" autocomplete="off" class="width_200" /></td>
       	    </tr>
            <tr>
            	<td>eg 2010/2011 session</td>
            </tr>
            <tr align="right">
            	<td align="right" colspan="2"><input name="enter" type="button" id="enter" value="Enter" onclick="enter_click()" />
                <input name="back" type="button" id="back" onclick="back_click()" value="Back" /></td>
            </tr>
        </table>
        
        <p>
          <script language="javascript">
			function back_click()
			{
				document.getElementById("myform").action="home.php";
				document.getElementById("myform").submit();
			}
			
			function enter_click()
			{
				if(document.getElementById("enter").value=="")
				{
					alert("Please make sure the field is not empty!");
					document.getElementById("enter").focus();
					return null;
				}
				
				document.getElementById("myform").submit();
			}
		  </script>
      </p>
    </form>
    </p>
	<!-- InstanceEndEditable --></div>
    <div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
    </div>
</body>
<!-- InstanceEnd --></html>