<!DOCTYPE html>
<html>
<head>
    <script>

      if(document.cookie.indexOf("lang") > 0){
		document.cookie = document.cookie.substring(document.cookie.indexOf("lang")+5);
	} else {
		document.cookie = 'lang=en'
	}
    </script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120909715-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-120909715-1');
</script>

<?php

header('Content-Type: text/html; charset=utf-8' );
ini_set('default_charset', 'utf-8');

//$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);



//$lang = trim(isset($_COOKIE['lang'])? $_COOKIE['lang'] : 'en');
if (isset($_GET['lang'])){
	$lang = $_GET['lang'];
}else{
	$lang = 'es';
}
//$lang = 'kr';


switch ($lang){
    case "en":
        include("lang/en-US.php");
        break;   
    case "es":
        include("lang/es.php");
        break;
    case "id":
        include("lang/id.php");
        break;   
    case "de":
        include("lang/de.php");
        break;
    case "it":
        include("lang/it.php");
        break;   
    case "pt":
        include("lang/pt.php");
        break;
    case "vn":
        include("lang/vn.php");
        break;   
    case "ru":
        include("lang/ru.php");
        break;
    case "cn":
        include("lang/cn.php");
        break;   
    case "jp":
        include("lang/jp.php");
        break;
    case "kr":
        include("lang/kr.php");
        break;   
    case "ir":
        include("lang/ir.php");
        break;
    case "gr":
        include("lang/gr.php");
        break;   
    case "sa":
        include("lang/sa.php");
        break;
    default:
        require("lang/en-US.php");
        break;
}
?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="asset/img/logo-single.png" type="image/png">
	<title>SocialRemit</title>

    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
	<link rel="stylesheet" href="owl/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="owl/assets/owl.theme.default.css">
	<link rel="stylesheet" href="assets/css/styles.css?ver=<?php echo rand(1000,9999) ?>">

	<script src="owl/jquery.min.js"></script>
	<script src="owl/owl.carousel.js"></script>
	<script src="owl/custom.js?ver=<?php echo rand(1000,9999) ?>"></script>
	<link rel="stylesheet" href="assets/css/animate.css?ver=<?php echo rand(1000,9999) ?>">
	<link rel="stylesheet" href="webfonts/awesome/css/font-awesome.css" type="text/css"></head>
	<style>
	.owl-carousel {
	  background-image: url(assets/roadmap1.svg);
	  background-repeat: no-repeat;
	  background-size: 105%;
	  height: 15px;
	  background-position: top center;
	  padding-top: 6%;
	  margin:0 auto;
	  width:80%;
	  position: relative;
	}
	.owl-carousel .owl-nav .owl-prev,
	  .owl-carousel .owl-nav .owl-next,
	  .owl-carousel .owl-dot {
	    font-family: 'fontAwesome';

	}

	</style>
<body>
<ul class="social-bar-list sticky-social-bar">
<li><a style="color:#11a9f7" href="https://t.me/SocialRemit"><em class="fa fa-telegram"></em></a></li>
<ul class="hidden-social-icon">
    <li><a style="color:#3b5998" href="https://www.facebook.com/SocialRemit-Blockchain-Networks-LTD-225736334625445/"><i class="fa fa-facebook"></i></a></li>
    <li><a href="https://twitter.com/Socialremit_uk"><em class="fa fa-twitter"></em></a></li>
    <li><a style="color:#0077B5" href="https://www.linkedin.com/company/SocialRemit/"><em class="fa fa-linkedin"></em></a></li>
    <li><a style="color:#ff4500" href="https://www.reddit.com/user/socialremit/posts/"><em class="fa fa-reddit"></em></a></li>
    <li><a style="color:#FF9900" href="https://bitcointalk.org/index.php?topic=4471416"><em class="fa fa-bitcoin"></em></a></li>
    <li><a style="color:#00ab6c" href="https://medium.com/@SocialRemit"><em class="fa fa-medium"></em></a></li>
</ul>
<li style="cursor: pointer;"class="hidden-social-btn" onclick="showHideIcons()"><a style="color: #d63330;cursor:pointer"><em class="fa fa-angle-double-down"></em></a></li>
</ul>
	<nav class="flex" id="nav">
		<div class="wrapper flex animated fadeInDown d065">

		<a href="/" class="logo"><img src="assets/logo.png" alt="SocialRemit"></a>
		<a class="icon" onclick="menu()" style="margin-left: 15%;">
				<i class="fa fa-bars fa-fw fa-2x"></i>
		</a>
		</div>
        <div class="social-nav-list" style="width: 70%;">
		    <div id="nav-menu" class="flex animated fadeInDown d075 overlay1 onemenu">
                <a  class="closebtn" onclick="menu()">&times;</a>
<!--            <div class="overlay-content">-->
<!--                <div>-->
                <a href="/#about" class="nav-link"><span><?= $t['n_the company'] ?></span></a>
                <a href="/#choose" class="nav-link"><span><?= $t['n_whyhow'] ?></span></a>
		<a href="consulting.php" class="nav-link"><span><?= $t['consulting'] ?></span></a>
                <a href="/whitepaper.php" class="nav-link"><span><?= $t['whitepaper_menu'] ?></span></a>
                <a href="/airdrop.php" class="nav-link"><span><?= $t['n_airdrop'] ?></span></a>
                <a href="/#token" class="nav-link"><span><?= $t['n_tokens'] ?></span></a>
                <a href="/#wallet" class="nav-link"><span><?= $t['sec_icowallet'] ?></span></a>
                <a href="/#team" class="nav-link"><span><?= $t['n_team'] ?></span></a>
                <a href="news.php" class="nav-link"><span><?= $t['news'] ?></span></a>
                <a href="/#faq" class="nav-link"><span><?= $t['n_faq'] ?></span></a>
		
<!--                <a href="/forum" class="nav-link"><span>--><?//= $t['n_community'] ?><!--</span></a>-->
                <a href="/login" class="nav-link"><span><?= $t['n_signin'] ?></span></a>
<!--                </div>-->
		
            </div>

	    </div>
<div class="lang-switch">
            		<div class="switch-pan">
                	<!--
				<div data-lang='en' class="switch left-tab  <?php echo ($lang == 'en')? 'switch-selected' : '' ?>"><img src="/assets/flags/1x1/gb.svg" width="15px"></div>
                		<div data-lang='es' class="switch right-tab <?php echo ($lang == 'es')? 'switch-selected' : '' ?>"><img src="/assets/flags/1x1/es.svg" width="15px"></div>
			-->
				<img id="langswitch" src="imgs/mundo.png" style="max-height:64px;max-width:auto;">
            		</div>
        	</div>

        	<form id="redirect" method="post">
			<input type="hidden" id="lang" name="lang">
		</form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.ddslick.min.js" ></script>
		<script>
			$("#languajes").change(function(){
				$("#lang").val($(this).val());
				$("#redirect").submit();
			});	
		</script>

		<script>
			$("#langswitch").click(function(){
				window.open("languaje.php","_self");
			});
		</script>
    </nav>


