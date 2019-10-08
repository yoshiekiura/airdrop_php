@extends("client.layout.master")

@push("custom_css")
<style>
    .btn-social-icon{
        color: white !important;
        margin-left: 10px;
    }
    span.checkbox::before{
        display:none !important;
    }
    [type=checkbox]:checked+label:before{
        display:none !important;
    }
    [type=checkbox]+label:before, [type=checkbox]:not(.filled-in)+label:after{
        display:none !important;
    }
    .cryptocompare-logo{
        display:none !important;
    }
    #forex_ticker{
        margin:0 auto;
        background-color:white;
        width:100%;
        height:50px;
        line-height: 1.5rem;
        font-size: 1.5rem;
        padding: 10px;
        border:1px solid #42A400;
        color:#42A400;"
    }
</style>
@endpush

@section("sidebar_dashboard", "class=active")

@section("content")
<section class="content-header">
	<h1>
		Dashboard
		<!-- <small style="margin-left: 20px" id="ico_counter">
			ICO ends in
			<strong class="text-red" id="ico_counter_day">23</strong> days /
			<strong class="text-red" id="ico_counter_hour">21</strong> hours /
			<strong class="text-red" id="ico_counter_minute">10</strong> minutes /
			<strong class="text-red" id="ico_counter_second">30</strong> seconds
		</small> -->
	</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="breadcrumb-item active">Dashboard</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<!--       

        <section class="content">
          <div class="row">
          </div>
        </section> -->
	<!-- <div class="row">
      <div class="col-xl-3 col-md-6 col-12 ">
          <div class="box box-body pull-up">
            <h6 class="text-uppercase">Your Balance</h6>
            <div class="flexbox mt-2">
              <span class="ion ion-ios-heart text-danger font-size-40"></span>
              <span class=" font-size-30">11,457 SREUR</span>
            </div>
          </div>
      </div>
    </div> -->

	<div class="row">
		<div class="col-md-6 col-12 ">
			<div class="box box-body pull-up">
				<h6 class="text-uppercase">Your CSR tokens</h6>
				<div class="flexbox mt-2">
					<span class="ion ion-ios-heart text-danger font-size-40"></span>
					<span class=" font-size-30">{{$userdata->mlm_flag? $userdata->mlm_commission : $userdata->total_score}} CSR</span>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-12 ">
			<div class="box box-body pull-up">
				<h6 class="text-uppercase">Your SREUR tokens</h6>
				<div class="flexbox mt-2">
					<span class="ion ion-ios-heart text-danger font-size-40"></span>
					<span class=" font-size-30">{{$userdata->total_ico_token}} SREUR</span>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-xl-3">
			<div class="box pull-up">
				<div class="box-body">
					<div class="row align-items-center">
						<div class="col-2">
							<i class="cc BTC font-size-30" title="BTC"></i>
						</div>
						<div class="col-8">
							<h4 class="counter text-dark text-center mb-0" id="chart-box-BTC">
                                $ 12458
                                <small class="text-danger pl-10"> <i class="mdi mdi-arrow-down text-danger"></i> -7.45%</small>
                            </h4>
						</div>
						<div class="col-2">
							<a href="#" class="btn btn-success btn-sm float-right">Buy</a>
						</div>
						<div class="col-12">
							<div id="sparkline0" class="mt-10"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xl-3">
			<div class="box pull-up">
				<div class="box-body">
					<div class="row align-items-center">
						<div class="col-2">
							<i class="cc ETH font-size-30" title="ETH"></i>
						</div>
						<div class="col-8">
							<h4 class="counter text-dark text-center mb-0" id="chart-box-ETH">$ 845 <small class="text-success pl-10"><i class="mdi mdi-arrow-up text-success"></i>
									+5.45%</small></h4>

						</div>
						<div class="col-2">
							<a href="#" class="btn btn-danger btn-sm float-right">Sell</a>
						</div>
						<div class="col-12">
							<div id="sparkline1" class="mt-10"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xl-3">
			<div class="box pull-up">
				<div class="box-body">
					<div class="row align-items-center">
						<div class="col-2">
							<i class="cc DASH font-size-30" title="DASH"></i>
						</div>
						<div class="col-8">
							<h4 class="counter text-dark text-center mb-0"  id="chart-box-DASH">$ 4587 <small class="text-danger pl-10"><i class="mdi mdi-arrow-down text-danger"></i>
									-4.45%</small></h4>

						</div>
						<div class="col-2">
							<a href="#" class="btn btn-success btn-sm float-right">Buy</a>
						</div>
						<div class="col-12">
							<div id="sparkline2" class="mt-10"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xl-3">
			<div class="box pull-up">
				<div class="box-body">
					<div class="row align-items-center">
						<div class="col-2">
							<i class="cc LTC font-size-30" title="LTC"></i>
						</div>
						<div class="col-8">
							<h4 class="counter text-dark text-center mb-0" id="chart-box-LTC">$ 1458 <small class="text-success pl-10"><i class="mdi mdi-arrow-up text-success"></i>
									+5.45%</small></h4>

						</div>
						<div class="col-2">
							<a href="#" class="btn btn-danger btn-sm float-right">Sell</a>
						</div>
						<div class="col-12">
							<div id="sparkline3" class="mt-10"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="box">
		<div class="box-body tickers-block">
			<ul id="price-ticker">
			</ul>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-12">
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">Ethereum Exchange ETH/EUR</h4>
					<ul class="box-controls pull-right">
						<li><a class="box-btn-close" href="#"></a></li>
						<li><a class="box-btn-slide" href="#"></a></li>
						<li><a class="box-btn-fullscreen" href="#"></a></li>
					</ul>
				</div>
				<div class="box-body">
					<div class="chart">
                        <!-- <div id="chartdiv1" style="height: 500px;"></div> -->
                        <div>
                         <script type="text/javascript">
                            baseUrl = "https://widgets.cryptocompare.com/";
                            var scripts = document.getElementsByTagName("script");
                            var embedder = scripts[ scripts.length - 1 ];
                            (function (){
                            var appName = encodeURIComponent(window.location.hostname);
                            if(appName==""){appName="local";}
                            var s = document.createElement("script");
                            s.type = "text/javascript";
                            s.async = true;
                            var theUrl = baseUrl+'serve/v3/coin/chart?fsym=ETH&tsyms=EUR,USD,GBP,BTC';
                            s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
                            embedder.parentNode.appendChild(s);
                            })();
                            </script>
                        </div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		<div class="col-lg-4 col-12">
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">Market Info</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table id="market-info" class="table table-striped table-bordered no-margin">
							<thead>
								<tr class="bg-pale-dark">
									<th>Coin</th>
									<th>Price</th>
									<th>Change %</th>
								</tr>
							</thead>
							<tbody>
                            </tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>

    <div class="box">
        <div class="box-body tickers-block">
            <div id="forex_ticker">
                <script type="text/javascript">
                    DukascopyApplet = {"type":"runboard","params":{
                        "instruments":
                            ["EUR/USD","EUR/GBP","EUR/CHF","EUR/RUB","EUR/CNY","EUR/JPY","EUR/INR",
                            "EUR/MXN","EUR/VEF","EUR/AUD","USD/EUR","USD/GBP","USD/CHF","USD/RUB",
                            "USD/CNY","USD/JPY","USD/INR","USD/MXN","USD/VEF","USD/AUD"],
                        "showDelta":true,
                        "showDeltaPercent":false,
                        "animationSpeed":80000,
                        "fontSize":"15",
                        "fontFamily":["Verdana, Geneva, sans-serif"],
                        "instrumentColor":"#030d00",
                        "priceColor":"#00a825",
                        "delimeterColor":"#0000ff",
                        "bgColor":"#FFFFFF",
                        "width":"100%",
                        "height":"100%",
                        "adv":"popup"}};
                </script>
                <script type="text/javascript" src="https://freeserv-static.dukascopy.com/2.0/core.js"></script>

                <!-- Forex Rates Ticker Script - EXCHANGERATEWIDGET.COM -->
                <!-- <script type="text/javascript"
                src="//www.exchangeratewidget.com/converter.php?l=en&f=USD&t=EURUSD,EURGBP,EURCHF,EURRUB,EURCNY,EURJPY,EURINR,EURMXN,EURVEF,EURAUD,USDEUR,USDGBP,USDCHF,USDRUB,USDCNY,USDJPY,USDINR,USDMXN,USDVEF,USDAUD,&a=1&d=42A400&n=FFFFFF&o=FFFFFF&v=11"></script> -->
                <!-- End of Exchange Rates Script -->
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-body" style="height:500px">
            <iframe id="tradingview_98de4" src="https://s.tradingview.com/dailyfx/widgetembed/?frameElementId=tradingview_98de4&amp;symbol=FX_IDC%3AEURUSD&amp;interval=D&amp;hidesidetoolbar=0&amp;symboledit=1&amp;saveimage=1&amp;toolbarbg=f4f7f9&amp;studies=%5B%5D&amp;hideideas=1&amp;theme=White&amp;timezone=exchange&amp;showpopupbutton=1&amp;studies_overrides=%7B%7D&amp;overrides=%7B%7D&amp;enabled_features=%5B%5D&amp;disabled_features=%5B%5D&amp;showpopupbutton=1&amp;locale=en&amp;utm_source=www.dailyfx.com&amp;utm_medium=widget&amp;utm_campaign=chart&amp;utm_term=FX_IDC%3AEURUSD" style="width: 100%; height: 100%; margin: 0 !important; padding: 0 !important;" frameborder="0" allowtransparency="true" scrolling="no" allowfullscreen=""></iframe>
        </div>
    </div>

    <div class="row">
        
    </div>

	<div class="box">
		<div class="box-header with-border">
			<h4 class="box-title">Latest Transactions</h4>
			<ul class="box-controls pull-right">
				<li><a class="box-btn-close" href="#"></a></li>
				<li><a class="box-btn-slide" href="#"></a></li>
				<li><a class="box-btn-fullscreen" href="#"></a></li>
			</ul>
		</div>
		<div class="box-body">
			<div class="table-responsive">
                
                <table id="Ajax_DataTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                    <thead>
                        <tr>
                            <th colspan="1"></th>
                            <th colspan="3">Order</th>
                            <th colspan="2">Guarantee</th>
                            <th colspan="5">Payment</th>
                            <th colspan="3">Receive</th>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>Token</th>
                            <th>Amount</th>
                            <th>Price</th>

                            <th>Date</th>
                            <th>Price</th>

                            <th>Method</th>
                            <th>Currency</th>
                            <th>Amount</th>
                            <th>Detail</th>
                            <th>Status</th>

                            <th>Hash</th>
                            <th>Status</th>
                            <th>Date/Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- <section class="content-header">
      <h1>
        Dashboard
        <small>Airdrop</small>
      </h1>
    </section> -->


    <!-- Airdrop Dashboard -->
    <div class="row">
        <div class="col-md-6 col-12">
        </div>
    </div>
