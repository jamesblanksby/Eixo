# Exio
#### A lightweight and super simple PHP framework

## Getting started
### Adding routes
```php
// GET route.
// Routes can also be defined using POST, PUT and DELETE methods.
$app->get($route, $response);

// Match any method type.
$app->any($route, $response);
```
A few things to remember when defining routes:
* A valid **route** must always start with a slash.
* The **response** can be an anonymous function or an array specifying either, a View or a Controller.

### Using regex
Matching dynamic URIs with regular expressions. Routes can be defined using standard regular expressions to match dynamic URIs.
```php
$app->get('/user/{[\d]+}', $response);
```
Instead of having to type common regex strings you can use Eixo's array of predefined regular expressions. You can add your own strings to the array here `/application/config/route.php`.
```
i => [\s\S]*            // Matches everything
i => [0-9]+             // Numbers only
a => [a-zA-Z0-9]+       // Alphanumeric
c => [a-zA-Z0-9+_\-\.]+ // Alnumnumeric and + _ - . characters
```
### Defining responses
```php
// Defining a route response with an anonymous function.
$app->get('/', function() {
    echo 'It works!';
});

// Anonymous route functions can be passed registered Services.
$app->get('/', function() use ($app) {
    $app->render('user', 'User', ['name' => 'John Smith']);
});

// Using a controller method as a response.
$app->get('/', ['controller' => 'WelcomeController/main']);

/**
 * Finally, defining a route that renders a View.
 * When defining a View you can give it a title and a data array 
 * to display which can be accessed via $this.
 */
$app->get('/', [
    'view' => [
        'view' => 'user',
        'title' => 'User',
        'data' => ['name' => 'John Smith']
    ]
]);

// You can also create a route that responds to two or more URIs.
$app->get(['/', '/home'], $response);
```

## Models
Models are used to maintain data and should never communicate with the view.
```php
<?php

// Controllers requiring database access should extend the Database class

use Eixo\Database\Database;

class UserModel extends Database {

    public function __construct() {
        parent::__construct();
    }

    ...
```

## Views
his is what the user will view once a route has been matched. Variables and Services passed via the route can be accessed here using, specifically, GET parameters are located in the following associative array `$this->route->parameter`.


## Controllers
Instead of defining all your route logic with anonymous functions in the route.php, it makes sense to organise this behaviour using Controller classes.
```php
<?php

// All controllers should extend the BaseController class.

use Eixo\HTTP\Controller\BaseController;

class UserController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->user_model = $this->model->load('UserModel')->get();
    }

    public function main() {
    
    }

    ...
```

## Services
The Service container allows you initiate and use Services throughout your application whenever you need the specific functionality it provides.
### Registering
Services must be registered with Eixo before they can be loaded. If a Service relies on one or more other Services they must be registered first.
```php
Service::register('Resource', new Eixo\Core\ResourceHandler);
```
### Loading
Now our Services have been registered they can be loaded.
```php
$resource = Service::load('Resource');
```