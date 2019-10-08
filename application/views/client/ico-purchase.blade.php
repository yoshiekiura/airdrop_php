@extends("client.layout.master")

@push("plugin_css")
<!-- Select2 -->
<link rel="stylesheet" href="{{base_url()}}assets/vendor_components/select2/dist/css/select2.min.css">
<!-- bootstrap datepicker -->   
<link rel="stylesheet" href="{{base_url()}}assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

@endpush

@push("custom_css")
<style>
    .btn-lg{
        line-height: 45px !important;
    }
    .exchange-calculator input
    {
        font-size: 1.5 em;
        width: auto;
    }
    .formular-term{
        display: flex;
    }
    .exchange-calculator .select2-container{
        width: 50% !important;
    }
    #pay-amount{
        width: 50%;
        margin-right:10px;
    }
    .equal{
        width: 5%
    }
    #tos_link{
        color: cyan;
    }
    #tos_link:hover{
        text-decoration-line: underline;
    }
</style>
@endpush

@section("menu-ico", "menu-open")
@section("ico-purchase_test", "active")
@section("dropdown-ico", "display: block")

@section("content")
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Purchase SREUR Tokens
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">ICO</a></li>
        <li class="breadcrumb-item active">Purchase</li>
    </ol>
</section>
<p />

