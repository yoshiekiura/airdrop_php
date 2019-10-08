<?php
include_once(dirname(__FILE__).'/calc.php');
class IPrintModule extends Module
{
    
    public function __construct()
    {
        $this->name = 'iprintmodule';
        $this->tab = 'pricing_promotion';
        $this->version = '0.1.0';
        $this->author = 'heyday88';

        parent::__construct();
        $this->displayName = $this->l('iPrint Module');
        /*$this->description = $this->l(
               ''
        );*/

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall "iPrint Module"?');


    }

    public function install()
    {
        if (Shop::isFeatureActive())
            Shop::setContext(Shop::CONTEXT_ALL);

        if (!parent::install() ||
            !$this->alterTable('add') ||
            !$this->registerHook('displayAdminProductsExtra')||
            //!$this->registerHook('displayProductPriceBlock')||
            !$this->registerHook('actionProductUpdate')//||
            //!$this->registerHook('header') ||
            //!Configuration::updateValue('MYMODULE_NAME', 'my friend')
        )
            return false;

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() OR !$this->alterTable('remove'))
            return false;
        return true;
    }

    public function alterTable($method)
    {
        switch ($method) {
            case 'add':

                $sql = 'ALTER TABLE ' . _DB_PREFIX_ . 'product ADD `is_dynamically_priced_product` BOOL DEFAULT NULL;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product ADD `pricing_algorithm_attribute_groups` TEXT DEFAULT NULL;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product ADD `dynamic_pricing_product_quantity` INT DEFAULT NULL;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product ADD `has_custom_quantity_attribute` BOOL DEFAULT NULL;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product ADD `custom_quantity_attribute_name` TEXT DEFAULT NULL;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product ADD `has_alias_for_quantity` TEXT DEFAULT NULL;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product ADD `formula_to_use` INT NULL;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product_attribute ADD `dynamic_pricing_order_quantity` INT DEFAULT NULL;';

                
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_clients`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `name` varchar(128),
                                `password` varchar(128),
                                `title` varchar(128),
                                `first_name` varchar(128),
                                `last_name` varchar(128),
                                `company` varchar(128),
                                `address` varchar(128),
                                `country` varchar(128),
                                `telephone` varchar(128),
                                `fax` varchar(128),
                                `email` varchar(128),
                                `settore` varchar(128),
                                `paese` varchar(128),
                                `maggiorazione` varchar(128),
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_clips`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `printer` varchar(128),
                                `circulation` int(10),
                                `price` float,
                                `sheets` varchar(128),
                                `paper` varchar(128),
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_folding`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `printer` varchar(128),
                                `circulation` int(10),
                                `price` float,
                                `pages` varchar(128),
                                `paper` varchar(128),
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_formt`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `Format` varchar(128),
                                `Area` float,
                                `m` varchar(128),
                                `maxp` int(10),
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_glue`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `printer` varchar(128),
                                `circulation` int(10),
                                `price` float,
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_main`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `format` varchar(128),
                                `circulation` int(10),
                                `pages_inside` int(10),
                                `paper_inside` int(10),
                                `colors_inside` int(10),
                                `pages_of_cover` int(10),
                                `paper_of_cover` int(10),
                                `colors_of_cover` int(10),
                                `binding` varchar(128),
                                `password` varchar(128),
                                `extra1` varchar(128),
                                `extra2` varchar(128),
                                `extra3` varchar(128),
                                `extra4` varchar(128),
                                `key` varchar(128),
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_paper`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `printer` varchar(128),
                                `circulation` int(10),
                                `price` float,
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_papertype`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `name` varchar(128),
                                `printer` varchar(128),
                                `price` float,
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_print`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `color` int(10),
                                `m` varchar(128),
                                `printer` varchar(128),
                                `circulation` int(10),
                                `price` float,
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_saved`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `format` varchar(128),
                                `circulation` int(10),
                                `pages_inside` int(10),
                                `paper_inside` int(10),
                                `colors_inside` int(10),
                                `pages_of_cover` int(10),
                                `paper_of_cover` int(10),
                                `colors_of_cover` int(10),
                                `binding` varchar(128),
                                `special` int(10),
                                `cardboard` varchar(128),
                                `hardcover_material` varchar(128),
                                `printer` varchar(128),
                                `comments` varchar(128),
                                `type` int(10),
                                `rec_key` int(10),
                                `order_date` date,
                                `price` float,
                                `tprintl` float,
                                `tpaperl` float,
                                `tprintC` float,
                                `tpaperC` float,
                                `tfold` float,
                                `tclips` float,
                                `tglue` float,
                                `tsewing` float,
                                `thardcover` float,
                                `tspecial` float,
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_sewing`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `printer` varchar(128),
                                `circulation` int(10),
                                `price` float,
                                `sheets` varchar(128),
                                `paper` varchar(128),
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_special`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `type` varchar(128),
                                `printer` varchar(128),
                                `area` int(10),
                                `price` float,
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
            $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_bundling`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `printer` varchar(128),
                                `circulation` int(10),
                                `price` float,
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
            $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_proof`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `printer` varchar(128),
                                `circulation` int(10),
                                `price` float,
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
            $sql .= 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'iprint_productiontime`
                            (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `printer` varchar(128),
                                `circulation` int(10),
                                `price` float,
                                PRIMARY KEY (`id`)
                            )
                            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
                break;

            case 'remove':
               
                $sql = 'ALTER TABLE ' . _DB_PREFIX_ . 'product DROP `is_dynamically_priced_product`;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product DROP `pricing_algorithm_attribute_groups`;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product DROP `dynamic_pricing_product_quantity`;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product DROP `has_custom_quantity_attribute`;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product DROP `custom_quantity_attribute_name`;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product DROP `has_alias_for_quantity`;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product DROP `formula_to_use`;';
                $sql .= 'ALTER TABLE ' . _DB_PREFIX_ . 'product_attribute DROP `dynamic_pricing_order_quantity`;';

                
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_clients;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_clips;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_folding;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_formt;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_glue;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_main;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_paper;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_papertype;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_print;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_saved;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_sewing;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_special;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_bundling;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_proof;";
                $sql .= "DROP TABLE IF EXISTS "._DB_PREFIX_."iprint_productiontime;";
                
                break;
        }

        if(!Db::getInstance()->Execute($sql))
            return false;
        return true;
    }

   public function hookDisplayAdminProductsExtra($params) {

        $attributes = Attribute::getAttributes(Context::getContext()->language->id, true);

        foreach ($attributes as $k => $attribute)
            $attribute_js[$attribute['id_attribute_group']][$attribute['id_attribute']] = $attribute['name'];

        $attribute_groups = AttributeGroup::getAttributesGroups($this->context->language->id);
        $this->product = new Product((int)Tools::getValue('id_product'));

        $this->context->smarty->assign(array(
            'tax_rates' => $this->product->getTaxesRate(),
            'generate' => isset($_POST['generate']) && !count($this->errors),
            /*'combinations_size' => count($this->combinations),*/
            'product_name' => $this->product->name[$this->context->language->id],
            'attribute_groups' => $attribute_groups,
            'attribute_js' => $attribute_js,
            'product' => $this->product,
            'attr_groups_being_used' => $this->product->pricing_algorithm_attribute_groups,//$this->array_2_csv_with_parentheses(json_decode($this->product->pricing_algorithm_attribute_groups))
            'dp_product_quantity' => $this->product->dynamic_pricing_product_quantity,
            'formula_to_use' => $this->product->formula_to_use
        ));

        return $this->display(__FILE__, 'views/templates/admin/iprintmodule.tpl');
    }

    //On save of the Dynamic Pricing tab, this code runs
    public function hookActionProductUpdate($params)
    {
        //d($params);
        $is_dynamically_priced_product = NULL;


        //str_getcsv returns an array
        //$attr_group_names = str_getcsv(Tools::getValue("attribute_groups_used"));

        //json_encode transforms the array into a json string to be decoded when it is retrieved next time
        //$pricing_algor_attribute_groups = json_encode($attr_group_names);

        $does_use_dynamic_pricing = Tools::getValue("does_use_dynamic_pricing");
        
        $id_of_product;
        
        if (Tools::getValue('id_product') == null || Tools::getValue('id_product') == "") {
            $id_of_product = $params["id_product"];
        } else {
            $id_of_product = Tools::getValue('id_product');
        }

        if ($does_use_dynamic_pricing == "1") {
            $is_dynamically_priced_product = true;
        } else if ($does_use_dynamic_pricing == "0") {
            $is_dynamically_priced_product = false;
        }
        //TODO: add a former_show_price field? so that when product stops being a dynamically priced product, it will keep it's former show_price value
        if ($is_dynamically_priced_product) {
            $val = Tools::getValue("attribute_groups_used");
            if (!empty($val)) {
                Db::getInstance()->update('product',//update table
                    array( // with this data
                        'is_dynamically_priced_product' => true,
                        'pricing_algorithm_attribute_groups' => Db::getInstance()->_escape(Tools::getValue("attribute_groups_used")),
                        'dynamic_pricing_product_quantity' => Db::getInstance()->_escape(Tools::getValue("dp_product_quantity")),
                        /*'quantity' => Db::getInstance()->_escape(Tools::getValue("dp_product_quantity")),
                        'out_of_stock' =>  ((int)Tools::getValue("dp_product_quantity")) <= 0 ? 1 : 0,*/
                        /*'specific_quantity_choices' => Tools::getValue("specific_qty_choices")*/
                        'has_custom_quantity_attribute' => intval(Tools::getValue("has_custom_qty_attr")),
                        'custom_quantity_attribute_name' => Tools::getValue("custom_qty_attr_name"),
                        'formula_to_use' => Tools::getValue("formula_to_use"),
                        'has_alias_for_quantity' => true
                    ),
                    'id_product = ' . $id_of_product//where
                );

                if (is_numeric(Tools::getValue("dp_product_quantity"))) {
                    //This causes the StockAvailable quantity to align with the dp_product_quantity
                    StockAvailable::updateQuantity($id_of_product, null, 0);
                }
            } else {
                $error = Tools::displayError('No data added to the "Attribute groups to be displayed..." field');
                $this->context->controller->errors[] = $error;
            }
            //TODO: programatically set this product to have setting of "Allow orders" "When out of stock" so that the price doesn't display
        } else {

            Db::getInstance()->update('product',//update table
                array( // with this data
                    'is_dynamically_priced_product' => false/*,
                    'show_price' => true*/
                ),
                'id_product = '.$id_of_product//where
            );
        }


        /*if hook product update may be triggered many times use this
        if ($this->isSaved)
            return null;

        and do $this->isSaved = true; at end of this method*/
        /*Db::getInstance()->update('product', array('custom_field'=> pSQL(Tools::getValue('custom_field_'.$lang['id_lang']))) ,'id_lang = ' . $lang['id_lang'] .' AND id_product = ' .$id_product );
        $id_product = (int)Tools::getValue('id_product');

        $languages = Language::getLanguages(true);
        foreach ($languages as $lang) {
            if(!Db::getInstance()->update('product_lang', array('custom_field'=> pSQL(Tools::getValue('custom_field_'.$lang['id_lang']))) ,'id_lang = ' . $lang['id_lang'] .' AND id_product = ' .$id_product ))
                $this->context->controller->_errors[] = Tools::displayError('Error: ').mysql_error();
        }*/

        //possibly will need die() at end
    }

}
