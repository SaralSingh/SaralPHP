<?php

function url($path)
{
    return BASE_URL . $path;
}

function redirect($path)
{
    header("Location: " . BASE_URL . $path);
    exit;
}

function view($filePath, $data = [])
{
    $path = str_replace('.', DIRECTORY_SEPARATOR, $filePath);
    $fullPath = APP_ROOT . '/views/' . $path . '.php';
    if (!file_exists($fullPath)) {
        die("View not found: $fullPath");
    }
    extract($data, EXTR_SKIP);
    require $fullPath;
}

function set_flash($key, $message)
{
    if (!isset($_SESSION['flash'])) {
        $_SESSION['flash'] = [];
    }
    $_SESSION['flash'][$key] = $message;
}

function flash($key)
{
    if (isset($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]); // auto clear
        return $msg;
    }
    return null;
}

function sessionON($data)
{
    foreach ($data as $key => $value) {
        $_SESSION[$key] = $value;
    }
}

function makeHash($input)
{
    return password_hash($input, PASSWORD_BCRYPT);
}

// function responseTime()
// {

//     // Connect to DB
//     $conn = new PDO("mysql:host=localhost;dbname=test", "root", "");

//     // Start time
//     $start = microtime(true);

//     // Run query
//     $stmt = $conn->query("SELECT * FROM users_test WHERE status = 1 LIMIT 50");

//     // Fetch results
//     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     // End time
//     $end = microtime(true);

//     // Calculate difference in milliseconds
//     $timeTaken = round(($end - $start) * 1000, 3);

//     echo "Time taken: {$timeTaken} ms\n";
// }

function csrf_token()
{
    // Token already generated? then return same
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

