<?php
/*@!$*/
class Combination extends CombinationCore
{

    /** @var this is the amount to display for an order*/
    public $dynamic_pricing_order_quantity;


    public function __construct($id_product = null, $full = false, $id_lang = null, $id_shop = null, Context $context = null)
    {
        /*@!$*/
        self::$definition['fields']['dynamic_pricing_order_quantity'] = array('type' => self::TYPE_INT, 'validate' => 'isInt');


        parent::__construct($id_product, $full, $id_lang, $id_shop, $context);
    }




    public static function setDynamicPricedProductOrderQuantity($id_product_attribute, $quantity) {
        /*@!$*/
        $result = Db::getInstance()->update('product_attribute',//update table
            array( // with this data
                'dynamic_pricing_order_quantity' => $quantity
            ),
            'id_product_attribute = ' . $id_product_attribute//where
        );

        return $result;

    }

    public static function getDynamicPricedProductOrderQuantity($id_product_attribute) {
        /*@!$*/
        // creates the query object
        $query = new DbQuery();

        $query->select('dynamic_pricing_order_quantity');
        $query->from('product_attribute', 'pa');
        $query->where('pa.id_product_attribute = '.(int)$id_product_attribute);


        return Db::getInstance()->getValue($query);

    }
}