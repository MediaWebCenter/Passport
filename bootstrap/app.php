<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

 $app->withFacades();

 $app->withEloquent();
 //Facades dingo
 /*if(!class_exists('DingoApi')){
     class_alias('Dingo\Api\Facade\API','DingoApi');
 }
 //Router
 if(!class_exists('DingoRoute')){
    class_alias('Dingo\Api\Facade\Route','DingoRoute');
}*/
//configurar auth con config/auth
 $app->configure('auth');
 //confugurar cors en la aplicacion
 $app->configure('cors');

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//    App\Http\Middleware\ExampleMiddleware::class
// ]);

 $app->routeMiddleware([
     //autenticacion en lumen
     'auth' => App\Http\Middleware\Authenticate::class,
     //CORS para poder usar con multiples dominios
     'cors' => \Barryvdh\Cors\HandleCors::class,
 ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

 $app->register(App\Providers\AppServiceProvider::class);
 $app->register(App\Providers\AuthServiceProvider::class);
 $app->register(App\Providers\EventServiceProvider::class);
 //comandos para usar en lumen como laravel https://packagist.org/packages/flipbox/lumen-generator
 // php artisan list para sacar la lista comandos disponibles
 $app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);
 // Passport como configurarlo https://www.youtube.com/watch?v=SuafvdjfHwg&t=1538s
 //colocar los provider para passport
 $app->register(Laravel\Passport\PassportServiceProvider::class);
 $app->register(Dusterio\LumenPassport\PassportServiceProvider::class);
 //configurar las rutas para que se apliquen de passport
 Dusterio\LumenPassport\LumenPassport::routes($app);
 //configurar el provider de CORS
 $app->register(Barryvdh\Cors\ServiceProvider::class);
 //configurar Dingo https://www.youtube.com/watch?v=r40yAZAi6PQ
 //$app->register(Dingo\Api\Provider\LumenServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;
