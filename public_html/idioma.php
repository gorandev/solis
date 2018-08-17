<?
	include("conecta.php");
	$bdd_link=Conectarse();
	session_start();
	$id=$_GET["id"];
	$ref=$_GET["ref"];
	$query= "select * from idiomas where id = '$id'";
	$sopa=mysql_query($query,$bdd_link);
	while($row = mysql_fetch_array($sopa)) {
		$_SESSION['idiomaid'] = $row['id'];
		$_SESSION['idiomanom'] = $row['original'];
		$_SESSION['idiomaabr'] = $row['abreviatura'];
	}
	header("Location: " . $ref);
	exit;

?>
