<?php
	if(!empty($_POST['g-recaptcha-response'])) {


		$url="https://www.google.com/recaptcha/api/siteverify";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
			http_build_query(
				array(
					'secret' => '6LdofSMUAAAAAAFMw1JD4S9YcrAcu-OruDA_0MQ6',
					'response' => $_POST['g-recaptcha-response'],
				)
			)
		);
		$response = curl_exec($ch);

		
		$respuesta=print_r(json_decode($response, true), true);
		if ($respuesta["success"]){
			$nombre=utf8_decode($_POST["nombre"]);
			$email=$_POST["email"];
			$telefono=$_POST["telefono"];
			$servicio=utf8_decode($_POST["servicio"]);
			$personas=$_POST["personas"];
			$mensaje=utf8_decode($_POST["mensaje"]);
			$texto="
			Nombre: $nombre
			Cantidad de personas: $personas
			Email: $email
			Telefono: $telefono
			Servicio solicitado: $servicio
			Consulta: $mensaje";
			mail("info@crucerodesolis.com.ar","Reserva",$texto,"From: ".$nombre." <".$email.">");
			echo "Muchas gracias por contactarse con nosotros!<br>Le responderemos a la brevedad.";
		} else{
			echo "Error: Debe completar el captcha";
		}
	} else {
		echo "Error de captcha.";
	}
	
	die();

?>