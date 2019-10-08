<!DOCTYPE html>
<?php
	$lang = "en";

	if (isset($_GET['lang'])){
		$lang = $_GET['lang'];
	}else{
	    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
	        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	    }else{
	        $lang = 'en';
	    }
	}

	switch ($lang){
	    case "en":
	        include("lang_gp/en.php");
	        break;   
	    case "es":
	        include("lang_gp/es.php");
	        break;
	   	default:
	       include("lang_gp/en.php");
    }
?>
<html><!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="description" content="SOCIAL REMIT GROUP | Blockhain Networks"><meta name="author" content="www.socialremit.com">
		<title>SOCIALREMIT GROUP| Blockhain Networks</title>
		<!-- Mobile Specific Meta
	  ================================================== --><meta name="viewport" content="width=device-width, initial-scale=1"><!-- Favicon -->
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" /><!-- bootstrap.min css -->
		<link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet" /><!-- Revo Slider CSS
	    ================================================== --><!-- RS5.0 Main Stylesheet -->
		<link href="plugins/revo-slider/css/settings.css" rel="stylesheet" type="text/css" /><!-- RS5.0 Layers and Navigation Styles -->
		<link href="plugins/revo-slider/css/layers.css" rel="stylesheet" type="text/css" />
		<link href="plugins/revo-slider/css/navigation.css" rel="stylesheet" type="text/css" /><!-- REVOLUTION STYLE SHEETS -->
		<link href="plugins/revo-slider/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css" />
		<link href="plugins/revo-slider/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="plugins/revo-slider/css/settings.css" rel="stylesheet" type="text/css" />
		<link href="plugins/revo-slider/css/layers.css" rel="stylesheet" type="text/css" />
		<link href="plugins/revo-slider/css/navigation.css" rel="stylesheet" type="text/css" /><!-- CSS
	  ================================================== --><!-- Themefisher Icon font -->
		<link href="plugins/themefisher-font/style.css" rel="stylesheet" /><!-- Lightbox.min css -->
		<link href="plugins/lightbox2/dist/css/lightbox.min.css" rel="stylesheet" /><!-- Slick Carousel -->
		<link href="plugins/slick-carousel/slick/slick.css" rel="stylesheet" />
		<link href="plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet" /><!-- Main Stylesheet -->
		<link href="css/style.css" rel="stylesheet" />
		<style>
			.btn-wp{
				margin-top: 0px;
				display:inline;
			}
			@media (max-width: 600px){
				.btn-wp{
					margin-top: 20px;
					display:block;
				}
			}

		</style>
	</head>
	<body id="body"><!--
		Start Preloader
		==================================== -->
		<div id="preloader">
			<div class="preloader">
				<div class="sk-circle1 sk-child">&nbsp;</div>

				<div class="sk-circle2 sk-child">&nbsp;</div>

				<div class="sk-circle3 sk-child">&nbsp;</div>

				<div class="sk-circle4 sk-child">&nbsp;</div>

				<div class="sk-circle5 sk-child">&nbsp;</div>

				<div class="sk-circle6 sk-child">&nbsp;</div>

				<div class="sk-circle7 sk-child">&nbsp;</div>

				<div class="sk-circle8 sk-child">&nbsp;</div>

				<div class="sk-circle9 sk-child">&nbsp;</div>

				<div class="sk-circle10 sk-child">&nbsp;</div>

				<div class="sk-circle11 sk-child">&nbsp;</div>

				<div class="sk-circle12 sk-child">&nbsp;</div>
			</div>
		</div>
		<!--
		End Preloader
		==================================== --><!--
		Fixed Navigation
		==================================== -->

		<section class="header navigation">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
					<nav class="navbar navbar-expand-md">
						<a class="navbar-brand" href="/">
							<img alt="logo" src="images/logo.png" />
						</a>
						<button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button"></button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">&nbsp;</div>
					</nav>
					</div>
				</div>
			</div>
			<footer class="bg-one" id="footer">
						<div class="footer-bottom">
							<h1 style="color:#FFF;"><?php echo $t['tit_gpo'] ?></h1>
						</div>
				</footer>
		</section>

		<section class="hero-area">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="video-player">
							<img class="img-fluid rounded" src="images/slider/sr.png" alt="">
							<a class="play-icon" href="javascript:void(0)">
								<i class="tf-ion-play"  data-video="<?php echo $t['vid_sr'] ?>"></i>

							</a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="block">
							<h2>SOCIALREMIT </h2>
							<h4 style="color:#357E22"><?php echo $t['protected'] ?></h4>
							<h3 style="color:#F00"><?php echo $t['ico_start'] ?></h3>
							<p><?php echo $t['tit_sr'] ?></p>
							
							<ul class="list-inline wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".7s">
								<li class="list-inline-item">
									<a href="https://www.socialremit.com/redirect.php?prm=1" target="_blank" class="btn btn-main" style="background-image: linear-gradient(100deg, #a31b11, #ba6066);">ICO</a>
									<a href="https://www.socialremit.com/redirect.php?prm=2" target="_blank" class="btn btn-main btn-wp">WEB</a>
									<a href="https://www.socialremit.com/redirect.php?prm=4" target="_blank" class="btn btn-main btn-wp">WHITEPAPERS</a>	
								</li>
							</ul>
							<img src = "images/sello1.png" style="width:150px;height:auto; margin-top: 20px;">
						</div>
					</div>
				</div>
			</div>
		</section>

		<!--
		Welcome Slider
		==================================== -->

		<section class="hero-area">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="video-player">
							<img class="img-fluid rounded" src="images/slider/video-player-thumb.jpg" alt="">
							<a class="play-icon" href="javascript:void(0)">
								<i class="tf-ion-play"  data-video="<?php echo $t['vid_okay'] ?>"></i>
							</a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="block">
							<h2>OKAY MONEY</h2>
							<p><?php echo $t['tit_okay'] ?></p>
							<ul class="list-inline wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".7s">
								<li class="list-inline-item">
									<a href="https://www.socialremit.com/redirect.php?prm=3" target="_blank" class="btn btn-main btn-wp">WEB</a>
									<a href="https://www.socialremit.com/redirect.php?prm=4" target="_blank" class="btn btn-main btn-wp">WHITEPAPERS</a>			
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="hero-area">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="video-player">
							<img class="img-fluid rounded" src="images/slider/s1w.png" alt="">
							<a class="play-icon" href="javascript:void(0)">
								<i class="tf-ion-play"  data-video="<?php echo $t['vid_s1w'] ?>"></i>
							</a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="block">
							<h2>STOCK1WISE</h2>
							<p><?php echo $t['tit_s1w'] ?></p>
							<ul class="list-inline wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".7s">
								<li class="list-inline-item">
									<a href="https://www.socialremit.com/redirect.php?prm=5" target="_blank" class="btn btn-main btn-wp">WEB</a>	
									<a href="https://www.socialremit.com/redirect.php?prm=6" target="_blank" class="btn btn-main btn-wp">WHITEPAPERS</a>		
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End container -->
		<footer class="bg-one" id="footer">
			<div class="top-footer">
				<div class="container">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<h3>SocialRemit</h3>

							<p>SOCIALREMIT BLOCKCHAIN NETWORKS LTD tiene su sede central en Reino Unido y delegaciones en Espa&ntilde;a, Malta, USA y Am&eacute;rica Latina.</p>
						</div>
						<!-- End of .col-sm-3 -->

						<div class="col-sm-3 col-md-3 col-lg-3">
							<h3>Nuestras Webs</h3>

							<ul>
								<li><a href="https://www.socialremit.com/redirect.php?prm=2">SocialRemit</a></li>
								<li><a href="https://www.socialremit.com/redirect.php?prm=3">OkayMoney</a></li>
								<li><a href="https://www.socialremit.com/redirect.php?prm=5">Stock1Wise</a></li>
							</ul>
						</div>
						<!-- End of .col-sm-3 -->

						<div class="col-sm-3 col-md-3 col-lg-3">
							<h3>Redes Sociales</h3>

							<ul>
								<li><a href="https://www.facebook.com/SocialRemit-Blockchain-Networks-LTD-225736334625445/">Facebook</a></li>
								<li><a href="https://twitter.com/Socialremit_uk">  Twitter</a></li>
								<li><a href="https://www.linkedin.com/company/socialremit/">Linkedin</a></li>
								<li><a href="https://icobench.com/ico/socialremit">Icobench</a></li>
							</ul>
						</div>
						<!-- End of .col-sm-3 --><!-- End of .col-sm-3 --></div>
					</div>
				<!-- end container -->
				</div>

				<div class="footer-bottom">
					<h5>Copyright 2017. Todos los derechos reservados.</h5>

					<h6>Dise&ntilde;o y desarrollo realizado por 
						<a href="https://www.socialremit.com/redirect.php?prm=2" target="_blank">SocialRemit</a>
					</h6>
				</div>
			</div>
		</footer>
		<!-- end footer --><!-- end Footer Area
		========================================== --><!-- 
		Essential Scripts
		=====================================-->
		<!-- Main jQuery -->
			<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
			<script src="plugins/bootstrap/bootstrap.min.js"></script>
		<!-- Parallax -->
			<script src="plugins/parallax/jquery.parallax-1.1.3.js"></script>
		<!-- lightbox -->
			<script src="plugins/lightbox2/dist/js/lightbox.min.js"></script>
		<!-- Owl Carousel -->
			<script src="plugins/slick-carousel/slick/slick.min.js"></script>
		<!-- Portfolio Filtering -->
			<script src="plugins/mixitup/dist/mixitup.min.js"></script>
		<!-- Smooth Scroll js -->
			<script src="plugins/smooth-scroll/dist/js/smooth-scroll.min.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI14J_PNWVd-m0gnUBkjmhoQyNyd7nllA"></script>
		<!-- Form Validation -->
			<script src="plugins/form-validation/jquery.form.js"></script>
			<script src="plugins/form-validation/jquery.validate.min.js"></script>
		<!-- Custom js -->
			<script type="text/javascript" src="plugins/revo-slider/js/jquery.themepunch.tools.min.js"></script>
			<script type="text/javascript" src="plugins/revo-slider/js/jquery.themepunch.revolution.min.js"></script>
			<script src="js/script.js"></script>

		<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
		(Load Extensions only on Local File Systems ! 
		The following part can be removed on Server for On Demand Loading) -->
		<script type="text/javascript" src="plugins/revo-slider/js/extensions/revolution.extension.actions.min.js"></script>
		<script type="text/javascript" src="plugins/revo-slider/js/extensions/revolution.extension.carousel.min.js"></script>
		<script type="text/javascript" src="plugins/revo-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
		<script type="text/javascript" src="plugins/revo-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
		<script type="text/javascript" src="plugins/revo-slider/js/extensions/revolution.extension.migration.min.js"></script>
		<script type="text/javascript" src="plugins/revo-slider/js/extensions/revolution.extension.navigation.min.js"></script>
		<script type="text/javascript" src="plugins/revo-slider/js/extensions/revolution.extension.parallax.min.js"></script>
		<script type="text/javascript" src="plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
		<script type="text/javascript" src="plugins/revo-slider/js/extensions/revolution.extension.video.min.js"></script>
		<script>
	    /* https://learn.jquery.com/using-jquery-core/document-ready/ */
	    jQuery(document).ready(function () {
	        /* initialize the slider based on the Slider's ID attribute */
	        jQuery('#rev_slider_1').show().revolution({

	            /* options are 'auto', 'fullwidth' or 'fullscreen' */
	            sliderLayout: 'fullscreen',

	            /* basic navigation arrows and bullets */
	            navigation: {

	                arrows: {
	                    style: "zeus",
	                    enable: true,
	                    hide_onmobile: true,
	                    hide_under: 600,
	                    hide_onleave: true,
	                    hide_delay: 200,
	                    hide_delay_mobile: 1200,
	                    tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
	                    left: {
	                        h_align: "left",
	                        v_align: "center",
	                        h_offset: 30,
	                        v_offset: 0
	                    },
	                    right: {
	                        h_align: "right",
	                        v_align: "center",
	                        h_offset: 30,
	                        v_offset: 0
	                    }
	                }
	                ,
	                bullets: {
	                    enable: false,
	                    hide_onmobile: true,
	                    hide_under: 600,
	                    style: "metis",
	                    hide_onleave: true,
	                    hide_delay: 200,
	                    hide_delay_mobile: 1200,
	                    direction: "horizontal",
	                    h_align: "center",
	                    v_align: "bottom",
	                    h_offset: 0,
	                    v_offset: 30,
	                    space: 5,
	                    tmp: '<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
	                }
	            }
	        });
	    });
		</script>
	</body>
</html>