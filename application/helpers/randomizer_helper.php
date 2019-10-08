<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('generate_rand_string')) {
     function generate_rand_string($length) {
        $password = "";
        $arr = array(
        'A', 'B', 'C', 'D',
        'E', 'F', 'G', 'H', 'I', 'J',
        'K', 'L', 'M', 'N', 'O', 'P',
        'Q', 'R', 'S', 'T', 'U', 'V',
        'W', 'X', 'Y', 'Z', '1', '2',
        '3', '4', '5', '6', '7', '8',
        '9', '0'
        );
        for ($i = 0; $i < $length; $i++)
        $password .= $arr[mt_rand(0, count($arr) - 1)];
        return $password;
    }
}
