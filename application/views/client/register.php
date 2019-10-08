<!DOCTYPE html>
<html lang="en">

<head>
<script>
var geotargetlyblock1536603564300 = document.createElement('script');
geotargetlyblock1536603564300.setAttribute('type','text/javascript');
geotargetlyblock1536603564300.async = 1;
geotargetlyblock1536603564300.setAttribute('src', '//geotargetly-1a441.appspot.com/geoblock?id=-LM3hPU4K4JO4TjRm6SM');
document.getElementsByTagName('head')[0].appendChild(geotargetlyblock1536603564300);
</script>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Bootstrap Admin App + jQuery">
   <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
   <title>SocialRemit - User</title>
   <link rel="shortcut icon" href="asset/img/logo-single.png" type="image/png">
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="<?=base_url()?>asset/vendor/font-awesome/css/font-awesome.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="<?=base_url()?>asset/vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="<?=base_url()?>asset/css/bootstrap.css" id="bscss">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="<?=base_url()?>asset/css/app.css" id="maincss">
   <link rel="stylesheet" href="<?=base_url()?>asset/css/custom1.css" id="maincss">

    <!-- country selector -->	
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor_components/country-select-js-master/build/css/countrySelect.min.css">
</head>

<style>
body {
    background: none !important;
    background-image: url('<?=base_url()?>asset/img/illustration_plane.jpg') !important;
    background-size: cover !important;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.country-select{
    width: 86%
}
</style>

<body>
   <div class="wrapper">
      <div class="block-center mt-4 wd-xxl login-register-box">
         <!-- START card-->
         <div class="card card-flat">
            <div class="card-header text-center">
               <a href="#">
                  <img class="block-center" src="<?= base_url()?>asset/img/logo.png" alt="Image">
               </a>
            </div>
            <div class="card-body">
               <p class="text-center py-2">SIGNUP TO GET INSTANT ACCESS.</p>
               <?php echo form_open(base_url().'register',array('class' => 'mb-3','id'=>'registerform','method'=>'post')); ?>
                  <div class="form-group">
                     <label class="text-muted" for="signupInputEmail1">Email address</label>
                     <div class="input-group with-focus">
                        <input name ="email" class="form-control border-right-0" id="signupInputEmail1" type="email" placeholder="Enter email" autocomplete="off" required>
                        <div class="input-group-append">
                           <span class="input-group-text fa fa-envelope text-muted bg-transparent border-left-0"></span>
                        </div>
                        <div id="email-valid" class="error"></div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="text-muted" for="signupInputEhtereum">Ethereum address</label>
                     <div class="input-group with-focus">
                        <input name="ethereum" class="form-control" id="signupInputEthereum" type="text" placeholder="Enter Ethereum Address" autocomplete="off" required>
                     </div>
					 <div id="ethereum-valid" class="error"></div>
                  </div>
                  <div class="form-group">
                     <label class="text-muted" for="signupInputusername">UserName</label>
                     <div class="input-group with-focus">
                        <input name="username" class="form-control border-right-0" id="signupInputusername" type="text" placeholder="Enter UserName" autocomplete="off" required>
                        <div class="input-group-append">
                           <span class="input-group-text fa fa-address-card text-muted bg-transparent border-left-0"></span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="text-muted" for="signupInputusername">Country</label>
                     <div class="input-group with-focus">
                        <input type="hidden" name="country_code" id="country_code" required>
                        <input type="text" class="form-control border-right-0" name="country" id="country" autocomplete="off" required>
                        <!-- <input name="username" class="form-control border-right-0" id="signupInputusername" type="text" placeholder="Enter UserName" autocomplete="off" required> -->
                        <div class="input-group-append">
                           <span class="input-group-text fa fa-globe text-muted bg-transparent border-left-0"></span>
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
					 <div id="password-valid" class="error"></div>
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
				  <div class="form-group">
						<div class="g-recaptcha" data-theme="light" data-sitekey="<?php echo config_item('google_captcha_key'); ?>" id="captcha_container" data-callback="recaptchaCallback"></div>
						<input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
						<div id="captcha-error" class="error"></div>
					</div>
                  <div class="checkbox c-checkbox mt-0">
                     <label>
                        <input type="checkbox" value="" required name="agreed">
                        <span class="fa fa-check"></span>I agree with the<a class="ml-1" href="ts_es.pdf">terms</a>
                     </label>
                  </div>
                  <button class="btn btn-block btn-primary mt-3" type="submit">Create account</button>
               </form>
               <p class="pt-3 text-center">Have an account?</p><a class="btn btn-block btn-secondary" href="<?= base_url() ?>login">Sign In</a>
            </div>
         </div>
      </div>
   </div>
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="<?=base_url()?>asset/vendor/modernizr/modernizr.custom.js"></script>
   <!-- JQUERY-->
   <script src="<?=base_url()?>asset/vendor/jquery/dist/jquery.js"></script>
   <!-- BOOTSTRAP-->
   <script src="<?=base_url()?>asset/vendor/bootstrap/dist/js/bootstrap.js"></script>
   <!-- STORAGE API-->
   <script src="<?=base_url()?>asset/vendor/js-storage/js.storage.js"></script>
   <script src="<?=base_url()?>asset/js/sha3.min.js"></script>
   <!-- PARSLEY-->
   <script src="<?=base_url()?>asset/vendor/parsleyjs/dist/parsley.js"></script>

   <!-- =============== APP SCRIPTS ===============-->
   <script src="<?=base_url()?>asset/js/app.js"></script>
   <script src="<?=base_url()?>asset/js/client/toastr.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?onload=loadCaptcha&render=explicit" async defer></script>

    <!-- country selector -->
    <script src="<?=base_url()?>assets/vendor_components/country-select-js-master/build/js/countrySelect.min.js"></script>

	<script type='text/javascript'>
		var base_url = "<?php echo base_url(); ?>";
		var captchaContainer = null;
		var loadCaptcha = function () {
			captchaContainer = grecaptcha.render('captcha_container', {
				'sitekey': "<?php echo config_item('google_captcha_key'); ?>",	
				'callback': function (response) {
					$("#captcha").val(response);
					if (response != "") {
						$("#captcha-error").css("display", "none");
					}
				}
			});
		};

		$('#registerform').on('submit', function(e) {
			if(grecaptcha.getResponse() == "") {
			 	//e.preventDefault();
			 	$("#captcha-error").css("display","block");
			 	$("#captcha-error").html("Please enter valid captcha");
			 	return false;
            }

            const selectedCountryData = $("#country").countrySelect("getSelectedCountryData");
            $("#country_code").val(selectedCountryData.iso2);

			var address = document.getElementById("signupInputEthereum").value;
			if(!isAddress(address)){
				$("#ethereum-valid").css("display","block");
				$("#ethereum-valid").html("Please enter valid Ethereum Address");
				return false;
            }
            $("#ethereum-valid").css("display","none");

            if(($("#signupInputPassword1").val().length < 6)){
				$("#password-valid").css("display","block");
				$("#password-valid").html("Password must be longer than 6 characters.");
				return false;
            }
            $("#password-valid").css("display","none");
            
            $("#email-valid").css("display","none");

			$("button[type=submit]").prop( "disabled", true );
//			$(this).find(":submit").prop( "disabled", true );
		});
		
		// console.log(isAddress('c2d7cf95645d33006175b78989035c7c9061d3f9'));
		
		function isAddress(address) {
			if (!/^(0x)?[0-9a-f]{40}$/i.test(address)) {
				// check if it has the basic requirements of an address
				return false;
			} else if (/^(0x)?[0-9a-f]{40}$/.test(address) || /^(0x)?[0-9A-F]{40}$/.test(address)) {
				// If it's all small caps or all all caps, return true
				return true;
			} else {
				//return false;
				// Otherwise check each case
				// return isChecksumAddress(address);
				return   true;
			}
		};

		// function isChecksumAddress(address) {
		// 	// Check each case
		// 	address = address.replace('0x','');
		// 	var addressHash = sha3_256(address.toLowerCase());
		// 	for (var i = 0; i < 40; i++ ) {
		// 		// the nth letter should be uppercase if the nth digit of casemap is 1
		// 		if ((parseInt(addressHash[i], 16) > 7 && address[i].toUpperCase() !== address[i]) || (parseInt(addressHash[i], 16) <= 7 && address[i].toLowerCase() !== address[i])) {
		// 			return false;
		// 		}
		// 	}
		// 	return true;
		// };

        $(document).ready(function(){
            $("#country").countrySelect();
        });

	</script>

	<?php echo message_box('error'); ?>
   	<?php echo message_box('success'); ?>
</body>

</html>
