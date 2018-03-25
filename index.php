<?php
	session_start();
	$page_title="Welcome to C.A Tracker :: sign up :: sign in :: learn more"; 
	
	$full_name=isset($_SESSION['full_name']) ?trim($_SESSION['full_name']) : "";
	$email=isset($_SESSION['email']) ?trim($_SESSION['email']) : "";
	$password=isset($_SESSION['password']) ?trim($_SESSION['password']) : "";
	$sex=isset($_SESSION['sex']) ?trim($_SESSION['sex']) : "";
	$date_of_birth=isset($_SESSION['date_of_birth']) ?trim($_SESSION['date_of_birth']) : "";
	$school_name=isset($_SESSION['school_name']) ?trim($_SESSION['school_name']) : "";
	$class=isset($_SESSION['class']) ?trim($_SESSION['class']) : "";
	$no_of_subjects_offered=isset($_SESSION['no_of_subjects_offered']) ?trim($_SESSION['no_of_subjects_offered']) : "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_title; ?></title>
<script language="javascript" src="jquery-1.4.2.min.js"></script>
<script language="javascript" src="functions.js"></script>
<link href="mystyles2.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	var img=new Array();
	var total_img=5;
	var count, current_pix;
	
	for(count=1; count<=total_img; count++)
	{
		img[count]=new Image();
		img[count].src="images/ca" + count + ".jpg";
	}
	current_pix=Math.round(Math.random() * total_img);
	$(document).ready(
		function()
		{
			$("#pix_animation img").attr('src', img[current_pix].src);
			setInterval("change_pix()",8000);
		}
	);
	
	function change_pix()
	{
		current_pix++;
		if(current_pix>total_img)
		{
			current_pix=1;
		}
		
		$("#pix_animation").fadeOut(5000,
			function()
			{
				$("#pix_animation img").attr("src", img[current_pix].src);
			$("#pix_animation").fadeIn(1000);
			}
		);
	}
</script>
</head>

<body>
<div id="heading">
 C.A Tracker 
</div>

