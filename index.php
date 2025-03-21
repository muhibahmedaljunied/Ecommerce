<?php
/*
Project        :   Valex – Laravel Admin Template A PHP Framework
@package       :   Laravel
Version        :   7.0
Create Date    :   06/06/2020
Copyright      :   Spruko Technologies Private Limited
Author         :   SprukoSoft
Author URL     :   https://themeforest.net/user/sprukosoft
Support        :   support@spruko.com
License        :   Licensed under ThemeForest Licence
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/



require __DIR__ . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/
// https://www.youtube.com/watch?v=gpjFP6RJMXA



$app = require_once __DIR__ . '/bootstrap/app.php';


// KV(sW5Qu#riHRZF   passwor of paypal
// $r = new ReflectionClass(get_class($app));
        // ob_start();
        // var_dump($r->getMethods());
        // $dump = ob_get_contents();
        // ob_end_clean();
    
        // echo "<pre> $dump </pre>";  
        
        // die();

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);



$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);


// ob_start();
// echo 'I am in app.php inside bootstrap<br>';
// var_dump($request);
// $dump = ob_get_contents();
// ob_end_clean();

// echo "<pre> $dump </pre>";
// die($request);


$response->send();

$kernel->terminate($request, $response);
