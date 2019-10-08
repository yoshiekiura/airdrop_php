<?php
/*@!$*/
class Validate extends ValidateCore
{

    //Because isNegativePrice doesn't consider very small numbers to be valid prices....
    //I think it's because $price's conversion to a string makes it a number in scientific notation
    //for numbers with lots of decimal places. And, ofcourse, the preg_match below doesn't match for
    //numbers in scientific notation
    //Number format is to make sure the $price only has 9 decimal places. If it has more then the
    //preg_match returns false/0

    public static function isNegativePrice($price)
    {
        return preg_match('/^[-]?[0-9]{1,10}(\.[0-9]{1,9})?$/', Validate::convertFloat((number_format($price, 9))));
    }

    //Makes strings for numbers that would usually be expressed in scientific notation if using
    //strval or casting with (string)
    protected static function convertFloat($floatAsString)
    {
        $norm = strval(floatval($floatAsString));

        if (($e = strrchr($norm, 'E')) === false) {
            return $norm;
        }

        return number_format($norm, -intval(substr($e, 1)));
    }
}