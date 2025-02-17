<?php

namespace App\Controller;

class BaseController
{
    function index()
    {
        require_once 'Views/home/index.php';
    }
}