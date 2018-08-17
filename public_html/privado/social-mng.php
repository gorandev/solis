<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$facebook=$_POST["facebook"];
	$twitter=$_POST["twitter"];
	$youtube=$_POST["youtube"];
	$flickr=$_POST["flickr"];
	$email=$_POST["email"];
	$query="update social set facebook='$facebook', twitter='$twitter', youtube='$youtube', flickr='$flickr', email='$email' where id='1'";
	$result=mysqli_query($bdd_link,$query);


	header("Location: index.php");
	exit;
?>