@extends("client.layout.master")

@push("custom_css")
@endpush

@section("settings", "active")

@section("content")
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Settings
	</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="breadcrumb-item active">Settings</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">
		<!-- left column -->
		<div class="col-xl-6 col-lg-12">
			<!-- general form elements -->
			<div class="box">
				<div class="box-header with-border bg-dark">
					<h3 class="box-title">Change Password</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
                <?php echo form_open(base_url().'client/settings/change_password',array('class' => 'form-element', 'method'=>'post')); ?>
					<div class="box-body">
						<div class="form-group">
							<label for="inputCurrentPassword">Current Password</label>
							<input type="password" class="form-control" name="oldpassword" placeholder="">
						</div>
						<div class="form-group">
							<label for="inputNewPassword">New Password</label>
							<input type="password" class="form-control" name="password" placeholder="">
						</div>
						<div class="form-group">
							<label for="inputConfirmPassword">Confirm Password</label>
							<input type="password" class="form-control" name="repassword" placeholder="">
						</div>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<div class="row">
							<div class="col-6 mx-auto">
								<button type="submit" class="btn btn-block btn-success">Update</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- /.box -->
		</div>
		<!--/.col (left) -->


		<!-- right column -->
		<div class="col-xl-6 col-lg-12">
			<!-- Horizontal Form -->
			<div class="box">
				<div class="box-header with-border bg-dark">
					<h3 class="box-title">Withdrawal Wallet</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<h6 class="mt-15 mb-5">Your Ethereum Address for Withdrawal</h6>

					<div class="input-group">
						<span class="input-group-addon"><i class="cc ETH-alt font-size-20"></i></span>
						<input type="text" class="form-control" id="new_address" name="new_address" placeholder="ERC20" value="{{$userdata->eth_address}}" readonly>
					</div>
					<br>
				</div>
				<!-- /.box-footer -->
			</div>

			<div class="box">
				<div class="box-header with-border bg-dark">
					<h3 class="box-title">2 Factor Authentication</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					@if(!$userdata->enable_2_auth)
					<h6 class="mt-15 mb-5">1. Install <strong>Google Authenticator</strong> application to your mobile phone</h6>

					<div class="row">
						<div class="col-6 text-right">
							<a class = "appbadge" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">
								<img height="45" src="http://www.niftybuttons.com/googleplay/googleplay-button8.png" alt="Get on Google Play">
							</a>
						</div>
						<div class="col-6 text-left">
							<a class = "appbadge" href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8?at=1000lc66" target="_blank">
								<img height="45" src="http://www.niftybuttons.com/itunes/itunesbutton1.png" alt="iTunes Button">
							</a>
						</div>
					</div>

					<h6 class="mt-15 mb-5">2. Scan QR code.</h6>
					<h6 class="mt-15 mb-5">3. Submit verification code.</h6>
{{-- 
					<div class="input-group">
						<span class="input-group-addon"><i class="cc ETH-alt font-size-20"></i></span>
						<input type="text" class="form-control" id="new_address" name="new_address" placeholder="ERC20" value="{{$userdata->eth_address}}" readonly>
					</div> --}}
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-6 mx-auto">
							<button class="btn btn-block btn-success" id="btn_enable_2fa">Enable</button>
						</div>
					</div>
				</div>
				@else
				<h6 class="mt-15 mb-5">You have to use <strong>Google Authenticator</strong> to login. </h6>
				</div>
				
				<div class="box-footer">
					<div class="row">
						<div class="col-6 mx-auto">
							<button class="btn btn-block btn-danger" id="btn_disable_2fa">Disable</button>
						</div>
					</div>
				</div>
				@endif
				<!-- /.box-footer -->
			</div>
			<!-- /.box -->

			 {{-- <div class="box box-inverse bg-info">
				<div class="box-body">
					<div class="flexbox">
						<h5>KYC</h5>
						<div class="dropdown">
							<span class="dropdown-toggle no-caret" data-toggle="dropdown">
								<i class="ion-android-more-vertical rotate-90"></i>
							</span>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#"><i class="ion-android-list"></i> Learn More</a>
							</div>
						</div>
					</div>

					<div class="text-center my-2">
						<div class="font-size-50">Passed</div>
						<p class="text-white">
							<br>Now you can buy tokens freely.<br>
						</p>
					</div>
				</div>

				<div class="card-body bg-gray-light py-12">
					<div class="row">
						<div class="col-6 mx-auto">
							<button class="btn btn-block btn-info">Buy Tokens!</button>
						</div>
					</div>
				</div>

				<div class="progress progress-xxs mt-0 mb-0">
					<div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 3px;" aria-valuenow="30"
					 aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
			 --}}
		</div>

		<div class="col-xl-6 col-lg-12">

		</div>
		<!--/.col (right) -->
		<div class="row">
			<!-- 2FA modal -->
			<div class="modal fade modal_2fa" tabindex="-1" role="dialog" aria-labelledby="modal_label" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-md">
                    <div class="modal-content">
                        @if($userdata->enable_2_auth)
                        <?php echo form_open(base_url().'client/settings/disable2FA',array('id'=>'verification_form','enctype'=>'multipart/form-data','accept-charset'=>'utf-8','method'=>'post')); ?>
                            <div class="modal-header">
								<h3 class="modal-title" id="modal_label">Confirm Verification Code</h3>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                        @else
                        <?php echo form_open(base_url().'client/settings/deviceConfirm',array('id'=>'verification_form','enctype'=>'multipart/form-data','accept-charset'=>'utf-8','method'=>'post')); ?>
							<div class="modal-header">
								<h3 class="modal-title" id="modal_label">Device Verification</h3>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
							<div class="modal-body">
								<h4 class="text-center">QR Code and key</h4>
								<h5 class="text-center">
									<img src="" alt="qrcode_img" id = "qrcode_img">
									<span class="text-center text-danger" id="secretkey" style="font-size: 1.2rem;"></span>
                                </h5>
                        @endif
								<h4 class="text-center">Verification Code</h4>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mobile font-size-20"></i></span>
									<input name="verifyCode" min="0" max="999999" step="1" class="form-control border-right-0" id="verifyCode" type="number" placeholder="6 digit number" autocomplete="off" required>
								</div>
							</div>
							<div class="modal-footer" style="width: 100%">
								<div class="row">
									<div class="col-md-6 mx-auto">
										<input type="submit" id="submit_btn" class="btn btn-primary btn-block" value="Submit"></input>
									</div>
								</div>
							</div>
                            <!-- /.modal-content -->
                        </form>
                    </div>
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
		</div>
	</div>
	<!-- /.row -->

