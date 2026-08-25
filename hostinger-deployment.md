Run all commands on local machine
    npm install
    npm run build
    
    php artisan optimize:clear

    php artisan serve

Zip your project directory

Upload zip folder of sinas-site-laravel to hostinger file manager

Extract it

Move the files of public folder of sinas-site-laravel to public_html

Update index.php of public_html (moved from public folder of project)
    <?php

    use Illuminate\Foundation\Application;
    use Illuminate\Http\Request;

    define('LARAVEL_START', microtime(true));

    // Determine if the application is in maintenance mode...
    if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    // Register the Composer autoloader...
    // change the path where required
    require '/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/vendor/autoload.php';

    // Bootstrap Laravel and handle the request...
    // change the path where required
    /** @var Application $app */
    $app = require_once '/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/bootstrap/app.php';
    $app->handleRequest(Request::capture());

Set .env
    update database credentials

Upload database

Test
