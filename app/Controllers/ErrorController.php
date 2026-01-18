<?php

namespace App\Controllers;

class ErrorController
{

    public function forbidden()
    {
        return view('errors.403');
    }
}
