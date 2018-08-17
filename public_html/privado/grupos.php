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
<?
	if (!empty($_SESSION['grupofull'])){
		$grupo=$_SESSION['grupofull'];
		unset($_SESSION['grupofull']);
		echo "
			<script>
				jQuery(document).ready(function($) {
				
					$.msgbox('<b>Error:</b> El grupo <b>$grupo</b> está siendo utilizado en este momento.<br><br><hr><br>Asegúrese que ningún paquete o producto esté relacionado con este grupo antes de borrarla.', {
					  type : 'error',
					  buttons : [
						{type: 'submit', value:'Aceptar'}
					  ]
					});
					
								
				  ev.preventDefault();
				
				});
			</script>";
	}
?>
	</head>
	<body>
		<div id="cuerpo">
			<a href="index.php" class="volver">Volver</a>
			<a href="grupo-conf.php" class="configurar">Configurar</a>
			<div class="limpiar"></div>
			<h1>Sección: Grupos de Productos</h1>
			<div id="listado">
				<table>
					<thead>
						<tr>
							<th class='subebaja'>Orden</th>
							<th> </th>
							<th>Título</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="4"><a href="grupo-nuevo.php">Agregar Grupo</a></td>
						</tr>
					</tfoot>
					<tbody>

<?
	$sopa=mysqli_query($bdd_link,"select * from grupos");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		$query= "select * from grupos ORDER BY orden ASC";
		$sopa=mysqli_query($bdd_link,$query);
		$nroreg=1;
		while($row = mysqli_fetch_array($sopa)) {
			$id = $row['id'];
			$nombre = $row['nombre'];
			$orden = $row['orden'];
			$estado = $row['estado'];
			echo "<tr><td class='subebaja'>";
			if ($nroreg!=$filasDevueltas){
				echo "<a href='mover.php?accion=subir&amp;orden=$orden&amp;tipo=grupos&amp;sx=$sx' title='bajar posición'><img src='css/dn.gif' alt='bajar posición' /></a> ";
			}
			if ($nroreg!=1){
				echo "<a href='mover.php?accion=bajar&amp;orden=$orden&amp;tipo=grupos&amp;sx=$sx' title='subir posición'><img src='css/up.gif' alt='subir posición' /></a>";
			}
			echo "</td><td class='stat'>";
			if ($estado!="activo"){
				echo "<a href='estado_gr.php?id=$id&amp;st=i' title='Grupo Inactivo'><img src='css/inactivo.jpg' alt='Grupo Inactivo' /></a>";
			} else {
				echo "<a href='estado_gr.php?id=$id&amp;st=a' title='Grupo Activo'><img src='css/activo.jpg' alt='Grupo Activo' /></a>";
			}
			echo "</td>
				<td class='bandancha'><a href='seccion.php?sx=$id' title='Administrar productos de $nombre.'>$nombre</a></td>
				<td><a href='grupo-borrar.php?grupo=$id' title='Borrar Grupo' class='icon-2' onclick='var mylink = this; $.msgbox(\"<b>ATENCIÓN:</b><br />¿Desea eliminar este grupo?\",{buttons : [ {type: \"submit\", value:\"Si, Confirmo la eliminación\"},  {type: \"cancel\", value:\"NO\"} ] }, function(result) { if (result==\"Si, Confirmo la eliminación\") { { window.location = mylink.href;  } } });return false;'></a></td>
			</tr>";
			$nroreg=$nroreg + 1;
		}
	} else {
		echo "<tr><td colspan='4'>No hay grupos cargados</td></tr>";
	}

?>
					</tbody>
				</table> 					
			</div>
		</div>
	</body>
</html>

