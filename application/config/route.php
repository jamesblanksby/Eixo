<?php

return array (

	/*
	|-----------------------------------------------------------------------
	|	Route Regex Shortcuts
	|-----------------------------------------------------------------------
	|
	|	Define application wide variables
	|
	*/

	'regex_shortcut' => array (
		'*' => '[\s\S]*',			// match anything
		'i' => '[0-9]+',			// numbers only
		'a' => '[a-zA-Z0-9]+',		// alphanumeric
		'c' => '[a-zA-Z0-9+_\-\.]+'	// alnumnumeric and + _ - . characters
	)

);