</section>
@endsection

@push('plugin_js')
    <!--amcharts charts -->
	<!-- <script src="http://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/gauge.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/amstock.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/themes/patterns.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>	 -->
	
	<!-- webticker -->
	<script src="{{base_url()}}assets/vendor_components/Web-Ticker-master/jquery.webticker.min.js"></script>
	
	<!-- EChartJS JavaScript -->
	<script src="{{base_url()}}assets/vendor_components/echarts-master/dist/echarts-en.min.js"></script>
	<script src="{{base_url()}}assets/vendor_components/echarts-liquidfill-master/dist/echarts-liquidfill.min.js"></script>
	
	<!-- This is data table -->
    <script src="{{base_url()}}assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>

    <!-- Sparkline -->
	<script src="{{base_url()}}assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

    <!-- Flip Clock -->
	<script src="{{base_url()}}assets/vendor_components/FlipClock-master/compiled/flipclock.min.js"></script>

    <!-- Jquery countdown -->
	<script src="{{base_url()}}assets/vendor_plugins/jquery.countdown-2.2.0/jquery.countdown.min.js"></script>
@endpush

@push('custom_js')
    <script>
        var importantCoins=['BTC','ETH','DASH','LTC',];
        var supportedCoins=['BTC','ETH',       'LTC','XRP','ZEC'];
        var coins =        ['BTC','ETH','DASH','LTC','XRP','ZEC','BCH','ETC','DOGE','XMR','OMG','WAVES'];

        var coin_prices = {};
        var coingate_rates = {!!$coingate_rates!!};

        function refreshWidgets(){
            console.log(coin_prices);
            if( jQuery.isEmptyObject(coin_prices))  return;

            //price ticker
            var dom_ticker = $("#price-ticker");
            for (var coin in coin_prices.DISPLAY) {
                var ticker_html = `<li><i class="cc ${coin}"></i> ${coin} <span class="text-yellow"> ${coin_prices.DISPLAY[coin].EUR.PRICE}</span></li>`;
                dom_ticker.append(ticker_html)
            }

            dom_ticker.webTicker({
                height: 'auto',
                duplicate: true,
                startEmpty: false,
                rssfrequency: 5,
            });

            //market info
            var tableBody = $('#market-info tbody');
            for (var coin in coin_prices.DISPLAY) {
                if(coin == 'OMG')  break;
                var tr =
                 `<tr>
                    <td> <p class="font-size-18 no-margin">${coin}</p> </td>
                    <td> <p class="no-margin">${coin_prices.DISPLAY[coin].EUR.PRICE}</td>
                    <td class="no-wrap">
                        <span class="badge `;

                if(coin_prices.RAW[coin].EUR.CHANGE24HOUR < 0)
                    tr += `badge-danger"> <i class="fa fa-chevron-down"></i>`;
                else tr += `badge-success"> <i class="fa fa-chevron-up"></i> +`;
                tr +=
                    `${coin_prices.DISPLAY[coin].EUR.CHANGEPCT24HOUR}</span></td>
                </tr>`
                // var tr = `<li><i class="cc ${coin}"></i> ${coin} <span class="text-yellow"> ${coin_prices.DISPLAY[coin].EUR.PRICE}</span></li>`;
                tableBody.append(tr);
            }

            $('#market-info').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : false
            });

            //chart boxes
            for(var i = 0; i < importantCoins.length; i++){
                var change = coin_prices.DISPLAY[importantCoins[i]].EUR.CHANGEPCT24HOUR;
                var display_price = coin_prices.DISPLAY[importantCoins[i]].EUR.PRICE;

                var priceText = 
                    `${display_price} <small class="text-${change < 0 ? 'danger' : 'success'} pl-10"> <i class="mdi mdi-arrow-${change < 0 ? 'down' : 'up'} text-${change < 0 ? 'danger' : 'success'}"></i> ${change}%</small>`
                $('#chart-box-' + importantCoins[i]).html(priceText);
            }
        }

        (function(window, document, $, undefined) {
            $(function() {
                var cryptoCompareAPI = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms=';
                for(var i = 0; i < coins.length; i++){
                    cryptoCompareAPI += coins[i] + ',';
                }
                cryptoCompareAPI += '&tsyms=EUR';

                /** Get Price from cryptocompare.com */
                $.getJSON(cryptoCompareAPI, function(data){
                    coin_prices = data;

                    /** Update Price according to coingate.com */
                    for(var index in supportedCoins){
                        coin_prices.DISPLAY[supportedCoins[index]].EUR.PRICE = '&euro; ' + coingate_rates[supportedCoins[index]].EUR;
                        coin_prices.RAW[supportedCoins[index]].EUR.PRICE = coingate_rates[supportedCoins[index]].EUR;
                    }
                    refreshWidgets();
                });

                $('#ico_counter').countdown('2019/4/15').on("update.countdown", function(event) {
                    $('#ico_counter_day').text(event.strftime('%D'));
                    $('#ico_counter_hour').text(event.strftime('%H'));
                    $('#ico_counter_minute').text(event.strftime('%M'));
                    $('#ico_counter_second').text(event.strftime('%S'));
                });
                
                $('#airdrop_counter').countdown('2018/10/15').on("update.countdown", function(event) {
                    $('#airdrop_counter_day').text(event.strftime('%D'));
                    $('#airdrop_counter_hour').text(event.strftime('%H'));
                    $('#airdrop_counter_minute').text(event.strftime('%M'));
                    $('#airdrop_counter_second').text(event.strftime('%S'));
                });

                $("#copy-btn").click(function() {
                    const el = document.createElement('textarea');
                    el.value = '{{base_url()."ref/".$userdata->user_id}}';
                    document.body.appendChild(el);
                    el.select();
                    document.execCommand('copy');
                    document.body.removeChild(el);

                    $.toast({
                        heading: 'URL Copied!',
                        position: 'bottom-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 2000,
                        stack: 6
                    });
                });

                /** transaction table */
                $("#Ajax_DataTable").dataTable({
                    "searching": false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "<?=base_url()?>client/ICO/getICOTransactionData",
                    "columns": [
                        {"data": "no"},
                        {"data": "token"},
                        {"data": "payout_amount"},
                        {"data": "price_amount"},

                        {"data": "guarantee_date"},
                        {"data": "guarantee_price"},

                        {"data": "payment_method"},
                        {"data": "pay_currency"},
                        {"data": "pay_amount"},
                        {"data": "payment_details"},
                        {"data": "status"},

                        {"data": "payout_hash"},
                        {"data": "payout_status"},
                        {"data": "payout_at"},
                    ]
                });

                // document.querySelector("a[href*='dukas']").hidden=true;
            });
        })(window, document, window.jQuery);
    </script>
    <script src="{{base_url()}}assets/js/pages/dashboard.js"></script>
	<script src="{{base_url()}}assets/js/pages/dashboard-chart.js"></script>

@endpush
