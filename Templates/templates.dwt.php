<?php
	$page_title="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title><?php echo $page_title; ?> :: C.A Tracker</title>
<!-- TemplateEndEditable -->
<script language="javascript" src="../scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" src="../functions.js"></script>
<link href="../mystyles3.css" rel="stylesheet" type="text/css" />
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
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
	<!-- TemplateBeginEditable name="myobject" -->Put Contents Here<!-- TemplateEndEditable --></div>

<div id="footer">
&copy; <?php echo date("Y"); ?> I-Corporation LTD
</div>
</body>
</html>