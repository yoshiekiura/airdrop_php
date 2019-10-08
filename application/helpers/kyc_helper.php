<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('getKYCTextWithId')) {

    define("KYC_ITEMS", array(
        "first_name",
        "second_name",
        "gender",
        "birth",
        "phone",
        // "country",
        // "country_code",
		"address",
    ));

    define("PROOF_TYPES", array(
        "identity" => array(
            "passport" => "Passport",
            "identity_card" => "Identity Card",
            "driving_license" => "Driving License"
        ),
        "address" => array(
            "passport" => "Secure Receipt",
            "rent" => "Rent",
            "bank_statement" => "Bank Statement",
            "water_receipt" => "Water Receipt",
            "electricity_bill" => "Electricity Bill",
            "gas_bill" => "Gas Bill"
        ),
        "selfie" => "Selfie Photo"
    ));

    function getKYCTextWithId($id) {
        return PROOF_TYPES [$id]["text"];
    }
}
