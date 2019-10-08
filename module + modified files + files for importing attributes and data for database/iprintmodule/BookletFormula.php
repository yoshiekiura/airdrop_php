<?php

include_once(dirname(__FILE__).'/../../config/config.inc.php');

//include(dirname(__FILE__).'/../../header.php');

class BookletFormula {
    protected $s_format, $s_printer, $s_binding;
    protected $i_colors, $i_pages, $i_type, $i_special;
    protected $d_paper, $d_area;
 //--public fields-------------------------------------------
    public $colorsCover=1;//4;
    public $pagesCover=0;//0;
    public $paperCover= 90;//0.2;
    public $tprintI, $tpaperI, $tprintC, $tpaperC, $tfold, $tclips, $tglue, $tsewing, $thardcover, $tspecial;           
//--public methods-------------------------------------------
    
    
    public function __construct($format, $printer, $binding, $colorsI, $pagesI, $paperI, $special) {
        $this->s_format = $format;
        $this->s_printer = $printer;
        $this->s_binding = $binding;
        $this->i_colors = $colorsI;
        $this->i_pages = $pagesI;
        $this->d_paper = $paperI;
        $this->i_special = $special;
        //$this->i_type = $type;
    }
    
    public function cost($circ) {
        /**Initialize variables to 0**/
        $this->tprintC = $this->tpaperC = $this->tfold = $this->tclips = 0;
        $this->tglue = $this->tsewing = $this->thardcover = $this->tspecial = 0;
        /** **/
        
        $this->tprintI = $this->costOfPrint($circ, $this->i_pages, $this->i_colors);
        $this->tpaperI = $this->costOfPaper($circ, $this->i_pages, $this->d_paper);
        
        if ($this->pagesCover == 0) {
            $price = $this->tprintI + $this->tpaperI;
            
            //$price = costOfPrint($circ, $this->i_pages, $this->i_colors, $this->d_paper); //hs version
        } else {
            $this->tprintC = $this->costOfPrint($circ, $this->pagesCover, $this->colorsCover) * 1.1;
            $this->tpaperC = $this->costOfPaper($circ, $this->pagesCover, $this->paperCover);
            $price = $this->tprintI + $this->tpaperI + ($this->tprintC)+($this->tpaperC);
        }
        
        if ($this->s_binding == "None") {
            $price += 0;
        } else {
            $price += $this->costOfBinding($circ, $this->i_pages, ($this->pagesCover == 0));
        }
        
        /*******
        $format = new Format($this->s_format);
        $modCir = $circ * $format.factor($pagesCover);
        
        $paper = new Paper($modCir, $this->s_printer);
        
        $numOfPrintedSides = format.numOfPrintedSheets($pagesCover);
        $totalArea = format.area() * $numOfPrintedSides;
        
        $this->d_area = $totalArea * $modCir;
        ******/
        
   
        if ($this->pagesCover == 0) {
            $area = $this->d_area;
        } else {
            $area = $this->d_area/2;
        }
        
        $special = new Special($area, $this->i_special, $this->s_printer);
        
        $this->tspecial = $special->cost();
        
        $price += $this->tspecial;
        
        $price += $this->costOfBundling($circ);
        $price += $this->costOfProof($circ);
        $price += $this->costOfProductionTurnaround($circ);
        
        return $price;
        
    }
    
    protected function costOfPrint($circ, $pages, $colors) {
        $format = new Format($this->s_format);
        $modCir = $circ * $format->factor($pages);
        
        $print = new PrintX($modCir, $colors, $this->s_printer);
        
        $numOfPrintedS = $format->numOfPrintedSheets($pages);
        $costOfPrint = $numOfPrintedS * $print->cost();
        
        return $costOfPrint;
    }
    
    protected function costOfPaper($circ, $pages, $paperCover) {
        $format = new Format($this->s_format);
        $modCir = $circ * $format->factor($pages);
       
        $paper = new Paper($modCir, $this->s_printer);
        
        $numOfPrintedSides = $format->numOfPrintedSheets($pages);
        $totalArea = $format->area() * $numOfPrintedSides;
        
        $this->d_area = $totalArea * $modCir;
        
        $costOfPaper = 0.5 * $totalArea * $paperCover * 
                (($numOfPrintedSides<2)? $paper->cost()+400000:$paper->cost());
        
        return $costOfPaper;
    }
    
