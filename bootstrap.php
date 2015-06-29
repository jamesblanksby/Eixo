<?php

use Eixo\Core\ServiceContainer as Service;

/*
|-----------------------------------------------------------------------
|	Composer Autoload
|-----------------------------------------------------------------------
|
|	Autoloader file provided by composer.
|
*/

require_once __DIR__ . '/vendor/autoload.php';

/*
|-----------------------------------------------------------------------
|	Services
|-----------------------------------------------------------------------
|
|	Contains all the necesary services to run Eixo. It is possible
|	register additional services in this file and then load them 
|	anywhere in the app.
|
*/

require_once __DIR__ . '/application/service.php';

/*
|-----------------------------------------------------------------------
|	Routes
|-----------------------------------------------------------------------
|
|	Contains your predefined application routes.
|
*/

require_once __DIR__ . '/application/route.php';

/*
|-----------------------------------------------------------------------
|	Base URL
|-----------------------------------------------------------------------
|
|	Sets the application base url to the current root directory.
|
*/

$_SERVER['BASE_URL'] = rtrim($_SERVER['SCRIPT_NAME'], 'index.php/');

/*
|-----------------------------------------------------------------------
|	Base Path
|-----------------------------------------------------------------------
|
|	Sets the application base path to the current root directory.
|
*/

$_SERVER['BASE_PATH'] = $_SERVER['DOCUMENT_ROOT'] . rtrim($_SERVER['SCRIPT_NAME'], 'index.php/');

/*
|-----------------------------------------------------------------------
|	Configuration
|-----------------------------------------------------------------------
|
|	Get your configuration array to set up the application environment
|
*/

$config = Service::load('Config');
$config = $config->get();

/*
|-----------------------------------------------------------------------
|	Application Timezone
|-----------------------------------------------------------------------
|
| 	Set the default timezone used by all date/time functions
|
*/

date_default_timezone_set($config['app']['timezone']);

/*
|-----------------------------------------------------------------------
|	Session
|-----------------------------------------------------------------------
|
| 	Set the session name an starts a new or resumes an existing session
|
*/

if(is_writable($config['session']['save_path'])) {
	session_save_path($config['session']['save_path']);
	session_name($config['session']['name']);
	session_start();
} else {
	throw new Exception($config['session']['save_path'] . ' does not have sufficient permissions');
}