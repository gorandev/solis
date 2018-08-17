<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();

	$seccion=$_POST['seccion'];
	$contador=$_POST['contador'];
	$nombre=$_POST['nombre'];
	if (empty($seccion) || empty($contador) || empty($nombre)){
		header("Location: seccion.php?sx=" .$seccion);
		exit;
	}
	$sopa=mysqli_query($bdd_link,"select * from productos WHERE sx='$seccion'");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		$query= "select * from productos WHERE sx='$seccion' ORDER BY orden DESC LIMIT 1";
				$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

			$orden = $row['orden'] + 1;
		}
	} else {
		$orden=1;
	}
	$query="insert into productos (sx,nombre,orden,estado) values ('$seccion','$nombre','$orden','activo')";
	$result=mysqli_query($bdd_link,$query);

	$query= "select * from productos ORDER BY id DESC LIMIT 1";
			$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

		$producto = $row['id'];
	}
	
	
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
		$idioma=$todas["$nro"]["idioma"];
		$titulo=$todas["$nro"]["titulo"];
		$texto=$todas["$nro"]["texto"];
		$query="insert into textos (idioma,titulo,texto,producto) values ('$idioma','$titulo','$texto','$producto')";
		$result=mysqli_query($bdd_link,$query);

	}

	header("Location: seccion.php?sx=" .$seccion);
	exit;
?>