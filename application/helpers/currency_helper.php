<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('getCurrencyFullnameFromInitials')) {

    define("CURRENCIES", array(
        'EUR'=>array('full_name'=>'Euro', 'symbol'=>'X',),
        'USD'=>array('full_name'=>'USA Dollar', 'symbol'=>'X',),
        'GBP'=>array('full_name'=>'Great Britain Pound', 'symbol'=>'X',),
        'CHF'=>array('full_name'=>'Switzerland Franc', 'symbol'=>'X',),
        'RUB'=>array('full_name'=>'Russia Rouble', 'symbol'=>'X',),
        'CNY'=>array('full_name'=>'China Yuan', 'symbol'=>'X',),
        'JPY'=>array('full_name'=>'Japan Yen', 'symbol'=>'X',),
        'IRR'=>array('full_name'=>'Iran Rial', 'symbol'=>'X',),
        'INR'=>array('full_name'=>'India Rupee', 'symbol'=>'X',),
        'MXN'=>array('full_name'=>'Mexico Peso', 'symbol'=>'X',),
        'VES'=>array('full_name'=>'Venezuelan Bolívar', 'symbol'=>'X',),
    ));

    function getCurrencyFullnameFromInitials($key) {
        return CURRENCIES [$key];
    }
}
