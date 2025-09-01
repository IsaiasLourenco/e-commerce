<div class="box-12 mg-t-12">
    <h2 class=" poppins-medium fw-300 fonte22">
        <i class="fa-solid fa-tags mg-r-1 fonte22 fnc-secundario"></i>
        <?php
        $titulo = isset($id) && $id <> '' ?  'Atualizar Produto ' : 'Cadastrar Produto';
        echo $titulo;
        ?>
    </h2>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <form action="" method="POST" enctype="multipart/form-data">

        <div>
            <input type="hidden" name="id" value="<?php if (isset($id) && $id <> ''): echo $produto[0]->id;
                                                    endif; ?>">
        </div>

        <div class="box-4">
            <label for="">Nome</label>
            <input type="text" name="nome" value="<?php if (isset($id) && $id <> ''): echo $produto[0]->nome;
                                                        endif; ?>" autofocus required tabindex="1">
        </div>

        <div class="box-4">
            <label for="">Descrição</label>
            <input type="text" name="descricao" value="<?php if (isset($id) && $id <> ''): echo $produto[0]->descricao;
                                                        endif; ?>" required tabindex="2">
        </div>

        <div class="box-4">
            <label for="">Quantidade</label>
            <input type="text" name="quantidade" value="<?php if (isset($id) && $id <> ''): echo $produto[0]->quantidade;
                                                        endif; ?>" tabindex="3">
        </div>

        <div class="box-3">
            <label for="">Cor</label>
            <input type="text" name="cor" value="<?php if (isset($id) && $id <> ''): echo $produto[0]->cor;
                                                        endif; ?>" required tabindex="4">
        </div>

        <div class="box-3">
            <label for="">Preço</label>
            <input type="text" name="preco" value="R$ <?= isset($produto[0]) ? number_format((float) $produto[0]->preco, 2, ',', '.') : ''; ?>" required tabindex="5">
        </div>

        <div class="box-3">
            <label for="">Desconto</label>
            <input type="text" name="desconto" value="<?= isset($produto[0]) ? number_format((float) $produto[0]->desconto, 2, ',', '.') : ''; ?> %" tabindex="6">
        </div>

        <div class="box-3">
            <label for="">Preço de Custo</label>
            <input type="text" name="preco_custo" value="R$ <?= isset($produto[0]) ? number_format((float) $produto[0]->preco_custo, 2, ',', '.') : ''; ?>" required tabindex="7">
        </div>

        <div class="box-4">
            <label for="" class="fnc-preto-azulado">Categoria</label>
            <select name="categoria" required>
                <option value="" disabled selected hidden>Selecione a categoria...</option>
                <?php if (isset($categorias) && count($categorias) > 0):
                    foreach ($categorias as $categoria):
                        $selected = (isset($id) && $id != '' && $produto[0]->categoria == $categoria->id) ? 'selected' : '';
                        echo "<option value='{$categoria->id}' {$selected}>{$categoria->descricao}</option>";
                    endforeach;
                endif; ?>
            </select>
        </div>

        <div class="box-6">
            <?php
            $imagem = isset($id) && $id != '' ? $produto[0]->imagem : 'produto-padrao.png';
            $dirImagem = 'lib/img/upload/' . $imagem;
            $imagemAlt = $imagem === 'produto-padrao.png' ? 'Escolha uma imagem...' : 'Imagem do Produto';
            ?>
            <label for="img" class="fonte16 fnc-preto-azulado mg-t-3 mg-b-3">
                <i class="fa-solid fa-file-image fonte20 fnc-cinza"></i>
                <?php echo $imagemAlt; ?>
            </label>
            <input type="file" id="img" name="imagem" onchange="mostrar(this)" value="<?php echo $imagem; ?>">
            <img class="logo-150 mg-b-2" id="foto" src="<?php echo $dirImagem; ?>" alt="<?php echo $imagemAlt; ?>">
        </div>


        <div class="box-12" style="align-items: center;">
            <input type="submit" value="Cadastrar" class="btn-10 bg-primario mg-t4">
        </div>
    </form>
</div>