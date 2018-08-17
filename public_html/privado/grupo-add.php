<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$nombre=$_POST['nombre'];
	if (empty($nombre)){
		header("Location: grupos.php");
		exit;
	}
	$sopa=mysqli_query($bdd_link,"select * from grupos");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		$query= "select * from grupos ORDER BY orden DESC LIMIT 1";
				$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

			$orden = $row['orden'] + 1;
		}
	} else {
		$orden=1;
	}
	$query="insert into grupos (nombre,orden,estado) values ('$nombre','$orden','activo')";
	$result=mysqli_query($bdd_link,$query);

	header("Location: grupos.php");
	exit;
?>