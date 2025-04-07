<div class="box-12 mg-t-12">
    <h2 class=" poppins-medium fw-300 fonte22">
        <i class="fa-solid fa-bag-shopping mg-r-1 fonte22 fnc-secundario"></i>
        <?php
        $titulo = isset($id) && $id <> '' ?  'Atualizar usuario ' : 'Cadastrar usuario';
        echo $titulo;
        ?>

    </h2>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->ID;
                                                endif; ?>">
        <div class="box-12">
            <label for="">Nome </label>
            <input type="text" name="nome" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->NOME;
                                                    endif; ?>" required>
        </div>

        <div class="box-4">
            <label for="">Cpf </label>
            <input type="text" name="cpf" id="cpf" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->CPF;
                                                            endif; ?>" maxlength="14" onkeypress="formata_mascara(this, '###.###.###-##')">
            <span id="cpfFeedback"></span>
        </div>

        <div class="box-4">
            <label for="">Data de Nascimento </label>
            <input type="date" name="datanascimento" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->DATANASCIMENTO;
                                                            endif; ?>">
        </div>

        <div class="box-4">
            <label for="">Email </label>
            <input type="email" name="email" id="email" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->EMAIL;
                                                                endif; ?>" required>
            <span id="emailFeedback"></span>
        </div>
        <?php if (isset($id) && $id <> ''):

        else: ?>
            <div class="box-3">
                <label for="">Senha </label>
                <input type="password" name="senha" required>
            </div>

        <?php endif; ?>


        <div class="box-3">
            <label for="">Cep </label>
            <input type="text" name="cep" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->CEP;
                                                                endif; ?>" onkeypress="formata_mascara(this, '#####-###')" maxlength="9" onblur="getDadosEnderecoPorCEP(this.value)" required>
        </div>

        <div class="box-6">
            <label for="">Endereço </label>
            <input type="text" id='endereco' value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->LOGRADOURO;
                                                                endif; ?>" name="logradouro" readonly>
        </div>

        <div class="box-6">
            <label for="">Bairro </label>
            <input type="text" id="bairro" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->BAIRRO;
                                                                endif; ?>" name="bairro" readonly>
        </div>

        <div class="box-6">
            <label for="">Cidade </label>
            <input type="text" id="cidade" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->CIDADE;
                                                                endif; ?>" name="cidade" readonly>
        </div>

        <div class="box-3">
            <label for="">Numero </label>
            <input type="text" name="numero" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->NUMERO;
                                                                endif; ?>">
        </div>

        <div class="box-3">
            <label for="">Uf </label>
            <input type="text" id="uf" name="uf" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->UF;
                                                                endif; ?>" readonly>
        </div>

        <div class="box-4">
            <label for="" class="fnc-preto-azulado">Perfil</label>
            <select name="perfil" id="">
                <?php if (isset($perfis) && count($perfis) > 0):
                    foreach ($perfis as $perfil):
                        $selected  = (isset($id) && $id != '' && $cliente[0]->PERFIL == $perfil->ID) ? 'selected' : '';
                        $descricao = $perfil->DESCRICAO;
                        echo "<option value='{$perfil->ID}' {$selected} > {$descricao} </option>"
                ?>


                <?php endforeach;
                endif; ?>


            </select>
        </div>

        <div class="box-6 pd-l-2 fnc-branco radius pd-t-1 bg-light mg-t-2">
            <label for="img">Escolher uma Imagem </label>
            <input type="file" name="imagem" id="img">
        </div>

        <div class="box-12">
            <input type="submit" value="cadastrar" class="btn-100 bg-primario mg-t-4">
        </div>
    </form>
</div>