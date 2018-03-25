<?php
	require_once("db_connect.php");
	session_start();
	$page_title="You're almost done";
	
	$target=isset($_SESSION['target']) ?trim($_SESSION['target']) : "";
	$subject=isset($_SESSION['subject']) ?trim($_SESSION['subject']) : "";
	
	if(!isset($_SESSION['current_user_class']))
	{
		header("location: index.php");
		exit;
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templates.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $page_title; ?>:: C.A Tracker</title>
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
     <?php
		if(isset($_SESSION['message']))
		{
			?>
   	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
            <?php
			unset($_SESSION['message'], $_SESSION['messagetype']);
		}
	?>
    	<form action="almost_done_process.php" method="post" id="myform">
        	<h2>Set a target for your self</h2><br />
            <strong id="strong">Target:</strong> <input name="target" type="text" id="target" autocomplete="off" value="<?php echo $target; ?>" />   <span id="eg">eg 80%</span>
            <br />
            <br />
            <br />
            <h2 align="center">You inputed <?php echo $_SESSION['current_user_no_of_sub']; ?> subjects</h2>
            <h2 align="center">Select the subjects</h2>
            <input type="hidden" value="<?php echo $_SESSION['current_user_no_of_sub'] ?>" id="subject_no" />
            <input name="list_of_subjects_offered" type="hidden" id="list_of_subjects_offered" value="list_of_subjects_offereed" />
            <table align="center" cellspacing="20px" cellpadding="15px" style="border:solid 2px #2828ff;" id="data_table">
            	<?php
					if($_SESSION['current_user_class']=="Sss1" || $_SESSION['current_user_class']=="Sss2" || $_SESSION['current_user_class']=="Sss3")
					{
						$class_level="SS";
					}
					else
					{
						$class_level="JS";
					}
					if($_SESSION['current_user_class']=="Sss1" || $_SESSION['current_user_class']=="Sss2" || $_SESSION['current_user_class']=="Sss3")
					{
						?>
                        	<tr>
                	<td><input name="subject1" type="checkbox" id="subject1" value="accounting " /> Accounting</td>
                    <td><input name="subject2" type="checkbox" id="subject2" value="agricultural science" /> Agricultural Science</td>
              </tr>
                <tr>
                	<td><input name="subject3" type="checkbox" id="subject3" value="biology" /> Biology</td>
                    <td><input name="subject4" type="checkbox" id="subject4" value="chemistry" /> Chemistry</td>
                </tr>
                <tr>0
                	<td><input name="subject5" type="checkbox" id="subject5" value="christian religious knowledge" /> Christian Religious Knowledge</td>
                    <td><input name="subject6" type="checkbox" id="subject6" value="commerce" /> Commerce</td>
                </tr>
                <tr>
                	<td><input name="subject7" type="checkbox" id="subject7" value="economics" /> Economics</td>
                    <td><input name="subject8" type="checkbox" id="subject8" value="english language" /> English Language</td>
                </tr>
                <tr>
                	<td><input name="subject9" type="checkbox" id="subject9" value="food and nutrition" /> Food&Nutrition</td>
                    <td><input name="subject10" type="checkbox" id="subject10" value="french" /> French</td>
                </tr>
                <tr>
                	<td><input name="subject11" type="checkbox" id="subject11" value="further mathematics" /> Further Mathematics</td>
                    <td><input name="subject12" type="checkbox" id="subject12" value="geography" /> Geography</td>
                </tr>
                <tr>
                	<td><input name="subject13" type="checkbox" id="subject13" value="government" /> Government</td>
                    <td><input name="subject14" type="checkbox" id="subject14" value="hausa" /> Hausa</td>
                </tr>
                <tr>
                	<td><input name="subject15" type="checkbox" id="subject15" value="history" /> History</td>
                    <td><input name="subject16" type="checkbox" id="subject16" value="islamic religious studies" /> Islamic Religious Studies</td>
                </tr>
                <tr>
                	<td><input name="subject17" type="checkbox" id="subject17" value="literature in english" /> Literature In English</td>
                    <td><input name="subject18" type="checkbox" id="subject18" value="mathematics" /> Mathematics</td>
                </tr>
                <tr>
                	<td><input name="subject19" type="checkbox" id="subject19" value="physical and health education" /> Physical&health Education</td>
                    <td><input name="subject20" type="checkbox" id="subject20" value="physics" /> Physics</td>
                </tr>
                <tr>
                	<td><input name="subject21" type="checkbox" id="subject21" value="technical drawing" /> Technical Drawing</td>
                    <td><input name="subject22" type="checkbox" id="subject22" value="visual art" /> Visual Art</td>
                </tr>
                        <?php
					}
				?>
               	
                <?php
					if($_SESSION['current_user_class']=="Jss1" || $_SESSION['current_user_class']=="Jss2" || $_SESSION['current_user_class']=="Jss3")
					{
						?>
                        	 <tr>
                	<td><input name="subject23" type="checkbox" id="subject23" value="agricultural science" /> Agricultural Science</td>
                    <td><input name="subject24" type="checkbox" id="subject24" value="business studies" /> Business Studies</td>
                </tr>
                <tr>
                	<td><input name="subject25" type="checkbox" id="subject25" value="mathematics" /> Mathematics</td>
                    <td><input name="subject26" type="checkbox" id="subject26" value="english language" /> English Language</td>
                </tr>
                <tr>
                	<td><input name="subject27" type="checkbox" id="subject27" value="civic education" /> Civic Education</td>
                    <td><input name="subject28" type="checkbox" id="subject28" value="information and communication technology" /> Information&Communication Technology</td>
                </tr>
                <tr>
                	<td><input name="subject29" type="checkbox" id="subject29" value="christian religious knowledge" /> Christian Religious Knowledge</td>
                    <td><input name="subject30" type="checkbox" id="subject30" value="basic science" /> Basic Science</td>
                </tr>
                <tr>
                	<td><input name="subject31" type="checkbox" id="subject31" value="basic technology" /> Basic Technology</td>
                    <td><input name="subject32" type="checkbox" id="subject32" value="cultural and creative art" /> cultural&Creative Art</td>
                </tr>
                <tr>
                	<td><input name="subject33" type="checkbox" id="subject33" value="islamic religious studies" /> Islamic Religious Studies</td>
                    <td><input name="subject34" type="checkbox" id="subject34" value="hausa" /> Hausa</td>
                </tr>
                <tr>
                	<td><input name="subject35" type="checkbox" id="subject35" value="french" /> French</td>
                    <td><input name="subject36" type="checkbox" id="subject36" value="physical and health education" /> Physical&health Education</td>
                </tr>
                <tr>
                	<td><input name="subject37" type="checkbox" id="subject37" value="social studies" /> Social Studies</td>
                    <td><input name="subject38" type="checkbox" id="subject38" value="home economics" /> Home Economics</td>
                </tr>
                        <?php
					}
				?>
                
              <script language="javascript">
					function val_almost_done_click()
					{
						if(document.getElementById("target").value=="" || document.getElementById("target").value<1 || document.getElementById("target").value>100 )
						{
							$("#target").css(
								{
									'border' : 'solid red 2px',
									'background-image' : 'url(images/error.jpg)',
									'background-repeat' : 'no-repeat',
									'background-position' : 'right'
								}
							);
							alert("Please make sure that your target is between 1 to 100");
							document.getElementById("target").focus();
							return null;
						}
						else
						{
							$("#target").css(
								{
									'border' : 'solid green 2px',
									'background-image' : 'url(images/correct%20.jpg)',
									'background-repeat' : 'no-repeat',
									'background-position' : 'right'
								}
							);
						}
					
						var subject_no=document.getElementById("subject_no").value*1;
						var count_selected_subjects=0;
						var list_of_subjects_offered="";
						
						<?php
							if($class_level=="SS")
							{
								?>
									var start_count=1;
									var stop_count=22;
								<?php
							}
							else
							{
								?>
									var start_count=23;
									var stop_count=38;
								<?php
							}
						?>
						
						
						for(var count=start_count; count<=stop_count; count++)
						{
							//alert("subject"+count+" checked = "+document.getElementById("subject"+count).checked);
							if(document.getElementById("subject"+count).checked==true)
							{
								count_selected_subjects++;
								list_of_subjects_offered=list_of_subjects_offered+document.getElementById("subject"+count).value+",";
								//alert(document.getElementById("subject"+count).value);
							}
						}
						
						if(count_selected_subjects!=subject_no)
						{
							alert("The number of subjects you selectd is below/above the required number of subjects you inputed earlier!");
							return null;
						}
						
						var len=list_of_subjects_offered.length;
						list_of_subjects_offered=list_of_subjects_offered.substr(0,len-1);
						
						document.getElementById("list_of_subjects_offered").value=list_of_subjects_offered;
						//alert(document.getElementById("list_of_subjects_offered").value);
						document.getElementById("myform").submit();
				}
				</script>
          </table>
            <br />
            <br />
            <div align="right"><input  type="button" value="Next" onclick="val_almost_done_click()" /></div>
        </form>
<!-- InstanceEndEditable --></div>

<div id="footer">
&copy; <?php echo date("Y"); ?> I-Corporation LTD
</div>
</body>
<!-- InstanceEnd --></html>