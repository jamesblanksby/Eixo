<?php

/*
|-----------------------------------------------------------------------
|	Bootstrap
|-----------------------------------------------------------------------
|
|	Include to necessary files for Eixo to function
|
*/

require_once __DIR__ . '/bootstrap.php';

/**
 *	Uncomment the line below to set a different resource path.
 *
 *	@var string
 */
// $resource->path('path/to/resources/');

$app->dispatch();