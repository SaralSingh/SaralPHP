<?php
define('APP_ROOT', __DIR__);
define('BASE_URL', '/SARALPHP');

session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'secure'   => !empty($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict', // or Lax
]);

ini_set('session.use_strict_mode', 1);
ini_set('session.gc_maxlifetime', 1800);

session_start();

require_once APP_ROOT . '/vendor/autoload.php';
require_once APP_ROOT . '/app/Helpers/helpers.php';
require_once APP_ROOT . '/routes/web.php';

use App\Services\Route;

Route::handle();
