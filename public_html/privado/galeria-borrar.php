<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$sx=$_GET["sx"];
	$producto=$_GET["producto"];
	$nombre=$_GET["nombre"];
	$id=$_GET['id'];
	if (!empty($id)){
		$query="delete from fotos where id = '$id'";
		$result=mysqli_query($bdd_link,$query);

//		chmod("/home/fitmedic/public_html/imagenes/", 0777);
		unlink("/home/crucerod/public_html/pics/chicas/" .$id. ".jpg");
		unlink("/home/crucerod/public_html/pics/grandes/" .$id. ".jpg");
//		chmod("/home/fitmedic/public_html/imagenes/", 0755);
	}
	header("Location: galeria.php?sx=$sx&producto=$producto&nombre=$nombre");
	exit;

?>