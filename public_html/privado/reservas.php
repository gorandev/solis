<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
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
			  height:       500, // height not including margins, borders or padding
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
			<a href="index.php" class="volver">Volver</a>
			<div class="limpiar"></div>
			<h1>Sección: Reservas</h1>
			<div id="formulario">
<?
// Búsqueda de los idiomas existentes
	$sopa=mysqli_query($bdd_link,"select * from idiomas");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		echo "
		<form id='form' method='post' action='reservas-mod.php'>
			<fieldset>";
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
			$query= "select * from reservas WHERE idioma='$idiomaid'";
					$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

				$id = $row['id'];
				$titulo = $row['titulo'];
				$nya = $row['nya'];
				$fecha = $row['fecha'];
				$producto = $row['producto'];
				$email = $row['email'];
				$telefono = $row['telefono'];
				$pax = $row['pax'];
				$comentarios = $row['comentarios'];
				$leyenda = $row['leyenda'];
				$boton = $row['boton'];
				$texto = $row['texto'];
				$enviar = $row['enviar'];
				$exito = $row['exito'];
				$gracias = $row['gracias'];
				$captcha = $row['captcha'];
			}
			echo "
				<h6><a href='#' id='ht" .$cuenta. "'>$nombreidioma</a></h6>
				<div id='caja" .$cuenta. "' class='caja'><input type='hidden' name='idioma_" .$cuenta. "' value='" .$idiomaid. "' />
				<input type='hidden' name='id_" .$cuenta. "' value='" .$id. "' />
				<label for='titulo_" .$cuenta. "'>Título:</label>
				<input type='text' name='titulo_" .$cuenta. "' id='titulo_" .$cuenta. "' value='".$titulo."' />
				<label for='boton_" .$cuenta. "'>Botón:</label>
				<input type='text' name='boton_" .$cuenta. "' id='boton_" .$cuenta. "' value='".$boton."' />
				<label for='nya_" .$cuenta. "'>Nombre y Apellido:</label>
				<input type='text' name='nya_" .$cuenta. "' id='nya_" .$cuenta. "' value='".$nya."' />
				<label for='fecha_" .$cuenta. "'>Fecha del Evento:</label>
				<input type='text' name='fecha_" .$cuenta. "' id='fecha_" .$cuenta. "' value='".$fecha."' />
				<label for='producto_" .$cuenta. "'>Producto:</label>
				<input type='text' name='producto_" .$cuenta. "' id='producto_" .$cuenta. "' value='".$producto."' />
				<label for='email_" .$cuenta. "'>Email:</label>
				<input type='text' name='email_" .$cuenta. "' id='email_" .$cuenta. "' value='".$email."' />
				<label for='telefono_" .$cuenta. "'>Teléfono:</label>
				<input type='text' name='telefono_" .$cuenta. "' id='telefono_" .$cuenta. "' value='".$telefono."' />
				<label for='pax_" .$cuenta. "'>Cantidad de pasajeros:</label>
				<input type='text' name='pax_" .$cuenta. "' id='pax_" .$cuenta. "' value='".$pax."' />
				<label for='comentarios_" .$cuenta. "'>Comentarios:</label>
				<input type='text' name='comentarios_" .$cuenta. "' id='comentarios_" .$cuenta. "' value='".$comentarios."' />
				<label for='captcha_" .$cuenta. "'>Captcha</label>
				<input type='text' name='captcha_" .$cuenta. "' id='captcha_" .$cuenta. "' value='".$captcha."' />
				<label for='leyenda_" .$cuenta. "'>Leyenda Campos Obligatorios:</label>
				<input type='text' name='leyenda_" .$cuenta. "' id='leyenda_" .$cuenta. "' value='".$leyenda."' />
				<label for='enviar_" .$cuenta. "'>Botón ENVIAR:</label>
				<input type='text' name='enviar_" .$cuenta. "' id='enviar_" .$cuenta. "' value='".$enviar."' />
				<label for='texto_" .$cuenta. "'>Texto:</label>
				<textarea name='texto_" .$cuenta. "' id='texto_" .$cuenta. "' cols='80' rows='10'>".$texto."</textarea>
				<label for='exito_" .$cuenta. "'>Éxito:</label>
				<input type='text' name='exito_" .$cuenta. "' id='exito_" .$cuenta. "' value='".$exito."' />
				<label for='gracias_" .$cuenta. "'>Gracias:</label>
				<textarea name='gracias_" .$cuenta. "' id='gracias_" .$cuenta. "' cols='80' rows='10'>".$gracias."</textarea></div>
				";
			$id = "";
				$titulo = "";
				$nya = "";
				$fecha = "";
				$producto = "";
				$email = "";
				$telefono = "";
				$pax = "";
				$comentarios = "";
				$leyenda = "";
				$captcha = "";
				$boton = "";
				$exito = "";
				$gracias = "";
				$texto = "";
				$enviar = "";
			$cuenta=$cuenta+1;
		}
		echo " <br />
				<button type='submit'>Modificar</button>
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