    protected function costOfBinding($circ, $pages, $isCover) {
        $price = 0;
        
        $format = new Format($this->s_format);
        
        $numOfPrintedSheets = $format->numOfPrintedSheets($pages);
        
        $foldRun = ceil(($numOfPrintedSheets * $circ) / 2);
        
        $fold = new Fold($foldRun, $this->s_printer);
        $clips = new Clips($circ, $this->s_printer);
        $glue = new Glue ($circ, $this->s_printer);
        $sewing = new Sewing ($circ, $this->s_printer);
        
        $this->tfold = $fold->cost() * sqrt(($pages / $numOfPrintedSheets) / 4);
        $collectCoef = ceil($numOfPrintedSheets / 2) + 1;
        $clipsCoef = ceil($numOfPrintedSheets / 2) + 
                ((!$isCover)? 2 : (($numOfPrintedSheets>2)? 1 : 1.5));//getting the parentheses right is very important for these nested ternary if statements operators
        
        switch ($this->s_binding) {
            case "Metal clips":
                $this->tclips = $clipsCoef * $clips->cost();// * (4/3);
                $price = $this->tfold + $this->tclips;
                break;
            case "gl":
                $this->tclips = $collectCoef * $clips->cost();
                $this->tglue = $glue->cost();
                $price = $this->tfold + $this->tclips + $this->tglue;
                break;
            case "sg":
                $this->tclips = $collectCoef * $clips->cost();
                $this->tglue = $glue->cost();
                $this->tsewing = $sewing->cost() + ceil($numOfPrintedSheets / 2);
                $price = $this->tfold + $this->tclips + $this->tglue + $this->tsewing;
                break;
            default:
                $price = $this->tfold;
        }
        
        return $price;
    }
    
    protected function costOfBundling($circ) {
        //Make select statement to filter Bundling table to get price from a row 
        //with the lowest circulation out of the row's with circulations greater than $circ
        $sql = new DbQuery();
        $sql->select('price');
        $sql->from('iprint_bundling');
        $sql->where('printer = "'.$this->s_printer.'"');
        $sql->where('circulation >= '.$circ);
        $sql->orderBy('circulation ASC');
        $sql->limit('1');
        
        $result = Db::getInstance()->executeS($sql);
        
        return $result[0]["price"];
    }
        
    protected function costOfProof($circ) {
        //Make select statement to filter table to get price from a row 
        //with the lowest circulation out of the row's with circulations greater than $circ
        $sql = new DbQuery();
        $sql->select('price');
        $sql->from('iprint_proof');
        $sql->where('printer = "'.$this->s_printer.'"');
        $sql->where('circulation >= '.$circ);
        $sql->orderBy('circulation ASC');
        $sql->limit('1');
        
        $result = Db::getInstance()->executeS($sql);
        
        return $result[0]["price"];       
    }
    
    protected function costOfProductionTurnaround($circ) {
        //Make select statement to filter table to get price from a row 
        //with the lowest circulation out of the row's with circulations greater than $circ
        $sql = new DbQuery();
        $sql->select('price');
        $sql->from('iprint_productiontime');
        $sql->where('printer = "'.$this->s_printer.'"');
        $sql->where('circulation >= '.$circ);
        $sql->orderBy('circulation ASC');
        $sql->limit('1');
        
        $result = Db::getInstance()->executeS($sql);
        
        return $result[0]["price"];  
    }
}

class Format {
    protected $formatName;
    protected $area;
    protected $maxP; //max p is max pages or max prices? or something else?
    
    public function __construct($formatName) {
        $format = $this->getFormat($formatName);
        $this->formatName = $format[0]["Format"];
        $this->area = $format[0]["Area"];
        $this->maxP = $format[0]["maxp"];
    }
    
