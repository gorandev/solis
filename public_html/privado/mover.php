<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$orden=$_GET["orden"];
	$tipo=$_GET["tipo"];
	$accion=$_GET["accion"];
	$sx=$_GET["sx"];
	switch ($tipo) {
		case "grupos":
			$bdd="grupos";
			$pagina="grupos.php";
			break;
		case "idiomas":
			$bdd="idiomas";
			$pagina="idiomas.php";
			break;
		case "videos":
			$bdd="videos";
			$pagina="videos.php";
			break;
		case "productos":
			$bdd="productos";
			$pagina="seccion.php?sx=$sx";
			$agregar="AND sx='$sx' ";
			break;

	}



	if ($accion!="subir"){
		$query="select * from " .$bdd. " WHERE orden<'" .$orden. "' ".$agregar."ORDER BY orden DESC LIMIT 1";
	} else {
		$query="select * from " .$bdd. " WHERE orden>'" .$orden. "' ".$agregar."ORDER BY orden ASC LIMIT 1";
	}
	$result=mysqli_query($bdd_link,$query);

	while($row = mysqli_fetch_array($result)) {
		$id=$row["id"];
		$viejo=$row["orden"];
	}
	$resulta=mysqli_query($bdd_link,"update " .$bdd. " set orden='9999' where id='" .$id. "' ");
	$resulta=mysqli_query($bdd_link,"update " .$bdd. " set orden='" .$viejo. "' where orden='" .$orden. "'");
	$resulta=mysqli_query($bdd_link,"update " .$bdd. " set orden='" .$orden. "' where id='" .$id. "' ");
	header("Location: " . $pagina);
	exit;
?>
