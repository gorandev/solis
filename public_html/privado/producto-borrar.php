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
	if (!empty($producto)){
		$sopa=mysqli_query($bdd_link,"select * from fotos WHERE producto='$producto'");
		$filasDevueltas = mysqli_num_rows($sopa);
		if ($filasDevueltas!=0){
			$query= "select * from fotos WHERE producto='$producto' ORDER BY orden ASC";
					$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

				$id = $row['id'];
				unlink("/home/crucerod/public_html/pics/chicas/" .$id. ".jpg");
				unlink("/home/crucerod/public_html/pics/grandes/" .$id. ".jpg");
			}
			$query="delete from fotos where producto='$producto'";
			$result=mysqli_query($bdd_link,$query);

		}
		$query="delete from textos where producto='$producto'";
		$result=mysqli_query($bdd_link,$query);

		$query="delete from productos where id='$producto'";
		$result=mysqli_query($bdd_link,$query);

	}
	header("Location: seccion.php?sx=$sx");
	exit;

?>