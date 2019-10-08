<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('getBankValueWithKey')) {

    define("BANK_TRANSFER_ITEMS", array(
        "username" => "User Name",
        "full_name" => "Full name",
        "country" => "Country",
        "email" => "Email",
        "transfer_date" => "Date of transfer",
        "bank" => "Bank",
        "origin_account" => "No.account of origin",
        "destination_account" => "Destination account number",
        "amount" => "Amount",
        "currency" => "Payment currency",
    ));

    define("COMPANY_BANK_ACCOUNTS", array(
        "United Kingdom" => array(
            "Branch code (UK Sort Code)  " => "23-14-70 ",
            "Account number" => "48775631",
            "Account Holder" => "Socialremit Blockchain Networks Ltd ",
            "Address" => "TransferWise<br>
                            56 Shoreditch High Street<br>
                            El 6JJ<br>
                            London<br>
                            United Kingdom"
        ),
        "United States" => array(
            "Wire route number" => "026073008 ",
            "ACH route number" => "026073150 ",
            "Account number" => "8310049149  ",
            "Account Holder" => "Socialremit Blockchain Networks Ltd ",
            "Address" => "TransferWise<br>
                            19 W 24th Street <br>
                            10010<br>
                            New York<br>
                            United States"
        ),
        "Australia" => array(
            "C6digo BSB " => "082-182",
            "Nümero de cuenta " => "811929995",
            "Account Holder" => "Socialremit Blockchain Networks Ltd ",
            "Address" => "TransferWise<br>
                            800 Bourke Street<br>
                            Melbourne VIC 3008<br>
                            Australia"
        ),
        "Germany" => array(
            "Code Bank(SWIFT / BIC)" => "DEKTDE7GXXX",
            "IBAN" => "DE13 7001 1110 6050 7877 60",
            "Account holder TW " => "Socialremit Blockchain Networks Ltd ",
            "Address" => "Handelsbank <br>
                            Elsenheimer Str. 41 <br>
                            80687<br>
                            München<br>
                            Germany"
        ),
        "Iran" => array(
            "Bank" => "Tejerat Bank - IRAN",
            "Account number" => "IR76 0180 0000 0000 0194 4350 29",
            "Account holder" => "HOSSEIN HOSSEINI",
        ),
    ));

    function getBankValueWithKey($id) {
        return BANK_ITEMS [$id];
    }
}
