<?php

include_once(dirname(__FILE__).'/CatalogFormula.php');
include_once(dirname(__FILE__).'/BrochureFormula.php');
include_once(dirname(__FILE__).'/BookletFormula.php');
//include_once(dirname(__FILE__).'/LeafletFormula.php');

class Calc {
    
    const CatalogFormula = 0;
    const BrochureFormula = 1;
    const BookletFormula = 2;
    const LeafletFormula = 3;
    
    public static function calculatePrice($chosen, $circulation, $formula_to_use) {
        $cost;
        $circulation = str_replace(",", "", $circulation);
        if ($formula_to_use == Calc::BookletFormula) {
            $format = $chosen["Booklet - Format"];
            $printer = "mediaprint";

            $binding = $chosen["Booklet - Type of Binding"];

            $colorsI = $chosen["Booklet - Colors Inside"];
            $pagesI = $chosen["Booklet - Pages Inside"];
            $paperI = $chosen["Booklet - Paper Inside"];
            $special = $chosen["Booklet - Special for Cover"];


            $calc = new BookletFormula($format, $printer, $binding, $colorsI, $pagesI, $paperI/1000, $special);
            $calc->colorsCover = $chosen["Booklet - Colors of Cover"];
            $calc->pagesCover = $chosen["Booklet - Pages of Cover"];
            $calc->paperCover = $chosen["Booklet - Paper of Cover"]/1000;//(150/1000);
            $cost = $calc->cost($circulation);
            
            $cost = Calc::postPrice($cost);
        } else if ($formula_to_use == Calc::CatalogFormula) {
            
            $calc = new CatalogFormula();
            $cost = $calc->cost($circulation, $chosen);
        } else if ($formula_to_use == Calc::BrochureFormula) {

            $calc = new BrochureFormula();
            $cost = $calc->cost($circulation, $chosen);
        } else if ($formula_to_use == Calc::LeafletFormula) {

        }
        
        return $cost;
    }
    
    public static function postPrice($cost) {
        $surcharge = 1.2;
        $currency_rate_for_lira_to_euro = 1936.27;
        $price = ($cost/$currency_rate_for_lira_to_euro) * $surcharge;
        
        return $price;
    }
}