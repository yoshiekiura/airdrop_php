<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('hasPermission')) {

    define("ADMIN_ROLE_NAMES", array(
        1 => "System Admin", //You can see everything
        3 => "Validation Team", //Only Menu Submits, menu customers and MLM Report
        4 => "Economic Team", //Airdrop payment, airdrop transaction and ICO transaction
        5 => "Customer Manager", //You can see everything
    ));

    define("ADMIN_ROLES", array(
        'sys_admin' => 1,
        'validation_team' => 3,
        'economic_team' => 4,
        'customer_manager' => 5,
    ));

    function hasPermission($query, $userInfo) {
        return ADMIN_ROLES[$query] && ADMIN_ROLES[$query] == $userInfo->role_id;
    }

    function hasPermissionInArray($queries, $userInfo) {
        foreach($queries as $query){
            if(hasPermission($query, $userInfo))    return true;
        }
        return false;
    }

    function getRoleNameByID($role_id){
        return ADMIN_ROLE_NAMES[$role_id];
    }

    function getRoleName($str){
        if(ADMIN_ROLES[$str])
            return ADMIN_ROLE_NAMES[ADMIN_ROLES[$str]];
        return "";
    }
}
