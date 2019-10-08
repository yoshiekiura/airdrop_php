<?php

//include_once(_PS_MODULE_DIR_.'iprintmodule/calculateprice.php');
include_once(_PS_MODULE_DIR_.'iprintmodule/calc.php');

class CartController extends CartControllerCore {

    public function init()
    {
        parent::init();

        $productInstance = new Product($this->id_product);

        $is_product_dynamically_priced = $productInstance->is_dynamically_priced_product;

        //Odd behavior when performing the following special if case for deletes and etc, so only perform for add and updates
        if ($is_product_dynamically_priced && (Tools::getIsset('add') || Tools::getIsset('update'))) {

            $attr_choices = json_decode(Tools::getValue('attribute_choices'), true);
            $attr_groups_data = unserialize(html_entity_decode(Tools::getValue('attribute_groups_data')));

            $price = null;

            $pricing_algorithm = $productInstance->pricing_algorithm;

            $chosen = array();
            foreach ($attr_choices as $attribute_group_id => $choice_id) {//Must create an array chosen made of attr group and attr choice names, not IDs
                $group_name = $attr_groups_data[$attribute_group_id]["group_name"];
                $data = $attr_groups_data[$attribute_group_id];
                $chosen[$attr_groups_data[$attribute_group_id]["group_name"]] = $attr_groups_data[$attribute_group_id]["attributes"][$choice_id];
            }

            /*FOR ALTERNATIVE METHOD OF DEALING WITH QUANTITY DISPLAY ISSUE if ($productInstance->has_custom_quantity_attribute){//This is so that the Specific Price uses the price of the admin chosen custom quantity attribute
                $quantity = intval($chosen[$productInstance->custom_quantity_attribute_name]);

                //The following two lines of code is to make sure we use the appropriate quantity('qty') for this case, in case a malevolent user overthrows the correct value that 'qty' should be set to for this case. That value is 1.
                $_POST['qty'] = 1;
                $_REQUEST['qty'] = 1;
            } else {*/
            $quantity = Tools::getValue('qty');
            //}
            
            $circulation = $_GET[$productInstance->custom_quantity_attribute_name];
            if ($productInstance->formula_to_use == Calc::BookletFormula) {
                $circulation = $chosen["Booklet - Circulation"];
            } else if ($productInstance->formula_to_use == Calc::CatalogFormula) {

            } else if ($productInstance->formula_to_use == Calc::BrochureFormula) {

            } else if ($productInstance->formula_to_use == Calc::LeafletFormula) {

            }
            
            if (!isset($circulation)) {
                $circulation = $quantity;
            }
            
            $price = Calc::calculatePrice($chosen, $circulation, $productInstance->formula_to_use);
            
            
            
            //If combination doesn't exists, create a new combination, otherwise use the id of the combination returned by productAttributeExists
            //TODO: is there a better algorithm to use for seeing if product combination exists than that used in productAttributeExists?
            if (($id_of_combination = $productInstance->productAttributeExists($attr_choices, false, null, true, true)) === false) //using === in case productAttributeExists returns a combination id of 0
            {
                //If a combination made of the customer's inputs doesn't yet exist, create one
                //Create the combination (by calling the below function which requires that long list of parameters declared below)
                $wholesale_price = "0";
                $comboPrice = 0;
                $weight = 0;
                $unit_impact = 0;
                $ecotax = 0;
                $combinationQuantity = 0;
                $id_images = false;
                $reference = "";
                $id_supplier = null;
                $ean13 = "";
                $default = false;
                $location = false;
                $upc = "";
                $minimal_quantity = "1";
                $id_supplier = null;
                $ean13 = "";
                $default = false;
                $location = false;
                $upc = "";
                $minimal_quantity = "1";
                $id_shop_list = array();
                $available_date = "0000-00-00";

                $id_of_combination = $productInstance->addCombinationEntity($wholesale_price, $comboPrice, $weight, $unit_impact, $ecotax, $combinationQuantity,
                    $id_images, $reference, $id_supplier, $ean13, $default, $location, $upc, $minimal_quantity, $id_shop_list, $available_date );

                $combination = new Combination((int)$id_of_combination);
                $combination->setAttributes($attr_choices);
            }

            //Set the special dynamic_pricing_order_quantity field of the Combination table (product_attribute) to match this dynamic product's selection's choice in the special quantity attribute
            //$result = Combination::setDynamicPricedProductOrderQuantity($id_of_combination, $quantity);

            $this->id_product_attribute = $id_of_combination;

            $unit_price = (round((float)($price) + pow(10, -2 - 1), 2))/$quantity;

            //Below attributes for creating the specific price
            $id_shop = Context::getContext()->shop->id;
            $id_currency = Context::getContext()->currency->id;
            $id_country = Context::getContext()->country->id;
            $id_group = "0"; //Use 0 to make sure the specific price applies to all customers, no matter their group
            $id_customer = "0"; //Use 0 to make sure this specific price applies to all customers, not any specific one
            $from_quantity = "1";
            $reduction = 0;
            $reduction_tax = "1";
            $reduction_type = "amount";
            $from = "0000-00-00 00:00:00"; //this way it never expires
            $to = "0000-00-00 00:00:00"; //this way it never expires


            $specificPriceID = null;
            //If specific price exists already, update instead of create a new
            if ($specificPriceID = SpecificPrice::exists((int)$productInstance->id, $id_of_combination, $id_shop, $id_group, $id_country, $id_currency, $id_customer, $from_quantity, $from, $to, false)) {
                $specificPrice = new SpecificPrice($specificPriceID, null,$id_shop);//the following only returns an array of a specific price object's values, not the actual object: $specificPrice = SpecificPrice::getSpecificPrice($productInstance->id, $id_shop, $id_currency, $id_country, $id_group, $quantity, $id_of_combination, $id_customer, 0, 0);
                $specificPrice->price = $unit_price;
                $specificPrice->update();
            } else {
                //Create the specific price for that combination
                $specificPrice = new SpecificPrice();
                $specificPrice->id_product = (int)$this->id_product;
                $specificPrice->id_product_attribute = (int)$id_of_combination;
                $specificPrice->id_shop = (int)$id_shop;
                $specificPrice->id_currency = (int)($id_currency);
                $specificPrice->id_country = (int)($id_country);
                $specificPrice->id_group = (int)($id_group);
                $specificPrice->id_customer = (int)$id_customer;
                $specificPrice->price = $unit_price; //for rounding to 2 decimal places for the price TODO: make this aligned with the client (JavaScript) code's side of rounding the price
                $specificPrice->from_quantity = (int)($from_quantity);
                $specificPrice->reduction = $reduction;//(float)($reduction_type == 'percentage' ? $reduction / 100 : $reduction);
                $specificPrice->reduction_tax = $reduction_tax;
                $specificPrice->reduction_type = $reduction_type;
                $specificPrice->from = $from;
                $specificPrice->to = $to;
                $specificPrice->add();
            }
        }
    }
    
