<?php

require_once('class.merchant.php');

$card_num       =   '4222222222222';
$exp_date       =   '0413';
$amount         =   '10.00';
$description    =   '19.99 A Month Package';
$first_name     =   'Testero';
$last_name      =   'Testingson';
$address        =   '123 Main St.';
$city           =   'Lake Forest';
$state          =   'CA';
$zip            =   '92630';


$M = new Merchant;
?>
<pre>
<?php
$response = $M->send($card_num,$exp_date,$amount,$description,$first_name,$last_name,$address,$city,$state,$zip);
print_r($response);
?>
</pre>