</section>
<!-- /.content -->
@endsection

@push('plugin_js')
@endpush

@push('custom_js')
	{{-- 'csrf_token_name' => $this->security->get_csrf_token_name(),
    'csrf_token_value' => $this->security->get_csrf_hash(), --}}
<script>
@if($userdata->enable_2_auth)
	$("#btn_disable_2fa").on('click', function(){
		$(".modal_2fa").modal('toggle');
	});
@else
	var secret = '';
	$("#btn_enable_2fa").on('click', function(){
		$.toast({
			heading: '',
			text: 'Generating QR code...',
			position: 'bottom-right',
			loaderBg: '#ff6849',
			icon: 'success',
			hideAfter: 2000,
			stack: 6,
		});
		$.getJSON("{{base_url().'client/settings/setOrGet2FACode'}}", (data) => {
			if(data.secret.length > 5){
				$("#qrcode_img").attr('src', data.qrCodeUrl);
				$("#secretkey").text(data.secret);
				$(".modal_2fa").modal('toggle');
			}
		}).fail((error) => {
			$.toast({
				heading: 'Failed!',
				text: 'Can not enable 2FA for now, please contact support.',
				position: 'bottom-right',
				loaderBg: '#ff6849',
				icon: 'warning',
				hideAfter: 15000,
				stack: 6,
			});
		});
	});
@endif

</script>
{!!message_box_new('error')!!}
{!!message_box_new('success')!!}
@endpush
