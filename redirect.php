<?php
	
	$prm 	= "-1";
	$target = "";

	if (isset($_GET['prm'])){
		$prm = $_GET['prm'];
	}
	

	switch($prm){
		case "1": $target = "https://www.socialremit.com/login";break;
		case "2": $target = "https://www.socialremit.com/index.php?t=1";break;
		case "3": $target = "http://www.okaymt.com/";break;
		case "4": $target = "http://www.socialremit.com/whitepaper.php";break;
		case "5": $target = "http://www.stock1wise.com/";break;
		case "6": $target = "https://www.socialremit.com/whitepaper.php";break;
		case "-1": $target = "https://www.socialremit.com/";break;
	}
	
	header("Location:".$target);
?>