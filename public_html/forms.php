<?
	include("conecta.php");
	$bdd_link=Conectarse();
	session_start();
	if (empty($_SESSION['idiomaid'])){
		$query= "select * from idiomas ORDER BY orden ASC limit 1";
	$sopa=mysqli_query($bdd_link,$query);
	while($row = mysqli_fetch_array($sopa)) {
			$_SESSION['idiomaid'] = $row['id'];
			$_SESSION['idiomanom'] = $row['original'];
			$_SESSION['idiomaabr'] = $row['abreviatura'];
		}
	}
	$idiomaid=$_SESSION['idiomaid'];

// Carga todos los datos de la base que son comunes a todas las páginas

	include("carga.php");



	$sx=$_GET["sx"];
	if ($sx != "c") {
		$bdd = "reservas";
	} else {
		$bdd = "contacto";
	}

	$query= "select * from " .$bdd. " WHERE idioma='$idiomaid'";
	$sopa=mysqli_query($bdd_link,$query);
	while($row = mysqli_fetch_array($sopa)) {
		$id = $row['id'];
		$titulo = $row['titulo'];
		$nya = $row['nya'];
		$fecha = $row['fecha'];
		$producto = $row['producto'];
		$femail = $row['email'];
		$telefono = $row['telefono'];
		$pax = $row['pax'];
		$comentarios = $row['comentarios'];
		$leyenda = $row['leyenda'];
		$texto = $row['texto'];
		$enviar = $row['enviar'];
		$_SESSION['exito'] = $row['exito'];
		$_SESSION['gracias'] = $row['gracias'];
		$captcha = $row['captcha'];
	}

