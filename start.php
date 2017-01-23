<?php
	/*
		SimpleGeoStats, version 1
		(c) krzysiu.net 2017
	*/
	chdir(__DIR__);
	
	$configCheck = include 'config.php';
	
	if (!$configCheck) die('ERROR: File config.php is missing. Check config.example.php for instructions');
	elseif (empty($config)) die('ERROR: Wrong config.php settings. Check config.example.php for instructions');
	
	require_once('modules/functions.php');
	
	if (!$input = file_get_contents($config['inputFile'])) die(sprintf('ERROR: Input file (%s) is missing', $config['inputFile']));
	
	$input = explode("\n", $input); // no \r support here, as it will be trimmed later
	//var_dump($input);
	$input = array_filter($input, function ($line, $key) { return !(trim($line) === '' || $line[0] === '#');	}, ARRAY_FILTER_USE_BOTH);
	
	array_walk($input, function (&$item) {
		$data = explode(',', $item, 2);
		if (count($data) === 1) $item = ['country' => strtoupper(trim($data[0]))]; 
		else $item = ['country' => strtoupper(trim($data[1])), 'city' => strtoupper(trim($data[0]))]; 
		return;
	});
	
	if (!count($input)) die('ERROR: Data in input file not found'); else echo sprintf('INFO: %d records loaded.%s', count($input), PHP_EOL);
	
	// Create output directory if it doesn't exist yet
	$config['outputFile']['directory'] = rtrim($config['outputFile']['directory'], DIRECTORY_SEPARATOR);
	if ($config['outputFile']['timestamp']) $config['outputFile']['directory'] = sprintf('%s%s%d', $config['outputFile']['directory'], DIRECTORY_SEPARATOR, time());
	if (!is_dir($config['outputFile']['directory'])) mkdir($config['outputFile']['directory'], 0777, true);
	
	$contRawDb = file_get_contents('data.csv');
	
	$countries = array_column($input, 'country');
	$countries = array_count_values($countries);
	arsort($countries);
	$countMax = max($countries);
	$contDb = [];
	foreach (explode("\n", $contRawDb) as $row) { $row = explode(',', $row); $contDb[$row[0]] = [$row[2], $row[1]]; }
	
	$contStat = [];
	$isoStat = [];
	foreach ($countries as $country => $count) {
		if (isset($contDb[$country])) {
			if (!isset($contStat[$contDb[$country][0]])) $contStat[$contDb[$country][0]] = 0;
			$contStat[$contDb[$country][0]] += $count;
			$isoStat[$contDb[$country][1]] = ['fillColor' => perc2col($count * 100 / $countMax), 'count' => $count];
		} else echo "WARNING: Can't find continent match for the following country: {$country}" . PHP_EOL;
	}	
	arsort($contStat);
	
	file_put_contents(getPath('continent'), json_encode($contStat));
	echo 'INFO: Continent statistics saved.' . PHP_EOL;
	unset($contStat);
	
	file_put_contents(getPath('map'), json_encode($isoStat));
	echo 'INFO: Map data saved.' . PHP_EOL;
	unset($isoStat);
	
	file_put_contents(getPath('country'), json_encode($countries));
	echo 'INFO: Country statistics saved.' . PHP_EOL;	
	unset($contDb, $countries);
