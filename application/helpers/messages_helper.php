<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('messages_helper')) {
    function messages_helper() {
        $CI = & get_instance();
        $CI->load->helper('cookie');
        $CI->load->library('encryption');
        
		$CI->load->model('login_model');
        $CI->login_model->_table_name = "tbl_config"; 
        $CI->login_model->_order_by = "config_key";
        $result = $CI->login_model->get();
        foreach ($result as $row) {
            $CI->config->set_item($row->config_key, $row->value);
        }
    }
}