// Carga el idioma de la fecha
	$query= "select * from idiomas WHERE id='$idiomaid'";
	$sopa=mysqli_query($bdd_link,$query);
	while($row = mysqli_fetch_array($sopa)) {
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
	$meses=$m1.",".$m2.",".$m3.",".$m4.",".$m5.",".$m6.",".$m7.",".$m8.",".$m9.",".$m10.",".$m11.",".$m12;
	$mesesabr=$ma1.",".$ma2.",".$ma3.",".$ma4.",".$ma5.",".$ma6.",".$ma7.",".$ma8.",".$ma9.",".$ma10.",".$ma11.",".$ma12;
	$dias=$d1.",".$d2.",".$d3.",".$d4.",".$d5.",".$d6.",".$d7;
	$diasabr=$da1.",".$da2.",".$da3.",".$da4.",".$da5.",".$da6.",".$da7;
	$idiomabrev=$_SESSION['idiomaabr'];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
<?
// Carga head común a todas las páginas
	include("head.php");
?>
    <link href="css/style.css" media="screen" rel="stylesheet" type="text/css"/>
    <link href="css/uniform.css" media="screen" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="scripts/jquery.tools.js"></script>
    <script type="text/javascript" src="scripts/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="scripts/main.js.php"></script>
	</head>
	
	<body>
	<div id="origenia">

<?
// Carga la sticky bar
	include("barra.php");
?>
		
		<!-- CONTENT -->
		<div class="cuerpo">
			<div id="encabezado">

<?
		include("MobileDetect.php");
		$MobileDetect = new MobileDetect();
		
		if($MobileDetect->IsMobile()){
			echo "<img src='imagenes/header.jpg' width='966' height='262' border='0' alt='Crucero de Solis'>";
		} else {
			echo "<a class='media {width:966, height:262}' href='flash/header.swf'></a>";
		}
?>

				 
			</div>
			<div id="contenido">
				<div id="barra_izq"></div>
					<div id="principal">		
<?
// Carga la botonera
//	include("botonera.php");
?>
						<div id="inside">
<?
// Carga la barra de banners de la izquierda
	include("bannerizq.php");
?>
							<div id="comun">
<? echo "<h1>".$titulo."</h1>"; ?>
		<div id="forma">











<div class="TTWForm-container">
     
     
     <form style="width: 480px;" action="process_form.php" class="TTWForm" method="post" novalidate="">
		<input type="hidden" name="tipo" value="<? echo $bdd; ?>" />
          
          
          <div id="field1-container" class="field f_100">
               <label for="field1">
                    <? echo $nya; ?>
               </label>
               <input name="nombre" id="field1" required="required" type="text">
          </div>
          
          
          <div id="field2-container" class="field f_100">
               <label for="field2">
                    <? echo $fecha; ?>
               </label>
               <input class="ttw-date date" name="fecha" id="field2" required="required"
               type="date">
<script>
$.tools.dateinput.localize("<? echo $idiomabrev; ?>",  {
   months:        '<? echo $meses; ?>',
   shortMonths:   '<? echo $mesesabr; ?>',
   days:          '<? echo $dias; ?>',
   shortDays:     '<? echo $diasabr; ?>'
});


$(":date").dateinput({ 
	lang: '<? echo $idiomabrev; ?>', 
	format: '<? echo $formato; ?>',
	offset: [30, 0]
});

</script>
          </div>
          
          
          <div id="field3-container" class="field f_100 checkbox-group required">
               <label for="field3-1">
                    <? echo $producto; ?>
               </label>
  
<?
		$query= "select * from grupos WHERE estado='activo' ORDER BY orden ASC";
	$sopa=mysqli_query($bdd_link,$query);
		$XXnroreg=1;
	while($row = mysqli_fetch_array($sopa)) {
			$id = $row['id'];
			$grupos["$XXnroreg"]["id"]=$id;
			$XXnroreg++;
		}
		$regact=1;
		while ($regact < $XXnroreg) {
			$gid = $grupos["$regact"]["id"];
			echo "
               <div class='option clearfix'>
                    <input name='productos[]' id='productos-".$gid."' value='" .$secciones["$gid"]["titulo"]. "' type='checkbox'>
                    <span class='option-title'>
                         " .$secciones["$gid"]["titulo"]. "
                    </span>
                    <br>
               </div>
			";
			$regact++;
		}



?>             
               

          </div>
          
          
          <div id="field4-container" class="field f_100">
               <label for="field4">
                    <? echo $femail; ?>
               </label>
               <input name="email" id="field4" required="required" type="email">
          </div>
          
          
          <div id="field6-container" class="field f_100">
               <label for="field6">
                    <? echo $telefono; ?>
               </label>
               <input name="telefono" id="field6" type="text">
          </div>
          
          
          <div id="field8-container" class="field f_100">
               <label for="field8">
                    <? echo $pax; ?>
               </label>
               <input max="100" min="1" class="ttw-range range" name="pasajeros" id="field8"
               required="required" type="range">
          </div>
          
          
          <div id="field5-container" class="field f_100">
               <label for="field5">
                    <? echo $comentarios; ?>
               </label>
               <textarea rows="5" cols="20" name="comentarios" id="field5"></textarea>
          </div>
          
          
          <div id="field9-container" class="field f_100">
               <label for="field9">
                    <? echo $captcha; ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="captcha.php" alt="C&oacute;digo de seguridad"/>
               </label>
               <input name="captcha" id="field9" required="required" type="text">
          </div>
          
          
          <div id="form-submit" class="field f_100 clearfix submit">
               <input value="<? echo $enviar; ?>" type="submit">
          </div>
     </form>

</div>






</div>


<div id="txt_con">
<? echo $texto; ?>
</div>






	
<!-- Fin del listado de productos //-->


							</div>
							</div>






					</div>
				<div id="barra_der"></div>
			</div>
		</div>
		<div class="limpiar"></div>
<?
// Carga el pie de página
	include("pie.php");
?>
		
</div>		
		
		

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-5367643-1");
pageTracker._trackPageview();
</script>
		
		
		
		
	</body>
</html>