<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$sx=$_GET["sx"];
	$producto=$_GET["producto"];
	$nombre=$_GET["nombre"];
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
		<link rel="stylesheet" type="text/css" href="css/jquery.msgbox.css" />
<!--		<link rel='stylesheet' href='css/styles.css' type='text/css' media='all' />   //-->
		<link type="text/css" rel="stylesheet" href="arriba/uploadify.css"  />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.msgbox.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
<!--	<script type="text/javascript" src="arriba/jquery-1.3.2.min.js"></script>  //-->
		<script type="text/javascript" src="arriba/jquery.uploadify.js"></script>
		<script type="text/javascript">
		  // When the document is ready set up our sortable with it's inherant function(s)
		  $(document).ready(function() {
			$("#test-list").sortable({
			  handle : '.handle',
			  update : function () {
				  var order = $('#test-list').sortable('serialize');
				$("#info").load("ordenador.php?producto=<? echo $producto; ?>&"+order);
			  }
			});
		});
		</script>
		<script type="text/javascript">
		$(document).ready(function() {
			$("#fileUpload").fileUpload({
					'uploader': 'arriba/uploader.swf',
					'cancelImg': 'arriba/cancel.png',
					'folder': '/pics/grandes/',
					'buttonText': 'Seleccionar',
					'checkScript': 'arriba/check.php',
					'script': 'arriba/upload.php',
					'scriptData' : {'producto' : '<? echo $producto; ?>'},
					'multi': true,
					'onAllComplete': function() {
						location.reload()
					},
					'simUploadLimit': 2
				});
		
		});
		
		</script>
		
		
		
	</head>
	<body>
		<div id="cuerpo">
			<a href="seccion.php?sx=<? echo $sx; ?>" class="volver">Volver</a>
			<div class="limpiar"></div>
			<h1>Sección: <? echo $seccion; ?> [Galería - <? echo $nombre; ?>]</h1>
			<div id="fotos">
				<div id="subidor">
					<input name="fileUpload" id="fileUpload" type="file" />
					<a href="javascript:$('#fileUpload').fileUploadStart()">Subir</a> | <a href="javascript:$('#fileUpload').fileUploadClearQueue()">Limpiar</a>
				</div>
				<div id="galeria">
<pre>
<div id="info"></div>
</pre>

					<ul id="test-list">
<?
	$sopa=mysqli_query($bdd_link,"select * from fotos WHERE producto='$producto'");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		$query= "select * from fotos WHERE producto='$producto' ORDER BY orden ASC";
		$sopa=mysqli_query($bdd_link,$query);
		$xx=0;
		while($row = mysqli_fetch_array($sopa)) {
			$id = $row['id'];
  			echo "<li id='listItem_" .$id. "'><img src='/pics/chicas/" .$id. ".jpg' alt='move' class='handle' /><a href='galeria-borrar.php?sx=$sx&amp;id=$id&amp;producto=$producto&amp;nombre=$nombre' title='Borrar Foto' class='icon-9'></a></li>\n";
			$xx++;
		}
	} else {
		echo "<div class='error'>No hay fotos disponibles</div>";
	}


?>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>

