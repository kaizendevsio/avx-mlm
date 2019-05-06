<?php
//AUTOLOAD HEADERS
header('Access-Control-Allow-Origin: *');
//error_reporting(0);

// AUTOLOAD VARIABLES
date_default_timezone_set("Asia/Manila");
$_date=date("Y-m-d");
$_datetime=date("Y-m-d H:i:s");
$_time=date("H:i:s");


//AUTO LOAD CONTROLLER MODULE
$controllers = new controllers($pdo);

//AUTOLOAD FUNCTIONS

 function generateRandomString($length) {
     if (isset($length) == false)
     {
         $length = 10;
     }
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

 function cleanString($string) {

     if (isset($string))
     {
         // $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
         return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     }


 }

 function isInteger($input){
     return(ctype_digit(strval($input)));
 }

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

 $ipaddress_data  = get_client_ip();
?>