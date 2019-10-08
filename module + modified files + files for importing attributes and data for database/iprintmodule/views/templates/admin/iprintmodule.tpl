{*"`$smarty.const._PS_MODULE_DIR_`iprintmodule/calc.php"|@print_r*}
{*include file="`$smarty.const._PS_MODULE_DIR_`iprintmodule/calc.php"*}
<script type="text/javascript">
    (function() {
        {*{addJsDef isDynamicallyPricedd=$product->is_dynamically_priced_product|boolval}

        if (!isDynamicallyPricedd) {
            $(".disable-if-not-dy-priced").prop( "disabled", true );
        }*}

        $(function(ready) {
            $("input[name='does_use_dynamic_pricing']:radio").change(function (e) {
                if ($("#notDynamicallyPricedChoice").is(':checked')) {
                    $(".disable-if-not-dy-priced").prop("disabled", true);
                } else if ($("#isDynamicallyPricedChoice").is(':checked')) {
                    $(".disable-if-not-dy-priced").prop("disabled", false);
                }
            });
        });

        $(function(ready) {
            $("input[name='has_custom_qty_attr']:radio").change(function (e) {
                if ($("#doesNotHaveCustomQtyAttrChoice").is(':checked')) {
                    $(".disable-if-no-special-qty-attr").prop("disabled", true);
                } else if ($("#doesHaveCustomQtyAttrChoice").is(':checked')) {
                    $(".disable-if-no-special-qty-attr").prop("disabled", false);
                }
            });
        });

        var attrs = new Array();
        attrs[0] = new Array(0, '---');

        {foreach $attribute_js as $idgrp => $group}
        {assign var="row" value="attrs[{$idgrp}] = new Array(0, '---'"}

        {foreach $group as $idattr => $attrname}
        {assign var="row" value="{$row}, {$idattr}, '{$attrname|escape}'"}
        {/foreach}

        {assign var="row" value="{$row});"}
        {$row}
        {/foreach}

        i18n_tax_exc = '{l s='Tax Excluded'} ';
        i18n_tax_inc = '{l s='Tax Included'} ';

        var product_tax = '{$tax_rates}';
        function calcPrice(element, element_has_tax)
        {
            var element_price = element.val().replace(/,/g, '.');
            var other_element_price = 0;

            if (!isNaN(element_price) && element_price > 0)
            {
                if (element_has_tax)
                    other_element_price = parseFloat(element_price / ((product_tax / 100) + 1)).toFixed(6);
                else
                    other_element_price = ps_round(parseFloat(element_price * ((product_tax / 100) + 1)), 2).toFixed(2);
            }

            $('#related_to_'+element.attr('name')).val(other_element_price);
        }

        $(document).ready(function() { $('.price_impact').each(function() { calcPrice($(this), false); }); });
    })();
</script>
<style>
    #attributes-list {
        cursor: initial;
        background-color: initial;
        opacity: 1;
    }
