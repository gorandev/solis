<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();

	$producto=$_POST['producto'];
	$seccion=$_POST['seccion'];
	$contador=$_POST['contador'];
	$nombre=$_POST['nombre'];
	if (empty($seccion) || empty($contador) || empty($nombre) || empty($producto)){
		header("Location: seccion.php?sx=" .$seccion);
		exit;
	}
	$query="update productos set nombre='$nombre' where id='$producto'";
	$result=mysqli_query($bdd_link,$query);

	
	
	foreach($_POST as $variable => $valor) {
		if (($variable != "seccion") && ($variable != "contador") && ($variable != "nombre")){
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
		$texto=$todas["$nro"]["texto"];
		if (!empty($id)){
			$query="update textos set titulo='$titulo', texto='$texto' where id='$id'";
			$result=mysqli_query($bdd_link,$query);

		} else {
			$query="insert into textos (idioma,titulo,texto,producto) values ('$idioma','$titulo','$texto','$producto')";
			$result=mysqli_query($bdd_link,$query);

		}

	}

	header("Location: seccion.php?sx=" .$seccion);
	exit;
?>