<div class="box-12 mg-t-1">
    <div class="box-8">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-tags mg-r-1 fonte22 fnc-secundario"></i> Lista de Perfil de acesso
        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="index.php?controller=PerfilController&metodo=index" class=" bg-primario fnc-secundario pd-10 radius fw-600">Novo Perfil</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <table class="zebra wd-100 collapse">
        <thead>
            <tr>
                <th class="pd-10">Código</th>
                <th class="pd-10">Descrição</th>
                <th class="pd-10">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (isset($perfis) && count($perfis)):
                foreach ($perfis as $perfil): ?>
                    <tr>
                        <td class="pd-10 txt-c"><?= $formater->zeroEsquerda($perfil->ID, 6); ?></td>
                        <td class="pd-10 txt-c"><?= $formater->formataTextoCap($perfil->DESCRICAO); ?></td>

                        <td class="pd-10 txt-c flex justify-center item-centro">
                            <a href="index.php?controller=PerfilController&metodo=deleteConfirm&id=<?= $perfil->ID; ?>"><i class="fa-solid fa-trash-can mg-r-2 fnc-secundario fonte14"></i> </a>
                            <a href="index.php?controller=PerfilController&metodo=index&id=<?= $perfil->ID; ?>"><i class="fa-solid fa-pen fnc-primario fonte14"></i> </a>

                        </td>
                    </tr>
            <?php endforeach;
            endif; ?>


        </tbody>
    </table>
</div>