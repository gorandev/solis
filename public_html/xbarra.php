		<div id="header" class="black">
			<ul id="menu">
				<li class="icon"><a href="index.php" class="tooltip" ><img src="css/images/home2.png" alt="Home" /><span>Home</span></a></li>
				<li><a class="drop" href="#">Servicios</a> <!-- EXAMPLE LINKS -->
					<div class="column3container dropcontent">
						<div class="column3">
							<ul class="bluebox">
								<li><a href="#">Día de Crucero</a></li>
								<li><a href="#">Salidas Románticas</a></li>
								<li><a href="#">Eventos Corporativos</a></li>
								<li><a href="#">Fiestas Sociales</a></li>
								<li><a href="#">Noche de Bodas</a></li>
								<li><a href="#">Safari por la Reserva de la Biósfera</a></li>
							</ul>
						</div>
					</div>
				</li>
				<li><a href="quienes_somos.php"><? echo $secciones["1"]["boton"]; ?></a></li>
				<li><a href="embarcaciones.php"><? echo $secciones["2"]["boton"]; ?></a></li>
				<li><a href="contacto.php"><? echo $contacto; ?></a></li>
				<li><a href="reservas.php"><? echo $reservas; ?></a></li>
<?
	if ($cantidiomas != 0){
		echo "	<li class='right'><a class='drop' href='#'>".$_SESSION['idiomanom']."</a>
					<ul class='dropdown'>";
	}

	$nro=0;
	while($nro <= $cantidiomas) {
		$nro++;
		echo "<li><a href='idioma.php?id=".$idiomas["$nro"]["id"]."&amp;ref=".$_SERVER["PHP_SELF"]."'>".$idiomas["$nro"]["nombre"]."</a></li>";
	}

	if ($cantidiomas != 0){
		echo "
					</ul>
				</li>";
	}
?>
				<li class="right separator"></li>
				<li class="right icon"><a class="tooltip" href="<? echo $email; ?>"><img src="css/images/email.png" alt="Email" /><span>Email</span></a></li>
				<li class="right icon"><a class="tooltip" href="<? echo $flickr; ?>"><img src="css/images/flickr.png" alt="Flickr" /><span>Flickr</span></a></li>
				<li class="right icon"><a class="tooltip" href="<? echo $youtube; ?>"><img src="css/images/youtube.png" alt="YouTube" /><span>YouTube</span></a></li>
				<li class="right icon"><a class="tooltip" href="<? echo $twitter; ?>"><img src="css/images/twitter.png" alt="Twitter" /><span>Twitter</span></a></li>
				<li class="right icon"><a class="tooltip" href="<? echo $facebook; ?>"><img src="css/images/facebook.png" alt="Facebook" /><span>Facebook</span></a></li>
			</ul>
		</div>