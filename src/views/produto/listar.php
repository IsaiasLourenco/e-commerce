<div class="box-12 mg-t-1">
    <div class="box-8">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-tags mg-r-1 fonte22 fnc-secundario"></i> Lista de Produtos
        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="index.php?controller=ProdutoController&metodo=index" class=" bg-primario fnc-secundario pd-10 radius fw-600">Novo Produto</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <table class="zebra wd-100 collapse">
        <thead>
            <tr>
                <th class="pd-10">Código</th>
                <th class="pd-10">Data Cadastro</th>
                <th class="pd-10">Nome </th>
                <th class="pd-10">Quantidade</th>
                <th class="pd-10">Preco de Custo</th>
                <th class="pd-10">Preço</th>
                <th class="pd-10">Desconto</th>
                <th class="pd-10">Estatus</th>
                <th class="pd-10">Ação</th>
            </tr>
        </thead>

        <tbody>
            <?php if (isset($produtos) && count($produtos)):
                foreach ($produtos as $produto):
                    if (is_null($produto->CODIGO)): $produto->CODIGO = 0;
                    endif; ?>

                    <tr>
                        <td class="pd-10 txt-c"><?= $formater->zeroEsquerda($produto->CODIGO, 6); ?></td>
                        <td class="pd-10 txt-c"><?= $formater->formatarDataTime($produto->DATACADASTRO); ?></td>
                        <td class="pd-10 txt-c"><?= $formater->formataTextoCap($produto->NOME); ?></td>
                        <td class="pd-10 txt-c"><?= $produto->QUANTIDADE; ?></td>
                        <td class="pd-10 txt-c">R$ <?= $formater->converterMoeda($produto->PRECODECUSTO); ?></td>
                        <td class="pd-10 txt-c">R$ <?= $formater->converterMoeda($produto->PRECO); ?></td>
                        <td class="pd-10 txt-c"><?= $produto->DESCONTO; ?> %</td>
                        <td class=" txt-c">
                            <?php if ($produto->ESTATUS == 'A'): ?>
                                <span class="ativo" data-id="<?= $produto->ID; ?>" data-status="I" data-url="index.php?controller=ProdutoController&metodo=alterarStatus">
                                    <i class="fa-solid fa-lock-open fonte14 fnc-sucesso"></i>
                                </span>
                            <?php else: ?>
                                <span class="ativo" data-id="<?= $produto->ID; ?>" data-status="A" data-url="index.php?controller=ProdutoController&metodo=alterarStatus">
                                    <i class="fa-solid fa-lock fonte16 fnc-error"></i>
                                </span>

                            <?php endif; ?>
                        </td>
                        <td class="pd-10 txt-c flex justify-center item-centro">
                            <a href="index.php?controller=ProdutoController&metodo=deleteConfirm&id=<?= $produto->ID; ?>"><i class="fa-solid fa-trash-can mg-r-2 fnc-secundario fonte14"></i> </a>
                            <a href="index.php?controller=ProdutoController&metodo=index&id=<?= $produto->ID; ?>"><i class="fa-solid fa-pen fnc-primario fonte14"></i> </a>
                        </td>
                    </tr>
            <?php endforeach;
            endif; ?>

        </tbody>
    </table>
</div>
