<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$page_title="Congratulations";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templates.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $page_title; ?> :: C.A Tracker</title>
<!-- InstanceEndEditable -->
<script language="javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" src="functions.js"></script>
<link href="mystyles3.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="heading">
C.A Tracker
</div>

<div id="contents">
    
  <h1><?php echo $page_title; ?></h1>
  
   <?php
		if(isset($_SESSION['message']))
		{
			?>
            <p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
            <?php
			unset($_SESSION['message'], $_SESSION['messagetype']);
		}
	?>
	<!-- InstanceBeginEditable name="myobject" -->
    	<form action="finished_process.php" id="myform">
            <p>
                You have successfully completed the sign up process, the aim of C.A Tracker is majorly to <br />
                help you to keep track of your academic progress and help you to amend yourself in areas <br />
                of weakness. It also gives you the opportunity to make friends, ask questions which are <br />
                answered globally, it also keeps track of special events and keeps you informed on such days. <br />
                You can also improve on your reading skills by availing yourself to our various reading activities <br />
                and also by using our book relay interface which translates written words to voiced words. By <br /> using 
                this app you get to be trained by the interface as well as having series of resources at your disposal. <br />
                This is brought to you by I-corporation, bringing you success at its best.
            </p>
        </form>
        <div align="right">
        	<input type="button" value="Finish" onclick="finish_click()" />
    </div>
        
        <script language="javascript">
			function finish_click()
			{
				document.getElementById("myform").submit();
			}
		</script>
<!-- InstanceEndEditable --></div>

<div id="footer">
&copy; <?php echo date("Y"); ?> I-Corporation LTD
</div>
</body>
<!-- InstanceEnd --></html>