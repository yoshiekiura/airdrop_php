
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
   <link rel="stylesheet" href="<?=base_url()?>asset/vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- ANIMATE.CSS-->
   <link rel="stylesheet" href="<?=base_url()?>asset/vendor/animate.css/animate.css">
   <!-- WHIRL (spinners)-->
   <link rel="stylesheet" href="<?=base_url()?>asset/vendor/whirl/dist/whirl.css">
   <!-- =============== PAGE VENDOR STYLES ===============-->
   <!-- Loaders.css-->
   <link rel="stylesheet" href="<?=base_url()?>asset/vendor/loaders.css/loaders.css">
   <link rel="stylesheet" href="<?=base_url()?>asset/css/custom1.css" id="maincss">

</head>

<style>
body {
    background: none !important;
background-image: url('<?=base_url()?>asset/img/illustration_plane.jpg') !important;
background-size: cover !important;
background-position: center;
background-repeat: no-repeat;
/*background-attachment: fixed;*/
}

.nav-link{
    display: inherit;
    padding: 0;
}
.wrapper.flex.animated.fadeInDown.d065{
    width: 25%;
}
label {
    position: inherit !important;
    display: inline-block !important;
    padding: 0!important;
    font-size: inherit !important;
}
.btn{
    background-image: none !important;
    background-color: #5d9cec !important;
    border-color: #5d9cec !important;
}
.btn-secondary{
    background-color: #fff !important;
    border-color: #eaeaea !important;
}
label:before{
    visibility: hidden;
}

button.btn.btn-block.btn-primary.mt-3 {
    color: #212529;
}
.card-header.text-center{
    margin: 20px 10px 0;
}
@media screen and (max-width: 768px) {
    .wrapper.flex.animated.fadeInDown.d065 {
        width: auto !important;
        overflow-x: visible;
    }

    body{
        margin-top: 130px;
    }
}

.g-recaptcha>div>div>iframe{
    width: 100% !important;
    height: 78px !important;
}

</style>

<body>
<?php require_once 'header.php'; ?>

   <div class="wrapper" style="margin-top: 100px">
      <div class="block-center mt-4 wd-xl login-register-box">
         <!-- START card-->
         <div class="card card-flat">
            <div class="card-header text-center">
               <a href="#">
                  <img class="block-center rounded" src="<?=base_url()?>asset/img/logo.png" alt="Image">
               </a>
            </div>
            <div class="card-body">
               <p class="text-center py-2">SIGN IN TO CONTINUE.</p>
               <p class="text-center py-2">Join Us in Telegram <a href="https://web.telegram.org/#/login" target="_blank"><img src="assets/t_logo.png" style="width:30px;height:auto;"></a></p>
               <?php echo form_open(base_url().'login',array('class' => 'mb-3','id'=>'loginForm','method'=>'post')); ?>
                  <div class="form-group">
                     <div class="input-group with-focus">
                        <input name="email" class="form-control border-right-0" id="exampleInputEmail1" type="email" placeholder="Enter email" autocomplete="off" required>
                        <div class="input-group-append">
                           <span class="input-group-text fa fa-envelope text-muted bg-transparent border-left-0"></span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="input-group with-focus">
                        <input name="password" class="form-control border-right-0" id="exampleInputPassword1" type="password" placeholder="Password" required>
                        <div class="input-group-append">
                           <span class="input-group-text fa fa-lock text-muted bg-transparent border-left-0"></span>
                        </div>
                     </div>
                  </div>

                  <div class="clearfix">
                     <div class="checkbox c-checkbox float-left mt-0">
                        <label>
                           <input type="checkbox" value="" name="remember">
                           <span class="fa fa-check"></span>Remember Me</label>
                     </div>
                     <div class="float-right"><a class="text-muted" href="<?=base_url()?>forgot_password">Forgot your password?</a>
                     </div>
                  </div>
                
                <div class="form-group">
                    <div class="g-recaptcha" data-theme="light" data-sitekey="<?php echo config_item('google_captcha_key'); ?>" id="captcha_container" data-callback="recaptchaCallback"></div>
                    <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                    <div id="captcha-error" class="error"></div>
                </div>

			<button class="btn btn-block btn-primary mt-3" type="submit">Login</button>
               </form>
               <p class="pt-3 text-center">Need to Signup?</p><a class="btn btn-block btn-secondary" href="<?=base_url()?>register">Register Now</a>
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
   <!-- PARSLEY-->
   <script src="<?=base_url()?>asset/vendor/parsleyjs/dist/parsley.js"></script>
    <!-- JQUERY EASING-->
    <script src="<?=base_url()?>asset/vendor/jquery.easing/jquery.easing.js"></script>
   <!-- ANIMO-->
   <script src="<?=base_url()?>asset/vendor/animo/animo.js"></script>
   <!-- SCREENFULL-->
   <script src="<?=base_url()?>asset/vendor/screenfull/dist/screenfull.js"></script>
   <!-- LOCALIZE-->
   <script src="<?=base_url()?>asset/vendor/jquery-localize/dist/jquery.localize.js"></script>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="<?=base_url()?>asset/js/app.js"></script>
   <script src="<?=base_url()?>asset/js/client/toastr.min.js"></script>
   <script src="https://www.google.com/recaptcha/api.js?onload=loadCaptcha&render=explicit" async defer></script>

   <script type='text/javascript'>
		var base_url = "<?php echo base_url(); ?>";
		var captchaContainer = null;
		function loadCaptcha () {
			captchaContainer = grecaptcha.render('captcha_container', {
				'sitekey': "<?php echo config_item('google_captcha_key'); ?>",	
				'callback': function (response) {
					$("#hiddenRecaptcha").val(response);
					if (response != "") {
						$("#captcha-error").css("display", "none");
					}
				}
			});
		};

        $('#loginForm').on('submit', function(e) {
			if(grecaptcha.getResponse() == "") {
			 	// e.preventDefault();
			 	// $("#captcha-error").css("display","block");
			 	// $("#captcha-error").html("Please enter valid captcha");
			 	// return false;
            }
        });
    </script>

   <?php echo message_box('error'); ?>
   <?php echo message_box('success'); ?>
</body>

</html>

