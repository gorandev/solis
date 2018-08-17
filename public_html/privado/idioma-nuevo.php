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
			<a href="idiomas.php" class="volver">Volver</a>
			<div class="limpiar"></div>
			<h1>Nuevo Idioma</h1>
			<div id="formulario">
				<form id="form" method="post" action="idioma-mas.php" enctype="multipart/form-data">
					<fieldset>
					<label for="castellano">Nombre en Castellano:</label>
					<input type="text" name="castellano" id="castellano" />
					<label for="original">Nombre Original:</label>
					<input type="text" name="original" id="original" />
					<label for="abreviatura">Abreviatura:</label>
					<input type="text" name="abreviatura" id="abreviatura" />

					<label for="enero">Enero:</label>
					<input type="text" name="enero" id="enero" />

					<label for="febrero">Febrero:</label>
					<input type="text" name="febrero" id="febrero" />

					<label for="marzo">Marzo:</label>
					<input type="text" name="marzo" id="marzo" />

					<label for="abril">Abril:</label>
					<input type="text" name="abril" id="abril" />

					<label for="mayo">Mayo:</label>
					<input type="text" name="mayo" id="mayo" />

					<label for="junio">Junio:</label>
					<input type="text" name="junio" id="junio" />

					<label for="julio">Julio:</label>
					<input type="text" name="julio" id="julio" />

					<label for="agosto">Agosto:</label>
					<input type="text" name="agosto" id="agosto" />

					<label for="septiembre">Septiembre:</label>
					<input type="text" name="septiembre" id="septiembre" />

					<label for="octubre">Octubre:</label>
					<input type="text" name="octubre" id="octubre" />

					<label for="noviembre">Noviembre:</label>
					<input type="text" name="noviembre" id="noviembre" />

					<label for="diciembre">Diciembre:</label>
					<input type="text" name="diciembre" id="diciembre" />

					<label for="ene">Ene:</label>
					<input type="text" name="ene" id="ene" />

					<label for="feb">Feb:</label>
					<input type="text" name="feb" id="feb" />

					<label for="mar">Mar:</label>
					<input type="text" name="mar" id="mar" />

					<label for="abr">Abr:</label>
					<input type="text" name="abr" id="abr" />

					<label for="may">May:</label>
					<input type="text" name="may" id="may" />

					<label for="jun">Jun:</label>
					<input type="text" name="jun" id="jun" />

					<label for="jul">Jul:</label>
					<input type="text" name="jul" id="jul" />

					<label for="ago">Ago:</label>
					<input type="text" name="ago" id="ago" />

					<label for="sep">Sep:</label>
					<input type="text" name="sep" id="sep" />

					<label for="oct">Oct:</label>
					<input type="text" name="oct" id="oct" />

					<label for="nov">Nov:</label>
					<input type="text" name="nov" id="nov" />

					<label for="dic">Dic:</label>
					<input type="text" name="dic" id="dic" />

					<label for="domingo">Domingo:</label>
					<input type="text" name="domingo" id="domingo" />

					<label for="lunes">Lunes:</label>
					<input type="text" name="lunes" id="lunes" />

					<label for="martes">Martes:</label>
					<input type="text" name="martes" id="martes" />

					<label for="miercoles">Miércoles:</label>
					<input type="text" name="miercoles" id="miercoles" />

					<label for="jueves">Jueves:</label>
					<input type="text" name="jueves" id="jueves" />

					<label for="viernes">Viernes:</label>
					<input type="text" name="viernes" id="viernes" />

					<label for="sabado">Sábado:</label>
					<input type="text" name="sabado" id="sabado" />

					<label for="domingo">Domingo:</label>
					<input type="text" name="domingo" id="domingo" />

					<label for="lun">Lun:</label>
					<input type="text" name="lun" id="lun" />

					<label for="mar">Mar:</label>
					<input type="text" name="mar" id="mar" />

					<label for="mie">Mie:</label>
					<input type="text" name="mie" id="mie" />

					<label for="jue">Jue:</label>
					<input type="text" name="jue" id="jue" />

					<label for="vie">Vie:</label>
					<input type="text" name="vie" id="vie" />

					<label for="sab">Sab:</label>
					<input type="text" name="sab" id="sab" />

					<label for="formato">Formato:</label>
					<select name="formato">
						<option selected value="dddd dd, mmmm yyyy">Miércoles 21, Octubre 2011</option>
						<option value="dddd, mmmm dd, yyyy">Octubre, Miércoles 21, 2011</option>
						<option value="dd/mm/yyyy">21/10/2011</option>
						<option value="mm/dd/yyyy">10/21/2011</option>
						<option value="yyyy/mm/dd">2011/10/21</option>
					</select> 

					<button type="submit">Agregar</button>
					<div class="spacer"></div>
					</fieldset>
				</form>
			</div>
		</div>
	</body>
</html>

