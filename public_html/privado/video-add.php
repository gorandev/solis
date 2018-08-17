<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();

	$urlvideo=$_POST['urlvideo'];
	if (empty($urlvideo)){
		header("Location: youtube.php");
		exit;
	}
	$codigo= substr($urlvideo, 16);
$sopa=mysqli_query($bdd_link,"select * from youtube");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		$query= "select * from youtube ORDER BY orden DESC LIMIT 1";
				$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

			$orden = $row['orden'] + 1;
		}
	} else {
		$orden=1;
	}
	$query="insert into youtube (orden,codigo) values ('$orden','$codigo')";
	$result=mysqli_query($bdd_link,$query);

	header("Location: youtube.php");
	exit;
?>