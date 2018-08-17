<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	include("funciones.php");
	$bdd_link=Conectarse();
	$sx=$_GET["sx"];
	$seccion = esonoes($sx);
	noCache();
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
							"bold italic underline | color highlight | alignleft center alignright justify | removeformat",
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
			<h1>Sección: <? echo $seccion; ?> [Configuración]</h1>
			<div id="formulario">
<?
// Búsqueda de los idiomas existentes
$sopa=mysqli_query($bdd_link,"select * from idiomas");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		echo "
		<form id='form' method='post' action='seccion-mng.php' enctype='multipart/form-data'>
			<fieldset>
			<input type='hidden' name='seccion' value='" .$sx. "' />";
		$a = array(1,2,11,12,13,14,16);
		if (!in_array($sx, $a)) {
			echo "<label for='archivo'>Imagen del Home:</label>";
			if (file_exists("../pics/home/small/" .$sx . ".jpg")){
				echo "<img src='/pics/home/small/" .$sx . ".jpg' />";
			}
			echo "<input type='file' name='archivo' id='archivo'/>";
		}
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
			$sopa=mysqli_query($bdd_link,"select * from secciones WHERE sx='$sx' AND idioma='$idiomaid'");
			$filasDevueltas = mysqli_num_rows($sopa);
			if ($filasDevueltas!=0){
				$query= "select * from secciones WHERE sx='$sx' AND idioma='$idiomaid'";
						$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

					$id = $row['id'];
					$boton = $row['boton'];
					$destacado = $row['destacado'];
					$titulo = $row['titulo'];
					$txthome = $row['txthome'];
				}
			}
			echo "
				<h6><a href='#' id='ht" .$cuenta. "'>$nombreidioma</a></h6>
				<div id='caja" .$cuenta. "' class='caja'><input type='hidden' name='id_" .$cuenta. "' value='" .$id. "' />
				<input type='hidden' name='idioma_" .$cuenta. "' value='" .$idiomaid. "' />
				<label for='boton_" .$cuenta. "'>Botón:</label>
				<input type='text' name='boton_" .$cuenta. "' id='boton_" .$cuenta. "' value='" .$boton. "' />
				<label for='titulo_" .$cuenta. "'>Título:</label>
				<input type='text' name='titulo_" .$cuenta. "' id='titulo_" .$cuenta. "' value='" .$titulo. "' />";
			if (!in_array($sx, $a)) {
				echo "<label for='txthome_" .$cuenta. "'>Texto Home:</label>
				<input type='text' name='txthome_" .$cuenta. "' id='txthome_" .$cuenta. "' value='" .$txthome. "' />";
			}
			echo "
				<label for='destacado_" .$cuenta. "'>Texto Destacado:</label>
				<textarea name='destacado_" .$cuenta. "' id='destacado_" .$cuenta. "' cols='80' rows='10'>" .$destacado. "</textarea></div>";
			$id = "";
			$boton = "";
			$destacado = "";
			$url = "";
			$titulo = "";
			$txthome = "";
			$cuenta=$cuenta+1;
		}
		echo " <br />
				<button type='submit'>Aceptar</button>
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

