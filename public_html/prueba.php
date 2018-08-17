<?
	include("conecta.php");
	$bdd_link=Conectarse();
	$nrocat="cate_" .$_GET['nro']. "#";
	$largo=strlen($nrocat);
	echo "Buscar: " .$nrocat. " (Largo: " .$largo. ")<br><br>";
	$query= "select * from prueba WHERE categorias LIKE '%" .$nrocat. "%'";
	$sopa=mysql_query($query,$bdd_link);
	while($row = mysql_fetch_array($sopa)) {
		$id = $row['id'];
		$categorias = $row['categorias'];
		$categoria = explode(";", $categorias);
		foreach ($categoria as &$cats) {
			$corte=substr($cats,0,$largo);
			if ($corte==$nrocat) {
				$orden=substr($cats,$largo);
				$resultados["$orden"]["id"]=$id;
				$resultados["$orden"]["prueba"]="hola";
				
				echo $id. " - " .$categorias. " - Encontrado: " .$cats. " [" .$orden. "] <br />";
				break;
			}
		}
	}
	if (!empty($resultados)){
		ksort($resultados);
		foreach ($resultados as $key => $value) {
			$id=$value["id"];
			$prueba=$value["prueba"];
			$orden=$key;
			echo "$orden = $id ::> Prueba: $prueba<br>";
		}
	}
?>