<?
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
	include("../conecta.php");
	$bdd_link=Conectarse();

	$id=$_POST['id'];
	$castellano=$_POST['castellano'];
	$original=$_POST['original'];
	$abreviatura=$_POST['abreviatura'];
	$m1=$_POST['m1'];
	$m2=$_POST['m2'];
	$m3=$_POST['m3'];
	$m4=$_POST['m4'];
	$m5=$_POST['m5'];
	$m6=$_POST['m6'];
	$m7=$_POST['m7'];
	$m8=$_POST['m8'];
	$m9=$_POST['m9'];
	$m10=$_POST['m10'];
	$m11=$_POST['m11'];
	$m12=$_POST['m12'];
	$ma1=$_POST['ma1'];
	$ma2=$_POST['ma2'];
	$ma3=$_POST['ma3'];
	$ma4=$_POST['ma4'];
	$ma5=$_POST['ma5'];
	$ma6=$_POST['ma6'];
	$ma7=$_POST['ma7'];
	$ma8=$_POST['ma8'];
	$ma9=$_POST['ma9'];
	$ma10=$_POST['ma10'];
	$ma11=$_POST['ma11'];
	$ma12=$_POST['ma12'];
	$d1=$_POST['d1'];
	$d2=$_POST['d2'];
	$d3=$_POST['d3'];
	$d4=$_POST['d4'];
	$d5=$_POST['d5'];
	$d6=$_POST['d6'];
	$d7=$_POST['d7'];
	$da1=$_POST['da1'];
	$da2=$_POST['da2'];
	$da3=$_POST['da3'];
	$da4=$_POST['da4'];
	$da5=$_POST['da5'];
	$da6=$_POST['da6'];
	$da7=$_POST['da7'];
	$formato=$_POST['formato'];
	if (empty($castellano) || empty($original)){
		header("Location: idiomas.php");
		exit;
	}
	$query="update idiomas set castellano='$castellano', original='$original', abreviatura='$abreviatura', m1='$m1', m2='$m2', m3='$m3', m4='$m4', m5='$m5', m6='$m6', m7='$m7', m8='$m8', m9='$m9', m10='$m10', m11='$m11', m12='$m12', ma1='$ma1', ma2='$ma2', ma3='$ma3', ma4='$ma4', ma5='$ma5', ma6='$ma6', ma7='$ma7', ma8='$ma8', ma9='$ma9', ma10='$ma10', ma11='$ma11', ma12='$ma12', d1='$d1', d2='$d2', d3='$d3', d4='$d4', d5='$d5', d6='$d6', d7='$d7', da1='$da1', da2='$da2', da3='$da3', da4='$da4', da5='$da5', da6='$da6', da7='$da7', formato='$formato' where id='$id'";
	$result=mysqli_query($bdd_link,$query);


	header("Location: idiomas.php");
	exit;
?>
