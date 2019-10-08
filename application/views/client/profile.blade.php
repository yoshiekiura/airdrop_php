@extends("client.layout.master")

@push("plugin_css")
<!-- for Croppie -->
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/croppie/croppie.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<!-- bootstrap datepicker -->	
<link rel="stylesheet" href="<?=base_url()?>assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<!-- country selector -->	
<link rel="stylesheet" href="<?=base_url()?>assets/vendor_components/country-select-js-master/build/css/countrySelect.min.css">

@endpush

@push("custom_css")
<style>
#input_ghost{
    visibility: hidden;
    height:0;
}

.media.media-single{
    cursor: pointer
}

.modal-footer{
    width:100%;
    padding-top:25px;
}

.jq-toast-wrap{
    z-index: 99999 !important;
}

</style>
@endpush

@section("sidebar_profile", "active")

@section("content")
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Profile
	</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="breadcrumb-item active">Profile</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">
		<div class="col-xl-4 col-lg-5">

			<!-- Profile Image -->
			<div class="box bg-dark bg-deathstar-dark">
				<div class="box-body box-profile">
					<!-- <img class="profile-user-img rounded-circle img-fluid mx-auto d-block" src="05.jpg" alt="User profile picture"> -->
                    <div class="row"  style="padding-top:50px;">
                        <div id="croppie-div"></div>
                    </div>

					<h2 class="profile-username text-center mb-0">{{empty($userdata->first_name) ? $userdata->username : $userdata->first_name.' '.$userdata->second_name}}</h2>

					<h4 class="text-center mt-0"><i class="fa fa-envelope-o mr-10"></i>{{$userdata->email}}</h4>

					<div class="row social-states">
						<div class="col-6 text-right">{{$userdata->total_ico_token}} SREUR</div>
						<div class="col-6 text-left">{{$userdata->mlm_flag? $userdata->mlm_commission : $userdata->total_score}} CSR</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="media-list media-list-hover media-list-divided w-p100 mt-30">
                               <?php echo form_open(base_url().'client/profile/update_profile', array('id' => 'form_photo','method'=>'post','enctype'=>'multipart/form-data','accept-charset'=>'utf-8')); ?>
                                    <input type="file" accept="image/*" name="avatarimg" id="input_ghost">
                                    <input type="hidden" name="cropped_photo" id="cropped_photo">
                                </form>
								<h4 class="media media-single p-15" id="photo_change">
                                    <i class="fa fa-arrow-circle-o-right mr-10"></i>
                                    <span class="title">Change Photo</span>
								</h4>
								<h4 class="media media-single p-15" id="photo_submit">
                                    <i class="fa fa-arrow-circle-o-right mr-10"></i>
                                    <span class="title">Update Photo</span>
                                </h4>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->

            @if( $userdata->kyc_status == 0 )
			<div class="box box-inverse bg-danger">
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
						<div class="font-size-50">Not Passed</div>
						<p class="text-white">
							<br>
							You need to pass KYC verification to withdraw tokens. <br>
							This process takes less than 5 minutes.
						</p>
					</div>
				</div>

				<div class="card-body bg-gray-light py-12">
					<div class="row">
						<div class="col-6 mx-auto">
                            <button class="btn btn-block btn-danger" id="btn_pass_kyc">Pass KYC!</button>
						</div>
					</div>
				</div>

				<div class="progress progress-xxs mt-0 mb-0">
					<div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 3px;" aria-valuenow="30"
					 aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
            @elseif( $userdata->kyc_status == 1 )
            <div class="box box-inverse bg-info">
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
						<div class="font-size-50">Pending</div>
						<p class="text-white">
							<br>Your identity information is under admin's review.<br>
						</p>
					</div>
				</div>

				<div class="card-body bg-gray-light py-12">
					<div class="row">
						<div class="col-6 mx-auto">
                            <button class="btn btn-block btn-info" id="btn_pass_kyc">Resubmit Documents!</button>
						</div>
					</div>
				</div>

				<div class="progress progress-xxs mt-0 mb-0">
					<div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 3px;" aria-valuenow="30"
					 aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
            @elseif( $userdata->kyc_status == 2 )
            <div class="box box-inverse bg-success">
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
							<a class="btn btn-block btn-success" href="<?=base_url().'ico-purchase'?>">Buy Tokens!</a>
						</div>
					</div>
				</div>

				<div class="progress progress-xxs mt-0 mb-0">
					<div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 3px;" aria-valuenow="30"
					 aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
            @endif
		</div>
		<!-- /.col -->
		<div class="col-xl-8 col-lg-7">
			<div class="box box-solid bg-black">
				<div class="box-header with-border">
					<h3 class="box-title">Personal Details</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-12">
                            <?php echo form_open(base_url().'client/profile/update_kyc_info',array('class' => 'form-horizontal form-element col-12','id'=>'form_personal_details','method'=>'post')); ?>
								<div class="form-group row">
									<label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="first_name" id="kyc_first_name" value="{{$userdata->first_name}}" placeholder="" required>
									</div>
									<label for="inputSecondName" class="col-sm-2 control-label">Second Name</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="second_name" id="kyc_second_name" value="{{$userdata->second_name}}" placeholder="" required>
									</div>
								</div>
								<div class="form-group row">
                                    <label for="inputGender" class="col-sm-2 control-label">Gender</label>
									<div class="col-sm-4">
                                        <select class="form-control" name="gender" value="{{$userdata->gender}}">
                                            <option {{strtolower($userdata->gender) == 'male' ? 'selected' : ''}} >Male</option>
                                            <option {{strtolower($userdata->gender) == 'female' ? 'selected' : ''}} >Female</option>
                                        </select>
									</div>
									<label for="inputBirth" class="col-sm-2 control-label">Date of Birth</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="birth" id="kyc_birth" value="{{$userdata->birth}}" placeholder="" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPhone" class="col-sm-2 control-label">Phone</label>
									<div class="col-sm-4">
										<input type="number" class="form-control" name="phone" id="kyc_phone" value="{{$userdata->phone}}" placeholder="" required>
									</div>
									<label for="inputCountry" class="col-sm-2 control-label">Country</label>

									<div class="col-sm-4">
										<input type="text" class="form-control" id="kyc_country" placeholder="Not Specified" readonly disabled>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputAddress" class="col-sm-2 control-label">Address</label>

									<div class="col-sm-10">
										<input type="text" class="form-control" name="address" id="kyc_address" value="{{$userdata->address}}" placeholder="" required>
									</div>
								</div>
								<!-- <div class="form-group row">
                      <div class="ml-auto col-sm-10">
                        <div class="checkbox">
                          <input type="checkbox" id="basic_checkbox_1" checked="">
              <label for="basic_checkbox_1"> I agree to the</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Terms and Conditions</a>
                        </div>
                      </div>
                    </div> -->
								<div class="box-footer text-center">
									<div class="row">
										<div class="col-6 mx-auto">
											<input type="submit" class="btn btn-block btn-success"></input>
										</div>
									</div>
								</div>
							</form>

						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->

			<div class="box box-solid bg-black">
				<div class="box-header with-border">
					<h3 class="box-title">Social Media</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-12">
                            <?php echo form_open(base_url().'client/profile/update_social_media',array('class' => 'form-horizontal form-element col-12', 'method'=>'post')); ?>
                                <?php for( $tabId = 0; $tabId < count(C_TABS); $tabId += 0 ) {?>
                                    <div class="form-group row">
                                    <?php
                                        for($two = 2; $two > 0; $two--){
                                            if( $tabId == count(C_TABS) )   break;
                                            $tabName = C_TABS[$tabId];
                                            $tabId++;
                                            if($tabName=='WritingArticles') continue; ?>

                                        <label class="col-sm-2 control-label"><?=$tabName?> ID</label>
                                        <div class="col-sm-4">
                                            <input name="social_accounts[<?=$tabName?>]" class="form-control" type="text" 
                                                value="<?= isset($userdata->social_accounts [$tabName]) ? $userdata->social_accounts [$tabName] : ""?>">
                                        </div>
                                    <?php }?>
                                    </div>
                                <?php }?>
								<!-- <div class="form-group row">
                                <div class="ml-auto col-sm-10">
                                    <div class="checkbox">
                                    <input type="checkbox" id="basic_checkbox_1" checked="">
                        <label for="basic_checkbox_1"> I agree to the</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Terms and Conditions</a>
                                    </div>
                                </div>
                                </div> -->
								<div class="box-footer text-center">
									<div class="row">
										<div class="col-6 mx-auto">
											<button type="submit" class="btn btn-block btn-success">Submit</button>
										</div>
									</div>
								</div>
							</form>

						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->

		</div>
		<!-- /.col -->
	</div>

    <div class="row">
        <!-- KYC Content -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myLargeModalLabel">Account Verification</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open(base_url().'client/profile/kyc_verification',
                                array('id'=>'kyc_form','enctype'=>'multipart/form-data','accept-charset'=>'utf-8','method'=>'post')); ?>
                        <div class="modal-body">
                            <h4 class="text-center">1. Proof of Identity</h4>
                            
                            <div class="row">
                                <div class="col-md-5">
                                    <p>Please upload a photo of your document.</p>
                                    <p>The photo should be bright and clear, and all corners of your document must be visible.</p>
                                    <br>
                                    <h5 class="text-center">Choose your Document type</h5>
                                    <div class="demo-radio-button">
                                    <?php foreach(PROOF_TYPES['identity'] as $text => $fulltext) {?>
                                        <input name="identity_proof_type" type="radio" value="{{$text}}" id="identity_{{$text}}" class="with-gap radio-col-purple" checked/>
                                        <label for="identity_{{$text}}">{{$fulltext}}</label>
                                    <?php }?>
                                    
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="file-loading">
                                        <input id="kyc_photo_identity" name="identity" type="file">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h4 class="text-center">2. Proof of Address</h4>

                            <div class="row">
                                <div class="col-md-5">
                                    <p>Please upload a photo of your document.</p>
                                    <p>The photo should be bright and clear, and all corners of your document must be visible.</p>
                                    <br>
                                    <h5 class="text-center">Choose your Document type</h5>
                                    <div class="demo-radio-button">
                                        <?php foreach(PROOF_TYPES['address'] as $text => $fulltext) {?>
                                            <input name="address_proof_type" type="radio" value="{{$text}}" id="address_{{$text}}" class="with-gap radio-col-purple" checked/>
                                            <label for="address_{{$text}}">{{$fulltext}}</label>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="file-loading">
                                        <input id="kyc_photo_address" name="address" type="file" data-allowed-file-extensions='["jpg", "jpeg", "png", "pdf"]'>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>

                            <h4 class="text-center">3. Selfie with your ID document</h4>

                            <div class="row">
                                <div class="col-md-5">
                                    <p>Please take a selfie with your document so that it’s clearly visible and does not cover your face.</p>
                                    <p>We will compare your face in the selfie to the document photo.</p>
                                    <p>Make sure to upload a bright photo where all text is clearly readable.</p>
                                </div>
                                <div class="col-md-7">
                                    <div class="file-loading">
                                        <input id="kyc_photo_selfie" name="selfie" type="file" data-allowed-file-extensions='["jpg", "jpeg", "png", "pdf"]'>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button> -->
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <input type="submit" id="kyc_submit_btn" class="btn btn-primary btn-block" value="Submit"></input>
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
    </div>

</section>
<!-- /.content -->
@endsection

@push('plugin_js')
<script src="<?=base_url()?>asset/vendor/croppie/croppie.js"></script>
<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you 
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/piexif.min.js" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for 
    HTML files. This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/purify.min.js" type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/fileinput.min.js"></script>
<!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/themes/fa/theme.js"></script>

<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- country selector -->
<script src="<?=base_url()?>assets/vendor_components/country-select-js-master/build/js/countrySelect.min.js"></script>
@endpush

@push('custom_js')
<script>
    $(document).ready(function(){
        /** Init Personal Info Box */
        $("#kyc_birth").datepicker({
            autoclose: true
        });
        
        <?php if(!empty($userdata->country_code)) {?>
            $("#kyc_country").countrySelect();
            $("#kyc_country").countrySelect("selectCountry", "{{$userdata->country_code}}");
        <?php }?>


        //disable input fields when KYC is already passed
        if({{$userdata->kyc_status}} == 2)
            $("#form_personal_details *").prop('disabled', true);
        
        /** Photo */

        var $uploadCrop = $('#croppie-div').croppie({
            enableExif: true,
            url:<?php echo "'".base_url()."asset/uploads/".$userdata->avatar."'" ?>,
            viewport: {
                width: 300,
                height: 300,
                type: 'rectangle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#input_ghost').on('change', function () { 
            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#photo_change').on('click', function(){
            $('#input_ghost').click();
        });

        $('#photo_submit').on('click', function(){
            if($('#input_ghost').val()){
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (resp) {
                    return $('#cropped_photo').val(resp);
                }).then(function(){
                    $('#form_photo').submit();
                });
            }
        });

        $("#btn_pass_kyc").on('click', function(){

            if(<?=$kyc_info_all_submitted?>){
                $(".bs-example-modal-lg").modal('toggle');
            }else{
                $.toast({
                    heading: 'Personal detail is missing!',
                    text: 'First enter your personal details in the form please.',
                    position: 'bottom-right',
                    loaderBg: '#ff6849',
                    icon: 'warning',
                    hideAfter: 15000,
                    stack: 6,
                });
            }
        });

        /** bootstrap-fileinput plugin */

        $("#kyc_photo_identity").fileinput({'showUpload':false, autoOrientImage: false,'allowedFileExtensions':["jpg", "jpeg", "png", "pdf"],});
        $("#kyc_photo_address").fileinput({'showUpload':false, autoOrientImage: false,'allowedFileExtensions':["jpg", "jpeg", "png", "pdf"],});
        $("#kyc_photo_selfie").fileinput({'showUpload':false, autoOrientImage: false,'allowedFileExtensions':["jpg", "jpeg", "png", "pdf"],});

        $("#kyc_form").submit(function( event ) {
            if( $("#kyc_photo_identity")[0].files.length && 
                $("#kyc_photo_address")[0].files.length && 
                $("#kyc_photo_selfie")[0].files.length ){
                return;
            }
            $.toast({
                heading: 'Some files are missing!',
                text: 'Please upload all these documents.',
                position: 'bottom-right',
                loaderBg: '#ff6849',
                icon: 'warning',
                hideAfter: 15000,
                stack: 6,
            });
            event.preventDefault();
        });
    });
</script>

{!!message_box_new('error')!!}
{!!message_box_new('success')!!}
@endpush