<div id="contents">
  <h1>Sign Up</h1>
  <h2>It's free and easy to use</h2><br />
   <?php
		if(isset($_SESSION['message']))
		{
			?>
   	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
            <?php
			unset($_SESSION['message'], $_SESSION['messagetype']);
		}
	?>
    
  <form action="sign_up.php" method="post" id="myform">
  		<div style="float:left">
  		<table align="left" cellpadding="0px" cellspacing="15px">
        	<tr>
            	<td width="284"><input name="full_name" type="text" id="full_name" placeholder=" Full Name" autocomplete="off" value="<?php echo $full_name; ?>" /></td>
            </tr>
        	<tr>
            	<td><input name="email" type="text" id="email" autocomplete="off" placeholder=" Email Address" value="<?php echo $email; ?>" /></td>
            </tr>
            <tr>
            	<td><input name="password" type="password" id="password" placeholder=" Password" autocomplete="off" value="<?php echo $password; ?>"  /></td>
            </tr>
            <tr>
                 <td>
                 <select name="sex" id="sex"> 
               		 <option value="">Sex</option>
                     <option value="Male" <?php if($sex=='Male') { echo "selected='selected'"; } ?>>Male</option>
                     <option value="Female" <?php if($sex=='Female') { echo "selected='selected'"; } ?>>Female</option>
                </select>
              </td>
            </tr>
            <tr>
            	<td align="left" id="birthday">Birthday</td>
            </tr>
            <tr>
            	<td><input name="date_of_birth" type="text" id="date_of_birth" placeholder=" Year-Month-Day" autocomplete="off" value="<?php echo $date_of_birth; ?>" /></td>
            </tr>
            <tr>
            	<td><input name="school_name" type="text" id="school_name" placeholder=" Name Of School" autocomplete="off" value="<?php echo $school_name; ?>" /></td>
            </tr>
            <tr>
            	<td>
                	<select name="class" id="class">
                    	<option value="">Class</option>
                        <option value="Jss1" <?php if($class=='Jss1') { echo "selected='selected'";} ?>>Jss1</option>
                        <option value="Jss2" <?php if($class=='Jss2') { echo "selected='selected'";} ?>>Jss2</option>
                        <option value="Jss3" <?php if($class=='Jss3') { echo "selected='selected'";} ?>>Jss3</option>
                        <option value="Sss1" <?php if($class=='Sss1') { echo "selected='selected'";} ?>>Sss1</option>
                        <option value="Sss2" <?php if($class=='Sss2') { echo "selected='selected'";} ?>>Sss2</option>
                        <option value="Sss3" <?php if($class=='Sss3') { echo "selected='selected'";} ?>>Sss3</option>
                    </select>
              </td>
            </tr>
            <tr>
            	<td><input name="no_of_subjects_offered" type="text" id="no_of_subjects_offered" placeholder=" No Of Subjects Offered" autocomplete="off" value="<?php echo $no_of_subjects_offered; ?>" /></td>
            </tr>
            <tr>
           	  <td class="already_a_user2">Before clicking sign up make sure you <br /> have read our <a href="#">terms</a>  and you agree to them </td>
            </tr>
    <tr>
           	  <td align="center"><input type="button" value="Sign Up" onclick="sign_up_click()" /></td>
            </tr>
            <tr>
            	<td class="already_a_user">
            		Already have an account? <a href="sign_in.php">Sign in</a>
                </td>
            </tr>
            
            <script language="javascript">
				function sign_up_click()
				{
					if(document.getElementById("full_name").value=="")
					{
						$(document).ready(
							function()
							{
								$("#full_name").css(
								{
								'border' : 'solid red 2px',
								'background-image' : 'url(images/error.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
						alert("Please make sure the name field is not empty");
						document.getElementById("full_name").focus();
						return null;
					}
					if(document.getElementById("full_name").value!="")
					{
						$(document).ready(
							function()
							{
								$("#full_name").css(
								{
								'border' : 'solid green 2px',
								'background-image' : 'url(images/correct%20.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
					}
					
					if(validate_email_click(document.getElementById("email").value)==false)
					{
						
							$(document).ready(
							function()
							{
								$("#email").css(
								{
								'border' : 'solid red 2px',
								'background-image' : 'url(images/error.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
							 document.getElementById("email").focus();
							 return null;
					}
					if(document.getElementById("email").value!=false)
					{
						$(document).ready(
							function()
							{
								$("#email").css(
								{
								'border' : 'solid green 2px',
								'background-image' : 'url(images/correct%20.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
					}
					
					if(document.getElementById("password").value=="" || (document.getElementById("password").value).length<8)
					{
						$(document).ready(
							function()
							{
								$("#password").css(
								{
								'border' : 'solid red 2px',
								'background-image' : 'url(images/error.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
						alert("Please fill in a password not less than 8 characters!");
						document.getElementById("password").focus();
						return null;
					}
					if(document.getElementById("password").value!="" || document.getElementById("password").value>=8 )
					{
						$(document).ready(
							function()
							{
								$("#password").css(
								{
								'border' : 'solid green 2px',
								'background-image' : 'url(images/correct%20.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
					}
					
					if(document.getElementById("sex").value=="")
					{
						$(document).ready(
							function()
							{
								$("#sex").css(
								{
								'border' : 'solid red 2px',
								'background-image' : 'url(images/error.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
						alert("Please specify your sex");
						document.getElementById("sex").focus();
						return null;
					}
					if(document.getElementById("sex").value!="")
					{
						$(document).ready(
							function()
							{
								$("#sex").css(
								{
								'border' : 'solid green 2px',
								'background-image' : 'url(images/correct%20.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
					}
					
					if(val_date_click(document.getElementById("date_of_birth").value)==false)
					{
						$(document).ready(
							function()
							{
								$("#date_of_birth").css(
								{
								'border' : 'solid red 2px',
								'background-image' : 'url(images/error.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
						document.getElementById("date_of_birth").focus();
						return null;
					}
					if(document.getElementById("date_of_birth").value!=false)
					{
						$(document).ready(
							function()
							{
								$("#date_of_birth").css(
								{
								'border' : 'solid green 2px',
								'background-image' : 'url(images/correct%20.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
					}
					
					if(document.getElementById("school_name").value=="")
					{
						$(document).ready(
							function()
							{
								$("#school_name").css(
								{
								'border' : 'solid red 2px',
								'background-image' : 'url(images/error.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
						alert("Please make sure that your school name is stated");
						document.getElementById("school_name").focus();
						return null;
					}
					if(document.getElementById("school_name").value!="")
					{
						$(document).ready(
							function()
							{
								$("#school_name").css(
								{
								'border' : 'solid green 2px',
								'background-image' : 'url(images/correct%20.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
					}
					
					if(document.getElementById("class").value=="")
					{
						$(document).ready(
							function()
							{
								$("#class").css(
								{
								'border' : 'solid red 2px',
								'background-image' : 'url(images/error.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
						alert("Please state your class");
						document.getElementById("class").focus();
						return null;
					}
					if(document.getElementById("class").value!="")
					{
						$(document).ready(
							function()
							{
								$("#class").css(
								{
								'border' : 'solid green 2px',
								'background-image' : 'url(images/correct%20.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
					}
					
					if(document.getElementById("no_of_subjects_offered").value=="" || isNaN(document.getElementById("no_of_subjects_offered").value))
					{
						$(document).ready(
							function()
							{
								$("#no_of_subjects_offered").css(
								{
								'border' : 'solid red 2px',
								'background-image' : 'url(images/error.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
						alert("Please state the number of subjects you offer");
						document.getElementById("no_of_subjects_offered").focus();
						return null;
					}
					if(document.getElementById("no_of_subjects_offered").value!="")
					{
						$(document).ready(
							function()
							{
								$("#no_of_subjects_offered").css(
								{
								'border' : 'solid green 2px',
								'background-image' : 'url(images/correct%20.jpg)',
								'background-repeat' : 'no-repeat',
								'background-position' : 'right'
								}
								);
							}
						);
					}
					
					document.getElementById("myform").submit();
				}
			</script>
        </table>
        </div>
  </form>
 <div id="statement"> <h1 align="right" id="statement"> C.A Tracker gives you <br />the best academic life yet
</h1> <br /></div>
      <div id="pix_animation"> <img width="500" height="500" /></div>
</div>

<br />
<br />
<div id="footer">

<span class="footer_span"><a href="admin_user_sign_in.php">Admin/user login</a> | <a href="#">About us</a> | <a href="#">Contact us</a></span>
<span class="footer_span2">&copy; <?php echo date("Y"); ?> I-corporation LTD</span>

</div>
</body>
</html>