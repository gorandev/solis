<?
	include("conecta.php");
	$bdd_link=Conectarse();
	session_start();
	if (empty($_SESSION['idiomaid'])){
		$query= "select * from idiomas ORDER BY orden ASC limit 1";
		$sopa=mysql_query($query,$bdd_link);
		while($row = mysql_fetch_array($sopa)) {
			$_SESSION['idiomaid'] = $row['id'];
			$_SESSION['idiomanom'] = $row['original'];
		}
	}
	$idiomaid=$_SESSION['idiomaid'];

// Carga todos los datos de la base que son comunes a todas las páginas

	include("carga.php");

	$sx=$_GET["sx"];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
<?
// Carga head común a todas las páginas
	include("head.php");
?>
		<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="scripts/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$("a[rel^='prettyPhoto']").prettyPhoto();
			});
		</script>
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
		
		if($MobileDetect->IsMobile()){
			echo "<img src='imagenes/header.jpg' width='966' height='262' border='0' alt='Crucero de Solis'>";
		} else {
			echo "<a class='media {width:966, height:262}' href='flash/header.swf'></a>";
		}
?>

				 
			</div>
			<div id="contenido">
				<div id="barra_izq"></div>
					<div id="principal">		
<?
// Carga la botonera
	include("botonera.php");
?>
						<div id="inside">
<?
// Carga la barra de banners de la izquierda
	include("bannerizq.php");
?>
							<div id="comun">
<!-- Listado de productos //-->
<?
	$query= "select * from secciones WHERE sx='$sx' AND idioma='$idiomaid'";
	$sopa=mysql_query($query,$bdd_link);
	while($row = mysql_fetch_array($sopa)) {
		$id = $row['id'];
		$destacado = $row['destacado'];
		$titulo = $row['titulo'];
	}
	echo "<h1>".$titulo."</h1>";
	echo $destacado;

	$query= "select * from productos WHERE sx='$sx' AND estado='activo' ORDER BY orden ASC";
	$sopa=mysql_query($query,$bdd_link);
	$nro=0;
	while($row = mysql_fetch_array($sopa)) {
		$nro++;
		$producto["$nro"]["id"]=$row['id'];
	}
			

	if ($nro > 0){
		$cantprod=$nro;
		$nro=0;
		while ($nro <= $cantprod){
			$nro++;
			$produc=$producto["$nro"]["id"];
			$query= "select * from textos WHERE producto='$produc' AND idioma='$idiomaid'";
			$sopa=mysql_query($query,$bdd_link);
			while($row = mysql_fetch_array($sopa)) {
				$prod["$nro"]["id"] = $produc;
				$prod["$nro"]["texto"] = $row["texto"];
				$prod["$nro"]["titulo"] = $row["titulo"];
			}
		}
		$nro=0;
		while ($nro < $cantprod){
			$nro++;
			$xproducto=$prod["$nro"]["id"];
			$titulo=$prod["$nro"]["titulo"];
			$texto=$prod["$nro"]["texto"];
			echo "
			<div class='productos'>
				<h1>".$titulo."</h1>
				<div class='txt_prod'>
					".$texto."
				</div>
				<ul class='gallery clearfix galeria'>

			";
			$query= "select * from fotos WHERE producto='$xproducto' ORDER BY orden ASC";
			$sopa=mysql_query($query,$bdd_link);
			$xf=0;
			while($row = mysql_fetch_array($sopa)) {
				$xf++;
				$foto = $row['id'];
				if ($xf > 8){
					$clase=" class='oculto'>";
				} else {
					$clase="";
				}
				echo "<li".$clase."><a href='/pics/grandes/".$foto.".jpg' rel='prettyPhoto[galeria".$xproducto."]'><img src='/pics/chicas/".$foto.".jpg' width='90' height='90' alt='' /></a></li>";

			}
			echo "
				</ul>
				<div class='limpiar'></div>
				<a href='reservas.php' class='boton_cons'>Reservas / Consultas</a>
			</div>
			";
		}
		
		
	}
			








?>


	
<!-- Fin del listado de productos //-->


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