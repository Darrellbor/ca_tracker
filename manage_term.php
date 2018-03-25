<?php
	require_once("time_check.php");
	include_once("db_connect.php");
	$page_title="Manage Term";
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
  		<script language="javascript">
			$(document).ready(
				function()
					{
						shade_input_table("data_table")
					}
			);
		</script>
    
    	<?php
			$select_term=mysql_query("select * from `term`");
			if($select_term==FALSE)
			{
				?>
   	<p class="error">Error encountered selecting term <?php echo mysql_error(); ?></p>
            	<?php
				die();
			}
			
			$total_selected_term=mysql_num_rows($select_term);
			if($total_selected_term<=0)
			{
				?>
                	<p class="error">No term record found!</p>
                <?php
			}
		?>
        
         <?php
    if(isset($_SESSION['message']))
	{
		?>
   	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
        <p>
              <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
 ?>
              
    </p>
    </p>
        <p>&nbsp; </p>
        <p>
        	<?php
				while($row_selected_term=mysql_fetch_assoc($select_term))
				{
					?>
                    	<p style="color:#007DFB"><strong style="color:#007DFB">Current Term:</strong> <?php echo $row_selected_term['current_term']; ?></p>
                    <?php
				}
			?>
            
            <br />
    <h2 align="center" style="color:#007DFB">Select A New Term</h2>
            
            <form action="term_process.php" method="post" id="myform">
            <input name="term_value" type="hidden" id="term_value" value="term_value" />
            	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
                	<tr>
                    	<td><input name="term" type="radio" value="First Term" id="term" /></td>
                        <td style="color:#007DFB">First Term</td>
                  </tr>
                    
                    <tr>
                    	<td><input name="term" type="radio" value="Second Term" id="term" /></td>
                        <td style="color:#007DFB">Second Term</td>
                    </tr>
                    
                      <td><input name="term" type="radio" value="Third Term" id="term" /></td>
                      <td style="color:#007DFB">Third Term</td>
                      
                  <script language="javascript">
					  	function back_click()
							{
								document.getElementById("myform").action="home.php";
								document.getElementById("myform").submit();
							}
							
							function enter_click()
							{
								if($("input[type=radio]:checked").length<1)
								{
									alert("One term must be selected before submitting!");
								}
								
								else
								{
									var term=document.getElementsByName("term");
									var term_value="";
									for(i=0; i<term.length; i++)
									{
										if(term[i].checked)
										{
											term_value=term[i].value;
										}
									}
								}
								document.getElementById("term_value").value=term_value;
								//alert("Term value is " +term_value);
								document.getElementById("myform").submit();
							}
					  </script>
                </table>
                
                <div align="right">
                	  
                      	<input type="button" value="Enter" onclick="enter_click()" />
                        <input type="button" value="Back" onclick="back_click()" />
                      
                </div>
            </form>
    </p>
	<!-- InstanceEndEditable --></div>
    <div id="footer">
    	&copy; <?php echo date("Y"); ?> I-corporation LTD
    </div>
</body>
<!-- InstanceEnd --></html>