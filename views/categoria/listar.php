    <div class="box-12 mg-t-12">
        <div class="box-8">
            <h2 class=" poppins-medium fw-300 fonte22">
                <i class="fa-solid fa-list"></i> Lista de Categorias
            </h2>
        </div>
        <div class="box-4 flex justify-end item-centro">
            <a href="index.php?controller=CategoriaController&metodo=index" class=" bg-primario fnc-secundario pd-10 radius fw-600">Nova Categoria</a>
        </div>
    </div>

    <div class="box-12 divider mg-t-1 mg-b-2"></div>

    <div class="box-12">
        <table class="zebra wd-100 collapse" id="tabela">
            <thead>
                <tr>
                    <th class="pd-10" style="text-align: center;">Código</th>
                    <th class="pd-10" style="text-align: center;">Descrição</th>
                    <th class="pd-10" style="text-align: center;">Status</th>
                    <th class="pd-10" style="text-align: center;">Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if (isset($categorias) && count($categorias)):
                    foreach ($categorias as $categoria): ?>
                        <tr>
                            <td class="pd-10" style="text-align: center;"><?= $formater->zeroEsquerda($categoria->id, 6); ?></td>
                            <td class="pd-10" style="text-align: center;"><?= $categoria->descricao; ?></td>
                            <td  style="text-align: center;">
                                <?php if ($categoria->status_categoria == 'A'): ?>
                                    <span class="ativo" data-id="<?= $categoria->id; ?>" data-status="I" data-url="index.php?controller=CategoriaController&metodo=alterarStatus">
                                        <i class="fa-solid fa-lock-open fonte14 fnc-sucesso" style="cursor: pointer;"></i>
                                    </span>
                                <?php else: ?>
                                    <span class="ativo" data-id="<?= $categoria->id; ?>" data-status="A" data-url="index.php?controller=CategoriaController&metodo=alterarStatus">
                                        <i class="fa-solid fa-lock fonte16 fnc-error" style="cursor: pointer;"></i>
                                    </span>

                                <?php endif; ?>
                            </td>
                            <td class="pd-10 flex justify-center item-centro" style="text-align: center;">
                                <a href="index.php?controller=CategoriaController&metodo=deleteConfirm&id=<?= $categoria->id; ?>"><i class="fa-solid fa-trash-can mg-r-2 fnc-secundario fonte14"></i> </a>
                                <a href="index.php?controller=CategoriaController&metodo=index&id=<?= $categoria->id; ?>"><i class="fa-solid fa-pen fnc-primario fonte14"></i> </a>

                            </td>
                        </tr>
                <?php endforeach;
                endif; ?>


            </tbody>
        </table>
    </div>