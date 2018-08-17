<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$id=$_GET['id'];
	if (!empty($id)){
		$query="delete from youtube where id = '$id'";
		$result=mysqli_query($bdd_link,$query);

	}
	header("Location: youtube.php");
	exit;

?>