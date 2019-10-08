<!DOCTYPE html>
<html>
<head>

    <script>

      if(document.cookie.indexOf("lang") > 0){
	document.cookie = document.cookie.substring(document.cookie.indexOf("lang")+5);
} else {
	document.cookie = 'lang=en'
}

var idioma = navigator.language || navigator.userLanguage;
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

$lbl_lang = '';
$flag_img = '';

header('Content-Type: text/html; charset=utf-8' );
ini_set('default_charset', 'utf-8');

if (isset($_GET['lang'])){
	$lang = $_GET['lang'];
}else{
	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
        $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        if (strcmp(substr($lang,0,5), "en-US")==0){
            $lang = "us";
        }else {
            $lang = substr($lang, 0, 2);
        }
    }else{
        $lang = 'en';

    }
}

switch ($lang){
    case "us":
        include("lang/us.php");
        $lbl_lang = 'English';
        $flag_img = '/assets/flags/1x1/um.svg';
        break;
    case "en":
        include("lang/en.php");
        $lbl_lang = 'English';
        $flag_img = '/assets/flags/1x1/gb.svg';
        break;   
    case "es":
        include("lang/es.php");
        $lbl_lang = 'Español';
        $flag_img = '/assets/flags/1x1/es.svg';
        break;
    case "id":
        include("lang/id.php");
        $lbl_lang = 'Bahasa Indonesia';
        $flag_img = '/assets/flags/1x1/id.svg';
        break;   
    case "de":
        include("lang/de.php");
        $lbl_lang = 'Deutsch';
        $flag_img = '/assets/flags/1x1/de.svg';
        break;
    case "it":
        include("lang/it.php");
        $lbl_lang = 'Italiano';
        $flag_img = '/assets/flags/1x1/it.svg';
        break;   
    case "pt":
        include("lang/pt.php");
        $lbl_lang = 'Português';
        $flag_img = '/assets/flags/1x1/pt.svg';
        break;
    case "vn":
        include("lang/vn.php");
        $lbl_lang = 'Tiếng Việt';
        $flag_img = '/assets/flags/1x1/vn.svg';
        break;
    case "vi":
        include("lang/vn.php");
        $lbl_lang = 'Tiếng Việt';
        $flag_img = '/assets/flags/1x1/vn.svg';
        break;   
    case "ru":
        include("lang/ru.php");
        $lbl_lang = 'Русский';
        $flag_img = '/assets/flags/1x1/ru.svg';
        break;
    case "cn":
        include("lang/cn.php");
        $lbl_lang = '简体中文';
        $flag_img = '/assets/flags/1x1/cn.svg';
        break;
    case "zh":
        include("lang/cn.php");
        $lbl_lang = '简体中文';
        $flag_img = '/assets/flags/1x1/cn.svg';
        break;
    case "jp":
        include("lang/jp.php");
        $lbl_lang = '日本語';
        $flag_img = '/assets/flags/1x1/jp.svg';
        break;
    case "ja":
        include("lang/jp.php");
        $lbl_lang = '日本語';
        $flag_img = '/assets/flags/1x1/jp.svg';
        break;
    case "kr":
        include("lang/kr.php");
        $lbl_lang = '한국어';
        $flag_img = '/assets/flags/1x1/kr.svg';
        break;
    case "ko";
        include("lang/kr.php");
        $lbl_lang = '한국어';
        $flag_img = '/assets/flags/1x1/kr.svg';
        break;
    case "ir":
        include("lang/ir.php");
        $lbl_lang = 'فارسی';
        $flag_img = '/assets/flags/1x1/ir.svg';
        break;
    case "fa":
        include("lang/ir.php");
        $lbl_lang = 'فارسی';
        $flag_img = '/assets/flags/1x1/ir.svg';
        break;
    case "gr":
        include("lang/gr.php");
        $lbl_lang = 'Ελληνικά';
        $flag_img = '/assets/flags/1x1/gr.svg';
        break;
    case "el";
        include("lang/gr.php");
        $lbl_lang = 'Ελληνικά';
        $flag_img = '/assets/flags/1x1/gr.svg';
        break; 
    case "sa":
        include("lang/sa.php");
        $lbl_lang = 'اللغة العربية';
        $flag_img = '/assets/flags/1x1/sa.svg';
        break;
    case "ar":
        include("lang/sa.php");
        $lbl_lang = 'اللغة العربية';
        $flag_img = '/assets/flags/1x1/sa.svg';
        break;
    case "tr":
        include("lang/tr.php");
        $lbl_lang = 'Türkçe';
        $flag_img = '/assets/flags/1x1/tr.svg';
        break;
    case "fr":
        include("lang/fr.php");
        $lbl_lang = 'Français';
        $flag_img = '/assets/flags/1x1/fr.svg';
        break;
    case "ua":
        include("lang/uk.php");
        $lbl_lang = 'Українська';
        $flag_img = '/assets/flags/1x1/ua.svg';
        break;
    case "uk";
        include("lang/uk.php");
        $lbl_lang = 'Українська';
        $flag_img = '/assets/flags/1x1/ua.svg';
        break;
    default:
        require("lang/en-US.php");
        $lbl_lang = 'English';
        $flag_img = '/assets/flags/1x1/gb.svg';
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

		<a href="/?lang=<?php echo $lang ?>" class="logo"><img src="assets/logo.png" alt="SocialRemit"></a>
		<a class="icon" onclick="menu()" style="margin-left: 15%;">
				<i class="fa fa-bars fa-fw fa-2x"></i>
		</a>
		</div>
        <div class="social-nav-list" style="width: 70%;">
		    <div id="nav-menu" class="flex animated fadeInDown d075 overlay1 onemenu">
                <a  class="closebtn" onclick="menu()">&times;</a>
<!--            <div class="overlay-content">-->
<!--                <div>-->
                <a href="/?lang=<?php echo $lang ?>" class="nav-link"><span><?= $t['sr_home'] ?></span></a>
                <a href="#cons" class="nav-link"><span><?= $t['cons'] ?></span></a>
		<a href="#dev" class="nav-link"><span><?= $t['dev'] ?></span></a>
                <a href="#mkt" class="nav-link"><span><?= $t['mkt'] ?></span></a>
                <a href="#comm" class="nav-link"><span><?= $t['comm'] ?></span></a>
                <a href="news.php?lang=<?php echo $lang?>" class="nav-link"><span><?= $t['news'] ?></span></a>

<!--                <a href="/forum" class="nav-link"><span>--><?//= $t['n_community'] ?><!--</span></a>-->
                <a href="/#contact" class="nav-link"><span><?= $t['contact'] ?></span></a>
<!--                </div>-->
            </div>
	    </div>
        <div class="lang-switch">
            <div class="switch-pan">
                
            </div>
        </div>
    </nav>


