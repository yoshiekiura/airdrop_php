<?php


include_once(_PS_MODULE_DIR_.'dynamicpricing/lib/php2js/src/php2js.php');

class ProductController extends ProductControllerCore {

    public function initContent()
    {
        parent::initContent();

        if ($this->product->is_dynamically_priced_product) {

            //$pricing_algorithm = PHP2JS::translateString($this->product->pricing_algorithm);

            $this->context->smarty->assign(array(
                'pricing_algorithm' => $this->product->pricing_algorithm_js,
                'specific_quantity_choices' => explode(', ', $this->product->specific_quantity_choices) //returns array made of the quantity choices
            ));
        }
        //echo print_r($this->product);
    }

    protected function assignAttributesGroups()
    {
        parent::assignAttributesGroups();

        if ($this->product->is_dynamically_priced_product) {
            $colors = array();
            $groups = array();

            $attributes = $this->product->getAttributesForDynamicallyPricedProduct($this->context->language->id);

            foreach ($attributes as $itemIndex => $item) {
                if (!isset($groups[$item['id_attribute_group']]))
                    $groups[$item['id_attribute_group']] = array(
                        'group_name' => $item['group_name'],
                        'name' => $item['public_group_name'],
                        'group_type' => $item['group_type'],
                        'default' => -1,
                    );

                $groups[$item['id_attribute_group']]['attributes'][$item['id_attribute']] = $item['attribute_name'];

                if (isset($item['is_color_group']) && $item['is_color_group'] && (isset($item['attribute_color']) && $item['attribute_color']) || (file_exists(_PS_COL_IMG_DIR_.$item['id_attribute'].'.jpg'))) {
                    $colors[$item['id_attribute']]['value'] = $item['attribute_color'];
                    $colors[$item['id_attribute']]['name'] = $item['attribute_name'];
                }
            }

            $this->context->smarty->assign(array(
                'groups' => $groups,
                'colors' => (count($colors)) ? $colors : false
            ));
        }
    }

    public function setMedia()
    {
        parent::setMedia();
        if (count($this->errors))
            return;

        $this->addJS(array(
            /*_THEME_JS_DIR_.'php.js', //used for creating a mini-vm for running php code through javascript
            _THEME_JS_DIR_.'xhr.js'
            _THEME_JS_DIR_.'javascript-sandbox-console/src/sandbox-console.js'*/
        ));
    }



}

