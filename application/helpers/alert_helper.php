<?php

/**
 * -------------------------------------------------------------------
 * Developed and maintained by Zaman
 * -------------------------------------------------------------------
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('message_box')) {

    function message_box($message_type, $close_button = TRUE) {
        $CI = & get_instance();
        $message = $CI->session->flashdata($message_type);
        $retval = '';

        if ($message) {
            switch ($message_type) {
                case 'success':
                    $retval = '<script type="text/JavaScript">$(document).ready(function () {'
                            . 'toastr.success("' . $message . '");});</script>';
                    break;
                case 'error':
                    $retval = '<script type="text/JavaScript">$(document).ready(function () {'
                            . 'toastr.error("' . $message . '");});</script>';
                    break;
                case 'info':
                    $retval = '<script type="text/JavaScript">$(document).ready(function () {'
                            . 'toastr.info("' . $message . '");});</script>';
                    break;
                case 'warning':
                    $retval = '<script type="text/JavaScript">$(document).ready(function () {'
                            . 'toastr.warning("' . $message . '");});</script>';
                    break;
            }
            return $retval;
        }
    }
}

if (!function_exists('message_box_new')) {

    function message_box_new($message_type, $close_button = TRUE) {
        $CI = & get_instance();
        $message = $CI->session->flashdata($message_type);
        $retval = '';

        if ($message) {
            $retval = '<script type="text/JavaScript">$(document).ready(function () {';
            switch ($message_type) {
                case 'success':
                    $retval .= "$.toast({
                        heading: 'Success',
                        text: \"".$message."\",
                        position: 'bottom-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 15000,
                        stack: 6
                    });";
                    break;
                case 'error':
                    $retval .= "$.toast({
                        heading: 'Error',
                        text: \"$message\",
                        position: 'bottom-right',
                        loaderBg: '#ff6849',
                        icon: 'warning',
                        hideAfter: 15000,
                        stack: 6
                    });";
                    break;
                case 'info':
                    $retval .= "$.toast({
                        heading: 'Error',
                        text: \"$message\",
                        position: 'bottom-right',
                        loaderBg: '#ff6849',
                        icon: 'info',
                        hideAfter: 15000,
                        stack: 6
                    });";
                    break;
                case 'warning':
                    $retval .= "$.toast({
                        heading: 'Error',
                        text: \"$message\",
                        position: 'bottom-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 15000,
                        stack: 6
                    });";
                    break;
            }
            $retval .= '});</script>';
            return $retval;
        }
    }
}

if (!function_exists('set_message')) {

    function set_message($type, $message) {
        $CI = & get_instance();
        $CI->session->set_flashdata($type, $message);
    }

}