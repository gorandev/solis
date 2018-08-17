<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}

	include("../conecta.php");
	$bdd_link=Conectarse();

	$contador=$_POST['contador'];
	if (empty($contador)){
		header("Location: youtube.php");
		exit;
	}
	foreach($_POST as $variable => $valor) {
		if (($variable != "contador")){
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
		$fotos=$todas["$nro"]["fotos"];
		$videos=$todas["$nro"]["videos"];
		if (!empty($id)){
			$query="update videoscnf set idioma='$idioma', titulo='$titulo', fotos='$fotos', videos='$videos' where id='$id'";
			$sopa=mysqli_query($bdd_link,$query);
		} else {
			$query="insert into videoscnf (idioma,titulo,fotos,videos) values ('$idioma','$titulo','$fotos','$videos')";
			$sopa=mysqli_query($bdd_link,$query);
		}
	}

	header("Location: youtube.php");
	exit;
?>