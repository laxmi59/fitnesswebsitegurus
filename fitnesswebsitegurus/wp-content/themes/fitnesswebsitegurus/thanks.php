<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

/**
* Template Name: 	Thanks
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
extract($_POST);
require("phpmailer.inc.php");
$link = mysql_connect('localhost', 'fitnesswebsitegurus', 'fwgSufj8fF#');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('fitnesswebsitegurus');
$phonenumber=$pp1."-".$pp2."-".$pp3;
$sql="insert into wp_traffic_contacts(cname,email,phonenumber) values('$FirstName','$Email','$phonenumber')";
mysql_query($sql) or die(mysql_error());
?>
<?php 
if(trim($FirstName) != "" && trim($Email) != "") 
{
	$mail = new phpmailer;
	try {
	$mail->From = 'info@fitnesswebsitegurus.com';
	$mail->FromName = 'FitnessWebsiteGurus';
	$mail->AddAddress("brad@masterinternetgroup.com", "Brad");
	$mail->AddAddress("wayden@masterinternetgroup.com","Wayden");   // name is optional
	#$mail->AddAddress("shekar.palle@gmail.com","shekar");   // name is optional
	$body="<table>
	<tr><td colspan='5'>New FitnessWebsiteGurus.com Traffic Lead</td></tr>
	<tr><td>Name</td><td>:</td><td>".$FirstName."</td></tr>
	<tr><td>Email</td><td>:</td><td>".$Email."</td></tr>
	<tr><td>Phone</td><td>:</td><td>".$pp1."-".$pp2."-".$pp3."</td></tr>
	<tr><td>IP Address</td><td>:</td><td>".$_SERVER['REMOTE_ADDR']."</td></tr>
	</table>";
	$mail->IsHTML(true);    // set email format to HTML
	$mail->Subject = "FitnessWebsiteGurus.com Traffic Lead";
	$mail->Body = $body;
	$mail->Send(); // send message
	#echo "mail sent";

	} catch (phpmailerException $e) {
	  echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
	  echo $e->getMessage(); //Boring error messages from anything else!
	}
}
?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<?php the_content(); ?>
<?php endwhile; endif; ?>
