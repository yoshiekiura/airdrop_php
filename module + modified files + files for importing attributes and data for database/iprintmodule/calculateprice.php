<?php

include_once(dirname(__FILE__).'/calc.php');
//include_once(dirname(__FILE__).'/calc.php');
//include_once(_PS_MODULE_DIR_.'iprintmodule/iprintmodule.php');
//include(dirname(__FILE__).'/iprintmodule.php');
$varrr = _PS_MODULE_DIR_.'/iprintmodule/iprintmodule.php';
$vafaef = _PS_MODULE_DIR_;
$gjkls = __FILE__;
$falg = dirname(__FILE__);
$gags = dirname(__FILE__).'/iprintmodule.php';
//Get product id then get product instance then get calc type
//$parts = parse_url($_SERVER["QUERY_STRING"]);
//parse_str($parts["path"], $query);
//$circulation = (float) str_replace(',', '', $_GET["circulation"]);//5000;//$query["circ"];
/*$format = $_GET["Format"];//"A4";//$query['format'];
$printer = "mediaprint";//$query['printer'];

$binding = $_GET["Type_of_Binding"];

//$binding = "mc";//$query['binding'];
$colorsI = $_GET["Colors_Inside"];//1;//$query['colorsI'];
$pagesI = $_GET["Booklet_-_Pages_Inside"];//4;//$query['pagesI'];
$paperI = $_GET["Paper_Inside"];//0;//$query['paperI'];
$special = $_GET["Special_for_Cover"];//2;//$query['special'];


$calc = new Calc($format, $printer, $binding, $colorsI, $pagesI, $paperI/1000, $special);
$calc->colorsCover = $_GET["Colors_of_Cover"];
$calc->pagesCover = $_GET["Pages_of_Cover"];
$calc->paperCover = $_GET["Paper_of_Cover"]/1000;//(150/1000);
$cost = $calc->cost($circulation);
$surcharge = 1.2;
$currency_rate_for_lira_to_euro = 1936.27;
$final_cost = ($cost/$currency_rate_for_lira_to_euro) * $surcharge;

$returned_data["price"] = $final_cost;
echo json_encode($returned_data);*/

$formula_to_use = $_GET["formula_to_use"];
$productInstance = new Product($_GET["product_id"]);

$circulation = $_GET[str_replace(" ", "_" ,$productInstance->custom_quantity_attribute_name)];

if ($formula_to_use == Calc::BookletFormula) {
    $chosen["Booklet - Format"] = $_GET["Booklet_-_Format"];
    $chosen["Booklet - Type of Binding"] = $_GET["Booklet_-_Type_of_Binding"];
    $chosen["Booklet - Colors Inside"] = $_GET["Booklet_-_Colors_Inside"];
    $chosen["Booklet - Pages Inside"] = $_GET["Booklet_-_Pages_Inside"];
    $chosen["Booklet - Paper Inside"] = $_GET["Booklet_-_Paper_Inside"];
    $chosen["Booklet - Special for Cover"] = $_GET["Booklet_-_Special_for_Cover"];
    $chosen["Booklet - Colors of Cover"] = $_GET["Booklet_-_Colors_of_Cover"];
    $chosen["Booklet - Pages of Cover"] = $_GET["Booklet_-_Pages_of_Cover"];
    $chosen["Booklet - Paper of Cover"] = $_GET["Booklet_-_Paper_of_Cover"];
    
} else if ($formula_to_use == Calc::CatalogFormula) {
    $chosen["Catalog - Size"] = $_GET["Catalog_-_Size"]; 
    $chosen["Catalog - Number of Pages"] = $_GET["Catalog_-_Number_of_Pages"];
    $chosen["Catalog - Cover Paper"] = $_GET["Catalog_-_Cover_Paper"];
    $chosen["Catalog - Inside Pages Color"] = $_GET["Catalog_-_Inside_Pages_Color"];
    $chosen["Catalog - Inside Pages Paper"] = $_GET["Catalog_-_Inside_Pages_Paper"];
    $chosen["Catalog - Binding"] = $_GET["Catalog_-_Binding"];
    $chosen["Catalog - Production Turnaround"] = $_GET["Catalog_-_Production_Turnaround"];
    $chosen["Catalog - Proofing"] = $_GET["Catalog_-_Proofing"];
    $chosen["Catalog - Quantity"] = $_GET["Catalog_-_Quantity"];
    $chosen["Catalog - Three-Hole Punch"] = $_GET["Catalog_-_Three-Hole_Punch"];
}  else if ($formula_to_use == Calc::BrochureFormula) {
    $chosen["Brochure - Size"] = $_GET["Brochure_-_Size"];
    $chosen["Brochure - Color"] = $_GET["Brochure_-_Color"];
    $chosen["Brochure - Paper"] = $_GET["Brochure_-_Paper"];
    $chosen["Brochure - Hole Drilling"] = $_GET["Brochure_-_Hole_Drilling"];
    $chosen["Brochure - Perforation"] = $_GET["Brochure_-_Perforation"];
    $chosen["Brochure - Folding"] = $_GET["Brochure_-_Folding"];
    $chosen["Brochure - Proof"] = $_GET["Brochure_-_Proof"];
    $chosen["Brochure - Quantity"] = $_GET["Brochure_-_Quantity"];
    $chosen["Brochure - Production Turnaround"] = $_GET["Brochure_-_Production_Turnaround"];
}


$cost = Calc::calculatePrice($chosen, $circulation, $formula_to_use);

$returned_data["price"] = $cost;

echo json_encode($returned_data);