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
		$reservas=$todas["$nro"]["reservas"];
		$opciones=$todas["$nro"]["opciones"];
		if (!empty($id)){
			$query="update botones set reservas='$reservas', opciones='$opciones' where id='$id'";
			$result=mysqli_query($bdd_link,$query);

		} else {
			$query="insert into botones (idioma,reservas,opciones) values ('$idioma','$reservas','$opciones')";
			$result=mysqli_query($bdd_link,$query);

		}

	}

	header("Location: index.php");
	exit;
?>