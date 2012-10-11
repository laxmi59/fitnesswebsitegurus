<?php
/**************
 *  Reason Codes
 *  1 => Accepted
 *  2 => Declined
 *  3 => There has been an error processing this transaction
 *  4 => Transaction held for review
 */
class Merchant {
    private $api_login_id = '8X54Whgb';
    private $api_transaction_key = '94235fan28BaqVHB';
    private $test_api_login_id = '7B5z3cPX';
    private $test_api_transaction_key = '4YEH22v2V9e9qrHK';
    #private $api_post_url = 'https://test.authorize.net/gateway/transact.dll'; //test
    private $api_post_url = 'https://secure.authorize.net/gateway/transact.dll'; //live
    private $xml_post_url = 'https://api.authorize.net/xml/v1/request.api';
    private $test_xml_post_url = 'https://apitest.authorize.net/xml/v1/request.api';
    function send($card_num,$exp_date,$amount,$description,$first_name,$last_name,$address,$state,$zip) {
        $post_values = array(
            'x_login'           =>  $this->api_login_id,
            'x_tran_key'        =>  $this->api_transaction_key,
            'x_version'         =>  '3.1',
            'x_delim_data'      =>  'TRUE',
            'x_delim_char'		=>  '|',
            'x_relay_response'	=>  'FALSE',
            'x_type'			=>  'AUTH_CAPTURE',
            'x_method'			=>  'CC',
            'x_card_num'		=>  $card_num,
            'x_exp_date'		=>  $exp_date,
            'x_amount'			=>  $amount,
            'x_description'		=>  $description,
            'x_first_name'		=>  $first_name,
            'x_last_name'		=>  $last_name,
            'x_address'			=>  $address,
            'x_state'			=> $state,
            'x_zip'				=> $zip);
        foreach( $post_values as $key => $value ) { $post_string .= "$key=" . urlencode( $value ) . "&";}
        $post_string = rtrim( $post_string, "& " );
        $r = curl_init($this->api_post_url);
        curl_setopt($r,CURLOPT_HEADER,0);
        curl_setopt($r,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($r,CURLOPT_POSTFIELDS,$post_string);
        curl_setopt($r,CURLOPT_SSL_VERIFYPEER,FALSE);
        $response = curl_exec($r);
        curl_close($r);
        $r_array = explode('|',$response);
        $r_data = array('Reason Code'           =>  $r_array[0],
                        'Response Reason Code'  =>  $r_array[2],
                        'Response  Message'     =>  $r_array[3],
                        'Transaction ID'        =>  $r_array[37]);
        return $r_data;
    }
    function sendARB($reference_id,$sub_name,$sub_length,$sub_unit,$sub_start,$sub_total_occurences,$sub_trial_occurences,$sub_amount,$sub_trial_amount,$card_num,$exp_date,$card_code,$first_name,$last_name,$address,$city,$state,$zip) {
        $content =
        '<?xml version=\'1.0\' encoding=\'utf-8\'?>' .
        '<ARBCreateSubscriptionRequest xmlns=\'AnetApi/xml/v1/schema/AnetApiSchema.xsd\'>' .
            '<merchantAuthentication>'.
                '<name>' . $this->api_login_id . '</name>'.
                '<transactionKey>' . $this->api_transaction_key . '</transactionKey>'.
            '</merchantAuthentication>'.
            '<refId>' . $reference_id . '</refId>'.
            '<subscription>'.
                '<name>' . $sub_name . '</name>'.
                    '<paymentSchedule>'.
                    '<interval>'.
                        '<length>'. $sub_length . '</length>'.
                        '<unit>'. $sub_unit . '</unit>'.
                    '</interval>'.
                    '<startDate>' . $sub_start . '</startDate>'.
                    '<totalOccurrences>'. $sub_total_occurences . '</totalOccurrences>'.
                    /*'<trialOccurrences>'. $sub_trial_occurences . '</trialOccurrences>'.*/
                '</paymentSchedule>'.
                '<amount>'. $sub_amount .'</amount>'.
                /*'<trialAmount>' . $sub_trial_amount . '</trialAmount>'.*/
                '<payment>'.
                    '<creditCard>'.
                        '<cardNumber>' . $card_num . '</cardNumber>'.
                        '<expirationDate>' . $exp_date . '</expirationDate>'.
                        '<cardCode>' . $card_code . '</cardCode>'.  
                    '</creditCard>'.
                '</payment>'.
                '<billTo>'.
                    '<firstName>' . $first_name . '</firstName>'.
                    '<lastName>' . $last_name . '</lastName>'.
                    '<address>' . $address . '</address>'.
                    '<city>' . $city . '</city>'.
                    '<state>' . $state . '</state>'.
                    '<zip>' . $zip . '</zip>'.
                '</billTo>'.
            '</subscription>'.
        '</ARBCreateSubscriptionRequest>';
	   $ch = curl_init();
	   curl_setopt($ch, CURLOPT_URL, $this->xml_post_url);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
	   curl_setopt($ch, CURLOPT_HEADER, 0);
	   curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
	   curl_setopt($ch, CURLOPT_POST, 1);
	   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	   $response = curl_exec($ch);
       $xml =  simplexml_load_string($response);
       $results = array('Result Code'   =>  $xml->messages->resultCode[0],
                        'Response Code' =>  $xml->messages->message->code[0],
                        'Response Text' =>  $xml->messages->message->text[0]);
        foreach($results AS $key => $value) {
            $r[$key] = (string) $value;
        }
        #good return Array ( [Result Code] => Ok [Response Code] => I00001 [Response Text] => Successful. ) 
        return ($r);
        
    }
}
?>