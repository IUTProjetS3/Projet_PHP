<?php

class Security{
	public static function getRandomHex($nbBytes){
		$numbytes = $nbBytes; // Because 32 digits hexadecimal = 16 bytes
        $bytes = openssl_random_pseudo_bytes($numbytes);
        return bin2hex($bytes);
	}
}