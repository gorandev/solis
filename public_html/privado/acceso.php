<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	if (empty($user) || empty($pass)){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$query="update cnf set usuario='$user', clave='$pass' where id='2'";
	$result=mysqli_query($bdd_link,$query);

	header("Location: index.php");
	exit;
	
?>
