<div class="box-12 mg-t-12">
    <h2 class=" poppins-medium fw-300 fonte22">
        <i class="fa-solid fa-users mg-r-1 fonte22 fnc-secundario"></i>
        <?php
        $titulo = isset($id) && $id <> '' ?  'Atualizar Perfil ' : 'Cadastrar Perfil';
        echo $titulo;
        ?>
    </h2>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <form action="" method="POST">
        <div>
            <input type="hidden" name="id" value="<?php if (isset($id) && $id <> ''): echo $perfil[0]->id;
                                                    endif; ?>">
        </div>
        <div class="box-12"><label for="">Novo Perfil</label></div>
        <div class="box-6"> <input type="text" name="descricao" value="<?php if (isset($id) && $id <> ''): echo $perfil[0]->DESCRICAO;
                                                                        endif; ?>"></div>

        <div class="box-12">
            <input type="submit" value="cadastrar" class="captalize btn bg-primario fnc-secundario">
        </div>
    </form>
</div>