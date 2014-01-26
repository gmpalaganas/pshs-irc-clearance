<?php
/*
 * Crypt Class
 * 
 * This class is used to create Hash Codes for a set of parameters
 * to reduce the risk of code injection
 * 
 * Based on the codes  and concepts in topic 5.5.2 HMAC Verification and 5.5.3 PEAR::Crypt_HMAC 
 * of PHP 5 Power Programming by Andi Gutmans, Stig Sæther Bakken, and Derick Rethans
 * 
 * 
 */

class Crypt {

function __construct($key) 
{

//The encryption language
$this->_hash = "md5";

//If length of key is greater than 64 bytes hash then pad to 64 bytes
if (strlen($key) > 64) {
$key = pack('H32', md5($key));
}

//If lenght of key is less than 64 bytes pad to 64 bytes
if (strlen($key) < 64) {
$key = str_pad($key, 64, chr(0));
}

//inner hash
$this->_ipad = substr($key, 0, 64) ^ str_repeat(chr(0x36),64);

//outer hash
$this->_opad = substr($key, 0, 64) ^ str_repeat(chr(0x5C),64);
}

function hash($data)
{
$hash = $this->_hash;
$inner = pack('H32', $hash($this->_ipad . $data));
$digest = $hash($this->_opad . $inner);
return $digest;
}
}

?>
