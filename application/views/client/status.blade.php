@extends("client.layout.master")

@push("custom_css")
@endpush

@section("menu-airdrop", "menu-open")
@section("airdrop-status", "active")
@section("dropdown-airdrop", "display: block")

@section("content")
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Airdrop Status
	</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Airdrop</a></li>
		<li class="breadcrumb-item active">Status</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-md-4">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Airdrop Ends In</h3>
				</div>
				<div class="box-body">
					<div class="row text-center" id="airdrop_counter">
						<div class="col-2"></div>
						<div class="col-2">
							<span class="btn btn-success btn-xl" id="airdrop_counter_day">--</span> <br>
							Days
						</div>
						<div class="col-2">
							<span class="btn btn-success btn-xl" id="airdrop_counter_hour">--</span> <br>
							Hours
						</div>
						<div class="col-2">
							<span class="btn btn-success btn-xl" id="airdrop_counter_minute">--</span> <br>
							Minutes
						</div>
						<div class="col-2">
							<span class="btn btn-success btn-xl" id="airdrop_counter_second">--</span> <br>
							Seconds
						</div>
						<div class="col-2"></div>
					</div>
				</div>
			</div>
        </div>
        
        <div class="col-md-4">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Assigned Tokens</h3>
				</div>
				<div class="box-body">
					<div class="text-center my-2">
						<div class="font-size-50 text-success">{{number_format($assigned_csr)}}</div>
						<span class="text-muted">/ 20 Million</span>
					</div>
				</div>

				<div class="box-body bg-gray-light py-12">
					<span class="text-muted mr-1">Distribution:</span>
					<span class="text-dark">{{round($assigned_csr / $total_csr * 100.0, 2)}} %</span>
				</div>

				<div class="progress progress-xxs mt-0 mb-0">
					<div class="progress-bar bg-success" role="progressbar" style="width: {{round($assigned_csr / $total_csr * 100.0, 2)}}%;  height: 3px;"
					 aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
            </div>
        </div>

        <div class="col-md-4">
            @include('client.components.referral_link_box')
		</div>

        @if($userdata->mlm_flag)
        <div class="col-md-8 text-center">
            <div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Multilevel commission system by user registration</h3>
				</div>
				<div class="box-body lead">
                    <div class="row">
                        <div class="col-8">
                            <img src="{{base_url()}}asset/img/mlm.png" alt="mlm diagram">
                        </div>
                        <div class="col-4">
                            <div style="height: 40%;"></div>
                            <?php foreach($commissions as $index => $level) {?>
                                <div style="height: 20%;">
                                    Level <?=$index + 1?>: <strong> <?=$level?>%</strong>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
        @endif

        <div class="col-md-4">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Exchange tokens CSR to EaD</h3>
				</div>
        @if($userdata->mlm_flag)
				<div class="box-body lead">
                    <p>
                    To redeem your CSR gift tokens and captured referrals, you must:
                    </p>
                    <ul>
                        <li>Pass the identification KYC</li>
                        <li>Have a number of SREUR tokens in their wallet 25% of your CSR tokens</li>
                    </ul>
				</div>
        @else
                <div class="box-body lead">
                    <p>
                    To redeem your CSR gift tokens and captured referrals, you must:
                    </p>
                    <ul>
                        <li>KYC approved</li>
                        <li>Only one account will be valid per registered user</li>
                    </ul>
				</div>
        @endif
			</div>
        </div>

    </div>
</section>
<!-- /.content -->
@endsection

@push('plugin_js')
    <!-- Jquery countdown -->
	<script src="{{base_url()}}assets/vendor_plugins/jquery.countdown-2.2.0/jquery.countdown.min.js"></script>
@endpush

@push('custom_js')
<script>
$(function () {
    //airdrop counter
    $('#airdrop_counter').countdown('2019/4/30').on("update.countdown", function(event) {
        $('#airdrop_counter_day').text(event.strftime('%D'));
        $('#airdrop_counter_hour').text(event.strftime('%H'));
        $('#airdrop_counter_minute').text(event.strftime('%M'));
        $('#airdrop_counter_second').text(event.strftime('%S'));
    });
}); // End of use strict

</script>
@endpush
