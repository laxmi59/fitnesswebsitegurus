<?php
/**
 * Template Name: 	Apps
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

function randomPrefix($length)
{
$random= "";

srand((double)microtime()*1000000);

$data = "AbcDE123IJKLMN67QRSTUVWXYZ";
$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
$data .= "0FGH45OP89";

for($i = 0; $i < $length; $i++)
{
$random .= substr($data, (rand()%(strlen($data))), 1);
}

return $random;
}
$array_subs_amounts= array("1"=>"39.99","2"=>"59.99","3"=>"79.99");

 extract($_POST);
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
	$phone_number = $phone1."-".$phone2."-".$phone3;
	$inv_code = randomPrefix(10);
	#$nameoncard = explode(" ",$first_name);
	$error_message="";

	if($pkg_type == 1)
		$sub_name ='Bronze Package';
	else if($pkg_type == 2)
		$sub_name ='Silver Package';
	else if($pkg_type == 3)
		$sub_name ='Gold Package';
	$payment_success=0;

	

	if(trim($submit_type) == 1)
	 {
		$ins_sql="INSERT INTO idea_world_users(pkg_type,first_name,last_name,email,bill_address1,bill_address2,city,state,zipcode,phone_number,country,created_date,is_pay_later,	invitation_code) VALUES ('$pkg_type','$first_name','$last_name','$email','$st_address1','$st_address2','$city','$state','$zipcode','$phone_number','$country',now(),1,'$inv_code')";
		mysql_query($ins_sql) or die("Error".$ins_sql.mysql_error());

		$inv_sql = "INSERT INTO invitations(code,email,dt_created,pkg_type,is_pay_later) VALUE ('$inv_code','$email',now(),'$pkg_type',1)";
		mysql_db_query('mfwg',$inv_sql) or die(mysql_error());

		$error_message="";
		$payment_success=1;
	 }
	 else if(trim($submit_type) == 2)
	 {
		$reference_id           =   $first_name[0].$last_name[0].time();
		#$sub_name               =   '';
		$sub_length             =   '1';
		$sub_unit               =   'months';
		$sub_start              =   date('Y-m-d');
		$sub_total_occurences   =   '9999';
		$sub_trial_occurences   =   '0';
		//$sub_amount             =   '1.00';
		$sub_amount = $array_subs_amounts[$pkg_type];
		$sub_trial_amount       =   '0';
		
		$cardExpMonth=substr($cc_exp_date,0,2);
        $cardExpYear=substr($cc_exp_year,2,4);
        $exp_date=$cardExpMonth."-".$cardExpYear;


		$M = new Merchant;
		$pay_result = $M->sendARB($reference_id,$sub_name,$sub_length,$sub_unit,$sub_start,$sub_total_occurences,$sub_trial_occurences,$sub_amount,$sub_trial_amount,$cc_card_num,$exp_date,$cc_vcode,$first_name,$last_name,$st_address1." ".$st_address2,$city,$state,$zipcode);
		
		if($pay_result['Response Code'] == "I00001" && strtolower($pay_result['Result Code']) == "ok")
		 {
			$ins_sql="INSERT INTO idea_world_users (pkg_type,first_name,last_name,email,bill_address1,bill_address2,city,state,zipcode,phone_number,country,created_date,is_pay_later,	invitation_code,reference_id) VALUES ('$pkg_type','$first_name','$last_name','$email','$st_address1','$st_address2','$city','$state','$zipcode','$phone_number','$country',now(),0,'$inv_code','$reference_id')";
			mysql_query($ins_sql) or die(mysql_error());
			$inv_sql = "INSERT INTO invitations(code,email,dt_created,pkg_type,is_pay_later) VALUE ('$inv_code','$email',now(),'$pkg_type',0)";
			mysql_db_query('mfwg',$inv_sql) or die(mysql_error());
			$payment_success=1;
		 }
		 else
			 $error_message = $pay_result['Response Text'];
	
	 }

	if(trim($error_message) == "" && $email != "" && $payment_success == 1)
	 {
	    $email_filename = "merchant/email.html";
		if (file_exists($email_filename)) {
			$emailString = file_get_contents($email_filename);
			$emailString = str_replace('#FNAME#',$first_name,$emailString);
			$emailString = str_replace('#PACKAGE#',$sub_name,$emailString);
			$emailString = str_replace('#INV_CODE#',$inv_code,$emailString);
		}
		$mail = new PHPMailer();
		$mail->From = 'info@fitnesswebsitegrus.com';
		$mail->FromName = 'Fitness Website Gurus';

		$subject="Congratulations on selecting the ". $sub_name ." from Fitness Website Gurus!";
		$mail->Mailer = "mail";
		$body = wordwrap($emailString, 150);
		$mail->Body = stripslashes($emailString);
		$mail->Subject = stripslashes($subject);
		$mail->AddAddress($email);
		$mail->IsHTML(true);
		$mail->Send();
		$mail->ClearAddresses();

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
get_header(); ?>
<script type="text/javascript">
function chkvalid(bid) {
	
	document.orderform.submit_type.value=bid;
	if (!checkRadio("orderform","pkg_type"))
	{
		  alert("Please select package type");
		  document.orderform.pkg_type.focus();
		  return false;
	}
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

if(bid == 2)
{
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
	
}
	//return true;
	



	document.orderform.action="/idea-world/";
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
  <div id="content" role="main"  class="apps">
  <div class="gray-corner topLeft"></div>
<div class="gray-corner topRight"></div>
<div class="gray-corner bottomLeft"></div>
<div class="gray-corner bottomRight"></div>
 
    <?php while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?> 
	   <h1>  Overview</h1>
 <div class="sec"><img src="<?php bloginfo( 'template_url' ); ?>/images/apps-banner.png" class="" />   
	     <img src="<?php bloginfo( 'template_url' ); ?>/images/apps-pic1.png" class="f-right ml10 mtb20" /> 
		 <div class="mt50">
         <h2>fitness  website  gurus app  builder</h2>
       <div class="text"> 
	  The Fitness Website Gurus app team specializes in apps for iPhone, iPad, and iPod Touch. Our expert developers pay close attention to the current trends, but also aspire to start new ones by building on the practical aspects of successful past apps. Our app pros are second to none because they embrace both their technical and creative sides. The end results will amaze you!
	  </div>
	  </div>
	  </div>
   <div class="sec">  <img src="<?php bloginfo( 'template_url' ); ?>/images/apps-pic2.png" class="f-left mr10" />  
      <div class="mt50">    <h2>App Advantages/Features</h2> 
      <div class="text">
	
<ul>
  <li> Make it simple for existing and potential clients to reach you.</li>
  <li> Integrate checklists (for services offered, etc.) into your app as a reference <br />
    tool for existing and potential clients.</li>
  <li> Clients can store existing information (BMI, weight, etc.) into the app and <br />
    upload photographs as a way to track their progress.</li>
  <li> Introduction screen which will give the app a professional feel. The intro <br />
    screen is fully customizable -- you can include photos, areas of expertise, <br />
    contact information, logo, website, etc. </li>
</ul>  
</div>
</div>
</div>
  
  <div class="sec"> <img src="<?php bloginfo( 'template_url' ); ?>/images/apps-pic3.png" class="f-right ml10" />  
      <div class="text mt50">
	 
<ul>
  <li> List your locations and have separate screens for each location.</li>
  <li> Incorporate navigation into your app so clients can make their way to and <br />
  from your gym/training location.</li>
  <li> Include testimonials and/or photos in your app to show existing and potential <br />
  clients your work.</li>
  <li> Multiple languages available at the push of a button.</li>
  <li> Custom contact section -- current and prospective clients can contact you <br />
    right through your app. You can include push-button calling, direct texting, <br />
    location listings, and virtually anything else you can think of.
  </li>
</ul>  </div>
  </div>
	  <div class="clr"></div>
  
  <div class="sec">
   <h1>  Plans That Meet Your Needs</h1>
	 <img src="<?php bloginfo( 'template_url' ); ?>/images/apps-plans.png" class="mt20 " />  
     
  </div>
  </div>
  <!-- #content -->
</div>
<!-- #primary -->
<?php get_footer(); ?>
