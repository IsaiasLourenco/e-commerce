<div class="box-12 mg-t-1">
    <h2 class=" poppins-medium fw-300 fonte22">
        <i class="fa-solid fa-bag-shopping mg-r-1 fonte22 fnc-secundario"></i> 
        <?php  
        $titulo = isset($id) && $id <> '' ?  'Atualizar Produto ' : 'Cadastrar Produto';
        echo $titulo;
        ?>
        
    </h2>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="box-12 mg-b-2">
            <input type="hidden" name="id" value="<?php if(isset($id) && $id <> ''): echo $produtos[0]->ID; endif;?>">
        </div>
        <div class="box-12 mg-b-2">
            <input type="hidden" name="estatus" value="<?php if(isset($id) && $id <> ''): echo $produtos[0]->ESTATUS; endif;?>">
        </div>


        <div class="box-6 mg-b-2">
            <label for="">Nome</label>
            <input type="text" name="nome" value="<?php if(isset($id) && $id <> ''): echo $produtos[0]->NOME; endif;?>">
        </div>


        <div class="box-6 mg-b-2">
            <label for="">Descrição</label>
            <input type="text" name="descricao" value="<?php if(isset($id) && $id <> ''): echo $produtos[0]->DESCRICAO; endif;?>">
        </div>


        <div class="box-3 mg-b-2">
            <label for="">Quantidade</label>
            <input type="text" name="quantidade" value="<?php if(isset($id) && $id <> ''): echo $produtos[0]->QUANTIDADE; endif;?>">
        </div>

        <div class="box-3 mg-b-2">
            <label for="">Preço</label>
            <input type="text" name="preco" value="<?php if(isset($id) && $id <> ''): echo $produtos[0]->PRECO; endif;?>">
        </div>

        <div class="box-3 mg-b-2">
            <label for="">Desconto</label>
            <input type="text" name="desconto" value="<?php if(isset($id) && $id <> ''): echo $produtos[0]->DESCONTO; endif;?>">
        </div>

        <div class="box-3 mg-b-2">
            <label for="">Preço de custo</label>
            <input type="text" name="precodecusto" value="<?php if(isset($id) && $id <> ''): echo $produtos[0]->PRECODECUSTO; endif;?>">
        </div>


        <div class="box-6 mg-b-2">
            <label for="">Cor</label>
            <input type="text" name="cor" value="<?php if(isset($id) && $id <> ''): echo $produtos[0]->COR; endif;?>">
        </div>



        <div class="box-6 mg-b-2">
            <label for="">Categoria</label>
            <select name="categoria" id="">
                <?php if (isset($categorias) && count( $categorias) > 0):
                    foreach ( $categorias as $valores):
                        $selected  = (isset($id) && $id != '' && $produto[0]->CATEGORIA == $valores->ID) ? 'selected' : '';
                        $descricao = $valores->DESCRICAO;
                        echo "<option value='{$valores->ID}' {$selected} > {$descricao} </option>"
                ?>

                <?php endforeach;
                endif; ?>
            </select>
        </div>


        <div class="box-6">
            <?php
            $imagem = isset($id) && $id != '' ?  $produtos[0]->IMAGEM : 'produto-padrao.png';
            $dirImagem = 'lib/img/upload/produtos/' . $imagem;
            $imagemAlt = $imagem === 'produto-padrao.png' ? 'Escolha um produto' : 'Imagem do produto';
            ?>
            <label for="img" class="file-label fonte12 fnc-branco txt-c mg-t-3 pd-10 ">
                <i class="fa-solid fa-file-image fonte16 fnc-cinza"></i>
                <?= $imagemAlt; ?>
            </label>
            <input type="file" id="img" name="imagem" onchange="mostrar(this)" value="<?= $imagem; ?>">
            <img class=" logo-200" id="foto" src="<?= $dirImagem ?>" alt="<?= $imagemAlt; ?>">

        </div>

        <div class="box-12 mg-t-2">
            <input type="submit" value="cadastrar" class="captalize btn bg-primario fnc-secundario">
        </div>
    </form>
</div>