<?php
	
	function checkFile($file) { return (file_exists($file) && !is_dir($file)); }
	
	function getPath($type) { 
		global $config;
		return sprintf('%s%s%s.json', $config['outputFile']['directory'], DIRECTORY_SEPARATOR, $type);
	}	
	
	function perc2col($val) {
		$val = abs(($val - 100) * 2.55);
		return vsprintf("#%02x0000", $val);
	}
