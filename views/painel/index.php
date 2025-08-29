<?php require_once 'views/shared/header-painel.php'; ?>
<header class="fixed bg-preto-azulado-escuro hg-90"></header>
<section class="painel">

    <div class="container-100">

        <div class="box-2">

            <nav class="side-bar active">

                <button class="menu-toggle"> <i class="fa-solid fa-bars"></i> </button>

                <ul class="menu pd-5">
                    <li class="item">
                        <a href="index.php?controller=PainelController&metodo=index" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-table-columns"></i>
                            Painel
                        </a>
                    </li>
                    <li class="item">
                        <a href="index.php?controller=CategoriaController&metodo=listar" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-list"></i>
                            Categoria</a>
                    </li>
                    <li class="item">
                        <a href="index.php?controller=ProdutoController&metodo=listar" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-bag-shopping"></i>
                            Produto</a>
                    </li>
                    <li class="item">
                        <a href="index.php?controller=PerfilController&metodo=listar" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-users"></i>
                            Perfil</a>
                    </li>
                    <li class="item">
                        <a href="index.php?controller=UsuarioController&metodo=listar" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-keyboard"></i>
                            Usuario</a>
                    </li>
                    <li class="item">
                        <a href="index.php?controller=UsuarioController&metodo=listar" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-person"></i>
                            Cliente</a>
                    </li>

                    <li class="item">
                        <a href="index.php?controller=ClienteController&metodo=logout" class="fonte12 fnc-terciario">
                            <i class="fa-solid fa-right-from-bracket"></i>
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