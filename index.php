<?php
use App\Controllers\BaseController;

require_once 'vendor/autoload.php';

// CARREGANDO O .ENV
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// resto do código
if($_GET):
     $controller = $_GET['controller'];
     $metodo = $_GET['metodo'];

     $objClass = 'App\\Controllers\\'.$controller;

     $obj = new $objClass();
     $obj->$metodo();

else:
  $inicio = new BaseController();
  $inicio->index();

endif;