    public function getFormat($format) {
        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('iprint_formt');
        $sql->where('Format = "'.$format.'"');

        return Db::getInstance()->executeS($sql);
    }
    
    public function area() {
        return $this->area;
    }
    
    public function numOfPrintedSheets($pages) {
        if ($pages <= $this->maxP) {
            $numOfPrintedSheets = 1;
        } else {
            $numOfPrintedSheets = ceil($pages / $this->maxP);
        }
        
        return $numOfPrintedSheets;
    }
    
    public function factor($pages) { //factor to reduce circulation when printing several copies with same forms 
        if ($pages >= $this->maxP) {
            $factor = 1;
        } else {
            $factor = $pages / $this->maxP;
        }
        
        return $factor;
    }
}

class PrintX {//print cost for each printed side of paper sheet
    protected $dataSet;
    protected $bCirc, $lCirc;
    protected $bCost;
    
    public function __construct($circ, $numOfColoredPages, $printer) {
        $dataSet = $this->getPrintData($circ, $numOfColoredPages, $printer);
        
        $this->lCirc = $circ;
        $this->bCirc = $dataSet[0]["circulation"];
        $this->bCost = $dataSet[0]["price"];
        
        $this->dataSet = $dataSet;
        
    }
    
    public function getPrintData($circ, $numOfColoredPages, $printer) {
        $sql = new DbQuery();
        $sql->select('circulation, price');
        $sql->from('iprint_print');
        $sql->where('color = "'.$numOfColoredPages.'"');
        $sql->where('printer = "'.$printer.'"');
        $sql->orderBy('ABS(circulation - '.$circ.') ASC');
        $sql->limit('3');

        return Db::getInstance()->executeS($sql);
    }
    
    public function cost() {
        $price = 0;
        
        if (count($this->dataSet) >= 3) { //the pr func needs at least 3 rows in dataset 
            $price = HelperFuncs::pr($this->dataSet, $this->bCost, $this->lCirc, $this->bCirc);
        }
        return $price;
    }
}

class Fold {
    protected $dataSet;
    protected $bCirc, $lCirc;
    protected $bCost;   
    
    public function __construct($circ, $printer) {
        $dataSet = $this->getFoldData($circ, $printer);
        
        $this->lCirc = $circ;
        $this->bCirc = $dataSet[0]["circulation"];
        $this->bCost = $dataSet[0]["price"];
        
        $this->dataSet = $dataSet;
    }
    
    public function getFoldData($circ, $printer) {
        $sql = new DbQuery();
        $sql->select('circulation, price');
        $sql->from('iprint_folding');
        $sql->where('printer = "'.$printer.'"');
        $sql->orderBy('ABS(circulation - '.$circ.') ASC');
        $sql->limit('3');

        return Db::getInstance()->executeS($sql);
    }
    
    public function cost() {
        $price = 0;
        
        if (count($this->dataSet) >= 3) { //the pr func needs at least 3 rows in dataset 
            $price = HelperFuncs::pr($this->dataSet, $this->bCost, $this->lCirc, $this->bCirc);
        }
        return $price;
    }
    
}

class Clips {
    protected $dataSet;
    protected $bCirc, $lCirc;
    protected $bCost; //base cost???
    
    public function __construct($circ, $printer) {
        $dataSet = $this->getClipsData($circ, $printer);
        
        $this->lCirc = $circ;
        $this->bCirc = $dataSet[0]["circulation"];
        $this->bCost = $dataSet[0]["price"];
        
        $this->dataSet = $dataSet;
    }
    
    public function getClipsData($circ, $printer) {
        $sql = new DbQuery();
        $sql->select('circulation, price');
        $sql->from('iprint_clips');
        $sql->where('printer = "'.$printer.'"');
        $sql->orderBy('ABS(circulation - '.$circ.') ASC');
        $sql->limit('3');

        return Db::getInstance()->executeS($sql);
    }
    
    public function cost() {
        $price = 0;
        
        if (count($this->dataSet) >= 3) { //the pr func needs at least 3 rows in dataset 
            $price = HelperFuncs::pr($this->dataSet, $this->bCost, $this->lCirc, $this->bCirc);
        }
        return $price;
    }
        
}

