<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();

	$id=$_GET['id'];
	$st=$_GET['st'];
	if ($st != "a"){
		$query="update grupos set estado='activo' where id='$id'";
	} else {
		$query="update grupos set estado='inactivo' where id='$id'";
	}
	$result=mysqli_query($bdd_link,$query);


	header("Location: grupos.php");
	exit;
?>
