<?php
/*@!$*/
class Cart extends CartCore
{

    /*@!$*/
    public function getProducts($refresh = false, $id_product = false, $id_country = null)
    {
        $products = parent::getProducts($refresh, $id_product, $id_country);

        foreach ($products as $product => $productInfo) {
            if ((Product::isDynamicallyPricedProduct($productInfo['id_product'])) && ($dynamic_pricing_product_quantity = Product::getDynamicallyPricedProductQuantity($productInfo['id_product'])) != null) {
                $products[$product]['quantity_available'] = (int)$dynamic_pricing_product_quantity;
                $products[$product]['stock_quantity'] = (int)$dynamic_pricing_product_quantity;
            }
        }

        return $products;
    }

    /**
     * Update product quantity
     *
     * @param integer $quantity Quantity to add (or substract)
     * @param integer $id_product Product ID
     * @param integer $id_product_attribute Attribute ID if needed
     * @param string $operator Indicate if quantity must be increased or decreased
     */
    public function updateQty($quantity, $id_product, $id_product_attribute = null, $id_customization = false,
                              $operator = 'up', $id_address_delivery = 0, Shop $shop = null, $auto_add_cart_rule = true)
    {
        if ((!Product::isDynamicallyPricedProduct($id_product)) && !(($dynamic_pricing_product_quantity = Product::getDynamicallyPricedProductQuantity($id_product)) != null)) {
            return parent::updateQty($quantity, $id_product, $id_product_attribute, $id_customization,
                $operator, $id_address_delivery, $shop, $auto_add_cart_rule);
        } else {
            if (!$shop)
                $shop = Context::getContext()->shop;

            if (Context::getContext()->customer->id) {
                if ($id_address_delivery == 0 && (int)$this->id_address_delivery) // The $id_address_delivery is null, use the cart delivery address
                    $id_address_delivery = $this->id_address_delivery;
                elseif ($id_address_delivery == 0) // The $id_address_delivery is null, get the default customer address
                    $id_address_delivery = (int)Address::getFirstCustomerAddressId((int)Context::getContext()->customer->id);
                elseif (!Customer::customerHasAddress(Context::getContext()->customer->id, $id_address_delivery)) // The $id_address_delivery must be linked with customer
                    $id_address_delivery = 0;
            }

            $quantity = (int)$quantity;
            $id_product = (int)$id_product;
            $id_product_attribute = (int)$id_product_attribute;
            $product = new Product($id_product, false, Configuration::get('PS_LANG_DEFAULT'), $shop->id);

            if ($id_product_attribute) {
                $combination = new Combination((int)$id_product_attribute);
                if ($combination->id_product != $id_product)
                    return false;
            }

            /* If we have a product combination, the minimal quantity is set with the one of this combination */
            if (!empty($id_product_attribute))
                $minimal_quantity = (int)Attribute::getAttributeMinimalQty($id_product_attribute);
            else
                $minimal_quantity = (int)$product->minimal_quantity;

            if (!Validate::isLoadedObject($product))
                die(Tools::displayError());

            if (isset(self::$_nbProducts[$this->id]))
                unset(self::$_nbProducts[$this->id]);

            if (isset(self::$_totalWeight[$this->id]))
                unset(self::$_totalWeight[$this->id]);

            if ((int)$quantity <= 0)
                return $this->deleteProduct($id_product, $id_product_attribute, (int)$id_customization);
            elseif (!$product->available_for_order || (Configuration::get('PS_CATALOG_MODE') && !defined('_PS_ADMIN_DIR_')))
                return false;
            else {
                /* Check if the product is already in the cart */
                $result = $this->containsProduct($id_product, $id_product_attribute, (int)$id_customization, (int)$id_address_delivery);

                /* Update quantity if product already exist */
                if ($result) {
                    if ($operator == 'up') {
                        /* @!$*/
                        if ((Product::isDynamicallyPricedProduct($id_product)) && ($dynamic_pricing_product_quantity = Product::getDynamicallyPricedProductQuantity($id_product)) != null) {
                            if ($dynamic_pricing_product_quantity <= 0) {
                                $is_out_of_stock = 1;
                            } else {
                                $is_out_of_stock = 0;
                            }
                            $result2 = array(
                                'quantity' => (int)$dynamic_pricing_product_quantity,
                                'out_of_stock' => $is_out_of_stock
                            );
                        } else {
                            $sql = 'SELECT stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity
                                FROM ' . _DB_PREFIX_ . 'product p
                                ' . Product::sqlStock('p', $id_product_attribute, true, $shop) . '
                                WHERE p.id_product = ' . $id_product;

                            $result2 = Db::getInstance()->getRow($sql);
                        }/* @!$*/

                        $product_qty = (int)$result2['quantity'];
                        // Quantity for product pack
                        if (Pack::isPack($id_product))
                            $product_qty = Pack::getQuantity($id_product, $id_product_attribute);
                        $new_qty = (int)$result['quantity'] + (int)$quantity;
                        $qty = '+ ' . (int)$quantity;

                        if (!Product::isAvailableWhenOutOfStock((int)$result2['out_of_stock']))
                            if ($new_qty > $product_qty)
                                return false;
                    } elseif ($operator == 'down') {
                        $qty = '- ' . (int)$quantity;
                        $new_qty = (int)$result['quantity'] - (int)$quantity;
                        if ($new_qty < $minimal_quantity && $minimal_quantity > 1)
                            return -1;
                    } else
                        return false;

                    /* Delete product from cart */
                    if ($new_qty <= 0)
                        return $this->deleteProduct((int)$id_product, (int)$id_product_attribute, (int)$id_customization);
                    elseif ($new_qty < $minimal_quantity)
                        return -1;
                    else
                        Db::getInstance()->execute('
                            UPDATE `' . _DB_PREFIX_ . 'cart_product`
                            SET `quantity` = `quantity` ' . $qty . ', `date_add` = NOW()
                            WHERE `id_product` = ' . (int)$id_product .
                            (!empty($id_product_attribute) ? ' AND `id_product_attribute` = ' . (int)$id_product_attribute : '') . '
                            AND `id_cart` = ' . (int)$this->id . (Configuration::get('PS_ALLOW_MULTISHIPPING') && $this->isMultiAddressDelivery() ? ' AND `id_address_delivery` = ' . (int)$id_address_delivery : '') . '
                            LIMIT 1'
                        );
                } /* Add product to the cart */
                elseif ($operator == 'up') {
                    /* @!$*/
                    if ((Product::isDynamicallyPricedProduct($id_product)) && ($dynamic_pricing_product_quantity = Product::getDynamicallyPricedProductQuantity($id_product)) != null) {
                        if ($dynamic_pricing_product_quantity <= 0) {
                            $is_out_of_stock = 1;
                        } else {
                            $is_out_of_stock = 0;
                        }
                        $result2 = array(
                            'quantity' => (int)$dynamic_pricing_product_quantity,
                            'out_of_stock' => $is_out_of_stock
                        );
                    } else {
                        $sql = 'SELECT stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity
                                FROM ' . _DB_PREFIX_ . 'product p
                                ' . Product::sqlStock('p', $id_product_attribute, true, $shop) . '
                                WHERE p.id_product = ' . $id_product;

                        $result2 = Db::getInstance()->getRow($sql);

                    }/* @!$*/

                    // Quantity for product pack
                    if (Pack::isPack($id_product))
                        $result2['quantity'] = Pack::getQuantity($id_product, $id_product_attribute);

                    if (!Product::isAvailableWhenOutOfStock((int)$result2['out_of_stock']))
                        if ((int)$quantity > $result2['quantity'])
                            return false;

                    if ((int)$quantity < $minimal_quantity)
                        return -1;

                    $result_add = Db::getInstance()->insert('cart_product', array(
                        'id_product' => (int)$id_product,
                        'id_product_attribute' => (int)$id_product_attribute,
                        'id_cart' => (int)$this->id,
                        'id_address_delivery' => (int)$id_address_delivery,
                        'id_shop' => $shop->id,
                        'quantity' => (int)$quantity,
                        'date_add' => date('Y-m-d H:i:s')
                    ));

                    if (!$result_add)
                        return false;
                }
            }

            // refresh cache of self::_products
            $this->_products = $this->getProducts(true);
            $this->update();
            $context = Context::getContext()->cloneContext();
            $context->cart = $this;
            Cache::clean('getContextualValue_*');
            if ($auto_add_cart_rule)
                CartRule::autoAddToCart($context);

            if ($product->customizable)
                return $this->_updateCustomizationQuantity((int)$quantity, (int)$id_customization, (int)$id_product, (int)$id_product_attribute, (int)$id_address_delivery, $operator);
            else
                return true;
        }
    }


}