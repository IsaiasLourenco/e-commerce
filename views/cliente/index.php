<?php require_once "Views/shared/header.php"; ?>
<div class="box-12 mg-t-12">
    <h2 class=" poppins-medium fw-300 fonte22">
        <i class="fa-solid fa-bag-shopping mg-r-1 fonte22 fnc-secundario"></i>
        <?php
        $titulo = isset($id) && $id <> '' ?  'Atualizar Cliente ' : 'Cadastrar Cliente';
        echo $titulo;
        ?>

    </h2>
</div>

<section class="cad mg-t-4">
    <div class="container">
        <div class="box-6">
            <img src="lib/img/cad.jpg" alt="">
        </div>

        <div class="box-6">

            <form id="formCadastro" action="" method="POST" enctype="multipart/form-data" class="box-12 shadow-down  pd-10">
                <h3 class="fonte24 mg-b-1">Cadastre-se</h3>
                <div class="divider mg-b-4"></div>
                <input type="hidden" name="id" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->id;
                                                        endif; ?>">
                <div class="box-12">
                    <label for="">Nome </label>
                    <input type="text" name="nome" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->nome;
                                                            endif; ?>" required autofocus tabindex="1">
                </div>

                <div class="box-6">
                    <label for="">Cpf </label>
                    <input type="text" name="cpf" id="cpf" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->cpf;
                                                                    endif; ?>" maxlength="14" onkeypress="formata_mascara(this, '###.###.###-##')" required tabindex="2">
                    <span id="cpfFeedback"></span>
                </div>

                <div class="box-6">
                    <label for="">Data de Nascimento </label>
                    <input type="date" name="data_nascimento" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->data_nascimento;
                                                                        endif; ?>" required tabindex="3">
                </div>

                <div class="box-12">
                    <label for="">Email </label>
                    <input type="email" name="email" id="email" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->email;
                                                                        endif; ?>" required tabindex="4">
                    <span id="emailFeedback"></span>
                </div>

                <?php if (!isset($id) || $id == ''): ?>
                    <!-- Cadastro: campo de senha simples -->
                    <div class="box-6">
                        <label for="senha">Senha</label>
                        <div style="position: relative;">
                            <input type="password" name="senha" id="senha" style="padding-right: 40px;" tabindex="5">
                            <span id="toggleSenha" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">👁️</span>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Edição: senha atual + nova senha (condicional) -->
                    <div class="box-6">
                        <label for="senha_atual">Senha atual</label>
                        <div style="position: relative;">
                            <input type="password" name="senha_atual" id="senha_atual" style="padding-right: 40px;" tabindex="6">
                            <span id="toggleSenhaAtual" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">👁️</span>
                        </div>
                    </div>

                    <div class="box-6" id="novaSenhaBloco" style="display: none;">
                        <label for="nova_senha">Nova senha</label>
                        <div style="position: relative;">
                            <input type="password" name="nova_senha" id="nova_senha" style="padding-right: 40px;" tabindex="7">
                            <span id="toggleNovaSenha" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">👁️</span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="box-6">
                    <label for="">Cep </label>
                    <input type="text" name="cep" id="cep" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->cep;
                                                                    endif; ?>" onkeypress="formata_mascara(this, '#####-###')" maxlength="9" onblur="getDadosEnderecoPorCEP(this.value)" required tabindex="8">
                </div>

                <div class="box-12">
                    <label for="">Rua </label>
                    <input type="text" id="rua" name="logradouro" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->logradouro;
                                                                            endif; ?>" readonly>
                </div>

                <div class="box-6">
                    <label for="">Numero </label>
                    <input type="text" name="numero" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->numero;
                                                            endif; ?>" required tabindex="9">
                </div>

                <div class="box-6">
                    <label for="">Bairro </label>
                    <input type="text" id="bairro" name="bairro" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->bairro;
                                                                        endif; ?>" readonly>
                </div>

                <div class="box-12">
                    <label for="">Cidade </label>
                    <input type="text" id="cidade" name="cidade" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->cidade;
                                                                        endif; ?>" readonly>
                </div>

                <div class="box-6">
                    <label for="">Estado </label>
                    <input type="text" id="estado" name="uf" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->uf;
                                                                    endif; ?>" readonly>
                </div>

                <!-- <div class="box-12">
                    <label for="img">Cadastrar Imagem </label>
                    <input type="file" name="imagem" id="img">
                </div> -->

                <div class="box-12">
                    <?php
                    $imagem = isset($id) && $id != '' ? $cliente[0]->imagem : 'sem-foto.jpg';
                    $dirImagem = 'lib/img/users/' . $imagem;
                    $imagemAlt = $imagem === 'sem-foto.jpg' ? 'Escolha uma imagem...' : 'Imagem do Usuário';
                    ?>
                    <label for="img" class="fonte16 fnc-preto-azulado mg-t-3 mg-b-3">
                        <i class="fa-solid fa-file-image fonte20 fnc-cinza"></i>
                        <?php echo $imagemAlt; ?>
                    </label>
                    <input type="file" id="img" name="imagem" onchange="mostrar(this)" value="<?php echo $imagem; ?>">
                    <img class="logo-150 mg-b-2" id="foto" src="<?php echo $dirImagem; ?>" alt="<?php echo $imagemAlt; ?>">
                </div>

                <div class="box-12">
                    <input type="submit" value="<?= isset($id) && $id !== '' ? 'Atualizar' : 'Cadastrar' ?>" class="btn-100 bg-primario mg-t-4" onclick="document.getElementById('novaSenhaBloco').style.display = 'block';">
                </div>

            </form>
        </div>
    </div>
</section>