    /**
    * This process add or update a product in the cart
    */

	/*
	* module: iprintmodule
	* date: 2015-03-28 14:50:00
	* version: 0.1.0
	*/
    protected function processChangeProductInCart()
    {
        $mode = (Tools::getIsset('update') && $this->id_product) ? 'update' : 'add';

        if ($this->qty == 0)
                $this->errors[] = Tools::displayError('Null quantity.', !Tools::getValue('ajax'));
        elseif (!$this->id_product)
                $this->errors[] = Tools::displayError('Product not found', !Tools::getValue('ajax'));

        $product = new Product($this->id_product, true, $this->context->language->id);
        if (!$product->id || !$product->active)
        {
                $this->errors[] = Tools::displayError('This product is no longer available.', !Tools::getValue('ajax'));
                return;
        }

        $qty_to_check = $this->qty;
        $cart_products = $this->context->cart->getProducts();

        //If products in cart
        if (is_array($cart_products)) {
                if (!(isset($product->has_custom_quantity_attribute) && $product->has_custom_quantity_attribute)) {
                    foreach ($cart_products as $cart_product)
                    {
                            /*
                             * If this product doesn't use combinations OR it does use combinations and this current product in cart is same combination
                             * as product to be ADDED to cart (and they are the same product)
                             */
                            if ((!isset($this->id_product_attribute) || $cart_product['id_product_attribute'] == $this->id_product_attribute) &&
                                    (isset($this->id_product) && $cart_product['id_product'] == $this->id_product))
                            {
                                    $qty_to_check = $cart_product['cart_quantity'];

                                    if (Tools::getValue('op', 'up') == 'down')
                                            $qty_to_check -= $this->qty;
                                    else
                                            $qty_to_check += $this->qty;

                                    break;
                            }
                    }
                } else {
                    $total_qty_of_product_in_cart_already = 0;
                    foreach ($cart_products as $cart_product) {
                        if ((isset($product->has_custom_quantity_attribute) && $product->has_custom_quantity_attribute) 
                                && $cart_product['id_product'] == $this->id_product) {/*@!$*/
                                $cart_product_qty = $cart_product['cart_quantity'];

                                $total_qty_of_product_in_cart_already += $cart_product_qty;
                                
                                    
                        }
                    }
                    
                    $qty_to_check = $total_qty_of_product_in_cart_already;
                    if (Tools::getValue('op', 'up') == 'down')
                                        $qty_to_check -= $this->qty;
                                else
                                        $qty_to_check += $this->qty;
                }
        }

        // Check product quantity availability
        if ($this->id_product_attribute)
        {
                if (!Product::isAvailableWhenOutOfStock($product->out_of_stock) && !Attribute::checkAttributeQty($this->id_product_attribute, $qty_to_check))
                        $this->errors[] = Tools::displayError('There isn\'t enough product in stock.', !Tools::getValue('ajax'));
        }
        elseif ($product->hasAttributes())
        {
                $minimumQuantity = ($product->out_of_stock == 2) ? !Configuration::get('PS_ORDER_OUT_OF_STOCK') : !$product->out_of_stock;
                $this->id_product_attribute = Product::getDefaultAttribute($product->id, $minimumQuantity);
                // @todo do something better than a redirect admin !!
                if (!$this->id_product_attribute)
                        Tools::redirectAdmin($this->context->link->getProductLink($product));
                elseif (!Product::isAvailableWhenOutOfStock($product->out_of_stock) && !Attribute::checkAttributeQty($this->id_product_attribute, $qty_to_check))
                        $this->errors[] = Tools::displayError('There isn\'t enough product in stock.', !Tools::getValue('ajax'));
        }
        elseif (!$product->checkQty($qty_to_check))
                $this->errors[] = Tools::displayError('There isn\'t enough product in stock.', !Tools::getValue('ajax'));

        // If no errors, process product addition
        if (!$this->errors && $mode == 'add')
        {
                // Add cart if no cart found
                if (!$this->context->cart->id)
                {
                        if (Context::getContext()->cookie->id_guest)
                        {
                                $guest = new Guest(Context::getContext()->cookie->id_guest);
                                $this->context->cart->mobile_theme = $guest->mobile_theme;
                        }
                        $this->context->cart->add();
                        if ($this->context->cart->id)
                                $this->context->cookie->id_cart = (int)$this->context->cart->id;
                }

                // Check customizable fields
                if (!$product->hasAllRequiredCustomizableFields() && !$this->customization_id)
                        $this->errors[] = Tools::displayError('Please fill in all of the required fields, and then save your customizations.', !Tools::getValue('ajax'));

                if (!$this->errors)
                {
                        $cart_rules = $this->context->cart->getCartRules();
                        $update_quantity = $this->context->cart->updateQty($this->qty, $this->id_product, $this->id_product_attribute, $this->customization_id, Tools::getValue('op', 'up'), $this->id_address_delivery);
                        if ($update_quantity < 0)
                        {
                                // If product has attribute, minimal quantity is set with minimal quantity of attribute
                                $minimal_quantity = ($this->id_product_attribute) ? Attribute::getAttributeMinimalQty($this->id_product_attribute) : $product->minimal_quantity;
                                $this->errors[] = sprintf(Tools::displayError('You must add %d minimum quantity', !Tools::getValue('ajax')), $minimal_quantity);
                        }
                        elseif (!$update_quantity)
                                $this->errors[] = Tools::displayError('You already have the maximum quantity available for this product.', !Tools::getValue('ajax'));
                        elseif ((int)Tools::getValue('allow_refresh'))
                        {
                                // If the cart rules has changed, we need to refresh the whole cart
                                $cart_rules2 = $this->context->cart->getCartRules();
                                if (count($cart_rules2) != count($cart_rules))
                                        $this->ajax_refresh = true;
                                else
                                {
                                        $rule_list = array();
                                        foreach ($cart_rules2 as $rule)
                                                $rule_list[] = $rule['id_cart_rule'];
                                        foreach ($cart_rules as $rule)
                                                if (!in_array($rule['id_cart_rule'], $rule_list))
                                                {
                                                        $this->ajax_refresh = true;
                                                        break;
                                                }
                                }
                        }
                }
        }

        $removed = CartRule::autoRemoveFromCart();
        CartRule::autoAddToCart();
        if (count($removed) && (int)Tools::getValue('allow_refresh'))
                $this->ajax_refresh = true;
    }
 }