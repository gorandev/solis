<?
	session_start();
	if (!empty($_SESSION['usuario'])){
		$mostrarindex="ok";
	} else {
		if (!empty($_POST['username'])){
			include("../conecta.php");
			$bdd_link=Conectarse();
			$usuario=$_POST['username'];
			$clave=$_POST['password'];
			$sopa=mysqli_query($bdd_link,"select * from cnf WHERE usuario='$usuario' AND clave='$clave'");
			$filasDevueltas = mysqli_num_rows($sopa);
			if ($filasDevueltas!=0){
				$_SESSION['usuario']=$usuario;
				$mostrarindex="ok";
			} else {
				header("Location: index.php");
				exit;
			}
		}
	}
			
	
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>Administrador</title>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.msgbox.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery.msgbox.css" />
<?
	if ($mostrarindex != "ok"){
		echo "
		<script>
		jQuery(document).ready(function($) {
		
		  $.msgbox(\"<p><b>Sistema de Gestión de Contenidos</b></p><p>Sitio: <i>Crucero de Solís</i></p>\", {
			type    : \"prompt\",
			name    : \"lock\",
			inputs  : [
			  {type: \"text\",     name: \"username\", value: \"\", label: \"Usuario:\", required: true},
			  {type: \"password\", name: \"password\", value: \"\", label: \"Clave:\", required: true}
			],
			buttons : [
			  {type: \"submit\", name: \"submit\", value: \"Ingresar\"},
			  {type: \"cancel\", value: \"Cancelar\"}
			],
			form : {
			  active: true,
			  method: 'post',
			  action: 'index.php'
			}
		  });
		
		  ev.preventDefault();
		
		});
		</script>";
	} else {
		echo "<link rel='stylesheet' href='css/estilo.css' type='text/css' media='screen' title='default' />
		";
	}
?>
	</head>
	<body>
<?
	if ($mostrarindex != "ok"){
		echo "";
	} else {
		echo "
		<div id='cuerpo-home'>
			<h1>Administración del sitio Crucero de Solis</h1>
			<div id='listado'>
				<ul>
					<li class='titulo'>Menú Principal</li>
					<li><a href='grupos.php' title='Grupos de Productos'>Grupos de Productos</a></li>
					<li><a href='seccion.php?sx=1' title='Quienes Somos'>Quienes Somos</a></li>
					<li><a href='seccion.php?sx=2' title='Embarcaciones'>Embarcaciones</a></li>
					<li><a href='contacto.php' title='Contacto'>Contacto</a></li>
					<li><a href='reservas.php' title='Reservas'>Reservas</a></li>
					<li class='titulo'>Otros</li>
					<li><a href='seccion.php?sx=12' title='Paradores'>Paradores</a></li>
					<li><a href='seccion.php?sx=13' title='Carta Virtual'>Carta Virtual</a></li>
					<li><a href='seccion.php?sx=14' title='Regalos a Bordo'>Regalos a Bordo</a></li>
					<li><a href='youtube.php' title='Fotos y Videos'>Fotos y Videos</a></li>
					<li><a href='seccion.php?sx=16' title='Promociones'>Promociones</a></li>
					<li><a href='lluvia.php' title='Seguro de Lluvia'>Seguro de Lluvia</a></li>
					<li class='titulo'>Configuración</li>
					<li><a href='idiomas.php' title='Idiomas'>Idiomas</a></li>
					<li><a href='clima.php' title='Clima'>Clima</a></li>
					<li><a href='tags.php' title='Meta Tags'>Meta Tags</a></li>
					<li><a href='botones.php' title='Botones'>Botones</a></li>
					<li><a href='social.php' title='Botones Sociales'>Botones Sociales</a></li>
					<li><a href='#' title='Acceso' onclick=\"
		  $.msgbox('<p><b>Sistema de Gestión de Contenidos</b></p><p>Sitio: <i>Crucero de Solís</i></p><p><b>Modificación de Datos</b></p>', {
			type    : 'prompt',
			name    : 'lock',
			inputs  : [
			  {type: 'text',     name: 'user', value: '', label: 'Nuevo Usuario:', required: true},
			  {type: 'password', name: 'pass', value: '', label: 'Nueva Clave:', required: true}
			],
			buttons : [
			  {type: 'submit', name: 'submit', value: 'Confirmar el cambio'},
			  {type: 'cancel', value: 'Cancelar'}
			],
			form : {
			  active: true,
			  method: 'post',
			  action: 'acceso.php'
			}
		  });
		
		  ev.preventDefault();
	\">Acceso</a></li>
					<li><a href='salir.php' title='Salir'>Cerrar Sesión</a></li>
				</ul>
			</div>
		</div>";
?>


<?
	}
?>
	</body>
</html>

