<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$grupo=$_GET["grupo"];
	if (!empty($grupo)){
		$sopa=mysqli_query($bdd_link,"select * from productos WHERE sx = '$grupo'");
		$filasDevueltas = mysqli_num_rows($sopa);

		if ($filasDevueltas!=0){
			$query= "select * from grupos WHERE id='$grupo'";
					$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

				$_SESSION['grupofull'] = $row['nombre'];
			}
		} else {
			$query="delete from grupos where id='$grupo'";
			$result=mysqli_query($bdd_link,$query);

			$query="delete from secciones where sx='$grupo'";
			$result=mysqli_query($bdd_link,$query);

		}
	}
	header("Location: grupos.php");
	exit;

?>