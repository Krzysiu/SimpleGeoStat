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
		'coordinates' => 'coordinates.txt', // file with coordinates
		'countryStat' => 'country.txt', // country statistics
		'continentStat' => 'continent.txt' // continent statistics
		],
	'errorLog' => 'output/errors.txt', // errors like "can't get coords"
	'geonamesUsername' => '' // get free account: http://www.geonames.org/login
	];