class Glue {
    protected $dataSet;
    protected $bCirc, $lCirc;
    protected $bCost;   
    
    public function __construct($circ, $printer) {
        $dataSet = $this->getGlueData($circ, $printer);
        
        $this->lCirc = $circ;
        $this->bCirc = $dataSet[0]["circulation"];
        $this->bCost = $dataSet[0]["price"];
        
        $this->dataSet = $dataSet;
    }
    
    public function getGlueData($circ, $printer) {
        $sql = new DbQuery();
        $sql->select('circulation, price');
        $sql->from('iprint_glue');
        $sql->where('printer = "'.$printer.'"');
        $sql->orderBy('ABS(circulation - '.$circ.') ASC');
        $sql->limit('3');

        return Db::getInstance()->executeS($sql);
    }
    
    public function cost() {
        $price = 0;
        
        if (count($this->dataSet) >= 3) { //the pr func needs at least 3 rows in dataset 
            $price = HelperFuncs::pr($this->dataSet, $this->bCost, $this->lCirc, $this->bCirc);
        }
        return $price;
    }
       
}

class Paper {
    protected $dataSet;
    protected $bCirc, $lCirc;
    protected $bCost;   
    
    public function __construct($circ, $printer) {
        $dataSet = $this->getPaperData($circ, $printer);
        
        $this->lCirc = $circ;
        $this->bCirc = $dataSet[0]["circulation"];
        $this->bCost = $dataSet[0]["price"];
        
        $this->dataSet = $dataSet;
    }
    
    public function getPaperData($circ, $printer) {

        $sql1 = new DbQuery();
        $sql1->select('price');
        $sql1->from('iprint_papertype');
        $sql1->where('name = "standart"');
        $sql1->where('printer = "'.$printer.'"');
        
        $paperTypePrice = Db::getInstance()->getValue($sql1);
        
        $sql2 = new DbQuery();
        $sql2->select('circulation, (price * '.$paperTypePrice.'/2000) AS price');
        $sql2->from('iprint_paper');
        $sql2->where('printer = "'.$printer.'"');
        $sql2->orderBy('ABS(circulation - '.$circ.') ASC');
        $sql2->limit('3');

        return Db::getInstance()->executeS($sql2);
    }
    
    public function cost() {
        $price = 0;
        
        if (count($this->dataSet) >= 3) { //the pr func needs at least 3 rows in dataset 
            $price = HelperFuncs::pr($this->dataSet, $this->bCost, $this->lCirc, $this->bCirc);
        }
        return $price;
    }
       
}

class Sewing {
    protected $dataSet;
    protected $bCirc, $lCirc;
    protected $bCost;   
    
    public function __construct($circ, $printer) {
        $dataSet = $this->getSewingData($circ, $printer);
        
        $this->lCirc = $circ;
        $this->bCirc = $dataSet[0]["circulation"];
        $this->bCost = $dataSet[0]["price"];
        
        $this->dataSet = $dataSet;
    }
    
    public function getSewingData($circ, $printer) {
        $sql = new DbQuery();
        $sql->select('circulation, price');
        $sql->from('iprint_sewing');
        $sql->where('printer = "'.$printer.'"');
        $sql->orderBy('ABS(circulation - '.$circ.') ASC');
        $sql->limit('3');

        return Db::getInstance()->executeS($sql);
    }
    
    public function cost() {
        $price = 0;
        
        if (count($this->dataSet) >= 3) { //the pr func needs at least 3 rows in dataset 
            $price = HelperFuncs::pr($this->dataSet, $this->bCost, $this->lCirc, $this->bCirc);
        }
        return $price;
    }
      
}

class Special {
    protected $dataSet;
    protected $bCirc, $lCirc;
    protected $bCost;   
    
    public function __construct($area, $type, $printer) {
        $dataSet = $this->getSpecialData($area, $type, $printer);
        
        $this->lCirc = $area;
        $this->bCirc = $dataSet[0]["area"];
        $this->bCost = $dataSet[0]["price"];
        
        $this->dataSet = $dataSet;
    }
    
