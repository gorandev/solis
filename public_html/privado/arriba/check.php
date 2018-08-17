<?php
// Uploadify v1.6.2
// Copyright (C) 2009 by Ronnie Garcia
// Co-developed by Travis Nickels
$fileArray = array();
foreach ($_POST as $key => $value) {
	if ($key != 'folder') {
		if (file_exists($_SERVER['DOCUMENT_ROOT'] . $_POST['folder'] . '/' . $value)) {
			$fileArray[$key] = $value;
		}
	}
}
if(!function_exists('json_encode'))
{
include_once('jason.php');
$GLOBALS['JSON_OBJECT'] = new Services_JSON();
function json_encode($value)
{
return $GLOBALS['JSON_OBJECT']->encode($value);
}
function json_decode($value)
{
return $GLOBALS['JSON_OBJECT']->decode($value);
}
}echo json_encode($fileArray);
?>