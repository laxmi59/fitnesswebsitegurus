<?php

/**
 * @author 
 * @copyright 2012
 */

require_once('class.merchant.php');

$reference_id           =   '123123123';
$sub_name               =   '19.99 Hosting';
$sub_length             =   '1';
$sub_unit               =   'months';
$sub_start              =   date('Y-m-d');
$sub_total_occurences   =   '9999';
$sub_trial_occurences   =   '0';
$sub_amount             =   '1.00';
$sub_trial_amount       =   '0';
$card_num       =   '';
$exp_date       =   '';
$card_code      =   '';
$first_name     =   '';
$last_name      =   '';
$address        =   '';
$state          =   '';
$zip            =   '';

$M = new Merchant;
$M->sendARB($reference_id,$sub_name,$sub_length,$sub_unit,$sub_start,$sub_total_occurences,$sub_trial_occurences,$sub_amount,$sub_trial_amount,$card_num,$exp_date,$card_code,$first_name,$last_name,$address,$city,$state,$zip);

?>