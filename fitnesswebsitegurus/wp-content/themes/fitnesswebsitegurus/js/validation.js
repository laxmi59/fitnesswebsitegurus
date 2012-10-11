function chkvalid() {

	if(document.contactForm.FirstName.value == "")
	{
		alert("Please enter your name.");
		document.contactForm.FirstName.focus();
		return false;
	}

if(document.contactForm.Email.value == "")
	{
		alert("Please enter your email address.");
		document.contactForm.Email.focus();
		return false;
	}
		// Start Email Validation
	if(document.contactForm.Email.value != "")
	{
		var i;
		var input = document.contactForm.Email.value ;
		var lenth = input.length ;
		var ctr=0 ;
	
		if ( ( document.contactForm.Email.value.charAt(i) == '!' ) || ( 	document.contactForm.Email.value.charAt(i) == '#' ) )
	    {
		  alert("Please enter a proper email address") ;
		  document.contactForm.Email.focus();
	      return false;
	    }
		if (input =="")
		{
			alert("Please enter email address") ;
		    document.contactForm.Email.focus();
			return false ;
		}
		if(input.length == 40)
		{
			alert("Please enter a proper email address") ;
		    document.contactForm.Email.focus();
			return false ;
		}
	
		for ( i=0; i < lenth; i++ )
		{
			var oneChar = input.charAt(i) ;
			if(oneChar == "@")
			{
				ctr = ctr+1 ;
			}
			if ( (i == 0 && oneChar == "@") || (i == 0 && oneChar == ".") || 
				( oneChar == " " ) )
			{
				alert ( "This does not seem to be a proper email address" ) ;
		        document.contactForm.Email.focus();
				return false ;
			}
			if ( (oneChar == "@" && input.charAt(i+1) == ".") || 
				(oneChar == "." && input.charAt(i+1) == "@") ||
				(oneChar == "." && input.charAt(i+1) == ".") )
			{
				alert ( "This does not seem to be a proper email address" ) ;
		        document.contactForm.Email.focus();
				return false ;
			}
			if( input.indexOf("@") < 2 )
			{
				alert ( "This does not seem to be a proper email address" ) ;
		        document.contactForm.Email.focus();
				return false ;
			}
			if(input.indexOf(".")<1)
			{
				alert ( "This does not seem to be a proper email address" ) ;
		        document.contactForm.Email.focus();
				return false ;
			}
			if (ctr > 1)
			{
				alert ( "This does not seem to be a proper email address" ) ;
		        document.contactForm.Email.focus();
				return false ;
			}
		}
	}	
	// End Email Validation Script	
	
	//phone
	if(document.contactForm.pp1.value == "")
	{
		alert("Please enter first three numbers of your phone number.");
		document.contactForm.pp1.focus();
		return false;
	}
	if(document.contactForm.pp1.value.length != 3)
	{
		alert("Please enter first three numbers of your phone number.");
		document.contactForm.pp1.focus();
		return false;
	}
	if(document.contactForm.pp2.value == "")
	{
		alert("Please enter second set of three numbers of your phone number.");
		document.contactForm.pp2.focus();
		return false;
	}
	if(document.contactForm.pp2.value.length != 3)
	{
		alert("Please enter second set of three numbers of your phone number.");
		document.contactForm.pp2.focus();
		return false;
	}
	if(document.contactForm.pp3.value == "")
	{
		alert("Please enter third set of your phone number.");
		document.contactForm.pp3.focus();
		return false;
	}
	if(document.contactForm.pp3.value.length != 4)
	{
		alert("Please enter third set of your phone number.");
		document.contactForm.pp3.focus();
		return false;
	}
	//end phone	
	

	return true;
}

function validate_pphone(pphone,val,xval)
{
	if(xval == 1)
	{
		if(val == 1)
		if(pphone.length ==3)
			document.contactForm.phone2.focus();
		if(val == 2)
		if(pphone.length ==3)
			document.contactForm.phone3.focus();
	}
	else if(xval == 2)
	{
		if(val == 1)
		if(pphone.length ==3)
			document.contactForm.wphone2.focus();
		if(val == 2)
		if(pphone.length ==3)
			document.contactForm.wphone3.focus();
	}
}

function numbersonly1(e, decimal) {
var key;
var keychar;

if (window.event) {
   key = window.event.keyCode;
}
else if (e) {
   key = e.which;
}
else {
   return true;
}
keychar = String.fromCharCode(key);

if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
   return true;
}
else if ((("0123456789").indexOf(keychar) > -1)) {
   return true;
}
else if (decimal && (keychar == ".")) { 
  return true;
}
else if (key >= 97 && key <=105) { 
  return true;
}
else
{
	alert("Phone number value must be numeric.\n");
   return false;
}
}