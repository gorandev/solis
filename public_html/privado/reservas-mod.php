<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();

	$contador=$_POST['contador'];
	
	foreach($_POST as $variable => $valor) {
		if ($variable != "contador"){
			$pos = strpos($variable, "_");
			$cuenta= substr($variable, $pos+1);
			$campo= substr($variable, 0, $pos);
			$todas["$cuenta"]["$campo"]= $valor;
		}
	}
	$nro=0;
	while ($nro < $contador){
		$nro=$nro+1;
		$id=$todas["$nro"]["id"];
		$idioma=$todas["$nro"]["idioma"];
		$titulo=$todas["$nro"]["titulo"];
		$nya=$todas["$nro"]["nya"];
		$fecha=$todas["$nro"]["fecha"];
		$producto=$todas["$nro"]["producto"];
		$email=$todas["$nro"]["email"];
		$telefono=$todas["$nro"]["telefono"];
		$pax=$todas["$nro"]["pax"];
		$comentarios=$todas["$nro"]["comentarios"];
		$leyenda=$todas["$nro"]["leyenda"];
		$captcha=$todas["$nro"]["captcha"];
		$boton=$todas["$nro"]["boton"];
		$texto=$todas["$nro"]["texto"];
		$exito=$todas["$nro"]["exito"];
		$gracias=$todas["$nro"]["gracias"];
		$enviar=$todas["$nro"]["enviar"];

		if (!empty($id)){
			$query="update reservas set titulo='$titulo', nya='$nya', fecha='$fecha', producto='$producto', email='$email', telefono='$telefono', pax='$pax', comentarios='$comentarios', leyenda='$leyenda', boton='$boton', enviar='$enviar', texto='$texto', captcha='$captcha', exito='$exito', gracias='$gracias' where id='$id'";
			$result=mysqli_query($bdd_link,$query);

		} else {
			$query="insert into reservas (idioma,titulo,nya,fecha,producto,email,telefono,pax,comentarios,leyenda,boton,texto,enviar,captcha,gracias,exito) values ('$idioma','$titulo','$nya','$fecha','$producto','$email','$telefono','$pax','$comentarios','$leyenda','$boton','$texto','$enviar','$captcha','$gracias','$exito')";
			$result=mysqli_query($bdd_link,$query);

		}

	}

	header("Location: index.php");
	exit;
?>