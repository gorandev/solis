<?php
	include("../../conecta.php");
	$bdd_link=Conectarse();


$producto=$_GET["producto"];

// Uploadify v1.6.2
// Copyright (C) 2009 by Ronnie Garcia
// Co-developed by Travis Nickels
if (!empty($_FILES)) {
	
	$sopa=mysqli_query($bdd_link,"select * from fotos WHERE producto='$producto'");
	$filasDevueltas = mysqli_num_rows($sopa);
	if ($filasDevueltas!=0){
		$query= "select * from fotos WHERE producto='$producto' ORDER BY orden DESC LIMIT 1";
				$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

			$orden = $row['orden'] + 1;
		}
	} else {
		$orden=0;
	}
	$query="insert into fotos (orden,producto) values ('$orden','$producto')";
	$result=mysqli_query($bdd_link,$query);

	$query= "select * from fotos ORDER BY id DESC LIMIT 1";
			$sopa=mysqli_query($bdd_link,$query);
		while($row = mysqli_fetch_array($sopa)) {

		$id = $row['id'];
	}
	$nombrefoto=$id.".jpg";
	
	
	
	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_GET['folder'] . '/';
	$targetFile =  str_replace('//','/',$targetPath) .$nombrefoto;

	// Uncomment the following line if you want to make the directory if it doesn't exist
	// mkdir(str_replace('//','/',$targetPath), 0755, true);
//	chmod("/newimg/grandes/", 0777);
	move_uploaded_file($tempFile,$targetFile);
//	chmod($targetFile, 0755);
//	chmod("/newimg/grandes/", 0755);
//	chmod("/newimg/chicas/", 0777);
	include("arreglafoto.php");
	img_resizer($nombrefoto);
//	chmod("/newimg/chicas/", 0755);

}
echo "1";
?>