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
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
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
			<h1>Seguro de Lluvia</h1>
			<div id="formulario">
<?
// Búsqueda de los idiomas existentes
	$sopa=mysqli_query($bdd_link,"select * from idiomas");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		echo "
		<form id='form' method='post' action='lluvia-mng.php'>
			<fieldset>
		";
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
			$sopa=mysqli_query($bdd_link,"select * from lluvia WHERE idioma='$idiomaid'");
			$filasDevueltas = mysqli_num_rows($sopa);
			if ($filasDevueltas!=0){
				$query= "select * from lluvia WHERE idioma='$idiomaid'";
						$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

					$id = $row['id'];
					$titulo = $row['titulo'];
					$txthome = $row['txthome'];
				}
			}
			echo "
				<h6><a href='#' id='ht" .$cuenta. "'>$nombreidioma</a></h6>
				<div id='caja" .$cuenta. "' class='caja'><input type='hidden' name='id_" .$cuenta. "' value='" .$id. "' />
				<input type='hidden' name='idioma_" .$cuenta. "' value='" .$idiomaid. "' />
				<label for='titulo_" .$cuenta. "'>Título:</label>
				<input type='text' name='titulo_" .$cuenta. "' id='titulo_" .$cuenta. "' value='" .$titulo. "' />
				<label for='txthome_" .$cuenta. "'>Texto Home:</label>
				<input type='text' name='txthome_" .$cuenta. "' id='txthome_" .$cuenta. "' value='" .$txthome. "' /></div>";
			$id = "";
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

