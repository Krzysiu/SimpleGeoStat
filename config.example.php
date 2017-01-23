<?php
	
	/* 
		This is an example config file. To use SimpleGeoStats, edit this file and 
		save it as config.php
	*/
	
	$config = 
	[
	'inputFile' => 'input.txt', // file from where input data will be taken
	'outputFile' => [
		'directory' => 'output', // relative or absolute path to output data
		'timestamp' => false, // true - each run generates new timestamped directory
		                      // false - output in place, overwritting old data
		]
	];
