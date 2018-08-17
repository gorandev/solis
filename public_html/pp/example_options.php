<?
	include("../conecta.php");
	$bdd_link=Conectarse();


	require_once("Sajax.php");

	function test_get() {
		$s = "-- GET --\n";
		foreach ($_GET as $k=>$v) {
			$s .= "$k:$v\n";
		}
		return $s;
	}	

	function test_post() {
		$s = "-- POST --\n";
		foreach ($_POST as $k=>$v) {
			$s .= "$k:$v\n";
		}
		return $s;
	}

	function get_the_time() {
		return date("Y-m-d h:i:s");
	}

	function busqueda($xnro) {
		$nrocat="cate_" .$xnro. "#";
		$query= "select * from paquetes WHERE categorias LIKE '%" .$nrocat. "%'";
		$filasDevueltas = mysql_num_rows($query);
		if ($filasDevueltas!=0){
			$devuelto="si";
		} else {
			$devuelto="no";
		}
		return $devuelto;
	}







	// $sajax_debug_mode = 1;
	sajax_init();
	sajax_export("busqueda", "test_get", "test_post", "get_the_time");
	sajax_handle_client_request();	

?>
<html>
<head>
<title>Example of Sajax Options</title>
<script>
	function print_result(v) {
		alert(v);
	}
<?
	sajax_show_javascript();
?>
</script>
	
</head>
<body>

<button onClick="x_busqueda(5, print_result)">Buscar</button>
<button onClick="x_test_get(1, 2, 3, print_result)">Test GET</button>
<button onClick="sajax_request_type = 'POST'; x_test_post(1, 2, 3, print_result); sajax_request_type = '';">Test POST</button>

<button onClick="sajax_target_id = 'time'; x_get_the_time(); sajax_target_id = '';">Test updating IDs</button>

<div id="time">
<em>Time will appear here</em>
</div>

</body>
</html>
