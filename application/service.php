<?

use Eixo\Core\ServiceContainer as Service;

/*
|-----------------------------------------------------------------------
|	Services
|-----------------------------------------------------------------------
|
|	Register and load services for Eixo to use. Services can be loaded
|	on the fly inside model/controller classes.
|
*/

Service::register('Core', new Eixo\Core\Eixo);
Service::register('View', new Eixo\View\ViewHandler);
Service::register('Response', new Eixo\HTTP\Response);
Service::register('Model', new Eixo\Database\ModelHandler);
Service::register('Resource', new Eixo\Core\ResourceHandler);
Service::register('Config', new Eixo\Core\Config);
Service::register('Controller', new Eixo\HTTP\Controller\ControllerHandler);
Service::register('Database', new Eixo\Database\Database);

$app = Service::load('Core');
$view = Service::load('View');
$model = Service::load('Model');
$db = Service::load('Database');
$response = Service::load('Response');
$resource = Service::load('Resource');
$controller = Service::load('Controller');
$config = Service::load('Config');