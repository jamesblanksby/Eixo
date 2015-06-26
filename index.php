<?php

/*
|-----------------------------------------------------------------------
|	load.php
|-----------------------------------------------------------------------
|
|	Include to necessary files for Eixo to function
|
*/

require_once __DIR__ . '/bootstrap.php';

/**
 *	Uncomment the line below if you want to set a different
 *	resource path.
 */
// $resource->path('path/to/resources/');

$app->dispatch();