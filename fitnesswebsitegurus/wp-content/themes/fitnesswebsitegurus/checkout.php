<?php
/**
 * Template Name: 	Checkout
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

require_once('merchant/class.merchant.php');
require_once('merchant/class.phpmailer.php');
$link = mysql_connect('localhost', 'fitnesswebsitegurus', 'fwgSufj8fF#');
$db_selected = mysql_select_db('fitnesswebsitegurus', $link);
extract($_POST);
extract($_GET);

if(trim($package) != "")
{
	$pack_sql="SELECT * FROM subscription_plans WHERE shortcode='$package'";
	$pack_res = mysql_query($pack_sql) or die("Error".$pack_sql.mysql_error());
}
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
	$phone_number = $phone1."-".$phone2."-".$phone3;

	$error_message="";
	$payment_success=0;
	
		$reference_id           =   $first_name[0].$last_name[0].time();
		#$sub_name               =   '';
		$sub_length             =   '1';
		$sub_unit               =   'months';
		$sub_start              =   date('Y-m-d');
		$sub_total_occurences   =   $contract_length;
		$sub_trial_occurences   =   '0';
		//$sub_amount             =   '1.00';
		$sub_amount = $price;
		$sub_trial_amount       =   '0';
		
		$cardExpMonth=substr($cc_exp_date,0,2);
        $cardExpYear=substr($cc_exp_year,2,4);
        $exp_date=$cardExpMonth."-".$cardExpYear;


		$M = new Merchant;
		
		if($contract_length == 1)
		{
			$single_response = $M->send($cc_card_num,$exp_date,$sub_amount,$description,$first_name,$last_name,$st_address1." ".$st_address2,$city,$state,$zipcode);
		}
		else if($contract_length > 1)
		{
			$pay_result = $M->sendARB($reference_id,$sub_name,$sub_length,$sub_unit,$sub_start,$sub_total_occurences,$sub_trial_occurences,$sub_amount,$sub_trial_amount,$cc_card_num,$exp_date,$cc_vcode,$first_name,$last_name,$st_address1." ".$st_address2,$city,$state,$zipcode);
		}


		
		if(($pay_result['Response Code'] == "I00001" && strtolower($pay_result['Result Code']) == "ok") || ($single_response['Reason Code'] == 1 && $single_response['Transaction ID'] != ""))
		 {			
			$payment_success=1;
			$transaction_id = $single_response['Transaction ID'];
		 }
		 else
	    {
			if($contract_length == 1)
				$error_message = $single_response['Response  Message'];
			else
				$error_message = $pay_result['Response Text'];
		}
	
		if(trim($error_message) == "" && $email != "" && $payment_success == 1)
		{
			$ins_sql="INSERT INTO check_out_users (plan_id,first_name,last_name,email,bill_address1,bill_address2,city,state,zipcode,phone_number,country,created_date,reference_id,transaction_id) VALUES ('$planid','$first_name','$last_name','$email','$st_address1','$st_address2','$city','$state','$zipcode','$phone_number','$country',now(),'$reference_id','$transaction_id')";
			mysql_query($ins_sql) or die(mysql_error());

			Header("Location: /idea-world-thank-you/");
			exit;
		}

 }
 else
 {
	$first_name="";
	$last_name="";
	$email="";
	$st_address1="";
	$st_address2="";
	$city="";
	$state="";
	$zipcode="";
	$phone1="";
	$phone2="";
	$phone3="";
	$country="";
	$cc_card_num="";
	$cc_vcode="";

 }
 $arrCountry = array(""=>"Select Country", "United States"=>"United States", "Afghanistan"=>"Afghanistan","Aland Islands"=>"Aland Islands","Albania"=>"Albania","Algeria"=>"Algeria","American Samoa"=>"American Samoa","Andorra"=>"Andorra","Angola"=>"Angola","Anguilla"=>"Anguilla","Antarctica"=>"Antarctica","Antigua and Barbuda"=>"Antigua and Barbuda","Argentina"=>"Argentina","Armenia"=>"Armenia","Aruba"=>"Aruba","Australia"=>"Australia","Austria"=>"Austria","Azerbaijan"=>"Azerbaijan","Bahamas"=>"Bahamas","Bahrain"=>"Bahrain","Bangladesh"=>"Bangladesh","Barbados"=>"Barbados","Belarus"=>"Belarus","Belgium"=>"Belgium","Belize"=>"Belize","Benin"=>"Benin","Bermuda"=>"Bermuda","Bhutan"=>"Bhutan","Bolivia"=>"Bolivia","Bosnia and Herzegovina"=>"Bosnia and Herzegovina","Botswana"=>"Botswana","Bouvet Island"=>"Bouvet Island","Brazil"=>"Brazil","British Indian Ocean Territory"=>"British Indian Ocean Territory","British Virgin Islands"=>"British Virgin Islands","Brunei"=>"Brunei","Bulgaria"=>"Bulgaria","Burkina Faso"=>"Burkina Faso","Burundi"=>"Burundi","Cambodia"=>"Cambodia","Cameroon"=>"Cameroon","Canada"=>"Canada","Cape Verde"=>"Cape Verde","Cayman Islands"=>"Cayman Islands","Central African Republic"=>"Central African Republic","Chad"=>"Chad","Chile"=>"Chile","China"=>"China","Christmas Island"=>"Christmas Island","Cocos (Keeling) Islands"=>"Cocos (Keeling) Islands","Colombia"=>"Colombia","Comoros"=>"Comoros","Congo"=>"Congo","Cook Islands"=>"Cook Islands","Costa Rica"=>"Costa Rica","Croatia"=>"Croatia","Cuba"=>"Cuba","Cyprus"=>"Cyprus","Czech Republic"=>"Czech Republic","Democratic Republic of Congo"=>"Democratic Republic of Congo","Denmark"=>"Denmark","Disputed Territory"=>"Disputed Territory","Djibouti"=>"Djibouti","Dominica"=>"Dominica","Dominican Republic"=>"Dominican Republic","East Timor"=>"East Timor","Ecuador"=>"Ecuador","Egypt"=>"Egypt","El Salvador"=>"El Salvador","Equatorial Guinea"=>"Equatorial Guinea","Eritrea"=>"Eritrea","Estonia"=>"Estonia","Ethiopia"=>"Ethiopia","Falkland Islands"=>"Falkland Islands","Faroe Islands"=>"Faroe Islands","Federated States of Micronesia"=>"Federated States of Micronesia","Fiji"=>"Fiji","Finland"=>"Finland","France"=>"France","French Guyana"=>"French Guyana","French Polynesia"=>"French Polynesia","French Southern Territories"=>"French Southern Territories","Gabon"=>"Gabon","Gambia"=>"Gambia","Georgia"=>"Georgia","Germany"=>"Germany","Ghana"=>"Ghana","Gibraltar"=>"Gibraltar","Greece"=>"Greece","Greenland"=>"Greenland","Grenada"=>"Grenada","Guadeloupe"=>"Guadeloupe","Guam"=>"Guam","Guatemala"=>"Guatemala","Guinea"=>"Guinea","Guinea-Bissau"=>"Guinea-Bissau","Guyana"=>"Guyana","Haiti"=>"Haiti","Heard Island and Mcdonald Islands"=>"Heard Island and Mcdonald Islands","Honduras"=>"Honduras","Hong Kong"=>"Hong Kong","Hungary"=>"Hungary","Iceland"=>"Iceland","India"=>"India","Indonesia"=>"Indonesia","Iraq"=>"Iraq","Iraq-Saudi Arabia Neutral Zone"=>"Iraq-Saudi Arabia Neutral Zone","Ireland"=>"Ireland","Israel"=>"Israel","Italy"=>"Italy","Ivory Coast"=>"Ivory Coast","Jamaica"=>"Jamaica","Japan"=>"Japan","Jordan"=>"Jordan","Kazakhstan"=>"Kazakhstan","Kenya"=>"Kenya","Kiribati"=>"Kiribati","Kuwait"=>"Kuwait","Kyrgyzstan"=>"Kyrgyzstan","Laos"=>"Laos","Latvia"=>"Latvia","Lebanon"=>"Lebanon","Lesotho"=>"Lesotho","Liberia"=>"Liberia","Libya"=>"Libya","Liechtenstein"=>"Liechtenstein","Lithuania"=>"Lithuania","Luxembourg"=>"Luxembourg","Macau"=>"Macau","Macedonia"=>"Macedonia","Madagascar"=>"Madagascar","Malawi"=>"Malawi","Malaysia"=>"Malaysia","Maldives"=>"Maldives","Mali"=>"Mali","Malta"=>"Malta","Marshall Islands"=>"Marshall Islands","Martinique"=>"Martinique","Mauritania"=>"Mauritania","Mauritius"=>"Mauritius","Mayotte"=>"Mayotte","Mexico"=>"Mexico","Moldova"=>"Moldova","Monaco"=>"Monaco","Mongolia"=>"Mongolia","Montserrat"=>"Montserrat","Morocco"=>"Morocco","Mozambique"=>"Mozambique","Myanmar"=>"Myanmar","Namibia"=>"Namibia","Nauru"=>"Nauru","Nepal"=>"Nepal","Netherlands"=>"Netherlands","Netherlands Antilles"=>"Netherlands Antilles","New Caledonia"=>"New Caledonia","New Zealand"=>"New Zealand","Nicaragua"=>"Nicaragua","Niger"=>"Niger","Nigeria"=>"Nigeria","Niue"=>"Niue","Norfolk Island"=>"Norfolk Island","North Korea"=>"North Korea","Northern Mariana Islands"=>"Northern Mariana Islands","Norway"=>"Norway","Oman"=>"Oman","Pakistan"=>"Pakistan","Palau"=>"Palau","Palestinian Occupied Territories"=>"Palestinian Occupied Territories","Panama"=>"Panama","Papua New Guinea"=>"Papua New Guinea","Paraguay"=>"Paraguay","Peru"=>"Peru","Philippines"=>"Philippines","Pitcairn"=>"Pitcairn","Poland"=>"Poland","Portugal"=>"Portugal","Puerto Rico"=>"Puerto Rico","Qatar"=>"Qatar","Reunion"=>"Reunion","Romania"=>"Romania","Russia"=>"Russia","Rwanda"=>"Rwanda","Saint Helena and Dependencies"=>"Saint Helena and Dependencies","Saint Kitts and Nevis"=>"Saint Kitts and Nevis","Saint Lucia"=>"Saint Lucia","Saint Pierre and Miquelon"=>"Saint Pierre and Miquelon","Saint Vincent and the Grenadines"=>"Saint Vincent and the Grenadines","Samoa"=>"Samoa","San Marino"=>"San Marino","Sao Tome and Principe"=>"Sao Tome and Principe","Saudi Arabia"=>"Saudi Arabia","Senegal"=>"Senegal","Serbia and Montenegro"=>"Serbia and Montenegro","Seychelles"=>"Seychelles","Sierra Leone"=>"Sierra Leone","Singapore"=>"Singapore","Slovakia"=>"Slovakia","Slovenia"=>"Slovenia","Solomon Islands"=>"Solomon Islands","Somalia"=>"Somalia","South Africa"=>"South Africa","South Georgia and South Sandwich Islands"=>"South Georgia and South Sandwich Islands","South Korea"=>"South Korea","Spain"=>"Spain","Spratly Islands"=>"Spratly Islands","Sri Lanka"=>"Sri Lanka","Sudan"=>"Sudan","Suriname"=>"Suriname","Svalbard and Jan Mayen"=>"Svalbard and Jan Mayen","Swaziland"=>"Swaziland","Sweden"=>"Sweden","Switzerland"=>"Switzerland","Syria"=>"Syria","Taiwan"=>"Taiwan","Tajikistan"=>"Tajikistan","Tanzania"=>"Tanzania","Thailand"=>"Thailand","Togo"=>"Togo","Tokelau"=>"Tokelau","Tonga"=>"Tonga","Trinidad and Tobago"=>"Trinidad and Tobago","Tunisia"=>"Tunisia","Turkey"=>"Turkey","Turkmenistan"=>"Turkmenistan","Turks And Caicos Islands"=>"Turks And Caicos Islands","Tuvalu"=>"Tuvalu","Uganda"=>"Uganda","Ukraine"=>"Ukraine","UAE"=>"United Arab Emirates","United Kingdom"=>"United Kingdom","United Nations Neutral Zone"=>"United Nations Neutral Zone","United States Minor Outlying Islands"=>"United States Minor Outlying Islands","Uruguay"=>"Uruguay","US Virgin Islands"=>"US Virgin Islands","Uzbekistan"=>"Uzbekistan","Vanuatu"=>"Vanuatu","Vatican City"=>"Vatican City","Venezuela"=>"Venezuela","VietNam"=>"VietNam","Wallis and Futuna"=>"Wallis and Futuna","Western Sahara"=>"Western Sahara","Yemen"=>"Yemen","Yugoslavia"=>"Yugoslavia","Zambia"=>"Zambia","Zimbabwe"=>"Zimbabwe");

$months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
for ($month = 1; $month <= 12; $month++) {
	if($cc_exp_date == $month)
		$html_output .= '<option value="' . $month . '" selected>' . $months[$month] . '</option>'."\n";
	else
		$html_output .= '<option value="' . $month . '" >' . $months[$month] . '</option>'."\n";

}
function getCountriesList($arrCountries, $country) {
    $str = showValues($arrCountries, $country);
    return $str;
}
function showValues($dropdownvariable, $selectedvalue=-1) {
    $selectedvalues="";
    foreach ($dropdownvariable as $key => $value) {
        if (strtolower($selectedvalue) == strtolower($key))
            $selectedvalues .="<option value=\"$key\" selected='selected'>$value</option>";
        else
            $selectedvalues .="<option value=\"$key\">$value</option>";
    }
    return $selectedvalues;
}
if($state == "")
	$state="CA";
if($country == "")
	$country="United States";
get_header();
get_sidebar(); ?> 
<script type="text/javascript">
function chkvalid() {
	
	if(document.orderform.email.value == "")
	{
		alert("Please enter email.");
		document.orderform.email.focus();
		return false;
	}
	if(!emailCheck(document.orderform.email.value))
        {
            alert("Please enter valid email.");
			document.orderform.email.focus();
			return false;
        }
	if(document.orderform.first_name.value == "")
	{
		alert("Please enter your first name.");
		document.orderform.first_name.focus();
		return false;
	}
if(document.orderform.last_name.value == "" )
	{
		alert("Please enter your last name.");
		document.orderform.last_name.focus();
		return false;
	}

	if(document.orderform.st_address1.value == "")
	{
		alert("Please enter street address.");
		document.orderform.st_address1.focus();
		return false;
	}	
	if(document.orderform.city.value == "")
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

	if (!checkRadio("orderform","cc_type"))
	{
		  alert("Please select card type");
		  document.orderform.cc_type.focus();
		  return false;
	}
	if(document.orderform.cc_card_num.value == "")
	{
		alert("Please enter credit card number.");
		document.orderform.cc_card_num.focus();
		return false;
	}
	 if(document.orderform.cc_card_num.value != "")
        {
            /*if (!cardval(document.orderform.cc_card_num.value))
			{
				alert("Please enter valid credit card number.");
				document.orderform.cc_card_num.focus();
				return false;
			}*/
                
        }
	var curyear = <?php echo Date('Y');?>;
	var curmonth = <?php echo Date('m');?>;

	if(document.orderform.cc_exp_year.value == curyear && document.orderform.cc_exp_date.value < curmonth )
	{
		alert("Expiration Date should be greater than current date.");
		document.orderform.cc_vcode.focus();
		return false;
	}

	if(document.orderform.cc_vcode.value == "")
	{
		alert("Please enter card verification number.");
		document.orderform.cc_vcode.focus();
		return false;
	}
	if (document.orderform.termsofservice.checked == false)
	{
		alert("Please click I have read and agree to Terms of Service");
		document.orderform.termsofservice.focus();
		return false;
	}
	

	//return true;
	
	document.orderform.action="/checkout/";
	document.orderform.method ="POST";
	document.orderform.submit();

}
function emailCheck(emailStr)
    {
        var emailPat=/^(.+)@(.+)$/
        var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
        var validChars="\[^\\s" + specialChars + "\]"
        var quotedUser="(\"[^\"]*\")"
        var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
        var atom=validChars + '+'
        var word="(" + atom + "|" + quotedUser + ")"
        var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
        var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")

        var matchArray=emailStr.match(emailPat)
        if (matchArray==null) {
            return false
        }
        var user=matchArray[1]
        var domain=matchArray[2]
        if (user.match(userPat)==null) {
            return false
        }
        var IPArray=domain.match(ipDomainPat)
        if (IPArray!=null) {
            for (var i=1;i<=4;i++) {
                if (IPArray[i]>255) {
                    return false
                }
            }
            return true
        }
        var domainArray=domain.match(domainPat)
        if (domainArray==null) {
            return false
        }
        var atomPat=new RegExp(atom,"g")
        var domArr=domain.match(atomPat)
        var len=domArr.length
        if (domArr[domArr.length-1].length<2 ||
            domArr[domArr.length-1].length>4) {
            return false
        }
        if (len<2) {
            return false
        }
        return true;
    }
