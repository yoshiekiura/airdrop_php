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


<?php

header('Content-Type: text/html; charset=utf-8' );
ini_set('default_charset', 'utf-8');

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
    case "tr":
        include("lang/tr.php");
        break;
    case "fr":
        include("lang/fr.php");
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
	<link rel="stylesheet" href="assets/css/styles.css">

	<script src="owl/jquery.min.js"></script>
	<script src="owl.carousel.js"></script>
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="webfonts/awesome/css/font-awesome.css" type="text/css">
  <link rel="stylesheet" href="assets/css/airdrop.css?ver=<?php echo rand(1000,9999) ?>">

</head>


<body>

<?php require_once 'header.php'; ?>

<div id="container">
<div id="video" class="video">
		<div class="video-box" style="box-shadow: #282a2b94 6px 6px 12px; height: auto;">
		<!--
        <iframe width="640" height="344" allow="autoplay; encrypted-media" id="vplayer" src="https://www.youtube.com/embed/<?//= $t['youvidid'] ?>?autoplay=0&amp;controls=0&amp;disablekb=1&amp;fs=0&amp;iv_load_policy=3&amp;loop=1&amp;modestbranding=1&amp;playsinline=1&amp;rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;origin=http%3A%2F%2Fsocialremit.com&amp;widgetid=1" frameborder="0"></iframe>
        -->
        <iframe id="vplayer" class="embed-responsive-item mivideo"  src="<?= $t['airvidid'] ?>" frameborder="0"></iframe>
		</div>
	</div>
<div id="buttons-choices">
<a id="login" href="/login">REGISTER</a>
<a id="whitepaper" href="/whitepaper.php">WHITEPAPER</a>
</div>

<div class="contact-telegram flex wow fadeInUp d020">
			<a href="https://t.me/SocialRemit"><span><img src="assets/contact_telegram.svg" alt="Telegram">
                    <?= $t['sec_social_telegram'] ?></span></a>
		</div>

</div>
<?php require_once 'footer.php'; ?>
