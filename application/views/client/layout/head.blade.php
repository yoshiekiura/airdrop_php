<!DOCTYPE html>
<html lang="en">

<head>
{{--
<script>
var geotargetlyblock1536603564300 = document.createElement('script');
geotargetlyblock1536603564300.setAttribute('type','text/javascript');
geotargetlyblock1536603564300.async = 1;
geotargetlyblock1536603564300.setAttribute('src', '//geotargetly-1a441.appspot.com/geoblock?id=-LM3hPU4K4JO4TjRm6SM');
document.getElementsByTagName('head')[0].appendChild(geotargetlyblock1536603564300);
</script>
--}}
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="SocialRemit ICO is Live!">
	<meta name="author" content="SocialRemit Developers">
	<!-- <link rel="icon" href="../images/favicon.ico"> -->
	<link rel="shortcut icon" href="{{base_url()}}asset/img/SocialRemit_Logo.png" type="image/png">

	<title>SocialRemit - @yield('title')</title>

	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="{{base_url()}}assets/vendor_components/bootstrap/dist/css/bootstrap.css">

	<!-- flipclock-->
	<link rel="stylesheet" href="{{base_url()}}assets/vendor_components/FlipClock-master/compiled/flipclock.css">

	<!--amcharts -->
	<link href="https://www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap-extend -->
    <link rel="stylesheet" href="{{base_url()}}assets/css/bootstrap-extend.css">
    
    <!-- toast CSS -->
    <link href="{{base_url()}}assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css" rel="stylesheet">

    @stack('plugin_css')

	<!-- theme style -->
	<link rel="stylesheet" href="{{base_url()}}assets/css/master_style.css">

	<!-- Crypto_Admin skins -->
	<link rel="stylesheet" href="{{base_url()}}assets/css/skins/_all-skins.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @stack('custom_css')
    <style>
    .btn-social-icon{
        color: white !important;
        margin-left: 10px;
    }

    #header_date_section span{
        margin-left: 15px;
        margin-right: 15px;
    }
    #header_date_section strong{
        color: yellow;
        font-size: larger;
    }
    </style>
</head>

<body class="hold-transition skin-green sidebar-mini">
	<div class="wrapper">
