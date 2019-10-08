<?php $this->load->view('admin/layout/header.php') ?>
<div class="content-wrapper">
	<div class="content-heading">
		<div>Change Password
			<small>Input old and new password.</small>
		</div>
	</div>
	<div class="row">
		<div class="col-md-5 left">
			<!-- START card-->
			<div class="card card-default">
				<div class="card-header profile_content">Change Password</div>
				<div class="card-body">
				<?php echo form_open(base_url().'change_admin_password',array('method'=>'post')); ?>
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
						<div class="row">
							<button class="offset-md-5 btn btn-oval btn-primary" type="submit">Change Password</button>
						</div>
					</form>
				</div>
			</div>
			<!-- END card-->
		</div>
	</div>
</div>

<!-- PARSLEY-->

<?php $this->load->view('admin/layout/footer.php') ?>
<script src="<?=base_url()?>asset/js/client/toastr.min.js"></script>
<?php echo message_box('error'); ?>
<?php echo message_box('success'); ?>

