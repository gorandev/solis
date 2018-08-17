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
			<a href="grupos.php" class="volver">Volver</a>
			<div class="limpiar"></div>
			<h1>[Nuevo Grupo]</h1>
			<div id="formulario">
<?
		echo "
		<form id='form' method='post' action='grupo-add.php'>
			<fieldset>
			<label for='nombre'>Nombre interno del grupo:</label>
			<input type='text' name='nombre' id='nombre' /> <br />
				<button type='submit'>Agregar</button>
				<div class='spacer'></div>
				</fieldset>
			</form>
		";
		

?>

			</div>
		</div>
	</body>
</html>

