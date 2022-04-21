<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php

use App\Components\Curlapi;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;



// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$di = new FactoryDefault();

include APP_PATH.'/config/router.php';

include APP_PATH.'/config/services.php';

$config = $di->getConfig();

include APP_PATH.'/config/loader.php';

$di->set('api', new Curlapi);

$application = new Application($di);

try {
    // Handle the request
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();

   
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}