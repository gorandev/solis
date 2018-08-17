<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();
	$sx=$_GET["sx"];
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
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery.msgbox.css" />
		<script type="text/javascript" src="js/jquery.msgbox.min.js"></script>
	</head>
	<body>
		<div id="cuerpo">
			<a href="index.php" class="volver">Volver</a>
			<a href="sector-conf.php?sx=<? echo $sx; ?>" class="configurar">Configurar</a>
			<div class="limpiar"></div>
			<h1>Sector: <? echo $seccion; ?></h1>
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
							<td colspan="4"><a href="producto-nuevo.php?sx=<? echo $sx; ?>">Agregar Producto</a></td>
						</tr>
					</tfoot>
					<tbody>

<?
		$sopa=mysqli_query($bdd_link,"select * from contenido WHERE sx='$sx'");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		$query= "select * from contenido WHERE sx='$sx' ORDER BY orden ASC";
		$sopa=mysqli_query($bdd_link,$query);
		$nroreg=1;
		while($row = mysqli_fetch_array($sopa)) {
			$id = $row['id'];
			$nombre = $row['nombre'];
			$orden = $row['orden'];
			$estado = $row['estado'];
			echo "<tr><td class='subebaja'>";
			if ($nroreg!=$filasDevueltas){
				echo "<a href='mover.php?accion=subir&amp;orden=$orden&amp;tipo=productos&amp;sx=$sx' title='bajar posición'><img src='css/dn.gif' alt='bajar posición' /></a> ";
			}
			if ($nroreg!=1){
				echo "<a href='mover.php?accion=bajar&amp;orden=$orden&amp;tipo=productos&amp;sx=$sx' title='subir posición'><img src='css/up.gif' alt='subir posición' /></a>";
			}
			echo "</td><td class='stat'>";
			if ($estado!="activo"){
				echo "<a href='estado.php?id=$id&amp;sx=$sx&amp;st=i' title='Producto Inactivo'><img src='css/inactivo.jpg' alt='Producto Inactivo' /></a>";
			} else {
				echo "<a href='estado.php?id=$id&amp;sx=$sx&amp;st=a' title='Producto Activo'><img src='css/activo.jpg' alt='Producto Activo' /></a>";
			}
			echo "</td>
				<td class='bandancha'>$nombre</td>
				<td><a href='galeria.php?producto=$id&amp;sx=$sx&amp;nombre=$nombre' title='Galería de imágenes' class='icon-4'></a><a href='producto-editar.php?sx=$sx&amp;id=$id' title='Editar Producto' class='icon-1'></a><a href='producto-borrar.php?producto=$id&amp;sx=$sx' title='Borrar Producto' class='icon-2' onclick='var mylink = this; $.msgbox(\"<b>ATENCIÓN:</b><br />¿Desea eliminar este producto?\",{buttons : [ {type: \"submit\", value:\"Si, Confirmo la eliminación\"},  {type: \"cancel\", value:\"NO\"} ] }, function(result) { if (result==\"Si, Confirmo la eliminación\") { { window.location = mylink.href;  } } });return false;'></a></td>
			</tr>";
			$nroreg=$nroreg + 1;
		}
	} else {
		echo "<tr><td colspan='4'>No hay productos cargados</td></tr>";
	}

?>
					</tbody>
				</table> 					
			</div>
		</div>
	</body>
</html>

