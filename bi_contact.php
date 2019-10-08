<?php
	$code = 0;

    if (isset($_POST['g-recaptcha-response'])){

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
		    $email_subject = "Solicitud de Contacto. Grandes Inversores para SocialRemit";

			if(!isset($_POST['tx_nb']) || !isset($_POST['tx_ap']) ||
				!isset($_POST['tx_tl']) || !isset($_POST['tx_ce']) || 
			    !isset($_POST['tx_ps']) || !isset($_POST['tx_inv'])){

			    $code=1;
			    
			}else{
				$_nb = $_POST['tx_nb'];
			    $_ap = $_POST['tx_ap'];
			    $_tl = $_POST['tx_tl'];
			    $_ce = $_POST['tx_ce'];
			    $_ps = $_POST['tx_ps'];
			    $_inv = $_POST['tx_inv'];


			    $email_message = "Detalles del formulario de contacto:\n\n";
			    $email_message .= "Nombre: " . $_nb . "\n";
			    $email_message .= "Apellido: " . $_ap . "\n";
			    $email_message .= "E-mail: " . $_ce . "\n";
			    $email_message .= "Teléfono: " . $_tl . "\n";
			    $email_message .= "País: " . $_ps . "\n";
			    $email_message .= "Monto: " . $_inv . "\n\n";


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
	
    header("Location:contact_test.php?code=".$code);

?>