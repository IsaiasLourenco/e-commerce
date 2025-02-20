<?php

namespace App\Controllers;

class BaseController
{
    function index()
    {
        require_once 'Views/home/index.php';
    }
}