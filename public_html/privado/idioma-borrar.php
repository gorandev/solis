<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	$id=$_GET['id'];
	if (!empty($id)){
		include("../conecta.php");
		$bdd_link=Conectarse();
		$query="delete from idiomas where id = '$id'";
		$result=mysqli_query($bdd_link,$query);

		$query="delete from secciones where idioma = '$id'";
		$result=mysqli_query($bdd_link,$query);

		$query="delete from textos where idioma = '$id'";
		$result=mysqli_query($bdd_link,$query);

		$query="delete from videostit where idioma = '$id'";
		$result=mysqli_query($bdd_link,$query);

		$query="delete from videoscnf where idioma = '$id'";
		$result=mysqli_query($bdd_link,$query);

	}
	header("Location: idiomas.php");
	exit;
?>