</style>
<div id="product-dynamic-pricing" class="panel product-tab">
    <h3>{l s='iPrint Module'}</h3>


    <div class="row">
        <div class="col-lg-3">
            <div style="margin-bottom: 23px;">
                <h4>{l s='Use dynamic pricing?:'}</h4>
                <span class="switch prestashop-switch fixed-width-lg">
                    <input id="isDynamicallyPricedChoice" type="radio" name="does_use_dynamic_pricing" value="1" {if ($product->is_dynamically_priced_product)}checked="checked"{/if} >
                    <label for="isDynamicallyPricedChoice">Yes</label>
                    <input id="notDynamicallyPricedChoice"type="radio" name="does_use_dynamic_pricing" value="0" {if (!$product->is_dynamically_priced_product)}checked="checked"{/if} >
                    <label for="notDynamicallyPricedChoice">No</label>
                    <a class="slide-button btn"></a>
                </span>
            </div>

            <h4>{l s='(For reference) All attribute groups:'}</h4>
            <div class="form-group">
                <select disabled size="28" multiple name="attributes[]" id="attributes-list" style="height: 700px">
                    {foreach $attribute_groups as $k => $attribute_group}
                        {if isset($attribute_js[$attribute_group['id_attribute_group']])}
                            <optgroup name="{$attribute_group['id_attribute_group']}" id="{$attribute_group['id_attribute_group']}" label="{$attribute_group['name']|escape:'html':'UTF-8'}">
                                {*{foreach $attribute_js[$attribute_group['id_attribute_group']] as $k => $v}
                                    <option name="{$k}" id="attr_{$k}" value="{$v|escape:'html':'UTF-8'}" title="{$v|escape:'html':'UTF-8'}">{$v|escape:'html':'UTF-8'}</option>
                                {/foreach}*}
                            </optgroup>
                        {/if}
                    {/foreach}
                </select>
            </div>
        </div> <!--div col-lg-3-->
        <div class="col-lg-8 col-lg-offset-1">
            <h4>{l s='Attribute groups to be displayed for this product:'}</h4><h5>{l s='(Put name of attribute groups in quotes and separate them with a comma. Beware spelling mistakes.)'}</h5>
            <i>{l s='Example: "Attribute group name", "Another attribute group name", "Attr Group 3"'} </i>
            <input name="attribute_groups_used" type="text" class="disable-if-not-dy-priced form-control" {if isset($product->is_dynamically_priced_product) && (!$product->is_dynamically_priced_product)}disabled{/if} value="{if isset($attr_groups_being_used)}{$attr_groups_being_used|escape}{/if}"><br>

            <h4>{l s='Product quantity'}</h4><h5>{l s='Estimate of how much of this product you have in stock, no matter what combination.'}</h5>
            <input style="width: 80px;" name="dp_product_quantity" type="text" class="disable-if-not-dy-priced form-control" {if isset($product->is_dynamically_priced_product) && (!$product->is_dynamically_priced_product)}disabled{/if} value="{if isset($dp_product_quantity)}{$dp_product_quantity|escape}{/if}"><br>

            <div style="margin-bottom: 23px;">
                <h4>{l s='Has a special attribute for buying product in specific/limited quantity choices?:'}</h4>
                <span class="switch prestashop-switch fixed-width-lg">
                    <input id="doesHaveCustomQtyAttrChoice" type="radio" name="has_custom_qty_attr" value="1" {if ($product->has_custom_quantity_attribute)}checked="checked"{/if} >
                    <label for="doesHaveCustomQtyAttrChoice">Yes</label>
                    <input id="doesNotHaveCustomQtyAttrChoice"type="radio" name="has_custom_qty_attr" value="0" {if (!$product->has_custom_quantity_attribute)}checked="checked"{/if} >
                    <label for="doesNotHaveCustomQtyAttrChoice">No</label>
                    <a class="slide-button btn"></a>
                </span>
            </div>

            <h4>{l s="Quantity choice attribute"}</h4>
            <h5>{l s="Don't include quotes around the name of the attribute."}</h5>
            <input style="width: 160px;" name="custom_qty_attr_name" type="text" class="disable-if-not-dy-priced disable-if-no-special-qty-attr form-control" {if isset($product->has_custom_quantity_attribute) && (!$product->has_custom_quantity_attribute)}disabled{/if} value="{if isset($product->custom_quantity_attribute_name)}{$product->custom_quantity_attribute_name|escape}{/if}"><br>
           
            <h4>{l s="Formula type"}</h4>
            <select name="formula_to_use" id="formulaToUse">
                    <option value="0" {if isset($formula_to_use) && $formula_to_use == 0}selected="selected"{else}selected="selected"{/if}>Catalog Formula</option>
                    <option value="1" {if isset($formula_to_use) && $formula_to_use == 1}selected="selected"{/if}>Brochure Formula</option>
                    <option value="2" {if isset($formula_to_use) && $formula_to_use == 2}selected="selected"{/if}>Booklet Formula</option>
                    <!--<option value="3">Leaflet Formula</option>-->
            </select>
            {*
            <h4>{l s="Specific quantity choices"}</h4>
            <h5>{l s="Choice of quantities users can pick from."}</h5>
            <input style="width: 160px;" name="specific_qty_choices" type="text" class="disable-if-not-dy-priced form-control" value="{if isset($product->specific_quantity_choices)}{$product->specific_quantity_choices|escape}{/if}"><br>
            *}

        </div><!--div col-lg-8 col-lg-offset-1-->
    </div>
    <div class="panel-footer">
        <a href="{$link->getAdminLink('AdminProducts')}" class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel'}</a>
        <button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save'}</button>
        <button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save and stay'}</button>
    </div>
</div>

