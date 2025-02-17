<?php require_once 'views/shared/header.php'; ?>
<section class="painel">

    <div class="container-100">        
        <!-- MENU LATERAL -->
        <nav class="menu-lateral bg-preto-azulado-escuro box-2 pd-b-4">
            <div class=" mg-b-3 bg-branco pd-10">
                <div class="">
                    <i class="fa-solid fa-handshake-angle fonte16 fnc-preto-1"></i>
                    <span class="block fonte12 fnc-preto-1 espaco-letra fonte-fredoca mg-l-1 txt-c">
                         Olá <?php echo $_SESSION['nome'] 
                                    ?>, seja bem vindo! 
                    </span>
                </div>
            </div>

            <ul class="mg-l-2">

                <li class="mg-b-1 pd-b-1">
                    <i class="fas fa-tags fonte16 fnc-cinza"></i>
                    <a href="index.php?controller=CategoriaController&metodo=Listar" class=" pd-10 fonte12 fnc-cinza espaco-letra  mg-l-1">Proprietario</a>
                </li>

                <li class="mg-b-1 pd-b-1">
                    <i class="fas fa-users fonte16 fnc-cinza"></i>
                    <a href="index.php?controller=ClienteController&metodo=Listar" class="pd-10 fonte12 fnc-cinza espaco-letra  mg-l-1">Tipo de Imovel</a>
                </li>

                <li class="mg-b-1 pd-b-1">
                    <i class="fas fa-file-signature fonte16 fnc-cinza"></i>
                    <a href="index.php?controller=ProdutoController&metodo=Listar" class="pd-10 fonte12 fnc-cinza espaco-letra  mg-l-1">Finalidade</a>
                </li>

                <li class="mg-b-1 pd-b-1">
                    <i class="fa-solid fa-user-pen fonte16 fnc-cinza"></i>
                    <a href="index.php?controller=UsuarioController&metodo=Listar" class="pd-10 fonte12 fnc-cinza espaco-letra  mg-l-1">Imovel</a>
                </li>

                <li class="mg-b-1 pd-b-1">
                    <i class="fa-solid fa-user-tie fonte16 fnc-cinza"></i>
                    <a href="index.php?controller=UsuarioController&metodo=listar" class="pd-10 fonte12 fnc-cinza espaco-letra  mg-l-1">Usuário</a>
                </li>

                <li class="mg-b-1 pd-b-1">
                    <i class="fa-solid fa-right-from-bracket fonte16 fnc-branco"></i>
                    <a href="index.php?controller=UsuarioController&metodo=sair" class="pd-10 fonte12 fnc-cinza espaco-letra  mg-l-1">Logout</a>
                </li>

            </ul>

        </nav>
        <!-- FIM DO MENU LATERAL -->

        <section class="box-10 bg-branco mg-t-1 shadow-down radius pd-10">
            <div class="box-12 bg-p3-paper pd-10 limpar mg-b-4 shadow-down">
                <div class="box-12">
                    <ul class="flex justify-end">
                        <li>
                            <i class="fa-solid fa-house fonte24 mg-r-1"></i>
                            <a href="index.php?controller=PainelController&metodo=index" class="">
                                Home
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php

            if ($controle == "Painel" && $metodo == "index") : ?>
                <section class="">
                    <div class="box-12  pd-b-9">
                        <h2 class=" fonte68 roboto-condensed fnc-preto-azulado fw-bold box-12 txt-c mg-t-6">CasaWeb </h2>
                        <h3 class="box-12 roboto-condensed fonte26 espaco-letra fw-300 fnc-cinza uppercase txt-c"> sua IMOBILIARIA online</h3>

                        <span class="mg-l-4 box-12 txt-c mg-t-6">
                            <h4 class="roboto-condensed fonte20 espaco-letra fw-300 fnc-cinza uppercase txt-c box-12 mg-b-2"> compartilhe em nossas redes sociais </h4>
                            <a href=""> <i class="fa-brands fa-facebook-f   fnc-azul mg-r-4 fonte30 mg-r-1 fw-500 "></i> </a>
                            <a href=""> <i class="fa-brands fa-linkedin-in  fnc-azul mg-r-4 fonte30 mg-r-1 fw-500 "></i> </a>
                            <a href=""> <i class="fa-brands fa-youtube      fnc-vermelho mg-r-4 fonte30 mg-r-1 fw-500 "></i> </a>
                        </span>

                    </div>
                </section>

            <?php else:
                require_once "views/" . strtolower($controle) . "/" . strtolower($metodo) . ".php";
            endif;
            ?>
            
        </section>
    </div>

</section>
<div class="limpar mg-b-10"></div>


<!--  Sessão destinada a cadastro  -->
<?php require_once 'views/shared/footer.php'; ?>