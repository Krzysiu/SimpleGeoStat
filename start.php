<?php
	/*
		SimpleGeoStats, version 1
		(c) krzysiu.net 2017
	*/
	
	
	$configCheck = include 'config.php';
	if (!$configCheck) {
		echo 'File config.php is missing. Check config.example.php for instructions';
		die();
		}	elseif (empty($config)) {
		echo 'Wrong config.php settings. Check config.example.php for instructions';
		die();
	}
	
