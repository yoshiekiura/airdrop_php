<?php
/*@!$*/
class Product extends ProductCore
{
    /** @var boolean For determining if product uses dynamic prices */
    
    
    public $is_dynamically_priced_product = false;

    /** @var JSON string containing id's of all attributes used by this product in its dynamic algorithm */
    public $pricing_algorithm_attribute_groups;


    /** @var int holding the store owner/employee defined quantity of the product (a quantity that isn't dependent on the attributes) */
    public $dynamic_pricing_product_quantity;


    //public $specific_quantity_choices;

    /** @var boolean Set to true when admin wants to use a custom attribute for the product quantity (qty) in the buy/"add to cart" form */
    public $has_custom_quantity_attribute = false;

    /** @var string Holds name of attribute that product uses for special quantity selection */
    public $custom_quantity_attribute_name;
    
    /* text to be displayed above the quantity control*/
    public $has_alias_for_quantity = false;

    /* Should equal to a number that correlates with a constant in the iPrintModule formula, which itself correlates with a
     * one of the several "Formula" classes iPrintModule that takes inputs and outputs a cost for a product's attributes */
    public $formula_to_use;
    
    
    public function __construct($id_product = null, $full = false, $id_lang = null, $id_shop = null, Context $context = null)
    {
        /*@!$*/
        self::$definition['fields']['is_dynamically_priced_product'] = array('type' => self::TYPE_BOOL, 'validate' => 'isBool');
        self::$definition['fields']['pricing_algorithm_attribute_groups'] = array('type' => self::TYPE_SQL, 'validate' => 'isString');
        self::$definition['fields']['dynamic_pricing_product_quantity'] = array('type' => self::TYPE_INT, 'validate' => 'isInt');
        //self::$definition['fields']['specific_quantity_choices'] = array('type' => self::TYPE_BOOL, 'validate' => 'isString');
        self::$definition['fields']['has_custom_quantity_attribute'] = array('type' => self::TYPE_BOOL, 'validate' => 'isBool');
        self::$definition['fields']['custom_quantity_attribute_name'] = array('type' => self::TYPE_STRING, 'validate' => 'isString');
        self::$definition['fields']['has_alias_for_quantity'] = array('type' => self::TYPE_BOOL, 'validate' => 'isBool');
        self::$definition['fields']['formula_to_use'] = array('type' => self::TYPE_INT, 'validate' => 'isInt');
        
        parent::__construct($id_product, $full, $id_lang, $id_shop, $context);
    }

    public function getAttributesForDynamicallyPricedProduct($id_lang)
    {
        /*@!$*/
        $attributeGroupNames = $this->pricing_algorithm_attribute_groups;
        if (!empty($attributeGroupNames)) {
            $sql = "SELECT ag.`id_attribute_group`, ag.`is_color_group`, ag.`group_type`, ag.`position`, agl.`name`  AS `group_name`, agl.`public_name` AS `public_group_name`,\n"
                . "a.`id_attribute`, a.`color` AS `attribute_color`, a.`position`, al.`name` AS `attribute_name`\n"
                . "FROM `" . _DB_PREFIX_ . "attribute_group` ag\n"
                . "LEFT JOIN `" . _DB_PREFIX_ . "attribute_group_lang` agl ON agl.`id_attribute_group` = ag.`id_attribute_group`\n"
                . "LEFT JOIN `" . _DB_PREFIX_ . "attribute` a ON a.`id_attribute_group` = ag.`id_attribute_group`\n"
                . "LEFT JOIN `" . _DB_PREFIX_ . "attribute_lang` al ON al.`id_attribute` = a.`id_attribute`\n"
                . "WHERE agl.`name` IN (" . $attributeGroupNames . ")"
                . "ORDER BY ag.`position` ASC, a.`position` ASC;";

            $results = Db::getInstance()->executeS($sql);
            
            //All attributes should have the same quantity. Make it so here:
            foreach ($results as $k => $row) {
                $results[$k]['quantity'] = $this->dynamic_pricing_product_quantity;//$this->single_quantity;
            }
        } else {
            $results = null;
        }

        return ($results);
    }

    /*public function __get($name)
    {

        //If is a dynamically priced product, always return show_price is false so we can hide the price
        if ($name == "show_price" && $this->is_dynamically_priced_product) {
            return false;
        }
        return $this->$name;
    }*/


    /*public static function initPricesComputation($id_customer = null) {
        parent::initPricesComputation($id_customer);


            Context::getContext()
            $product = $this->context->controller->getProduct();
            if(self::is_dynamically_priced_product)
                self::$_taxCalculationMethod = -1; //This is for setting priceDisplay to a setting where price does not Display!!! see FrontController.php and trace back...
            //$priceDisplay = 400;

            //error_log(self::$is_dynamically_priced_product);

    }*/

    public function array_2_csv_with_parentheses($array)
    {
        /*@!$*/
        $csv = array();

        if (!empty($array)) {
            foreach ($array as $item) {
                if (is_array($item)) {
                    $csv[] = array_2_csv($item);
                } else {
                    $csv[] = $item;
                }
            }

            return "'".implode("','", $csv)."'";
        } else {
            return "";
        }

    }

    public static function isDynamicallyPricedProduct($product_id)
    {
        /*@!$*/
        // creates the query object
        $query = new DbQuery();

        $query->select('is_dynamically_priced_product');
        $query->from('product', 'p');
        $query->where('p.id_product = '.(int)$product_id);


        return Db::getInstance()->getValue($query);
    }

    public static function getProductProperties($id_lang, $row, Context $context = null)
    {
        /* @!$ */
        $row['is_dynamically_priced_product'] = Product::isDynamicallyPricedProduct($row['id_product']);

        return parent::getProductProperties($id_lang, $row, $context);

    }

    public static function getDynamicallyPricedProductQuantity($product_id) {
        /*@!$*/
        // creates the query object
        $query = new DbQuery();

        $query->select('dynamic_pricing_product_quantity');
        $query->from('product', 'p');
        $query->where('p.id_product = '.(int)$product_id);


        return Db::getInstance()->getValue($query);

    }

    public static function hasCustomQuantityAttribute($product_id) {
        /*@!$*/
        // creates the query object
        $query = new DbQuery();

        $query->select('has_custom_quantity_attribute');
        $query->from('product', 'p');
        $query->where('p.id_product = '.(int)$product_id);


        return Db::getInstance()->getValue($query);

    }

    public static function getCustomQuantityAttributeName($product_id) {
        /*@!$*/
        // creates the query object
        $query = new DbQuery();

        $query->select('custom_quantity_attribute_name');
        $query->from('product', 'p');
        $query->where('p.id_product = '.(int)$product_id);


        return Db::getInstance()->getValue($query);

    }
    
    public function getAttributesGroups($id_lang) {
        $attributes_groups = parent::getAttributesGroups($id_lang);
        
        if (isset($this->is_dynamically_priced_product) && $this->is_dynamically_priced_product) {
            //All attributes should have the same quantity. Make it so here:
            foreach ($attributes_groups as $k => $row) {
                $attributes_groups[$k]['quantity'] = $this->dynamic_pricing_product_quantity;
            }
        }
        
        return $attributes_groups;
    }
}