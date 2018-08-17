<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$id=$_GET["id"];
	$query= "select * from idiomas where id = '$id'";
			$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

		$castellano = $row['castellano'];
		$original = $row['original'];
		$abreviatura = $row['abreviatura'];
		$m1=$row['m1'];
		$m2=$row['m2'];
		$m3=$row['m3'];
		$m4=$row['m4'];
		$m5=$row['m5'];
		$m6=$row['m6'];
		$m7=$row['m7'];
		$m8=$row['m8'];
		$m9=$row['m9'];
		$m10=$row['m10'];
		$m11=$row['m11'];
		$m12=$row['m12'];
		$ma1=$row['ma1'];
		$ma2=$row['ma2'];
		$ma3=$row['ma3'];
		$ma4=$row['ma4'];
		$ma5=$row['ma5'];
		$ma6=$row['ma6'];
		$ma7=$row['ma7'];
		$ma8=$row['ma8'];
		$ma9=$row['ma9'];
		$ma10=$row['ma10'];
		$ma11=$row['ma11'];
		$ma12=$row['ma12'];
		$d1=$row['d1'];
		$d2=$row['d2'];
		$d3=$row['d3'];
		$d4=$row['d4'];
		$d5=$row['d5'];
		$d6=$row['d6'];
		$d7=$row['d7'];
		$da1=$row['da1'];
		$da2=$row['da2'];
		$da3=$row['da3'];
		$da4=$row['da4'];
		$da5=$row['da5'];
		$da6=$row['da6'];
		$da7=$row['da7'];
		$formato=$row['formato'];	
	}

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
			<h1>Editar Idioma</h1>
			<div id="formulario">
				<form id="form" method="post" action="idioma-mod.php">
					<fieldset>
					<input type="hidden" name="id" value="<? echo $id; ?>" />
					<label for="castellano">Nombre en Castellano:</label>
					<input type="text" name="castellano" id="castellano" value="<? echo $castellano; ?>" />
					<label for="original">Nombre Original:</label>
					<input type="text" name="original" id="original" value="<? echo $original; ?>" />
					<label for="abreviatura">Abreviatura:</label>
					<input type="text" name="abreviatura" id="abreviatura" value="<? echo $abreviatura; ?>" />


					<label for="m1">Enero:</label>
					<input type="text" name="m1" id="m1" value="<? echo $m1; ?>" />

					<label for="m2">Febrero:</label>
					<input type="text" name="m2" id="m2" value="<? echo $m2; ?>" />

					<label for="m3">Marzo:</label>
					<input type="text" name="m3" id="m3" value="<? echo $m3; ?>" />

					<label for="m4">Abril:</label>
					<input type="text" name="m4" id="m4" value="<? echo $m4; ?>" />

					<label for="m5">Mayo:</label>
					<input type="text" name="m5" id="m5" value="<? echo $m5; ?>" />

					<label for="m6">Junio:</label>
					<input type="text" name="m6" id="m6" value="<? echo $m6; ?>" />

					<label for="m7">Julio:</label>
					<input type="text" name="m7" id="m7" value="<? echo $m7; ?>" />

					<label for="m8">Agosto:</label>
					<input type="text" name="m8" id="m8" value="<? echo $m8; ?>" />

					<label for="m9">Septiembre:</label>
					<input type="text" name="m9" id="m9" value="<? echo $m9; ?>" />

					<label for="m10">Octubre:</label>
					<input type="text" name="m10" id="m10" value="<? echo $m10; ?>" />

					<label for="m11">Noviembre:</label>
					<input type="text" name="m11" id="m11" value="<? echo $m11; ?>" />

					<label for="m12">Diciembre:</label>
					<input type="text" name="m12" id="m12" value="<? echo $m12; ?>" />

					<label for="ma1">Ene:</label>
					<input type="text" name="ma1" id="ma1" value="<? echo $ma1; ?>" />

					<label for="ma2">Feb:</label>
					<input type="text" name="ma2" id="ma2" value="<? echo $ma2; ?>" />

					<label for="ma3">Mar:</label>
					<input type="text" name="ma3" id="ma3" value="<? echo $ma3; ?>" />

					<label for="ma4">Abr:</label>
					<input type="text" name="ma4" id="ma4" value="<? echo $ma4; ?>" />

					<label for="ma5">May:</label>
					<input type="text" name="ma5" id="ma5" value="<? echo $ma5; ?>" />

					<label for="ma6">Jun:</label>
					<input type="text" name="ma6" id="ma6" value="<? echo $ma6; ?>" />

					<label for="ma7">Jul:</label>
					<input type="text" name="ma7" id="ma7" value="<? echo $ma7; ?>" />

					<label for="ma8">Ago:</label>
					<input type="text" name="ma8" id="ma8" value="<? echo $ma8; ?>" />

					<label for="ma9">Sep:</label>
					<input type="text" name="ma9" id="ma9" value="<? echo $ma9; ?>" />

					<label for="ma10">Oct:</label>
					<input type="text" name="ma10" id="ma10" value="<? echo $ma10; ?>" />

					<label for="ma11">Nov:</label>
					<input type="text" name="ma11" id="ma11" value="<? echo $ma11; ?>" />

					<label for="ma12">Dic:</label>
					<input type="text" name="ma12" id="ma12" value="<? echo $ma12; ?>" />
					
					<label for="d1">Domingo:</label>
					<input type="text" name="d1" id="d1" value="<? echo $d1; ?>" />

					<label for="d2">Lunes:</label>
					<input type="text" name="d2" id="d2" value="<? echo $d2; ?>" />

					<label for="d3">Martes:</label>
					<input type="text" name="d3" id="d3" value="<? echo $d3; ?>" />

					<label for="d4">Miércoles:</label>
					<input type="text" name="d4" id="d4" value="<? echo $d4; ?>" />

					<label for="d5">Jueves:</label>
					<input type="text" name="d5" id="d5" value="<? echo $d5; ?>" />

					<label for="d6">Viernes:</label>
					<input type="text" name="d6" id="d6" value="<? echo $d6; ?>" />

					<label for="d7">Sábado:</label>
					<input type="text" name="d7" id="d7" value="<? echo $d7; ?>" />

					<label for="da1">Dom:</label>
					<input type="text" name="da1" id="da1" value="<? echo $da1; ?>" />

					<label for="da2">Lun:</label>
					<input type="text" name="da2" id="da2" value="<? echo $da2; ?>" />

					<label for="da3">Mar:</label>
					<input type="text" name="da3" id="da3" value="<? echo $da3; ?>" />

					<label for="da4">Mie:</label>
					<input type="text" name="da4" id="da4" value="<? echo $da4; ?>" />

					<label for="da5">Jue:</label>
					<input type="text" name="da5" id="da5" value="<? echo $da5; ?>" />

					<label for="da6">Vie:</label>
					<input type="text" name="da6" id="da6" value="<? echo $da6; ?>" />

					<label for="da7">Sab:</label>
					<input type="text" name="da7" id="da7" value="<? echo $da7; ?>" />

					<label for="formato">Formato:</label>
					<select name="formato">
						<option selected value="dddd dd, mmmm yyyy">Miércoles 21, Octubre 2011</option>
						<option value="dddd, mmmm dd, yyyy">Octubre, Miércoles 21, 2011</option>
						<option value="dd/mm/yyyy">21/10/2011</option>
						<option value="mm/dd/yyyy">10/21/2011</option>
						<option value="yyyy/mm/dd">2011/10/21</option>
					</select> 



					<button type="submit">Modificar</button>
					<div class="spacer"></div>
					</fieldset>
				</form>
			</div>
		</div>
	</body>
</html>

