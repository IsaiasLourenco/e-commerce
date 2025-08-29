<?php require_once "Views/shared/header.php"; ?>
<section class="cad mg-t-4">
    <div class="container">
        <div class="box-6">
            <img src="lib/img/cad.jpg" alt="">
        </div>

        <div class="box-6">

            <form id="formCadastro" action="" method="POST" enctype="multipart/form-data" class="box-12 shadow-down  pd-10">
                <h3 class="fonte24 mg-b-1">Cadastre-se</h3>
                <div class="divider mg-b-4"></div>
                <div class="box-12">
                    <label for="">Nome </label>
                    <input type="text" name="nome" required>
                </div>

                <div class="box-6">
                    <label for="">Cpf </label>
                    <input type="text" name="cpf"  id="cpf" maxlength="14" onkeypress="formata_mascara(this, '###.###.###-##')" required>
                    <span id="cpfFeedback"></span>
                </div>

                <div class="box-6">
                    <label for="">Data de Nascimento </label>
                    <input type="date" name="data_nascimento">
                </div>

                <div class="box-12">
                    <label for="">Email </label>
                    <input type="email" name="email" id="email" required>  
                    <span id="emailFeedback"></span>                  
                </div>

                <div class="box-6">
                    <label for="">Senha </label>
                    <input type="password" name="senha" required>
                </div>

                <div class="box-6">
                    <label for="">Cep </label>
                    <input type="text" name="cep" onkeypress="formata_mascara(this, '#####-###')" maxlength="9" onblur="getDadosEnderecoPorCEP(this.value)" required>
                </div>

                <div class="box-12">
                    <label for="">Endereço </label>
                    <input type="text" id='endereco' name="logradouro" readonly>
                </div>

                <div class="box-12">
                    <label for="">Bairro </label>
                    <input type="text" id="bairro" name="bairro" readonly>
                </div>

                <div class="box-12">
                    <label for="">Cidade </label>
                    <input type="text" id="cidade" name="cidade" readonly>
                </div>

                <div class="box-6">
                    <label for="">Numero </label>
                    <input type="text" name="numero" required>
                </div>

                <div class="box-6">
                    <label for="">Uf </label>
                    <input type="text" id="uf" name="uf" readonly>
                </div>

                <div class="box-12">
                    <label for="img">Cadastrar Imagem </label>
                    <input type="file" name="imagem" id="img">
                </div>

                <div class="box-12">
                    <input type="submit" value="cadastrar" class="btn-100 bg-primario mg-t-4">
                </div>

            </form>
        </div>
    </div>
</section>