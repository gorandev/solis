<?

// Carga los meta-tags
	$query= "select * from meta WHERE idioma='$idiomaid'";
	$sopa=mysqli_query($bdd_link,$query);
	while($row = mysqli_fetch_array($sopa)) {
		$descripcion = $row['descripcion'];
		$keywords = $row['keywords'];
		$titulo = $row['titulo'];
	}

// Carga el boton de servicios

	$query= "select * from gruposcnf WHERE idioma='$idiomaid'";
	$sopa=mysqli_query($bdd_link,$query);
	while($row = mysqli_fetch_array($sopa)) {
		$btn_serv = $row['titulo'];
	}


// Carga la info de secciones
	$query= "select * from secciones WHERE idioma='$idiomaid'";
	$sopa=mysqli_query($bdd_link,$query);
	while($row = mysqli_fetch_array($sopa)) {
		$id= $row['sx'];
		$secciones["$id"]["boton"]= $row['boton'];
		$url = $row['url'];
		$secciones["$id"]["link"]= strtolower($btn_serv)."/".$url.".html";
		$secciones["$id"]["destacado"]= $row['destacado'];
		$secciones["$id"]["titulo"]= $row['titulo'];
		$secciones["$id"]["txthome"]= $row['txthome'];
	}
	
// Carga el botón de contacto
	$query= "select * from contacto WHERE idioma='$idiomaid'";
	$sopa=mysqli_query($bdd_link,$query);
	while($row = mysqli_fetch_array($sopa)) {
		$contacto= $row['boton'];
	}
	
// Carga el botón de reservas
	$query= "select * from reservas WHERE idioma='$idiomaid'";
	$sopa=mysqli_query($bdd_link,$query);
	while($row = mysqli_fetch_array($sopa)) {
		$reservas= $row['boton'];
	}

// Carga de idiomas
	$query= "select * from idiomas WHERE estado='activo' ORDER BY orden ASC";
	$sopa=mysqli_query($bdd_link,$query);
	
	$nro=0;
	while($row = mysqli_fetch_array($sopa)) {
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
	$sopa=mysqli_query($bdd_link,$query);
	while($row = mysqli_fetch_array($sopa)) {
		$facebook= $row['facebook'];
		$youtube= $row['youtube'];
		$flickr= $row['flickr'];
		$twitter= $row['twitter'];
		$email= "mailto:".$row['email'];
	}

?>