<?php

namespace App\Middlewares;

class CsrfMiddleware
{

    public static function Validate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                !isset($_POST['csrf_token']) ||
                !isset($_SESSION['csrf_token']) ||
                !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
            ) {
                http_response_code(419);
                set_flash('error', 'Session expired. Please try again.');
                redirect('/login');
                exit;
            }

            unset($_SESSION['csrf_token']);
        }
    }
}
