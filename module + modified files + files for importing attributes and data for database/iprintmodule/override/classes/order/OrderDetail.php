<?php

/*@!$*/
class OrderDetail extends OrderDetailCore
{
    /**
     * Check the order status
     * @param array $product
     * @param int $id_order_state
     */
    protected function checkProductStock($product, $id_order_state)
    {
        parent::checkProductStock($product, $id_order_state);

        /*@!$*/
        if (Product::isDynamicallyPricedProduct($product['id_product'])) {
            if (Product::getDynamicallyPricedProductQuantity($product['id_product']) <= 0 && Configuration::get('PS_STOCK_MANAGEMENT')) {
                $this->outOfStock = true;
            } else {
                $this->outOfStock = false;
            }

            Product::updateDefaultAttribute($product['id_product']);
        }
    }
}