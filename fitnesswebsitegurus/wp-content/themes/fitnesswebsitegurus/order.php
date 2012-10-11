<?php
/**
 * Template Name: 	Order
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
for ($month = 1; $month <= 12; $month++) {
$html_output .= '<option value="' . $month . '">' . $months[$month] . '</option>'."\n";
}
get_header(); ?> 

<script type="text/javascript">
function chkvalid() {
	
	if(document.orderform.first_name.value == "" || document.orderform.first_name.value == "Full  Name")
	{
		alert("Please enter your name.");
		document.orderform.first_name.focus();
		return false;
	}	
	if(document.orderform.st_address1.value == "" || document.orderform.st_address1.value == "Address Line #1")
	{
		alert("Please enter street address.");
		document.orderform.st_address1.focus();
		return false;
	}	
	if(document.orderform.city.value == "" || document.orderform.city.value == "City")
	{
		alert("Please enter city.");
		document.orderform.city.focus();
		return false;
	}	
	if(document.orderform.state.value == "")
	{
		alert("Please enter state.");
		document.orderform.state.focus();
		return false;
	}	
	if(document.orderform.zipcode.value == "")
	{
		alert("Please enter zip code.");
		document.orderform.zipcode.focus();
		return false;
	}	
	//phone
	if(document.orderform.phone1.value == "")
	{
		alert("Please enter first three numbers of your phone number.");
		document.orderform.phone1.focus();
		return false;
	}
	if(document.orderform.phone1.value.length != 3)
	{
		alert("Please enter first three numbers of your phone number.");
		document.orderform.phone1.focus();
		return false;
	}
	if(document.orderform.phone2.value == "")
	{
		alert("Please enter second set of three numbers of your phone number.");
		document.orderform.phone2.focus();
		return false;
	}
	if(document.orderform.phone2.value.length != 3)
	{
		alert("Please enter second set of three numbers of your phone number.");
		document.orderform.phone2.focus();
		return false;
	}
	if(document.orderform.phone3.value == "")
	{
		alert("Please enter third set of your phone number.");
		document.orderform.phone3.focus();
		return false;
	}
	if(document.orderform.phone3.value.length != 4)
	{
		alert("Please enter third set of your phone number.");
		document.orderform.phone3.focus();
		return false;
	}
	//end phone	

	if(document.orderform.country.value == "")
	{
		alert("Please enter country.");
		document.orderform.country.focus();
		return false;
	}

	if(document.orderform.cc_card_num.value == "")
	{
		alert("Please enter credit card number.");
		document.orderform.cc_card_num.focus();
		return false;
	}

	if(document.orderform.cc_vcode.value == "")
	{
		alert("Please enter cared verification number.");
		document.orderform.cc_vcode.focus();
		return false;
	}
	
	return true;
}

function validate_pphone(pphone,val,xval)
{
	if(xval == 1)
	{
		if(val == 1)
		if(pphone.length ==3)
			document.orderform.phone2.focus();
		if(val == 2)
		if(pphone.length ==3)
			document.orderform.phone3.focus();
	}
	else if(xval == 2)
	{
		if(val == 1)
		if(pphone.length ==3)
			document.orderform.wphone2.focus();
		if(val == 2)
		if(pphone.length ==3)
			document.orderform.wphone3.focus();
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
</script>

		<div id="primary"> 	 
		 
			<div id="content" role="main"  class="order">

				<?php while ( have_posts() ) : the_post(); ?> 
			
				 
<?php the_content(); ?>

				<?php endwhile; // end of the loop. ?>
<div class="title"> <h1>Secure Order Form </h1></div>
<div class="pkg-price-table-sec">
<div class="pkg-price-table">
<h1>Package Pricing Table</h1>
<ul>
<li class="head">
<div class="col-1">Package</div>
<div class="col-2">Description</div>
</li>
<li>
<div class="col-1">
<div class="bronze-badge"></div>
<span><input type="radio" name="pkg_type" value="Bronze">Bronze($49)</span></div>
<div class="col-2">
<p>Our beginner package. Ideal for those who are looking to start an introductory marketing campaign and do not require all the bells and whistles.</p></div>
</li>
<li>
<div class="col-1">
<div class="silver-badge"></div>
<span><input type="radio" name="pkg_type" value="Silver">Silver($99)</span></div>
<div class="col-2">
<p>Our intermediate package. Ideal for those who require the basic functionality of the Bronze package but would like additional features.</p></div>
</li>
<li>
<div class="col-1">
<div class="gold-badge"></div>
<span><input type="radio" name="pkg_type" value="Gold">Gold($199)</span></div>
<div class="col-2">
<p>Our expert package. Ideal for professionals who want to launch aggressive, full-fledged marketing campaigns.</p></div>
</li>
<li>
<div class="note">* Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
</ul>
</div> 
</div> 

		<div class="subtitle"> <h2>Billing Information </h2></div>
				
		<form name="orderform" id="orderform" action="/thank-you-for-your-order/" method="post" onSubmit="return chkvalid()";>
<ul class="form">
      <li>
        <label>Name on Card <span>*</span></label>
         <input type="text" name="first_name" id="first_name" value="Full  Name" class="input405" onClick="this.value=''"  /> 
      </li>
      <li class="frmclr fspace">
        <label>Address Line 1 <span>*</span></label>
         <input type="text" name="st_address1"  id="st_address1" value="Address Line #1"  class="input405" onClick="this.value=''"  /> 
      </li>
      <li>
        <label>Address Line 2 <span>*</span></label>
         <input type="text" name="st_address2" value="Address Line #2"   class="input405" onClick="this.value=''"  /> 
      </li>
      <li class="fspace"> 
        <label>City <span>*</span></label>
		 <input type="text" name="city"  class="input470" >
     </li>
      <li class="fspace"> 
        <label>State<span>*</span></label>
		<select type="text" name="state"  class="input333" >
	<option value="AL" <?PHP if($state=="AL") echo "selected";?>>Alabama</option>
	<option value="AK" <?PHP if($state=="AK") echo "selected";?>>Alaska</option>
	<option value="AZ" <?PHP if($state=="AZ") echo "selected";?>>Arizona</option>
	<option value="AR" <?PHP if($state=="AR") echo "selected";?>>Arkansas</option>
	<option value="CA" <?PHP if($state=="CA") echo "selected";?>>California</option>
	<option value="CO" <?PHP if($state=="CO") echo "selected";?>>Colorado</option>
	<option value="CT" <?PHP if($state=="CT") echo "selected";?>>Connecticut</option>
	<option value="DE" <?PHP if($state=="DE") echo "selected";?>>Delaware</option>
	<option value="DC" <?PHP if($state=="DC") echo "selected";?>>District of Columbia</option>
	<option value="FL" <?PHP if($state=="FL") echo "selected";?>>Florida</option>
	<option value="GA" <?PHP if($state=="GA") echo "selected";?>>Georgia</option>
	<option value="HI" <?PHP if($state=="HI") echo "selected";?>>Hawaii</option>
	<option value="ID" <?PHP if($state=="ID") echo "selected";?>>Idaho</option>
	<option value="IL" <?PHP if($state=="IL") echo "selected";?>>Illinois</option>
	<option value="IN" <?PHP if($state=="IN") echo "selected";?>>Indiana</option>
	<option value="IA" <?PHP if($state=="IA") echo "selected";?>>Iowa</option>
	<option value="KS" <?PHP if($state=="KS") echo "selected";?>>Kansas</option>
	<option value="KY" <?PHP if($state=="KY") echo "selected";?>>Kentucky</option>
	<option value="LA" <?PHP if($state=="LA") echo "selected";?>>Louisiana</option>
	<option value="ME" <?PHP if($state=="ME") echo "selected";?>>Maine</option>
	<option value="MD" <?PHP if($state=="MD") echo "selected";?>>Maryland</option>
	<option value="MA" <?PHP if($state=="MA") echo "selected";?>>Massachusetts</option>
	<option value="MI" <?PHP if($state=="MI") echo "selected";?>>Michigan</option>
	<option value="MN" <?PHP if($state=="MN") echo "selected";?>>Minnesota</option>
	<option value="MS" <?PHP if($state=="MS") echo "selected";?>>Mississippi</option>
	<option value="MO" <?PHP if($state=="MO") echo "selected";?>>Missouri</option>
	<option value="MT" <?PHP if($state=="MT") echo "selected";?>>Montana</option>
	<option value="NE" <?PHP if($state=="NE") echo "selected";?>>Nebraska</option>
	<option value="NV" <?PHP if($state=="NV") echo "selected";?>>Nevada</option>
	<option value="NH" <?PHP if($state=="NH") echo "selected";?>>New Hampshire</option>
	<option value="NJ" <?PHP if($state=="NJ") echo "selected";?>>New Jersey</option>
	<option value="NM" <?PHP if($state=="NM") echo "selected";?>>New Mexico</option>
	<option value="NY" <?PHP if($state=="NY") echo "selected";?>>New York</option>
	<option value="NC" <?PHP if($state=="NC") echo "selected";?>>North Carolina</option>
	<option value="ND" <?PHP if($state=="ND") echo "selected";?>>North Dakota</option>
	<option value="OH" <?PHP if($state=="OH") echo "selected";?>>Ohio</option>
	<option value="OK" <?PHP if($state=="OK") echo "selected";?>>Oklahoma</option>
	<option value="OR" <?PHP if($state=="OR") echo "selected";?>>Oregon</option>
	<option value="PA" <?PHP if($state=="PA") echo "selected";?>>Pennsylvania</option>
	<option value="RI" <?PHP if($state=="RI") echo "selected";?>>Rhode Island</option>
	<option value="SC" <?PHP if($state=="SC") echo "selected";?>>South Carolina</option>
	<option value="SD" <?PHP if($state=="SD") echo "selected";?>>South Dakota</option>
	<option value="TN" <?PHP if($state=="TN") echo "selected";?>>Tennessee</option>
	<option value="TX" <?PHP if($state=="TX") echo "selected";?>>Texas</option>
	<option value="UT" <?PHP if($state=="UT") echo "selected";?>>Utah</option>
	<option value="VT" <?PHP if($state=="VT") echo "selected";?>>Vermont</option>
	<option value="VA" <?PHP if($state=="VA") echo "selected";?>>Virginia</option>
	<option value="WA" <?PHP if($state=="WA") echo "selected";?>>Washington</option>
	<option value="WV" <?PHP if($state=="WV") echo "selected";?>>West Virginia</option>
	<option value="WI" <?PHP if($state=="WI") echo "selected";?>>Wisconsin</option>
	<option value="WY" <?PHP if($state=="WY") echo "selected";?>>Wyoming</option>
		</select>  
     </li>
      <li>
        <label>Zip Code<span>*</span></label> 
        <input type="text" name="zipcode"  class="input145" /> 
     </li>
      <li class="frmclr fspace">
        <label>Phone Number<span>*</span></label>
         <input type="text" maxlength="3"  name="phone1" tabindex="7"/ onkeyup="validate_pphone(this.value,1,1); return numbersonly1(event, false,1)"  class="input110 fspace" /> 
          <input type="text" maxlength="3" name="phone2" tabindex="8" onkeyup="validate_pphone(this.value,2,1);return numbersonly1(event, false,1)"  class="input110 fspace"/> 
          <input type="text" maxlength="4" name="phone3" tabindex="8" onkeyup="return numbersonly1(event, false,1)"  class="input110" /> 
     </li>
      <li> 
         <label>Country<span>*</span></label> 
         <input type="text" name="country"  class="input405" /> 
      </li> </ul>

	  <div class="subtitle"> <h2>Credit Card Information</h2></div>
      <ul class="form">
      <li> 
         
		<ul class="cards"><li><input type="radio" name="cc_type" value="Visa">Visa <div class="visa-icon"></div></li>
		   <li><input type="radio" name="cc_type" value="Mastercard">Mastercard <div class="mastercard-icon"></div></li>
		   <li> <input type="radio" name="cc_type" value="American Express">American Express <div class="american-express-icon"></div></li></ul>
       
     </li>
      <li class="frmclr"> 
        <label>Credit Card Number <span>*</span></label>
         <input type="text" name="cc_card_num"  class="input405"  /> 
     </li>
      <li class="fspace frmclr"> 
        <label>Expiration Month  <span>*</span></label>
         <select name="cc_exp_date"  class="input280" >
          <?=$html_output;?>
        </select>
	</li>
      <li><label>Expiration Year <span>*</span></label>
          <select name="cc_exp_year"  class="input155" >
            <?php $year = Date('Y'); for($i=$year;$i<=2020;$i++) { ?>
            <option value="<?php echo $i?>"><?php echo $i?></option>
            <?php } ?>
          </select>         
      </li>
      <li class="frmclr" style="width: 306px;">
        <label>Security Code (3-4 Digit on Back) <span>*</span> <div class="help-icon" id="tooltip"><a></a> <div class="tooltip" id="tooltippopup">
	 <div class="tooltip-note">Note :<BR>
The Card security code is located on the back of MasterCard, Visa and Discover credit or debit cards and is typically a separate group of 3 digits to the right of the signature strip. 
</div>
<div class="secure-code">
</div> </div>
</div></label>
         <input type="text" name="cc_vcode" maxlength="4"  class="input306"  /> 
     </li>
     <li class="frmclr"> <label><input type="checkbox" name="checkbox" id="checkbox" /> I  have read and agree to <A HREF="#">Terms of Service</A>   </label>  </li> 
      <li class="frmclr">  <input type="submit" name="submit" value="Submit" class="complete-payment-btn" />        </li> 
    </ul>
	
		</form>
  <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
<script language="JavaScript">
 
$('#tooltip').click(function() {
  $('#tooltippopup').toggle('', function() {
    // Animation complete.
  });
});

</script>
  
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>