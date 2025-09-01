<?php require_once "Views/shared/header.php"; ?>
<section class="login">
    <div class="fundo">
        <div class="container flex justify-center">
            <div class="box-4 mg-t-4 shadow-down">

                <form method="POST">

                    <label for="cliente" class="fnc-branco">Cliente</label>
                    <input type="text" name="cliente" class="fnc-branco mg-b-3" autofocus>

                    <label for="senha" class="fnc-branco">Senha</label>
                    <input type="password" name="senha" class="fnc-branco">

                    <h4 class=" fnc-branco fonte12 fw-800">
                        ainda não tem cadastro? 
                        <a href="index.php?controller=ClienteController&metodo=index" class=" fnc-primario poppins-medium">cadastre-se</a>
                </h4>
                     <input type="submit" value="Acessar" class="btn-100 bg-primario fnc-secundario mg-t-2">
                </form>

            </div>
        </div>
    </div>
</section>