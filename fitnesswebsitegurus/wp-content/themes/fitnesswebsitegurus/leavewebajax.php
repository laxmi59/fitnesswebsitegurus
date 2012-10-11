<?php
require_once('/home/fitnesswebsitegurus/merchant/class.merchant.php');
require_once('/home/fitnesswebsitegurus/merchant/class.phpmailer.php');
$link = mysql_connect('localhost', 'fitnesswebsitegurus', 'fwgSufj8fF#');
$db_selected = mysql_select_db('fitnesswebsitegurus', $link);
mysql_query("insert into `contact_users` (`email`, `contact_after`, `date`) values ('".$_POST['email']."', ".$_POST['popselect'].",now())");
?>