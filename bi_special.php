<?php
	$code = 0;

    if (isset($_POST['g-recaptcha-response'])){
	define ('USUARIO','superdev');
	define ('CLAVE','szEban@2');
	define ('BASE','olive_airdrop_refined');
	define ('SRV','localhost');

	$conexion = @mysqli_connect(SRV, USUARIO, CLAVE, BASE) 
		or die("La conexion no pudo realizarse<br>".mysqli_connect_error());


    	$secret = '6LezbWoUAAAAAEr6biihT1mjWPNRBS7rLX5hIoCJ';
    	
		$response = $_POST['g-recaptcha-response'];
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$ip = $_SERVER['REMOTE_ADDR'];

		$data = array(
			'secret' => '6LezbWoUAAAAAEr6biihT1mjWPNRBS7rLX5hIoCJ',
			'response' => $_POST['g-recaptcha-response']
		);

		$options = array(
			'http' => array (
				'method' => 'POST',
			   	'content' => http_build_query($data)
			)
		);

		$context = stream_context_create($options);
		$verify = file_get_contents($url.'?secret='.$secret.'&response='.$response.'&remoteip='.$ip);

		$captcha_success = json_decode($verify);

		if ($captcha_success->success == false){
			$code = -2;
		}else if ($captcha_success->success == true){

			$email_to = "sales@pymesit.com.mx";
		    //$email_to = "sales@socialremit.com";
		    $email_subject = "Registro a Campaña Especial";

			if (!isset($_POST['tx_un']) || !isset($_POST['tx_nb']) || 
			    !isset($_POST['tx_ce']) || !isset($_POST['tx_ps'])){

			    $code=1;
			    
			}else{
				$_user = $_POST['tx_un'];
			    $_name = $_POST['tx_nb'];
			    $_mail = $_POST['tx_ce'];
			    $_country = $_POST['tx_ps'];
			    $_campaign = $_POST['tx_cp'];
			    $_socialnw = $_POST['tx_sn'];

			    $sql = "INSERT INTO tbl_special_campaign (username, fullname, email, country, campaignid, socialnetworkid) values ('$_user','$_name','$_mail','$_country','$_campaign','$_socialnw')";
			    
			    $conexion->query($sql);

			    $email_message = "Detalles del Registro en Campaña Especial:\n\n";
			    $email_message .= "Usuario: " . $_user . "\n";
			    $email_message .= "Nombre: " . $_name . "\n";
			    $email_message .= "E-mail: " . $_mail . "\n";
			    $email_message .= "País: " . $_country . "\n";
			    $email_message .= "Campaña: " . $_campaign . "\n";
			    $email_message .= "Red Social: " . $_socialnw . "\n\n";


			            //$email_from = $_POST['tx_nb']. ' ' . $_POST['tx_ap'];
			    $email_from = 'sales@socialremit.com';
			    $headers = 'From: '.$email_from."\r\n".
			    	'Reply-To: '.$email_from."\r\n" .
			    	'X-Mailer: PHP/' . phpversion();
			    @mail($email_to, $email_subject, $email_message, $headers);
			    $code=0;
			            
			}
		}
    }else{
    	$code = -1;
    }
	
    header("Location:frmSpecial.php?code=".$code);

?>