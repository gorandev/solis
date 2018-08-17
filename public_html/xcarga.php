<?

// Carga los meta-tags
	$query= "select * from meta WHERE idioma='$idiomaid'";
	$sopa=mysql_query($query,$bdd_link);
	while($row = mysql_fetch_array($sopa)) {
		$descripcion = $row['descripcion'];
		$keywords = $row['keywords'];
		$titulo = $row['titulo'];
	}

// Carga la info de secciones
	$query= "select * from secciones WHERE idioma='$idiomaid'";
	$sopa=mysql_query($query,$bdd_link);
	while($row = mysql_fetch_array($sopa)) {
		$id= $row['id'];
		$secciones["$id"]["boton"]= $row['boton'];
		$secciones["$id"]["destacado"]= $row['destacado'];
		$secciones["$id"]["titulo"]= $row['titulo'];
		$secciones["$id"]["txthome"]= $row['txthome'];
	}
	
// Carga el botón de contacto
	$query= "select * from contacto WHERE idioma='$idiomaid'";
	$sopa=mysql_query($query,$bdd_link);
	while($row = mysql_fetch_array($sopa)) {
		$contacto= $row['boton'];
	}
	
// Carga el botón de reservas
	$query= "select * from reservas WHERE idioma='$idiomaid'";
	$sopa=mysql_query($query,$bdd_link);
	while($row = mysql_fetch_array($sopa)) {
		$reservas= $row['boton'];
	}

// Carga de idiomas
	$query= "select * from idiomas WHERE estado='activo' ORDER BY orden ASC";
	$sopa=mysql_query($query,$bdd_link);
	
	$nro=0;
	while($row = mysql_fetch_array($sopa)) {
		$id = $row['id'];
		if ($id != $idiomaid){
			$nro++;
			$idiomas["$nro"]["id"]=$row['id'];
			$idiomas["$nro"]["nombre"]=$row['original'];
		}
	}
	$cantidiomas=$nro;

// SOCIALES
	$query= "select * from social WHERE id='1'";
	$sopa=mysql_query($query,$bdd_link);
	while($row = mysql_fetch_array($sopa)) {
		$facebook= $row['facebook'];
		$youtube= $row['youtube'];
		$flickr= $row['flickr'];
		$twitter= $row['twitter'];
		$email= "mailto:".$row['email'];
	}

?>