<?php
ob_start();

if (!isset($_SESSION)):
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
    <title>Compras online - Vetor256.</title>
    <!-- Ícone -->
    <link rel="icon" href="lib/img/e-commerce.ico" type="image/x-icon">
    <!-- carregando arquivos java scripts -->
    <script type="text/javascript" src="lib/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="lib/js/animacoes.js"></script>
    <script type="text/javascript" src="lib/js/ajax.js"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

     <?php
    if ($controller == "painel" && $metodo == "index"): ?>
        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
    <?php endif;  ?>

    <!-- carregando fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- carregANDO FONTES EXTERNAS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- CARREGANDO CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="lib/css/aurora.css">
    <link rel="stylesheet" href="lib/css/site.css">
    <link rel="stylesheet" href="lib/css/menu.css">

</head>

<body>