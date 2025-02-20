<?php
ob_start();

if(!isset($_SESSION)):
  session_start();
endif;

use App\Configurations\Formater;
$formater = new Formater();

if ($_GET) {
    $controller = strtolower(str_replace("Controller", "", $_GET['controller']));
    $metodo = strtolower($_GET['metodo']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Web - imobiliaria online</title>
    <!-- carregando arquivos java scripts -->
    <script type="text/javascript" src="lib/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="lib/js/animacoes.js"></script>

    <!-- carregando fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- carregANDO FONTES EXTERNAS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- CARREGANDO CSS -->
    <link rel="stylesheet" href="lib/css/aurora.css">
    <link rel="stylesheet" href="lib/css/site.css">

</head>

<body>
    <header class="header bg-terciario pd-t-1 ">
        <!-- primeiro menu -->
        <div class="container">
            <div class="box-12">
                <nav class="wd-100">
                    <ul class="flex justify-start">
                        <li class="mg-r-4"><a href="index.php" class="fonte14 fnc-secundario border-bottom-hover">Inicio</a></li>
                        <li class="mg-r-4"><a href="index.php?controller=UsuarioController&metodo=autenticar" class="fonte14 fnc-secundario border-bottom-hover">Login</a></li>       
                    </ul>
                </nav>
            </div>
        </div>
        <!-- BARRA DE PESQUUISA  -->
        <div class="limpar"></div>
        <div class="wd-100 bg-branco mg-t-1 pd-t-2 pd-b-2">
            <div class="container flex justify-start item-centro ">
                <div class="box-4">
                    <a href=""> <img src="lib/img/logo.png" alt="" class=" logo-40"></a>
                </div>

                <div class="box-8">
                    <form action="" class="pesquisar wd-100 flex justify-start" method="POST">
                        <div class="input">
                            <input type="search" name="pesquisa" class=" fnc-secundario roboto-condensed" placeholder="pesquisar por produto">
                        </div>
                        <div class="limpar"></div>
                        <div class="enviar flex justify-center item-centro">
                            <button type="submit" value="" class=" btn-search wd-100">
                                <i class="fa-solid fa-magnifying-glass fonte24 fnc-primario"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- BARRA DE PESQUUISA  -->
        <div class="limpar"></div>
        <div class="wd-100 bg-secundario hg-60">
            <div class="container">
                <div class="box-3 bg-primario hg-60 flex justify-start item-centro pd-l-1">
                    <i class="fa-solid fa-bars fonte30 fnc-secundario"></i>
                    <ul class="mg-l-2">
                        <li class="fonte20 dropdown-container">Categoria <i class="fa-solid fa-chevron-right fonte16 fnc-primario mg-l-2"></i>
                            <ul class="dropdown">
                                <li class="fonte14"><a href="" class="fnc-secundario block wd-10 pd-10">Camisetas </a> </li>
                                <li class="fonte14"><a href="" class="fnc-secundario block wd-10 pd-10">Calças </a> </li>
                                <li class="fonte14"><a href="" class="fnc-secundario block wd-10 pd-10">Sapatos </a> </li>
                                <li class="fonte14"><a href="" class="fnc-secundario block wd-10 pd-10">Acessórios </a> </li>
                            </ul>

                        </li>
                    </ul>
                </div>
                <div class="box-9 flex justify-end item-centro pd-t-2">
                    <i class="fa-solid fa-heart fonte18 fnc-primario"></i>
                    <div class="contador fnc-branco mg-r-1 flex justify-center item-centro">0</div>
                    <i class="fa-solid fa-cart-shopping fonte18 fnc-primario"></i>
                    <div class="contador fnc-branco flex justify-center item-centro">0</div>

                </div>
            </div>
        </div>
    </header>