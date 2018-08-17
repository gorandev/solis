<?
	include("conecta.php");
	$bdd_link=Conectarse();
	session_start();
	if (empty($_SESSION['idiomaid'])){
		$query= "select * from idiomas WHERE estado='activo' ORDER BY orden ASC limit 1";
		$sopa=mysql_query($query,$bdd_link);
		while($row = mysql_fetch_array($sopa)) {
			$_SESSION['idiomaid'] = $row['id'];
			$_SESSION['idiomanom'] = $row['original'];
			$_SESSION['idiomaabr'] = $row['abreviatura'];
		}
	}
	$idiomaid=$_SESSION['idiomaid'];

// Carga todos los datos de la base que son comunes a todas las páginas

	include("carga.php");

// Carga del Seguro de Lluvia
	$query= "select * from lluvia WHERE idioma='$idiomaid'";
	$sopa=mysql_query($query,$bdd_link);
	while($row = mysql_fetch_array($sopa)) {
		$lluvia_tit= $row['titulo'];
		$lluvia_txt= $row['txthome'];
	}


// Carga del Clima
	$query= "select * from clima WHERE idioma='$idiomaid'";
	$sopa=mysql_query($query,$bdd_link);
	while($row = mysql_fetch_array($sopa)) {
		$clima_tit= $row['titulo'];
		$clima_grado= $row['grado'];
	}
	$clima_idioma=$_SESSION['idiomaabr'];

	if (empty($clima_tit)) {
		$clima_tit="Weather in Delta";
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
<?
// Carga head común a todas las páginas
	include("head.php");
?>
		<link rel="stylesheet" type="text/css" href="css/weather.css" />
	</head>
	
	<body>
	<div id="origenia">
<?
// Carga la sticky bar
	include("barra.php");
?>
		<!-- CONTENT -->
		<div class="cuerpo">
			<div id="encabezado">

<?
		include("MobileDetect.php");
		$MobileDetect = new MobileDetect();
		
		if(!$MobileDetect->IsMobile()){
//			echo "<img src='imagenes/header.jpg' width='966' height='262' border='0' alt='Crucero de Solis'>";
//		} else {
//			echo "<a class='media {width:966, height:262, params:{ wmode: 'transparent'}}' href='flash/header.swf'></a>";
		}
?>

				 
			</div>
			<div id="contenido">
				<div id="barra_izq"></div>
					<div id="principal">		
<?
// Carga la botonera
//	include("botonera.php");
?>

						<div id="inside">
<?
// Carga la barra de banners de la izquierda
	include("bannerizq.php");
?>
							<div id="centro">
							     <ul>
<?
		$query= "select * from grupos WHERE estado='activo' ORDER BY orden ASC";
		$sopa=mysql_query($query,$bdd_link);
		$XXnroreg=1;
		while($row = mysql_fetch_array($sopa)) {
			$id = $row['id'];
			$grupos["$XXnroreg"]["id"]=$id;
			$XXnroreg++;
		}
		$regact=1;
		while ($regact < $XXnroreg) {
			$gid = $grupos["$regact"]["id"];
			echo "
				<li class='pr'>
					<h1>" .$secciones["$gid"]["titulo"]. "</h1>
					<p>" .$secciones["$gid"]["txthome"]. "</p>
					<a href='" .$secciones["$gid"]["link"]. "' title='" .$secciones["$gid"]["titulo"]. "'><img src='pics/home/small/" .$gid. ".jpg' alt='" .$secciones["$gid"]["titulo"]. "' /></a>
					<a href='" .$secciones["$gid"]["link"]. "' title='" .$secciones["$gid"]["titulo"]. "' class='opciones'>Ver opciones</a>
				</li>
			";
			$regact++;
		}


?>
</li>
								     <li class="pr">
										<h1><? echo $lluvia_tit; ?></h1>
										<p><? echo $lluvia_txt; ?></p>
										<img src="banners/lluvia.jpg" alt="<? echo $lluvia_tit; ?>" />										
									</li>   
							     </ul>
                                 
								<div class="limpiar"></div>
                                <div align="center" style="width:570px; height:115px;">
                                <div id="cont_e0188213e16b43da81f810c768bb0e7d"><span id="h_e0188213e16b43da81f810c768bb0e7d">El Tiempo  en Tigre</span>
<script type="text/javascript" src="http://www.tiempo.com/wid_loader/e0188213e16b43da81f810c768bb0e7d"></script></div>
</div>

<iframe src="http://www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/pages/El-Crucero-de-Solis/96662394428&width=570&colorscheme=light&show_faces=true&stream=false&header=true&height=292" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:570px; height:292px;" allowTransparency="true"></iframe>


						     </div>
                             </div>
						     <div id="banner_der">
							     <ul>
								     <li><a href="embarcaciones.php" title="Conozca nuestras embarcaciones"><img src="banners/embarcaciones.gif" alt="Conozca nuestras embarcaciones" /></a></li>
								     <li><a href="carta_virtual.php" title="Visite nuestra carta a bordo"><img src="banners/carta_virtual_banner.gif" alt="Visite nuestra carta a bordo" /></a></li>
								     <li><a href="regalos.php" title="Regalos a bordo"><img src="banners/regalos.gif" alt="Regalos a bordo" /></a></li>
								     <li><a href="reservas.php" title="Medios de pago"><img src="banners/tarjetas.gif" alt="Medios de pago" /></a></li>
							     </ul>
						     </div>
						    </div>
					
				<div id="barra_der"></div>
			</div>
		</div>
		<div class="limpiar"></div>
<?
// Carga el pie de página
	include("pie.php");
?>
	</div>		
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-5367643-1");
		pageTracker._trackPageview();
	</script>
<a href="http://qr.afip.gob.ar/?qr=5beTrDyPIYeaEfJrNt6qhg,," target="_F960AFIPInfo"><img src="http://www.afip.gob.ar/images/f960/DATAWEB.jpg" width="50" border="0" style='display:scroll;position:fixed;bottom:20px;right:30px'></a>
	</body>
</html>