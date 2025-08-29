<div class="box-12 mg-t-12">
    <div class="box-8">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-users"></i> Lista de Perfil de acesso
        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="index.php?controller=PerfilController&metodo=index" class=" bg-primario fnc-secundario pd-10 radius fw-600">Novo Perfil</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <table class="zebra wd-100 collapse" id="tabela">
        <thead>
            <tr>
                <th class="pd-10" style="text-align: center;">Código</th>
                <th class="pd-10" style="text-align: center;">Descrição</th>
                <th class="pd-10" style="text-align: center;">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (isset($perfis) && count($perfis)):
                foreach ($perfis as $perfil): ?>
                    <tr>
                        <td class="pd-10" style="text-align: center;"><?= $formater->zeroEsquerda($perfil->id, 6); ?></td>
                        <td class="pd-10" style="text-align: center;"><?= $formater->formataTextoCap($perfil->descricao); ?></td>

                        <td class="pd-10 flex justify-center item-centro" style="text-align: center;">
                            <a href="index.php?controller=PerfilController&metodo=deleteConfirm&id=<?= $perfil->id; ?>"><i class="fa-solid fa-trash-can mg-r-2 fnc-secundario fonte14" title="Apagar Registro"></i> </a>
                            <a href="index.php?controller=PerfilController&metodo=index&id=<?= $perfil->id; ?>"><i class="fa-solid fa-pen fnc-primario fonte14" title="Editar Registro"></i> </a>

                        </td>
                    </tr>
            <?php endforeach;
            endif; ?>


        </tbody>
    </table>
</div>