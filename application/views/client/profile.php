<?php $this->load->view('client/layout/header.php') ?>
<div class="content-wrapper">
	<div class="content-heading">
		<div>Profile
			<small>Set your social network IDs</small>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 left">
			<!-- START card-->
			<div class="card card-default">
				<div class="card-header profile_content">Update Profile</div>
				<div class="card-body">
				<?php echo form_open_multipart(base_url().'profile_update',array('class' => 'mb-3','id'=>'profileForm','method'=>'post', 'enctype'=>'multipart/form-data')); ?>
						<div class="form-group">
							<label>Eth Address</label>
							<p><a class="block" href="https://etherscan.io/address/<?=$this->session->userdata("user")->eth_address?>" target="_blank">
								<?=$this->session->userdata("user")->eth_address?></a></p>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input name="email" class="form-control" type="text" value="<?= $email ?>" disabled>
						</div>
						<div class="form-group">
							<label>User Name</label>
							<input name="username" class="form-control" type="text" value="<?= $username ?>" disabled>
						</div>
						<?php
						foreach(C_TABS as $tabId => $tabName) { if($tabName=='Writing Articles') continue; ?>
						<div class="form-group">
							<label><?=$tabName?> ID</label>
							<input name="social_accounts[<?=$tabName?>]" class="form-control" type="text" 
								value="<?= isset($social_accounts [$tabName]) ? $social_accounts [$tabName] : ""?>">
						</div>
						<?php }?>
						
						<div class="panel panel-default">
							<div class="panel-heading">Avatar</div>
							<div class="panel-body">
								<div class="row" style="padding-top:30px;">
									<div class="col-md-4">
										<input type="file" name="avatarimg" id="upload">
										<br>
										<!-- <button class="btn btn-success upload-result">Upload Image</button> -->
									</div>
								</div>
							</div>
							<div class="row"  style="padding-top:30px;">
								<div id="upload-demo"></div>
							</div>
						</div>
						<div class="row justify-content-center"  style="padding-top:30px;">
							<button class="btn btn-oval btn-primary" type="submit">Change Profile</button>
						</div>
					</form>
				</div>
			</div>
			<!-- END card-->
		</div>
		<div class="col-md-5 left">
			<!-- START card-->
			<div class="card card-default">
				<div class="card-header profile_content">Change Password</div>
				<div class="card-body">
				<?php echo form_open(base_url().'change_password',array('method'=>'post')); ?>
						<div class="form-group">
							<label class="text-muted" for="signupInputPassword2">Old Password</label>
							<div class="input-group with-focus">
								<input name="oldpassword" class="form-control border-right-0" id="signupInputPassword2" type="password" placeholder="Old Password" autocomplete="off" required>
								<div class="input-group-append">
								<span class="input-group-text fa fa-lock text-muted bg-transparent border-left-0"></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="text-muted" for="signupInputPassword1">Password</label>
							<div class="input-group with-focus">
								<input name="password" class="form-control border-right-0" id="signupInputPassword1" type="password" placeholder="Password" autocomplete="off" required>
								<div class="input-group-append">
								<span class="input-group-text fa fa-lock text-muted bg-transparent border-left-0"></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="text-muted" for="signupInputRePassword1">Retype Password</label>
							<div class="input-group with-focus">
								<input name="repassword" class="form-control border-right-0" id="signupInputRePassword1" type="password" placeholder="Retype Password" autocomplete="off" required data-parsley-equalto="#signupInputPassword1">
								<div class="input-group-append">
								<span class="input-group-text fa fa-lock text-muted bg-transparent border-left-0"></span>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<button class="btn btn-oval btn-primary" type="submit">Change Password</button>
						</div>
					</form>
				</div>
			</div>
			<!-- END card-->
		</div>
	</div>
</div>

<!-- PARSLEY-->

<?php $this->load->view('client/layout/footer.php') ?>
<script src="<?=base_url()?>asset/js/client/toastr.min.js"></script>
<script src="<?=base_url()?>asset/vendor/croppie/croppie.js"></script>
<?php echo message_box('error'); ?>
<?php echo message_box('success'); ?>

<script type="text/javascript">
	var imagename = <?php echo "'".$avatar."'"; ?>;
	$uploadCrop = $('#upload-demo').croppie({
		enableExif: true,
		url:<?php echo "'".base_url()."asset/uploads/".$avatar."'" ?>,
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


	$('#profileForm').on('submit', function(e) {
		$uploadCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function (resp) {
			$('<input />').attr('type', 'hidden')
            .attr('name', 'image')
            .attr('value', resp)
            .appendTo('#profileForm');
		})
		return true;
	})


	$('#upload').on('change', function () { 
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

</script>

