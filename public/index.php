<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Early Static File Handling (WAJIB UNTUK ASSET)
|--------------------------------------------------------------------------
*/
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$publicPath = __DIR__ . $uri;

if ($uri !== '/' && file_exists($publicPath) && is_file($publicPath)) {
    header('Content-Type: ' . mime_content_type($publicPath));
    readfile($publicPath);
    exit;
}

/*
|--------------------------------------------------------------------------
| Maintenance Mode
|--------------------------------------------------------------------------
*/
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Autoloader
|--------------------------------------------------------------------------
*/
require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Bootstrap Laravel
|--------------------------------------------------------------------------
*/
$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Handle Request (CARA BENAR)
|--------------------------------------------------------------------------
*/
$request = Request::capture();
$response = $app->handle($request);
$response->send();

$app->terminate($request, $response);
