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
	</head>
	<body onload="document.getElementById('castellano').focus();">
		<div id="cuerpo">
			<a href="index.php" class="volver">Volver</a>
			<div class="limpiar"></div>
			<h1>Botones Sociales</h1>
			<div id="formulario">
<?
		echo "
		<form id='form' method='post' action='social-mng.php'>
			<fieldset>
		";

			$query= "select * from social WHERE id='1'";
						$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

					$id = $row['id'];
					$facebook = $row['facebook'];
					$twitter = $row['twitter'];
					$youtube = $row['youtube'];
					$flickr = $row['flickr'];
					$email = $row['email'];
				}
			echo "
				<h6>Escriba la dirección de cada red</h6>
				<label for='facebook'>Facebook:</label>
				<input type='text' name='facebook' id='facebook' value='" .$facebook. "' />
				<label for='twitter'>Twitter:</label>
				<input type='text' name='twitter' id='twitter' value='" .$twitter. "' />
				<label for='youtube'>YouTube:</label>
				<input type='text' name='youtube' id='youtube' value='" .$youtube. "' />
				<label for='flickr'>Flickr:</label>
				<input type='text' name='flickr' id='flickr' value='" .$flickr. "' />
				<label for='email'>Email:</label>
				<input type='text' name='email' id='email' value='" .$email. "' />
			";
		echo " <br />
				<button type='submit'>Aceptar</button>
				<div class='spacer'></div>
				</fieldset>
			</form>
		";
		

?>

			</div>
		</div>
	</body>
</html>

