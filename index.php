<?php
define('APP_ROOT', __DIR__);
require_once APP_ROOT . '/vendor/autoload.php';

// Load Environment Variables
$dotenv = Dotenv\Dotenv::createImmutable(APP_ROOT);
$dotenv->safeLoad(); // safeLoad won't crash if .env is missing in production

// Define BASE_URL from ENV directly
define('BASE_URL', $_ENV['APP_URL']);

// ----- Global Error & Exception Handling -----
set_exception_handler(function (\Throwable $e) {
    if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'local') {
        // Local: Show raw error
        echo "<div style='border:1px solid red; padding:20px; font-family:sans-serif;'>";
        echo "<h2>🚨 Application Error</h2>";
        echo "<b>Message:</b> " . $e->getMessage() . "<br><br>";
        echo "<b>File:</b> " . $e->getFile() . " on line " . $e->getLine() . "<br><br>";
        echo "<b>Stack Trace:</b><br><pre>" . $e->getTraceAsString() . "</pre>";
        echo "</div>";
    } else {
        // Production: Log the error safely and show generic 500 page
        $logFile = APP_ROOT . '/storage/logs/error.log';
        if (!is_dir(dirname($logFile))) {
            mkdir(dirname($logFile), 0777, true);
        }
        $logMessage = "[" . date('Y-m-d H:i:s') . "] " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine() . PHP_EOL;
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        http_response_code(500);
        // Fallback if view function isn't loaded yet
        if (function_exists('view')) {
            view('errors.500');
        } else {
            echo "<h1>500 - Internal Server Error</h1><p>Something went wrong. Please try again later.</p>";
        }
    }
    exit;
});

set_error_handler(function ($severity, $message, $file, $line) {
    throw new \ErrorException($message, 0, $severity, $file, $line);
});
// ---------------------------------------------

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

require_once APP_ROOT . '/app/Helpers/helpers.php';
require_once APP_ROOT . '/routes/web.php';

use App\Services\Route;

Route::handle();
