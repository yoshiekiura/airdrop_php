
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Bootstrap Admin App + jQuery">
   <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
   <title>SocialRemit - User</title>
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
<<<<<<< HEAD
body { 
background-image: url('<?=base_url()?>asset/img/illustration_plane.jpg');
background-size: cover;
background-position: center;
background-repeat: none;
background-attachment: fixed;
=======
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
.card-header.text-center.bg-dark{
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
>>>>>>> changes727
}
</style>

<body>
<?php require_once 'header.php'; ?>

   <div class="wrapper" style="margin-top: 100px">
      <div class="block-center mt-4 wd-xl" style="box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);border-radius: 10px;border: 2px solid #f4f4f4;">
         <!-- START card-->
         <div class="card card-flat">
            <div class="card-header text-center bg-dark">
               <a href="#">
                  <img class="block-center rounded" src="<?=base_url()?>asset/img/logo.png" alt="Image">
               </a>
            </div>
            <div class="card-body">
               <p class="text-center py-2">SIGN IN TO CONTINUE.</p>
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
   <?php echo message_box('error'); ?>
   <?php echo message_box('success'); ?>
</body>

</html>

