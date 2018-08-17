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
		<link rel="stylesheet" type="text/css" href="css/jquery.msgbox.css" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.msgbox.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
		<script type="text/javascript">
		  // When the document is ready set up our sortable with it's inherant function(s)
		  $(document).ready(function() {
			$("#video-list").sortable({
			  handle : '.handle',
			  update : function () {
				  var order = $('#video-list').sortable('serialize');
				$("#info").load("ordenvideo.php?"+order);
			  }
			});
		});
		</script>
	</head>
	<body>
		<div id="cuerpo">
			<a href="index.php" class="volver">Volver</a>
			<a href="videos-conf.php" class="configurar">Configurar</a>
			<div class="limpiar"></div>
			<h1>Sección: Videos</h1>
			<div id="fotos">
					<form action="video-add.php" method="post">
						<fieldset>
							<label for="urlvideo">Código del Video en YouTube:</label>
							<input type="text" name="urlvideo" id="urlvideo"/>
							<button type='submit'>Aceptar</button>
						</fieldset>
					</form>

				<div id="galeria">
<pre>
<div id="info"></div>
</pre>

					<ul id="video-list">
<?
	$sopa=mysql_query("select * from youtube",$bdd_link);
	$filasDevueltas = mysql_num_rows($sopa);
	if ($filasDevueltas!=0){
		$query= "select * from youtube ORDER BY orden ASC";
		$sopa=mysqli_query($bdd_link,$query);
		$xx=0;
		while($row = mysqli_fetch_array($sopa)) {
			$id = $row['id'];
			$codigo = $row['codigo'];
  			echo "<li id='listItem_" .$id. "'><img src='http://img.youtube.com/vi/" .$codigo. "/default.jpg' alt='move' class='handle' /><a href='borrar_video.php?id=$id' title='Borrar Video' class='icon-9'></a></li>\n";
			$xx++;
		}
	} else {
		echo "<div class='error'>No hay videos disponibles</div>";
	}


?>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>

