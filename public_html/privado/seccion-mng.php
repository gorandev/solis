<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	include("funciones.php");
	$bdd_link=Conectarse();

	$seccion=$_POST['seccion'];
	$contador=$_POST['contador'];
	if (empty($seccion) || empty($contador)){
		header("Location: seccion.php?sx=" .$seccion);
		exit;
	}
	foreach($_POST as $variable => $valor) {
		if (($variable != "seccion") && ($variable != "contador")){
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
		$boton=$todas["$nro"]["boton"];
		$url=convierte_a_link($boton);
		$titulo=$todas["$nro"]["titulo"];
		$txthome=$todas["$nro"]["txthome"];
		$destacado=$todas["$nro"]["destacado"];
		if (!empty($id)){
			$query="update secciones set sx='$seccion', idioma='$idioma', boton='$boton', url='$url', titulo='$titulo', txthome='$txthome', destacado='$destacado' where id='$id'";
			$result=mysqli_query($bdd_link,$query);

		} else {
			$query="insert into secciones (sx,idioma,boton,titulo,txthome,destacado,url) values ('$seccion','$idioma','$boton','$titulo','$txthome','$destacado','$url')";
			$result=mysqli_query($bdd_link,$query);

		}
	}
	if (!empty($_FILES)) {
		$tempFile = $_FILES["archivo"]["tmp_name"];
		$targetFile = "/home/crucerod/public_html/pics/home/" . $seccion . ".jpg";
		move_uploaded_file($tempFile,$targetFile);
		include("imageprocessor.php");
		$ImageProcessor = new ImageProcessor();
		$ImageProcessor->Load($targetFile);
		$ImageProcessor->Resize(128, 128, RESIZE_FIT);
		$dondeva="../pics/home/small/" .$seccion . ".jpg";
		$ImageProcessor->Save($dondeva,90);
	}

	header("Location: seccion.php?sx=" .$seccion);
	exit;
?>