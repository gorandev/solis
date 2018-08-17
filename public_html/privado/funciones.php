<?

// FUNCIONES PHP

/* Determina si la variable xz es un grupo de productos o un sector estático */
//	

	Function esonoes($xz){
			session_start();

//		include("../conecta.php");
		$bdd_link=Conectarse();
		$a = array(1,2,11,12,13,14,16);
		if (in_array($xz, $a)) {
			$_SESSION['back']="index";
			switch ($xz) {
				case 1:
					$devolver="Quienes Somos";
					break;
				case 2:
					$devolver="Embarcaciones";
					break;
				case 11:
					$devolver="Fotos";
					break;
				case 12:
					$devolver="Paradores";
					break;
				case 13:
					$devolver="Carta Virtual";
					break;
				case 14:
					$devolver="Regalos a Bordo";
					break;
				case 16:
					$devolver="Promociones";
					break;
			}
		} else {
			$query= "select * from grupos WHERE id='$xz'";
					$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

				$devolver = $row['nombre'];
			}
			$_SESSION['back']="grupos";
		}
		Return $devolver;
	}




function noCache() {
  header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
}

	function convierte_a_link($str) {
		$str = trim($str);
		$str = strtolower($str);
		$banchars = array ("?", "!", "¿", "¡", "'", ",", ";", "--", ")", "(","\n","\r", "%", "&", " ", "á", "é", "í", "ó", "ú" );
		$reemplazo= array ("", "", "", "", "-","-","-","-","-","-","-","-","-","-","-","a","e","i","o","u");
		if ( eregi ( "[a-zA-Z0-9]+", $str ) ) {
				$str = str_replace( $banchars, $reemplazo, ( $str ) );
		} else {
				$str = NULL;
		}
		$str = trim($str);
		$str = strip_tags($str);
		$str = stripslashes($str);
		$str = addslashes($str);
		$str = htmlspecialchars($str);
		return $str;
	}
