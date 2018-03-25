// JavaScript Document

function shade_input_table(tablename)
{
	$("#"+tablename + " tr:odd").css('background-color' , '#cdcdcd');
	$("#"+tablename + " tr:even").css('background-color' , '#efefef');
}

function shade_data_table(tablename)
{
	$("#"+tablename + " tr:odd").css('background-color' , '#cdcdcd');
	$("#"+tablename + " tr:even").css('background-color' , '#efefef');
	$("#"+tablename + " tr:first").addClass("tableheading");
}

function check_characters(myemail)
{
	var thestr=myemail;
	var total=thestr.length;
	//var found=false;
	
	for(var mycount=0; mycount<total; mycount++)
	{
		var checkstr1=thestr.charAt(mycount);
		var checkstr=checkstr1.charCodeAt(0);
		
		if((checkstr>47 && checkstr<58) || (checkstr>63 && checkstr<91) || (checkstr>96 && checkstr<123) || (checkstr==46))
		{
			
		}
		else
		{
			return false;
		}
		
	}
	
	return true;
}


function space_found(thestr)
{
	var total=thestr.length;
	var found=false;
	
	for(var mycount=0; mycount<total; mycount++)
	{
		if(thestr[mycount]==" ")
		{
			found=true;
			break;
		}
	}
	
	return found;
}
	function validate_email_click(myemail)
	{
		//var =document.getElementById("myemail").value;
		
		//check the username and the domain name 
		var the_split=myemail.split("@");
		var total=the_split.length;
		if(total !=2)
		{
			alert("Invalid email address!");
			return false;
		}
		
		var the_username=the_split[0];
		var the_domain=the_split[1];
		
		if(check_characters(myemail)!=true)
		{
			alert("Invalid email address! Please make sure that all characters inputed are correct");
			return false;
		}
		
		if(space_found(the_username)==true || space_found(the_domain)==true)
		{
			alert("Invalid email address! Remove all spaces in your input!");
			return false;
		}
		
		//check the username
		if(the_username.length<2)
		{
			alert("Invalid email");
			return false;
		}
		
		if(the_domain.length<2)
		{
			alert("Invalid email");
			return false;
		}
		//alert("The domain name is " + the_domain);
		
		var the_split2=the_domain.split(".");
		var total2=the_split2.length;
		//alert("Domain split gave me "+ total2 +" components");
		if(total2<2)
		{
			alert("Invalid email address!");
			return false;
		}
		
		var mycount=0;
		var ok=true;
		
		for(mycount=0; mycount<total2; mycount++)
		{
			//alert("component " + mycount + " is "+ the_split2[mycount] );
			if(the_split2[mycount].length<2)
			{
				alert("Invalid email address!");
				return false;
			}
		}
		return true;
	}
	
	
	function val_date_click(mydate)
{
	//var mydate=document.getElementById("mydate").value;
	
	//check if my date is ten characters 
	if(mydate.length !=10)
	{
		alert("invalid date entry! please enter a valid date using yyyy-mm-dd eg 2019-12-05");
		return false;
	}
	
	//split the date into year, month and day
	var the_split=mydate.split("-");
	var total=the_split.length;
	if(total != 3)
	{
	    alert("invalid date entry! please enter a valid date using yyyy-mm-dd eg 2019-12-05");
		return false;
	}
	var the_year=the_split[0];
	var the_month=the_split[1];
	var the_day=the_split[2];
	
	// 1. theyear has to be four digits 2. the year has to be numeric.
	
	if(the_year.length!=4 || isNaN(the_year))
	{
		alert("invalid year entry! please enter a valid date using yyyy-mm-dd eg 2019-12-05");
		return false;
	}
	
	if(the_month.length!=2 || isNaN (the_month) || the_month<1 || the_month>12 )
	{
		alert("invalid month entry! please enter a valid date using yyyy-mm-dd eg 2019-12-05");
		return false;
	}
	if(the_day.length!=2 || isNaN(the_day))
	{
		alert("invalid day entry! please enter a valid date using yyyy-mm-dd eg 2019-12-05");
		return false;
	}
	else
	{
		if(the_day>31)
		{
			alert("invalid day entry! no month can be greater than 31 days");
			return false;
		}
		if((the_month==4 || the_month==6 || the_month==9 || the_month==11) && the_day>30)
		{
			alert("invalid day entry! April,june,september and november cannot have more than 30 days.  please enter a valid date using yyyy-mm-dd eg 2019-12-05");
			return false;
		}
		if(the_month==2)
		{
			if(the_year % 4 ==0 && the_day >29 )
			{
				alert("This is a leap year and feburary cannot be greater than 29 days");
				return false;
			}
			
			if(the_year % 4 !=0 && the_day >28 )
			{
				alert("This is not a leap year and feburary cannot be greater than 28 days");
				return false;
			}
		}
	}
	return true;
}


