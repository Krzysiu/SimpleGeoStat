<?php
	
	function checkFile($file) { return (file_exists($file) && !is_dir($file)); }
	
	