<?php
if (intval($is_accredited_investor) == -1 ){
?>
<section class="content-header">
    <h1 class="bg-info" style="padding:12px;border-radius:5px;color:white;">
    Are you an Accredited Investor?
    </h1>
    <p />

    <?php echo form_open(base_url().'client/ICO/setAccreditedInvestor',array('class' => 'form-element','id'=>'accredited_form','method'=>'post')); ?>

        <input type="radio" class="form-check-input" id="yes_flag" name="accredited-flag" value="1">
        <label for="yes_flag" class=" font-weight-500">YES</label>

        <input type="radio" class="form-check-input" id="no_flag" name="accredited-flag" value="0" checked="checked">
        <label for="no_flag" class=" font-weight-500">NO</label>

        <p style="width:30%; margin-right: 0px;"/>
        <button type="submit" id="sbmaccredited" class="btn btn-success btn-sm btn-block">Submit</button>

    </form>
    <hr>
    <p>
        You do not know what an Accredited Investor is? Read the <a style="color:blue;" href="https://www.ecfr.gov/cgi-bin/retrieveECFR?gp=&SID=8edfd12967d69c024485029d968ee737&r=SECTION&n=17y3.0.1.1.12.0.46.176" target="_blank">Electronic Code of Federal Regulations</a>
    </p>
    <p>
        <div class="alert alert-warning" role="alert">
            If you are a USA Citizen and you are not an Accredited Investor, you cannot purchase Tokens in our company.
        </div>

    </p>      
    
</section>
<?php
}else{
?>

<!-- Main content -->

<section class="content">
    <div class="box box-inverse bg-dark bg-hexagons-white">
        <div class="box-body">
            <h1 class="page-header text-center no-border font-weight-600 font-size-60 mt-25">Buy <span class="text-danger">SREUR</span>
            Tokens Now!
            <h3 class="subtitle text-center ">Buy now minimum pre-sale amount 10 SREUR Token.<br>We accept 20+ cryptocurrencies
            including Bitcoin, Ethereum and LiteCoin.</h3>

            <div class="row">
                <div class="col-12">
                    <?php echo form_open(base_url().'client/ICO/purchase', array('id'=>'purchase_form')); ?>
                        <div class="exchange-calculator text-center mt-35">
                            <div class="row">
                                <div class="col-md-3 formular-term">
                                    <input type="number" step="any" class="form-control" id="pay-amount" name="pay-amount" placeholder="" value="" required>
                                    <select id="currency-select" name="currency" required>
                                    </select>
                                </div>

                                <div class="equal"> = </div>

                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="number"  step="any"  class="form-control" id="receive-amount" name="receive-amount" placeholder="" value="50" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                SREUR
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="equal"> / </div>

                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="number"  step="any"  class="form-control" id="discount_field" disabled>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                Discount
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="equal"> = </div>

                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="number"  step="any"  class="form-control" id="total_field" disabled>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                Total
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-10 mb-10 font-size-20">
                            <input type="checkbox" id="guarantee_flag" name="guarantee-flag" class="filled-in chk-col-green" value="1">
                            <label for="guarantee_flag" class=" font-weight-500">PURCHASE WITH PRICE GUARANTEED up to
                                <a id="tos_link" href="https://www.socialremit.com/docs/CondicionesservicioAirdropEN.pdf" target="_blank">Terms of Service</a>
                            </label>
                        </div>
                        <div id="guarantee_explanation" class="text-center mt-10 mb-10" style="display:none;">
                            <p class="font-size-16 color-white">
                                According to <a href="https://www.socialremit.com/docs/TermsServiceAirdropEN.pdf" target="_blank" style="    color: cyan;">Terms of Service</a>
                            </p>
                            <!-- <p class="font-size-16">
                                If you do not change your SREUR tokens for 2 years, you will have guaranteed price at the end of the 2 years.
                            </p>
                            <p class="font-size-16">
                                You are able to exchange your tokens with
                                <span id="guarantee_price" class="badge badge-pill badge-lg badge-success font-size-20">55 EUR</span>
                                by <span id="guarantee_date"  class="badge badge-pill badge-lg badge-success font-size-20">11/30/2020</span>!
                            </p> -->
                        </div>

                        <input type="hidden" name="payment-method" id="payment_method_field" value="crypto"></input>
                        <input type="hidden" name="stripe-token" id="stripe_token_field" value=""></input>
                        <input type="hidden" name="bank-details" id="bank_details_field" value=""></input>

                        <div class="text-center mt-50 mb-40">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button id="crypto_btn" class="payment-button btn btn-yellow btn-lg btn-block">BUY WITH CRYPTOCURRENCY!</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button id="stripe_btn" class="payment-button btn btn-yellow btn-lg btn-block">BUY WITH CREDIT CARD!</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button id="bank_btn" class="payment-button btn btn-yellow btn-lg btn-block"
                                            data-toggle="modal" data-target=".bank_modal">BUY WITH BANK TRANSFER!</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bank Transfer Modal -->
    <div class="modal fade bank_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">BUY WITH BANK TRANSFER </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <form id="bank_form" class="form-element">

                <div class="modal-body">
                    <h4></h4>
                    <div class="row">
                        <div class="col-md-6 br-1">
                            <h4 class="text-center">Our company's bank details</h4>
                            <p>After making bank transfer, fill right side form please.</p>
                            <br>

                            <div class="row">
                                @foreach(COMPANY_BANK_ACCOUNTS as $country => $details)
                                    <div class="col-12 bt-1 mt-5 pt-5"><h4>{{$country}}</h4></div>
                                    @foreach($details as $key => $value)
                                        <div class="col-md-6">{!!$key!!}: </div>
                                        <div class="col-md-6"><strong>{!!$value!!}</strong></div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-center">Transfer Information</h4>
                            <p></p>
                            <br>
                            <div class="form-group row">
                                
                                <?php foreach(BANK_TRANSFER_ITEMS as $key => $val){
                                    $value = "";
                                    if( $key == 'full_name' ){
                                        $value = $userdata->first_name . ' ' . $userdata->second_name;
                                    }
                                    else if(isset($userdata->$key)){
                                        $value = $userdata->$key;
                                    }
                                ?>
                                    <label class="col-md-4 control-label">{{$val}}</label>
                                    <div class="col-md-8">
                                        @if($key == "username" || $key == "full_name" || $key == "country" || $key == "email")
                                            <input name="{{$key}}" class="form-control" type="text" value="{{$value}}" <?=empty($value) ? '' : 'disabled'?> required>
                                        @elseif($key == "transfer_date")
                                            <input id="{{$key}}" name="{{$key}}" class="form-control" type="text" required>
                                        @elseif($key == "bank")
                                            <input name="{{$key}}" class="form-control" type="text" required>
                                        @elseif($key == "amount")
                                            <input name="{{$key}}" class="form-control" type="number" required>
                                        @elseif($key == "currency")
                                            <select class="form-control" name="{{$key}}" required>
                                                @foreach(CURRENCIES as $initial => $info)
                                                    <option value="{{$initial}}">{{$initial}} : {{$info['full_name']}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input name="{{$key}}" class="form-control" type="text" required>
                                        @endif
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer pt-20" style="width: 100%">
                    <div class="row">
                        <div class="col-6 mx-auto">
                            <input id="bank_submit_btn" type="submit" class="btn btn-block btn-success"></input>
                        </div>
                    </div>
                </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- Light Ticker -->
    <div class="box">
        <div class="box-body tickers-block">
            <ul id="price-ticker">
                <!-- ... -->
            </ul>
        </div>
    </div>

</section>
<!-- /.content -->

<?php } ?>
@endsection

@push('plugin_js')
<!-- Select2 -->
<script src="{{base_url()}}assets/vendor_components/select2/dist/js/select2.full.js"></script>
<!-- webticker -->
<script src="{{base_url()}}assets/vendor_components/Web-Ticker-master/jquery.webticker.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Stripe -->
<script src="https://checkout.stripe.com/checkout.js"></script>
@endpush

@push('custom_js')
<script>
    var coingate_rates = {!!$coingate_rates!!};
    var supportedCoins=['EUR','USD','GBP', 'RUB', 'JPY','CNY','INR','PKR',//'VEF',    //fiat
                        'BTC','ETH',       'LTC','XRP','ZEC'];  //crypto

    var coin_prices = {
        // fiat
        EUR:    { fullname:     'Euro',                 price: '',    type: 'fiat' },
        USD:    { fullname:     'US Dollar',            price: '',    type: 'fiat' },
        GBP:    { fullname:     'British Pound',        price: '',    type: 'fiat' },
        RUB:    { fullname:     'Russian Rouble',       price: '',    type: 'fiat' },
        JPY:    { fullname:     'Japanese Yen',         price: '',    type: 'fiat' },
        CNY:    { fullname:     'Chinese Yuan',         price: '',    type: 'fiat' },
        INR:    { fullname:     'Indian Rupee',         price: '',    type: 'fiat' },
        PKR:    { fullname:     'Pakistani Rupee',      price: '',    type: 'fiat' },
        // VEF:    { fullname:     'Venezuelan Bolivar',   price: '',    type: 'fiat' },

        // crypto   
        BTC:    { fullname:     'Bitcoin',              price: '',    type: 'crypto' },
        ETH:    { fullname:     'Ethereum',             price: '',    type: 'crypto' },
        DASH:   { fullname:     'Dash',                 price: '',    type: 'crypto' },
        LTC:    { fullname:     'Litecoin',             price: '',    type: 'crypto' },
        XRP:    { fullname:     'Ripple',               price: '',    type: 'crypto' },
        ZEC:    { fullname:     'Zcash',                price: '',    type: 'crypto' },
        BCH:    { fullname:     'Bitcoin Cash',         price: '',    type: 'crypto' },
        ETC:    { fullname:     'Ethereum Classic',     price: '',    type: 'crypto' },
        DOGE:   { fullname:     'Dogecoin',             price: '',    type: 'crypto' },
        XMR:    { fullname:     'Monero',               price: '',    type: 'crypto' },
        OMG:    { fullname:     'OmiseGo',              price: '',    type: 'crypto' },
        WAVES:  { fullname:     'Waves',                price: '',    type: 'crypto' },
    };
    for(var i = 0; i < supportedCoins.length; i++){
        coin_prices[supportedCoins[i]].price = coingate_rates[supportedCoins[i]].EUR;
    }

    var token_price = {{$token_price}};
    var discount_rate = {{$discount_rate}};
    var guarantee_rate = {{$guarantee_rate}};

    var stripe_handler;

    function calculate_price(){
        var amount = $("#receive-amount").val();
        var coin = $("#currency-select").select2("val");

        if(isNaN(amount))   return;
        var price = (amount * token_price) / coin_prices[coin].price;
        $("#pay-amount").val(price.toFixed( coin_prices[coin].type == "fiat" ? 2 : 6 ));
        $("#total_field").val((amount / discount_rate).toFixed( 6 ));

        //guarantee
        // $("#guarantee_price").text((amount * guarantee_rate).toFixed( 2 ) + ' EUR');
    }

    function calculate_amount(){
        var price = $("#pay-amount").val();
        var coin = $("#currency-select").select2("val");

        if(isNaN(price))   return;
        var amount = (price * coin_prices[coin].price) / token_price;
        $("#receive-amount").val(amount.toFixed( 6 ));
        $("#total_field").val((amount / discount_rate).toFixed( 6 ));

        //guarantee
        // $("#guarantee_price").text((amount * guarantee_rate).toFixed( 2 ) + ' EUR');
    }

    function refreshWidgets(){
        var dom_ticker = $("#price-ticker");
        var coin_select = $("#currency-select");

        for(var index in supportedCoins){
            var option_html = `<option value="${supportedCoins[index]}">${coin_prices[supportedCoins[index]].fullname}</option>`
            coin_select.append(option_html)
        }

        for (var coin in coin_prices) {
            var ticker_html = `<li><i class="cc ${coin}"></i> ${coin} <span class="text-yellow"> &euro; ${coin_prices[coin].price}</span></li>`;
            if(coin.type === "crypto")
                dom_ticker.append(ticker_html)
        }
        // for (var coin in coin_prices) {
        //     var option_html = `<option value="${coin}">${coin_prices[coin].fullname}</option>`
        //     var ticker_html = `<li><i class="cc ${coin}"></i> ${coin} <span class="text-yellow"> $ ${coin_prices[coin].price}</span></li>`;
        //     coin_select.append(option_html)
        //     if(coin !== "EUR")
        //         dom_ticker.append(ticker_html)
        // }
        
        dom_ticker.webTicker({
            height: 'auto',
            duplicate: true,
            startEmpty: false,
            rssfrequency: 5,
        });
        
        coin_select.select2();
        calculate_price();
    }

    function validatePurchaseAmount(){
        if( $("#receive-amount").val() < 10 ){
            $.toast({
                heading: 'Too little amount!',
                text: 'You should purchase at least 10 tokens.',
                position: 'bottom-right',
                loaderBg: '#ff6849',
                icon: 'warning',
                hideAfter: 15000,
                stack: 6,
            });
            return false;
        }
        return true;
    }

    function disablePaymentButtons(){
        $(".payment-button").prop('disabled', true);
    }
    function enablePaymentButtons(){
        $(".payment-button").prop('disabled', false);
    }

    //form to json helper
    function objectifyForm(formArray) {//serialize data function
        var returnArray = {};
        for (var i = 0; i < formArray.length; i++){
            returnArray[formArray[i]['name']] = formArray[i]['value'];
        }
        return returnArray;
    }

    $(function () {
        "use strict";

        var apiUrl = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms=';
        for(var coin in coin_prices ){
            apiUrl += coin + ',';
        }
        apiUrl += '&tsyms=EUR';

        $.getJSON(apiUrl, function(data){
            for(var coin in coin_prices ){
                if(coin_prices[coin].price != '')   continue;
                coin_prices[coin].price = data.RAW[coin].EUR.PRICE;
            }
            refreshWidgets();
        });
        
        $("#receive-amount").change(function(){
            calculate_price();
        }).keyup(function(){
            calculate_price();
        });

        $("#pay-amount").change(function(){
            calculate_amount();
        }).keyup(function(){
            calculate_amount();
        });

        $('#currency-select').on('select2:select', function (e) {
            calculate_price();
        });

        $("#crypto_btn").on('click', function(event){
            event.preventDefault();
            // payment using credit card
            $("#payment_method_field").val('crypto');
            if( validatePurchaseAmount()){
                disablePaymentButtons()
                $("#purchase_form").submit();
            }
        });

        $("#receive-amount").val("50");
        $("#discount_field").val(discount_rate);

        //Guarantee option
        $("#guarantee_flag").change(function(){
            // if( $(this).is(':checked') ){}
            
            // $("#guarantee_explanation").animate({
            //     height: 'toggle'
            // }, "slow");
        })

        // Credit Card button
        stripe_handler = StripeCheckout.configure({
            key: '{{$stripe_public_key}}',
            image: 'https://www.socialremit.com/asset/img/SocialRemit_Logo.png',
            locale: 'auto',
            token: function(token) {
                // You can access the token ID with `token.id`.
                // Get the token ID to your server-side code for use.
                disablePaymentButtons();
                $("#payment_method_field").val('card');
                $("#stripe_token_field").val(token.id);
                //submit form manually
                $("#purchase_form").submit();
            }
        });

        $("#stripe_btn").on( 'click', function(event){
            // payment using credit card
            $("#payment_method_field").val('card');
            if(validatePurchaseAmount()){
                var coin = $("#currency-select").select2("val");
                var currency = coin_prices[coin].type == "fiat" ? coin : 'EUR';

                var price = Math.round(parseFloat($("#pay-amount").val()) * 100);
                stripe_handler.open({
                    name: 'SocialRemit ICO',
                    description: 'Purchase ' + $("#total_field").val() + ' SREUR tokens.',
                    email: '{{$userdata->email}}',
                    currency: currency,
                    amount: price,
                    // data-zip-code: 'true',
                });
            }
            event.preventDefault();
        });

        window.addEventListener('popstate', function() {
            stripe_handler.close();
        });

        /// Bank Transfer Button
        $("#bank_btn").on( 'click', function(event){
            // payment using credit card
            $("#payment_method_field").val('bank');
            // no need to check minimum amount
            // if(validatePurchaseAmount()){
            // }
            
            event.preventDefault();
        });

        /// Transfer form
        $("#bank_form").submit(function(event){
            event.preventDefault();
            disablePaymentButtons();

            var bank_form_values = $( this ).serializeArray();
            bank_form_values = objectifyForm(bank_form_values);
            $('#payment_method_field').val('bank');
            $('#bank_details_field').val(JSON.stringify(bank_form_values));
            $('.bank_modal').modal('hide');
            $('#purchase_form').submit();
        })
        $("#transfer_date").datepicker({
            autoclose: true
        });
    });
/*
{
EUR:    { fullname:     'Euro',    price: '1' },
BTC:    { fullname:     'Bitcoin',      price: '54.632' },
LTC:    { fullname:     'Litecoin',     price: '5.632' },
ETH:    { fullname:     'Ethereum',     price: '4.632' },
BCH:    { fullname:     'Bitcoin Cash', price: '54.32' },
XRP:    { fullname:     'Ripple',       price: '5.62' },
ETC:    { fullname:     'Ethereum Classic', price: '4.63' },
DASH:   { fullname:     'Dash',         price: '34.1632' },
DOGE:   { fullname:     'Dogecoin',     price: '3.4632' },
XMR:    { fullname:     'Monero',       price: '6.3632' },
OMG:    { fullname:     'OmiseGo',      price: '554.5632' },
WAVES:  { fullname:     'Waves',        price: '2.4632' },
ZEC:    { fullname:     'Zcash',        price: '5.6532' }
}


Bitcoin:BTC
Litecoin:LTC
Ethereum:ETH
Bitcoin Cash:BCH
Ripple:XRP
Ethereum Classic:ETC
Zcash:ZEC
Monero:XMR
Dash:DASH

Aragon
Basic Attention Token
Binance
Bancor
Blackcoin
Civic
Dogecoin:DOGE +
Edgeless
Golem
Matchpool
Komodo
LBRY Credits
Numeraire
Nxt
OmiseGo:OMG +
Potcoin
Polymath
Qtum
Augur
Reddcoin
RCN
iExec
Salt
Siacoin
Status
Storj
Swarm City
Waves:WAVES +
Wings
Zilliqa
0x
*/
</script>
{!!message_box_new('error')!!}
{!!message_box_new('success')!!}
@endpush
