<?php
require_once('/home/fitnesswebsitegurus/merchant/class.merchant.php');
require_once('/home/fitnesswebsitegurus/merchant/class.phpmailer.php');
$link = mysql_connect('localhost', 'fitnesswebsitegurus', 'fwgSufj8fF#');
$db_selected = mysql_select_db('fitnesswebsitegurus', $link);

//print_r($_POST);
//NPTIFREESTARTUP
//$num=mysql_num_rows(mysql_query("select * from `promo_codes`  where promo_code ='".$_POST['promo']."'"));
$num=mysql_num_rows(mysql_query("SELECT *  FROM `promo_codes` WHERE BINARY `promo_code` = '".$_POST['promo']."'"));

echo $num;
?>