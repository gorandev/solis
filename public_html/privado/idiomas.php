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
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery.msgbox.css" />
		<script type="text/javascript" src="js/jquery.msgbox.min.js"></script>
	</head>
	<body>
		<div id="cuerpo">
			<a href="index.php" class="volver">Volver</a>
			<div class="limpiar"></div>
			<h1>Idiomas Disponibles</h1>
			<div id="listado">
				<table>
					<thead>
						<tr>
							<th class='subebaja'>Orden</th>
							<th> </th>
							<th>Idioma</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="4"><a href="idioma-nuevo.php">Agregar Idioma</a></td>
						</tr>
					</tfoot>
					<tbody>

<?
	$sopa=mysqli_query($bdd_link,"select * from idiomas");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		$query= "select * from idiomas ORDER BY orden ASC";
	$sopa=mysqli_query($bdd_link,$query);
		$nroreg=1;
	while($row = mysqli_fetch_array($sopa)) {
			$id = $row['id'];
			$castellano = $row['castellano'];
			$orden = $row['orden'];
			$estado = $row['estado'];
			echo "<tr><td class='subebaja'>";
			if ($nroreg!=$filasDevueltas){
				echo "<a href='mover.php?accion=subir&amp;orden=$orden&amp;tipo=idiomas' title='bajar posición'><img src='css/dn.gif' alt='bajar posición' /></a> ";
			}
			if ($nroreg!=1){
				echo "<a href='mover.php?accion=bajar&amp;orden=$orden&amp;tipo=idiomas' title='subir posición'><img src='css/up.gif' alt='subir posición' /></a>";
			}
			echo "</td><td class='stat'>";
			if ($estado!="activo"){
				echo "<a href='statid.php?id=$id&amp;st=i' title='Idioma Inactivo'><img src='css/inactivo.jpg' alt='Idioma Inactivo' /></a>";
			} else {
				echo "<a href='statid.php?id=$id&amp;st=a' title='Idioma Activo'><img src='css/activo.jpg' alt='Idioma Activo' /></a>";
			}
			echo "</td>
				<td class='bandancha'>$castellano</td>
				<td><a href='idioma-editar.php?id=$id' title='Editar idioma' class='icon-1'></a><a href='idioma-borrar.php?id=$id' title='Borrar idioma' class='icon-2' onclick='var mylink = this; $.msgbox(\"<b>ATENCIÓN:</b> Al eliminar este idioma, también se borrarán todos los datos asociados al mismo sin posibilidad de recuperarlos.<br /><br />¿Desea eliminar este idioma?\",{buttons : [ {type: \"submit\", value:\"Si, Confirmo la eliminación\"},  {type: \"cancel\", value:\"NO\"} ] }, function(result) { if (result==\"Si, Confirmo la eliminación\") { { window.location = mylink.href;  } } });return false;'></a></td>
			</tr>";
			$nroreg=$nroreg + 1;
		}
	} else {
		echo "<tr><td colspan='4'>No hay idiomas cargados</td></tr>";
	}

?>
					</tbody>
				</table> 					
			</div>
		</div>
	</body>
</html>

