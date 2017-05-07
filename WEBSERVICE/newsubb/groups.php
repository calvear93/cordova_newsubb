<?php
if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$file = fopen('groups.txt', "r");
	$groups = array();

	while(!feof($file)) {
		$groups[] = preg_replace("/[\n\r]/", "", fgets($file));
	}

	header('content-type: application/json; charset=utf-8');
	header("access-control-allow-origin: *");

	echo json_encode($groups);
}
