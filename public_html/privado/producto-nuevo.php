<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$sx=$_GET["sx"];
	switch ($sx) {
		case 1:
			$seccion="Quienes Somos";
			break;
		case 2:
			$seccion="Embarcaciones";
			break;
		case 3:
			$seccion="Contacto";
			break;
		case 4:
			$seccion="Reservas";
			break;
		case 5:
			$seccion="Día de Crucero";
			break;
		case 6:
			$seccion="Cena Romántica";
			break;
		case 7:
			$seccion="Eventos Corporativos";
			break;
		case 8:
			$seccion="Fiestas Sociales";
			break;
		case 9:
			$seccion="Noche de Bodas";
			break;
		case 10:
			$seccion="Safari";
			break;
		case 11:
			$seccion="Fotos";
			break;
		case 12:
			$seccion="Paradores";
			break;
		case 13:
			$seccion="Carta Virtual";
			break;
		case 14:
			$seccion="Regalos a Bordo";
			break;
		case 15:
			$seccion="Videos";
			break;
		case 16:
			$seccion="Promociones";
			break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Administrador</title>
		<link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" title="default" />
		<link rel="stylesheet" href="css/jquery.cleditor.css" type="text/css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="js/jquery.cleditor.min.js"></script>
		<script type="text/javascript">
		<!--

		  $(document).ready(function() {
			$("textarea").cleditor({
			  width:        770, // width not including margins, borders or padding
			  height:       200, // height not including margins, borders or padding
			  controls:     // controls to add to the toolbar
							"bold italic underline | color highlight | size | alignleft center alignright justify | removeformat | source",
			  styles:       // styles in the style popup
							[["Normal", "<p>"], ["Azul", "<h5>"], ["Subtítulo", "<h3>"]],
			  useCSS:       false, // use CSS to style HTML when possible (not supported in ie)
			  docType:      // Document type contained within the editor
							'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
			  docCSSFile:   // CSS file used to style the document contained within the editor
							"css/estilo-textarea.css",
			  bodyStyle:    // style to assign to document body contained within the editor
							"margin:4px; font:10pt Arial,Verdana; cursor:text"
			});
		  });
		  //-->
		</script>
		<script type="text/javascript">
		$(function(){
<?
	$sopa=mysqli_query($bdd_link,"select * from idiomas");
	$filasDevueltas = mysqli_num_rows($sopa);

	$ddlf=0;
	while ($ddlf <= $filasDevueltas) {
		$ddlf++;
		echo "$(\"#ht" .$ddlf. "\").click(function(event) {
				event.preventDefault();
				$(\"#caja" .$ddlf. "\").slideToggle();
			});
			$(\"#caja" .$ddlf. " a\").click(function(event) {
				event.preventDefault();
				$(\"#caja" .$ddlf. "\").slideUp();
			});
		";
	}
?>
			
		});
		</script>
	</head>
	<body onload="document.getElementById('castellano').focus();">
		<div id="cuerpo">
			<a href="seccion.php?sx=<? echo $sx; ?>" class="volver">Volver</a>
			<div class="limpiar"></div>
			<h1>Sección: <? echo $seccion; ?> [Nuevo Producto]</h1>
			<div id="formulario">
<?
// Búsqueda de los idiomas existentes
	$sopa=mysqli_query($bdd_link,"select * from idiomas");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		echo "
		<form id='form' method='post' action='producto-add.php'>
			<fieldset>
			<input type='hidden' name='seccion' value='" .$sx. "' />
			<label for='nombre'>Nombre del Producto:</label>
			<input type='text' name='nombre' id='nombre' />";
		$query= "select * from idiomas ORDER BY orden ASC";
		$sopa=mysqli_query($bdd_link,$query);
		$nro=0;
		while($row = mysqli_fetch_array($sopa)) {
			$nro=$nro+1;
			$idioma["$nro"]["id"]= $row['id'];
			$idioma["$nro"]["nombre"]= $row['castellano'];
		}
		echo "	<input type='hidden' name='contador' value='" .$nro. "' />";

		$cuenta=1;
		while ($cuenta <= $nro){
			$idiomaid=$idioma["$cuenta"]["id"];
			$nombreidioma=$idioma["$cuenta"]["nombre"];
			echo "
				<h6><a href='#' id='ht" .$cuenta. "'>$nombreidioma</a></h6>
				<div id='caja" .$cuenta. "' class='caja'><input type='hidden' name='idioma_" .$cuenta. "' value='" .$idiomaid. "' />
				<label for='titulo_" .$cuenta. "'>Título:</label>
				<input type='text' name='titulo_" .$cuenta. "' id='titulo_" .$cuenta. "' />
				<label for='texto_" .$cuenta. "'>Texto:</label>
				<textarea name='texto_" .$cuenta. "' id='texto_" .$cuenta. "' cols='80' rows='10'></textarea></div>";
				
			$cuenta=$cuenta+1;
		}
		echo " <br />
				<button type='submit'>Agregar</button>
				<div class='spacer'></div>
				</fieldset>
			</form>
		";
	} else {
		echo "<div class='error'>No hay idiomas disponibles</div>";
	}
		

?>

			</div>
		</div>
	</body>
</html>

