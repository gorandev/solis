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
								     <li class="pr">
										<h1><? echo $secciones["3"]["titulo"]; ?></h1>
										<p><? echo $secciones["3"]["txthome"]; ?></p>
										<a href="dia_crucero.php" title="<? echo $secciones["3"]["titulo"]; ?>"><img src="imagenes/dia_crucero.jpg" alt="<? echo $secciones["3"]["titulo"]; ?>" /></a>
										<a href="dia_crucero.php" title="<? echo $secciones["3"]["titulo"]; ?>" class="opciones">Ver opciones</a>
									</li>
								     <li class="pr">
										<h1><? echo $secciones["4"]["titulo"]; ?></h1>
										<p><? echo $secciones["4"]["txthome"]; ?></p>
										<a href="escapadas.php" title="<? echo $secciones["4"]["titulo"]; ?>"><img src="imagenes/cena_romantica.jpg" alt="<? echo $secciones["4"]["titulo"]; ?>" /></a>
										<a href="escapadas.php" title="<? echo $secciones["4"]["titulo"]; ?>" class="opciones">Ver opciones</a>
									</li>
								     <li class="pr">
										<h1><? echo $secciones["5"]["titulo"]; ?></h1>
										<p><? echo $secciones["5"]["txthome"]; ?></p>
										<a href="eventos_corporativos.php" title="<? echo $secciones["5"]["titulo"]; ?>"><img src="imagenes/eventos_corporativos.jpg" alt="<? echo $secciones["5"]["titulo"]; ?>" /></a>
										<a href="eventos_corporativos.php" title="<? echo $secciones["5"]["titulo"]; ?>" class="opciones">Ver opciones</a>
									</li>
								     <li class="pr">
										<h1><? echo $secciones["6"]["titulo"]; ?></h1>
										<p><? echo $secciones["6"]["txthome"]; ?></p>
										<a href="fiestas_sociales.php" title="<? echo $secciones["6"]["titulo"]; ?>"><img src="imagenes/fiestas_sociales.jpg" alt="Día de Crucero" /></a>
										<a href="fiestas_sociales.php" title="<? echo $secciones["6"]["titulo"]; ?>" class="opciones">Ver opciones</a>
									</li>
								     <li class="pr">
										<h1><? echo $secciones["7"]["titulo"]; ?></h1>
										<p><? echo $secciones["7"]["txthome"]; ?></p>
										<a href="noche_bodas.php" title="<? echo $secciones["7"]["titulo"]; ?>"><img src="imagenes/luna_miel.jpg" alt="Día de Crucero" /></a>
										<a href="noche_bodas.php" title="<? echo $secciones["7"]["titulo"]; ?>" class="opciones">Ver opciones</a>
									</li>
								     <li class="pr">
										<h1><? echo $secciones["8"]["titulo"]; ?></h1>
										<p><? echo $secciones["8"]["txthome"]; ?></p>
										<a href="safari_reserva.php" title="<? echo $secciones["8"]["titulo"]; ?>"><img src="imagenes/safari.jpg" alt="Día de Crucero" /></a>
										<a href="safari_reserva.php" title="<? echo $secciones["8"]["titulo"]; ?>" class="opciones">Ver opciones</a>
									</li>
								     <li>
										<h1><? echo $clima_tit; ?></h1>
										<div id="clima">
<? include('weather_plugin.php'); ?>
<? 
	
	echo $get_weather->all('San Fernando Buenos Aires', false, $clima_grado, $clima_idioma);
	
?>
										</div>
									</li>
								     <li class="pr">
										<h1><? echo $lluvia_tit; ?></h1>
										<p><? echo $lluvia_txt; ?></p>
										<img src="banners/lluvia.jpg" alt="<? echo $lluvia_tit; ?>" />										
									</li>
							     </ul>
								<div class="limpiar"></div>

<iframe src="http://www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/pages/El-Crucero-de-Solis/96662394428&width=570&colorscheme=light&show_faces=true&stream=false&header=true&height=292" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:570px; height:292px;" allowTransparency="true"></iframe>



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
	</body>
</html>