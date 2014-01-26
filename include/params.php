<?php

/*
 * This PHP file has functions in generating and validating parameters
 * and Hash codes for reduced risk of code injection 
 * 
 * Based on the codes in topic and concepts 5.5.2 HMAC Verification and 5.5.3 PEAR::Crypt_HMAC 
 * of PHP 5 Power Programming by Andi Gutmans, Stig Sæther Bakken, and Derick Rethans
 */
require_once('crypt.php');

define("SECRET","51d2pr3jr4urb5last"); 


function create_parameters($array) //Generates parameters including hash code
{
$data = '';
$ret = array();
foreach ($array as $key => $value) {
    $data .= $key . $value;
    $ret[] = "$key=$value";
}

$h = new Crypt(SECRET, 'md5');
$hash = $h->hash($data);
$ret[] = "hash=$hash";
return join ('&amp;', $ret);
}

function verify_parameters($array) //parameter verification
{
$data = '';
$ret = array();
$hash = $array['hash'];

unset ($array['hash']);

foreach ($array as $key => $value) {
$data .= $key . $value;
$ret[] = "$key=$value";
}
$h = new Crypt(SECRET, 'md5');
if ($hash != $h->hash($data)) {
return FALSE;
} else {
return TRUE;
}
}

?>