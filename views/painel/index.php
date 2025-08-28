<?php require_once 'views/shared/header-painel.php'; ?>
<header class="fixed bg-preto-azulado-escuro hg-90"></header>
<section class="painel">

    <div class="container-100">

        <div class="box-2">

            <nav class="side-bar active">

                <button class="menu-toggle"> <i class="fa-solid fa-bars"></i> </button>

                <ul class="menu pd-20">
                    <li class="item">
                        <a href="index.php?controller=PainelController&metodo=index" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-tags mg-r-1 fonte12 fnc-terciario"></i>
                            Painel</a>
                    </li>
                    <li class="item">
                        <a href="index.php?controller=CategoriaController&metodo=listar" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-tags mg-r-1 fonte12 fnc-terciario"></i>
                            Categoria</a>
                    </li>
                    <li class="item">
                        <a href="index.php?controller=ProdutoController&metodo=listar" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-bag-shopping mg-r-1 fonte12 fnc-terciario"></i>
                            Produto</a>
                    </li>
                    <li class="item">
                        <a href="index.php?controller=PerfilController&metodo=listar" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-users mg-r-1 fonte12 fnc-terciario"></i>
                            Perfil</a>
                    </li>
                    <li class="item">
                        <a href="index.php?controller=UsuarioController&metodo=listar" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-user mg-r-1 fonte12 fnc-terciario"></i>
                            Usuario</a>
                    </li>

                    <li class="item">
                        <a href="index.php?controller=ClienteController&metodo=logout" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-right-from-bracket mg-r-1 fonte12 fnc-terciario"></i>
                            Logout</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- carregamento altomatico das páginas -->
        <div class="box-10">

            <?php
            if ($controller == "painel" && $metodo == "index") :                                
                require_once "Views/painel/dashboard.php";

            else:
                require_once "Views/" . strtolower($controller) . "/" . strtolower($metodo) . ".php";

            endif;
            ?>

        </div>

    </div>
</section>
<div class="limpar mg-b-10"></div>

<script>
    let table = new DataTable('#tabela');

    document.querySelector('.menu-toggle').addEventListener('click', function() {
        document.querySelector('.side-bar').classList.toggle('active');
    });
</script>