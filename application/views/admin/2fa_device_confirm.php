
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
   <title>Admin</title>
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

   <style>
   </style>
</head>

<body>
   <div class="wrapper">
      <div class="block-center mt-4 wd-xl">
         <!-- START card-->
         <div class="card card-flat">
            <div class="card-header text-center bg-dark">
               <a href="#">
                  <img class="block-center rounded" src="<?=base_url()?>asset/img/logo-white.png" alt="Image">
               </a>
            </div>
            <div class="card-body">
               <!-- <p class="text-center py-2">Enter Google Authenticator Code.</p> -->
               <p class="text-center py-2">Scan this QR code using Google Authenticator.</p>
               <div class="row">
                <div class="col-6">
                    <a class = "appbadge" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">
                        <img height="45" src="http://www.niftybuttons.com/googleplay/googleplay-button8.png" alt="Get on Google Play">
                    </a>
                </div>
                <div class="col-6">
                    <a class = "appbadge" href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8?at=1000lc66" target="_blank">
                        <img height="45" src="http://www.niftybuttons.com/itunes/itunesbutton1.png" alt="iTunes Button">
                    </a>
                </div>
               </div>
               
                
               <?php echo form_open(base_url().'adminlogin',array('class' => 'mb-3','id'=>'loginForm','method'=>'post')); ?>
                  <?php if(isset($qrCodeUrl)){ ?>
                    <div class="form-group  text-center">
                        <img src='<?php echo $qrCodeUrl; ?>' />
                    </div>
                  <?php } ?>
                  <p class="text-center py-2">Enter 2FA Code.</p>
                  <div class="form-group">
                     <div class="input-group with-focus">
                        <input name="deviceConfirmCode" min="0" max="999999" step="1" class="form-control border-right-0" id="deviceConfirmCode" type="number" placeholder="6 digit number" autocomplete="off" required>
                        <div class="input-group-append">
                           <span class="input-group-text fa fa-mobile text-muted bg-transparent border-left-0"></span>
                        </div>
                     </div>
                     <div id="code-error" class="error" style="text-color:red"></div>
                  </div>
                </div>

                <button class="btn btn-block btn-primary mt-3" type="submit">Login</button>
               </form>
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
   <!-- =============== APP SCRIPTS ===============-->
   <script src="<?=base_url()?>asset/js/app.js"></script>
   <script src="<?=base_url()?>asset/js/client/toastr.min.js"></script>

   <script type='text/javascript'>
		var base_url = "<?php echo base_url(); ?>";

        $('#loginForm').on('submit', function(e) {
            var reg = /^[0-9]{6}$/i
			if(!reg.test($('#deviceConfirmCode').val())) {
			 	//e.preventDefault();
			 	$("#code-error").css("display", "block").css("color", "red");
			 	$("#code-error").html("Please enter 6 digit number");
			 	return false;
            }
        });
    </script>

   <?php echo message_box('error'); ?>
   <?php echo message_box('success'); ?>
</body>

</html>
