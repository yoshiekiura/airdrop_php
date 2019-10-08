<?php
/*@!$*/
class StockAvailable extends StockAvailableCore
{


    public static function updateQuantity($id_product, $id_product_attribute, $delta_quantity, $id_shop = null)
    {
        /* @!$ */
        if (Product::isDynamicallyPricedProduct($id_product) && ($dynamic_pricing_product_quantity = Product::getDynamicallyPricedProductQuantity($id_product)) != null) {
            /**Update the dynamic pricing module's version of the product quantity**/

            $new_dp_product_quantity = $dynamic_pricing_product_quantity + $delta_quantity;

            Db::getInstance()->update('product',//update table
                array( // with this data
                    'dynamic_pricing_product_quantity' => $new_dp_product_quantity
                ),
                'id_product = ' . (int)$id_product//where
            );


            if (!Validate::isUnsignedId($id_product))
                return false;

            $id_stock_available = StockAvailable::getStockAvailableIdByProductId($id_product, $id_product_attribute, $id_shop);

            if (!$id_stock_available)
                return false;

            // Products that use combinations can't use Packs in PrestaShop v1.6: "You cannot use combinations with a pack."
            /*if (Pack::isPack($id_product))
            {
                $products_pack = Pack::getItems($id_product, (int)Configuration::get('PS_LANG_DEFAULT'));
                foreach ($products_pack as $product_pack)
                {
                    $pack_id_product_attribute = Product::getDefaultAttribute($product_pack->id, 1);
                    StockAvailable::updateQuantity($product_pack->id, $pack_id_product_attribute, $product_pack->pack_quantity * $delta_quantity, $id_shop);
                }
            }*/

            $stock_available = new StockAvailable($id_stock_available);
            $stock_available->quantity = $new_dp_product_quantity;
            $stock_available->update();

            Hook::exec('actionUpdateQuantity',
                array(
                    'id_product' => $id_product,
                    'id_product_attribute' => $id_product_attribute,
                    'quantity' => $stock_available->quantity
                )
            );

            Cache::clean('StockAvailable::getQuantityAvailableByProduct_' . (int)$id_product . '*');

            return true;
        } else {

            return parent::updateQuantity($id_product, $id_product_attribute, $delta_quantity, $id_shop);

        }
    }

    public static function getQuantityAvailableByProduct($id_product = null, $id_product_attribute = null, $id_shop = null)
    {
        /* @!$ */
        //In cases an id_product is not provided, then use the POST's (through Tools::getValue) provided id_product for our dynamic priced module's cases
        if ($id_product == null) {
            $product_id = (int)Tools::getValue('id_product');
        } else{
            $product_id = $id_product;
        }
        if ((Product::isDynamicallyPricedProduct($product_id)) && ($dynamic_pricing_product_quantity = Product::getDynamicallyPricedProductQuantity($product_id)) != null) {
            /**Get the dynamic pricing module's version of the product quantity**/
            return (int)$dynamic_pricing_product_quantity;
        } else{
            return parent::getQuantityAvailableByProduct($id_product, $id_product_attribute, $id_shop);
        }

    }
}