    public function getSpecialData($area, $type, $printer) {
        $sql = new DbQuery();
        $sql->select('area, price');
        $sql->from('iprint_special');
        $sql->where('printer = "'.$printer.'"');
        $sql->where('type = "'.$type.'"');
        $sql->orderBy('ABS(area - '.$area.') ASC');
        $sql->limit('3');
        
        return Db::getInstance()->executeS($sql);
    }
    
    public function cost() {
        $price = 0;
        
        if (count($this->dataSet) >= 3) { //the pr func needs at least 3 rows in dataset 
            $price = HelperFuncs::prs($this->dataSet, $this->bCost, $this->lCirc, $this->bCirc);
        }
        return $price;
    }
    
}

class HelperFuncs {
    
    public static function pr($dataSet, $bCost, $lCirc, $bCirc) {//PRICE = "PR"??
        
        //Sort the dataset by ascending circulation amount
        usort($dataSet, function($a, $b) {
            return $a['circulation'] - $b['circulation'];
        });
        
        $c1 = $dataSet[0]["circulation"];
        $c2 = $dataSet[1]["circulation"];
        $c3 = $dataSet[2]["circulation"];
        
        $p1 = $dataSet[0]["price"];
        $p2 = $dataSet[1]["price"];
        $p3 = $dataSet[2]["price"];
        
        $c_ln = HelperFuncs::point($c1, $c2) * HelperFuncs::point($c2, $c3) * 
                (HelperFuncs::coef($p1, $p2, $c1, $c2) - HelperFuncs::coef($p2, $p3, $c2, $c3)) / 
                (HelperFuncs::point($c2, $c3) - HelperFuncs::point($c1, $c2));
        
	$c_lin = (HelperFuncs::point($c1, $c2) * HelperFuncs::coef($p1, $p2, $c1, $c2) - 
                HelperFuncs::point($c2, $c3) * 
                HelperFuncs::coef($p2, $p3, $c2, $c3)) /
                (HelperFuncs::point($c1, $c2) - HelperFuncs::point($c2, $c3));
        
        $pr = $bCost + $c_lin * ($lCirc - $bCirc) + $c_ln *
                (log($lCirc + 500) - log($bCirc + 500));
        
        return $pr; 
    }
    
    public static function prs($dataSet, $bCost, $lCirc, $bCirc) { //PRICE SPECIAL = "PR.S"??
        //Sort the dataset by ascending area value
        usort($dataSet, function($a, $b) {
            return $a['area'] - $b['area'];
        });
        
        $a1 = $dataSet[0]["area"];
        $a2 = $dataSet[1]["area"];
        $a3 = $dataSet[2]["area"];
        
        $p1 = $dataSet[0]["price"];
        $p2 = $dataSet[1]["price"];
        $p3 = $dataSet[2]["price"];
        
        $c_ln = HelperFuncs::point($a1, $a2) * HelperFuncs::point($a2, $a3) * 
                (HelperFuncs::coef($p1, $p2, $a1, $a2) - HelperFuncs::coef($p2, $p3, $a2, $a3)) / 
                (HelperFuncs::point($a2, $a3) - HelperFuncs::point($a1, $a2));
        
	$c_lin = (HelperFuncs::point($a1, $a2) * HelperFuncs::coef($p1, $p2, $a1, $a2) - HelperFuncs::point($a2, $a3) * 
                HelperFuncs::coef($p2, $p3, $a2, $a3)) / 
                (HelperFuncs::point($a1, $a2) - HelperFuncs::point($a2, $a3));
        
        $prs = $bCost + $c_lin * ($lCirc - $bCirc) + 
                $c_ln * (log($lCirc + 500) - log($bCirc + 500));
        
        return $prs;
    }
    
    public static function point($c1, $c2) {
        $point = ($c2 - $c1) / (log($c2 + 500) - log($c1 + 500));
        
        return $point;
    }
    
    public static function coef($p1, $p2, $c1, $c2) {
        $coef = ($p2 - $p1) / ($c2 - $c1);
        
        return $coef;
    }
}