<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms {
	/*http://sms2.cantech.in/api/api_http.php?
username=nityams&password=secret&senderid=ANIRUB&to=8800830084&
text=Hello%20world&route=Transactional&type=text&datetime=2016-09-22%2013%3A42%3A28*/

    var $username = 'nityams';
    var $password = 'cantech@2016';
    var $sender_id = 'ANIRUB';
    var $mobile_no, $message;

    function send($to, $msg){
        $url = 'http://sms2.cantech.in/api/api_http.php?username='.$this -> username.'&password='.$this -> password.'&senderid=ANIRUB&to='.$to.'&text='.urlencode($msg).'&route=Transactional&type=text&datetime='.date('Y-m-d H:i:s');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec ($ch);
        curl_close ($ch);
    }
}