function cardval(s) {
        // remove non-numerics
        var v = "0123456789";
        var w = "";
        for (i=0; i < s.length; i++) {
            x = s.charAt(i);
            if (v.indexOf(x,0) != -1)
                w += x;
        }
        // validate number
        j = w.length / 2;
        if (j < 6.5 || j > 8 || j == 7) return false;
        k = Math.floor(j);
        m = Math.ceil(j) - k;
        c = 0;
        for (i=0; i<k; i++) {
            a = w.charAt(i*2+m) * 2;
            c += a > 9 ? Math.floor(a/10 + a%10) : a;
        }
        for (i=0; i<k+m; i++) c += w.charAt(i*2+1-m) * 1;
        return (c%10 == 0);
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

function checkRadio (frmName, rbGroupName) {
 var radios = document[frmName].elements[rbGroupName];
 for (var i=0; i <radios.length; i++) {
  if (radios[i].checked) {
   return true;
  }
 }
 return false;
}

</script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>


<div id="primary">
  <div id="content" role="main" class="checkout" style="overflow:hidden;">
  			<div class="gray-corner topLeft"></div>
                <div class="gray-corner topRight"></div>
                <div class="gray-corner bottomLeft"></div>
                <div class="gray-corner bottomRight"></div> 
    <header class="entry-header">
      <h1 class="entry-title">
        <?php the_title(); ?>
      </h1>
    </header> 
    <?php while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
    <form name="orderform" id="orderform" method="post">

      <div class="packagelistbox">
	  <div class="blue-grd gray-bdr graybox bdr-top-none  nopad" style="padding:0">
        <div class="blue-corner topLeft"></div>
        <div class="blue-corner topRight"></div>
		<div class="blue-corner bottomLeft"></div>
        <div class="blue-corner bottomRight"></div>
	  <table>
	  <tr>
		<th>Item</th>
		<th>Selection</th>
		<th>Price</th>
	  </tr>
<?php while($pack_row = mysql_fetch_array($pack_res)) { 
	$planid = $pack_row['planid'];
	$description  = $pack_row['plan_name']." - ".$pack_row['description'];
	if($pack_row['contract_length'] > 1)
		  {
			$price = $pack_row['price']/$pack_row['contract_length'];
		  }
	else
		$price = $pack_row['price'];

	$contract_length = $pack_row['contract_length'];
	?>
	  <tr class="row">
		<td><?=$pack_row['plan_name'];?></td>
		<td class='coltwo'><?=$pack_row['description'];?></td>
		<TD  class='colthree'>$<?=$price;?></td>
	  </tr>
		
<? } ?>
<!-- <tr class="altrow">
		<td><?=$pack_row['plan_name'];?></td>
		<td class='coltwo'><?=$pack_row['description'];?></td>
		<TD  class='colthree'>$<?=$price;?></td>
	  </tr> -->
 <tr class="total">
		<td> </td>
		<td class='coltwo'>total</td>
		<TD  class='colthree'>$<?=$price*$contract_length;?></td>
	  </tr>
	  </TABLE></div><div class="packagelistbox-shadow"></div>
      </div>
      <div class="blue-grd gray-bdr graybox bdr-top-none  nopad mt15  ">
        <div class="blue-corner topLeft"></div>
        <div class="blue-corner topRight"></div>
        <div class="pr20 shadow-separator">
          <div class="pl5">
            <h2 class="title">billing </h2>
            <h3 class="small">information</h3>
          </div>
        </div>
      </div>
      <div class="blue-bdr graybox bdr-top-none mb20  nopad">
        <div class="blue-corner bottomLeft"></div>
        <div class="blue-corner bottomRight"></div>
        <div class="pr20 shadow-separator"></div>
        <div class="p28">
          <ul class="form">
            <li>
              <label>Email <span>*</span></label>
              <input type="text" name="email" value="<?php if($email!= "") echo $email; ?>"   class="input375"   tabindex="2" />
            </li>
            <li class="frmclr fspace">
              <label>First Name <span>*</span></label>
              <input type="text" name="first_name" id="first_name" value="<?php if($first_name!= "") echo $first_name; ?>" class="input375"  tabindex="3"  />
            </li>
            <li>
              <label>Last Name <span>*</span></label>
              <input type="text" name="last_name" value="<?php if($last_name!= "") echo $last_name;?>"   class="input375"   tabindex="4" />
            </li>
            <li class="frmclr fspace">
              <label>Address Line 1 <span>*</span></label>
              <input type="text" name="st_address1"  id="st_address1" value="<?php if($st_address1!= "") echo $st_address1; ?>"  class="input375"   tabindex="5" />
            </li>
            <li>
              <label>Address Line 2 </label>
              <input type="text" name="st_address2" value="<?php if($st_address2!= "") echo $st_address2; ?>"    tabindex="6" class="input375"   />
            </li>
            <li class="fspace">
              <label>City <span>*</span></label>
              <input type="text" name="city"  class="input375" value="<?php if($city!= "") echo $city;?>"  tabindex="7">
            </li>
            <li class="fspace">
              <label>State<span>*</span></label>
              <select type="text" name="state"  class="input265"  tabindex="8">
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
              <input type="text" name="zipcode"  tabindex="9" class="input110" value="<?php if($zipcode!= "") echo $zipcode;?>"/>
            </li>
            <li class="frmclr fspace">
              <label>Phone Number<span>*</span></label>
              <input type="text" maxlength="3"  name="phone1" tabindex="10"/ onkeyup="validate_pphone(this.value,1,1); return numbersonly1(event, false,1)"  class="input100 fspace" value="<?php if($phone1!= "") echo $phone1;?>"/>
              <input type="text" maxlength="3" name="phone2" tabindex="11" onkeyup="validate_pphone(this.value,2,1);return numbersonly1(event, false,1)"  class="input100 fspace" value="<?php if($phone2!= "") echo $phone2;?>"/>
              <input type="text" maxlength="4" name="phone3" tabindex="12" onkeyup="return numbersonly1(event, false,1)"  class="input100" value="<?php if($phone3!= "") echo $phone3;?>"/>
            </li>
            <li>
              <label>Country<span>*</span></label>
              <select name="country" class="input265"  tabindex="13">
                <?=getCountriesList($arrCountry,$country);?>
              </select>
            </li>
             </ul>
        </div>
      </div> 
      <div class="blue-grd blue-bdr graybox bdr-top-none mt25  nopad">
        <div class="blue-corner topLeft"></div>
        <div class="blue-corner topRight"></div>
        <div class="pr20 shadow-separator">
          <div class="pl5 ">
            <h2 class="title">payment</h2>
            <h3 class="small">information</h3>
          </div>
        </div>
      </div>
      <div class="blue-bdr graybox bdr-top-none mb20  nopad">
        <div class="blue-corner bottomLeft"></div>
        <div class="blue-corner bottomRight"></div>
        <div class="pr20 shadow-separator"></div> 
        <?php if($error_message != "") echo "<div class='error-msg'>".$error_message."</div>"; ?>
        <div class="p28">
          <ul class="form">
            <li>
              <ul class="cards">
                <li>
                  <input type="radio" name="cc_type" value="Visa" <?php if(trim($cc_type) == "Visa") echo "checked";?>  tabindex="14">
                  Visa
                  <div class="visa-icon"></div>
                </li>
                <li>
                  <input type="radio" name="cc_type" value="Mastercard" <?php if(trim($cc_type) == "Mastercard") echo "checked";?>  tabindex="14">
                  Mastercard
                  <div class="mastercard-icon"></div>
                </li>
                <li>
                  <input type="radio" name="cc_type" value="American Express" <?PHP if(trim($cc_type) == "American Express") echo "checked";?>  tabindex="14">
                  American Express
                  <div class="american-express-icon"></div>
                </li>
              </ul>
            </li>
            <li class="frmclr">
              <label>Credit Card Number <span>*</span></label>
              <input type="text" name="cc_card_num"  maxlength=16 class="input405"  value="<?PHP if($cc_card_num!="") echo $cc_card_num;?>"  tabindex="15"/>
            </li>
            <li class="fspace frmclr">
              <label>Expiration Month <span>*</span></label>
              <select name="cc_exp_date"  class="input280"  tabindex="16">
                <?=$html_output;?>
              </select>
            </li>
            <li>
              <label>Expiration Year <span>*</span></label>
              <select name="cc_exp_year"  class="input155"  tabindex="17" >
                <?php $year = Date('Y'); for($i=$year;$i<=2020;$i++) { ?>
                <option value="<?php echo $i?>" <?php if($cc_exp_year == $i) echo "selected";?>><?php echo $i?></option>
                <?php } ?>
              </select>
            </li>
            <li class="frmclr" style="width: 215px;">
              <label>
              Security Code (3-4 Digit on Back) <span>*</span>
              <div class="chk-help-icon" id="tooltip"><a></a>
                <div class="tooltip" id="tooltippopup">
                  <div class="tooltip-note">Note :<BR>
                    The Card security code is located on the back of MasterCard, Visa and Discover credit or debit cards and is typically a separate group of 3 digits to the right of the signature strip. </div>
                  <div class="secure-code"> </div>
                </div>
              </div>
              </label>
              <input type="text" name="cc_vcode" maxlength="4"  class="input100" value=""  tabindex="18"/>
            </li>
            <li class="frmclr f-none  ">
              <label style="display:inline">
                <input type="checkbox" name="termsofservice" id="termsofservice"  tabindex="19"/>
                <span class="gallery"> I  have read and agree to <a rel="prettyPhoto[inline]" href="#terms">Terms of Service</A></span> </label>
				      <input type=hidden name="planid" value="<?php echo $planid;?>">
					  <input type=hidden name="price" value="<?php echo $price;?>">
					   <input type=hidden name="contract_length" value="<?php echo $contract_length;?>">
					    <input type=hidden name="description" value="<?php echo $description ;?>">
						 <input type=hidden name="package" value="<?php echo $package ;?>">
      

              <div id="terms" style=" display:none; overflow:scroll ">
                <h2>IMPORTANT INFORMATION</h2>
                <p>You should carefully read the following Terms and Conditions. Your   purchase or use of our products implies that you have read and accepted   these Terms and Conditions.</p>
                <h2>LICENSE</h2>
                <p>Our website grants you three possible types of license to use the   web templates and other products (the "products") sold through our   website by independent content providers in accordance with these Terms   and Conditions (the "license") issued by our company, as follows:</p>
                <h2>ONE TIME USAGE LICENSE</h2>
                <p>You may be granted a One Time Usage License in case of purchasing a   website template at a Non-Unique Price. It enables you to use each   individual product on a single website only, belonging to either you or   your client. You have to purchase the same template again if you to use   the same design in connection with another or other projects;</p>
                <h2>DEVELOPERS LICENSE</h2>
                <p>You may be granted a Developers License entitles you to make some   modifications with the products using any software or applications and   fitnesswebsitegurus.com designs. You are permitted to redistribute or   resell your projects after the receiving the license. You can apply for   the license at info@fitnesswebsitegurus.com.</p>
                <h2>BUYOUT PURCHASE LICENSE</h2>
                <p>You may be granted a Buyout Purchase License in case of purchasing a   website template at a Buyout Purchase Price. This type of license   guarantees that you are the last person to buy this template. After the   buyout purchase occurs, the template is permanently removed from the   fitnesswebsitegurus.com. sales directory and is never available to other   customers again. You can not redistribute or resell templates after   Buyout Purchase Price.</p>
                <h2>IMAGERY, CLIPARTS AND FONTS</h2>
                <p>All imagery, clipart, fonts and video footages used in our products   are royalty-free and are the integral part of our products. One Time   Usage License and Developers License give you the right to use images,   clipart, fonts and video footages only as a part of the website you   build using your template. You can use imagery, clipart, fonts and video   footages to develop one project only. Any kind of separate usage or   distribution is strictly prohibited. All images and illustrations used   in templates come in a single layer, as is.</p>
                <p>Some of the templates that are animated with the Flash technology   may contain effects created with the following software packages: Adobe   AfterEffects, 3DMax. To clarify whether or not effects like these are   present in certain template please address our Support Team for further   consulting.</p>
                <p>Please be informed that for editing these effects you will need   proper software and skills. The alternate variant is to hire someone to   do it for you. We recommend that you address TemplateTuning.com for   this.</p>
                <h2>MODIFICATIONS</h2>
                <p>You are authorized to make necessary modification(s) to our   products to fit your purposes in accordance with the type of license you   acquire.</p>
                <h2>UNAUTHORIZED USE</h2>
                <p>If you have not received the Buyout License, you shall not place   any of our products, modified or unmodified, on a diskette, CD, website   or any other medium. You also shall not offer them for redistribution or   resale of any kind without prior written consent from our company.</p>
                <h2>ASSIGNABILITY</h2>
                <p>You shall not sub-license, assign, or transfer the any mentioned   above to any entity without prior written consent from our company.</p>
                <h2>OUR REFUND POLICY</h2>
                <p>Since fitnesswebsitegurus.com. is offering non-tangible,   irrevocable goods we do not issue refunds after the product is shipped,   which you acknowledge prior to purchasing any product at our site.   Please make sure that you've carefully read sources available' section.   We only make exceptions with this rule when the product appears to be   not-as-described on a case by case basis at our sole discretion. The   deadline for any refund claim is one week after the delivery date. The   refund is issued to you after we receive a Waiver of Copyright signed by   you. This is a required condition.</p>
                <h2>OWNERSHIP</h2>
                <p>You do not claim intellectual property right or exclusive ownership   to any of our products, modified or unmodified. All products are   property of independent content providers. Our products are provided "as   is" without warranty of any kind, either expressed or implied. In no   event shall our company or its agents be liable for any damages   including, but not limited to, direct, indirect, special, punitive,   incidental or consequential, or other losses arising out of the use of   or inability to use our products.</p>
                <h2>INSTALLATIONS</h2>
                <p>We do not install any of our products which require this   (osCommerce templates, Zen Cart templates, etc.). Installation is a paid   service which is not included in the package price.</p>
                <h2>ANTIFRAUD CHECK</h2>
                <p>Customer purchase can be suspended for manual antifraud check for   10-20 minutes as well as it can be suspended for a longer term for more   serious investigations. Antifraud check occurs because of growing number   of fraud transactions from persons who are not actual cardholders of   the credit cards used during purchase.</p>
                <h2>THIRD-PARTIES SERVICES</h2>
                <p>We may allow access to or advertise certain third-party product or   service providers ("Merchants") from which you may purchase certain   goods or <a title="services" href="http://fitnesswebsitegurus.com/services/">services</a>.   You understand that we do not operate or control the products or   services offered by Merchants. Merchants are responsible for all aspects   of <a title="order" href="http://fitnesswebsitegurus.com/order/">order</a> processing, fulfillment, billing and customer service. We are not a   party to the transactions entered into between you and Merchants. You   agree that use of or purchase from such Merchants is at your sole risk   and is without warranties of any kind by us, expressed, implied or   otherwise including warranties of title, fitness for purpose,   merchantability or non-infringement. under no circumstances are we   liable for any damages arising from the transactions between you and   merchants or for any information appearing on merchant sites or any   other site linked to our site.</p>
                <h2>REGISTRATION/PURCHASE</h2>
                <p>Purchasing from the Site may optionally require you to register. If   registration is performed, you agree to provide us with accurate,   complete registration and/or purchase information. Your registration   must be done using accurate information. Each registration is for your   personal use only. We do not permit:any other person using the   registered sections under your name; oraccess through a single name   being made available to multiple users on a network. You are responsible   for preventing such unauthorized use.</p>
                <p>Templatemonster.com retains the sole right and authority to accept   or reject your registration, or to terminate registration once accepted,   for any reason that it deems appropriate.</p>
                <h2>ERRORS, CORRECTIONS AND CHANGES</h2>
                <p>We do not represent or warrant that the Site will be error-free,   free of viruses or other harmful components, or that defects will be   corrected. We do not represent or warrant that the information available   on or through the Site will be correct, accurate, timely or otherwise   reliable. We may make to the features, functionality or content of the   Site at any time. We reserve the right in our sole discretion to edit or   delete any documents, information or other content.</p>
                <h2>THIRD PARTY CONTENT</h2>
                <p>Third party content may appear on the Site or may be accessible via   links from the Site. We are not responsible for and assume no liability   for any mistakes, misstatements of law, defamation, omissions,   falsehood, obscenity, pornography or profanity in the statements,   opinions, representations or any other form of content on the Site. You   understand that the information and opinions in the third party content   represent solely the thoughts of the author and is neither endorsed by   nor does it necessarily reflect our belief.</p>
                <h2>UNLAWFUL ACTIVITY</h2>
                <p>We reserve the right to investigate complaints or reported   violations of this Agreement and to take any action we deem appropriate,   including but not limited to reporting any suspected unlawful activity   to law enforcement officials, regulators, or other third parties and   disclosing any information necessary or appropriate to such persons or   entities relating to your profile, email addresses, usage history,   posted materials, IP addresses and traffic information.</p>
                <h2>LIMITATION OF LIABILITY</h2>
                <p>We and any Affiliated Party shall not be liable for any loss,   injury, claim, liability, or damage of any kind resulting in any way   fromany errors in or omissions from the Site or any services or   products obtainable there from, the unavailability or interruption of   the Site or any features thereof, your use of the Site, the content   contained on the Site, or any delay or failure in performance beyond the   control of a Covered Party. The aggregate liability of us and the   affiliated parties in connection with any claim arising out of or   relating to the site and/or the products, information, documents and   services provided herein or hereby shall not exceed $100 and that amount   shall be in lieu of all other remedies which you may have against us   and any affiliated party.</p>
                <h2>PAYMENTS</h2>
                <p>You represent and warrant that if you are purchasing something from   us or from Merchants thatany credit information you supply is true and   complete,charges incurred by you will be honored by your credit card   company, andyou will pay the charges incurred by you at the posted   prices, including any applicable taxes.Fitness Website Gurus reserves   the right to cancel service and/or take down your website if payment is   not received within a specified timeline. Depending on service(s)   selected, recurring monthly payments will be incurred by you and you   will be billed accordingly.</p>
                <h2>GOVERNING LAW AND JURISDICTION</h2>
                <p>By accessing this website, you agree that all matters relating to   your access to and use of this website and/or its products shall be   governed by the statutes and laws of the State of California, without   regard to the conflict of laws principles thereof. The parties   specifically disclaim the U.N. Convention on Contracts for the   International Sale of Goods. You also agree and hereby submit to the   exclusive personal jurisdiction and venue of the state and federal   courts of Orange County, California with respect to any such matters   relating to your access or use of this website and/or its products.</p>
                <h2>INFORMATION DISCLOSURE</h2>
                <p>You may not disclose any order information including, but not limited to, Order ID, download link, etc.</p>
                <p>Our company reserves the right to change or modify the terms and conditions without prior notice.</p>
              </div>
            </li>
          </ul>
        </div>
		       
      </div> <input type="button" name="b2" value="paynow" class="confirmorder-btn f-right mt15" onClick="return chkvalid()";/>
      <script type="text/javascript" charset="utf-8">
			$(document).ready(function(){ 
				
				$(".gallery a[rel^='prettyPhoto']").prettyPhoto(); 
		
				 
			});
			</script>
    </form>
  </div>
  <!-- #content -->
</div>
<!-- #primary -->
<?php get_footer(); ?>
