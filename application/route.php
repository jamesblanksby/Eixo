<?php

/*
|-----------------------------------------------------------------------
|	Routes
|-----------------------------------------------------------------------
|
|	Define routes so Eixo can return it's responses when
|	they're requested. Regular expressions can be used in the standard 
|	format to match dynamic routes when required.
|
*/

$app->any('{*}', function() use ($app, $view) {
	$view->render('welcome', 'Eixo - It works!', array('framework' => 'Eixo', 'version' => '0.1', 'route' => $app->request));
});