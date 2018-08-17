<?php
	session_start();
	if (empty($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
/* This is where you would inject your sql into the database 
   but we're just going to format it and send it back
*/
	include("../conecta.php");
	$bdd_link=Conectarse();

foreach ($_GET['listItem'] as $position => $item) :
	$query="update youtube set orden = '$position' where id='$item'";
//	echo $query."<br>";
	$result=mysqli_query($bdd_link,$query);

endforeach;
?>