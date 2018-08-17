<?
function Conectarse()
{
		$enlace= mysqli_connect('localhost', 'crucerod_fgdbarc', '(^3RtOJvbp_P', 'crucerod_nueva');
	if (!$enlace) {
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
   return $enlace;
}
?>