<?php require_once 'views/shared/header-painel.php'; ?>
<header class="bg-secundario hg-90">

</header>
<section class="painel">

    <div class="container">
        <div class="box-12">           

            <!-- carregamento altomatico das páginas -->
            <?php if ($controller == "painel" && $metodo == "index") : ?>


            <?php else:  require_once "views/" . strtolower($controller) . "/" . strtolower($metodo) . ".php";
            endif; ?>


        </div>
    </div>
</section>
<div class="limpar mg-b-10"></div>