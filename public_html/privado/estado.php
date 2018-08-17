<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();

	$id=$_GET['id'];
	$sx=$_GET['sx'];
	$st=$_GET['st'];
	if ($st != "a"){
		$query="update productos set estado='activo' where id='$id'";
	} else {
		$query="update productos set estado='inactivo' where id='$id'";
	}
	$result=mysqli_query($bdd_link,$query);


	header("Location: seccion.php?sx=".$sx);
	exit;
?>
