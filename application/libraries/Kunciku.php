<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kunciku
{
    var $ci;
    function __construct()
    {
        $this->ci =& get_instance();
		$this->navbar_menu = array();
    }
    public function enc($message) 
	{
		$kunci = $this->ci->config->item('encryption_key');
		$key = md5($kunci);
		
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
		$message_padded = mr_pad_with_zeros($message);
		$encrypted = openssl_encrypt($message_padded,'AES-256-CBC',$key,OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,$iv);
		return $iv.$encrypted;
	}
	
	public function dec($message) 
	{
		$kunci = $this->ci->config->item('encryption_key');
		$key = md5($kunci);
		
		$iv = substr($message,0,openssl_cipher_iv_length('AES-256-CBC'));
		$encrypted = substr($message,openssl_cipher_iv_length('AES-256-CBC'),strlen($message)-openssl_cipher_iv_length('AES-256-CBC'));
		$decrypted = openssl_decrypt($encrypted,'AES-256-CBC',$key,OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,$iv);
		return TRIM($decrypted);
	}
}