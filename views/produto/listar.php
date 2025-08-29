<div class="box-12 mg-t-12">
    <div class="box-8">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-bag-shopping"></i> Lista de Produtos
        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="index.php?controller=ProdutoController&metodo=index" class=" bg-primario fnc-secundario pd-10 radius fw-600">Novo Produto</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <table class="zebra wd-100 collapse" id="tabela">
        <thead>
            <tr>
                <th class="pd-10">Código</th>
                <th class="pd-10">Data Cadastro</th>
                <th class="pd-10">Nome </th>
                <th class="pd-10">Quantidade</th>
                <th class="pd-10">Preco de Custo</th>
                <th class="pd-10">Preço</th>
                <th class="pd-10">Desconto</th>
                <th class="pd-10">Status</th>
                <th class="pd-10">Ação</th>
            </tr>
        </thead>

        <tbody>
            <?php if (isset($produtos) && count($produtos)):
                foreach ($produtos as $produto):
                    if (method_exists($produto, 'getCodigo') && is_null($produto->getCodigo())):
                        $produto->__set('codigo', '000000');
                    endif;

                    $codigoFormatado = $formater->zeroEsquerda((int) ($produto->getCodigo() ?? 0), 6);
                    $dataCadastro = method_exists($produto, 'getDataCadastro') ? $produto->getDataCadastro() : '';
                    $nome = method_exists($produto, 'getNome') ? $produto->getNome() : '';
                    $quantidade = method_exists($produto, 'getQuantidade') ? $produto->getQuantidade() : '';
                    $precoCusto = method_exists($produto, 'getPrecoCusto') ? $produto->getPrecoCusto() : '';
                    $preco = method_exists($produto, 'getPreco') ? $produto->getPreco() : '';
                    $desconto = method_exists($produto, 'getDesconto') ? $produto->getDesconto() : '';
                    $status = method_exists($produto, 'getStatusProduto') ? $produto->getStatusProduto() : 'A';
                    $id = method_exists($produto, 'getid') ? $produto->getid() : '';
            ?>
                    <tr>
                        <td class="pd-10 txt-c"><?= $codigoFormatado; ?></td>
                        <td class="pd-10 txt-c"><?= $formater->formatarDataTime($dataCadastro); ?></td>
                        <td class="pd-10 txt-c"><?= $formater->formataTextoCap($nome); ?></td>
                        <td class="pd-10 txt-c"><?= $quantidade; ?></td>

                        <?php
                        $precoCustoFloat = (float) ($produto->getPrecoCusto() ?: 0);
                        $precoFloat = (float) ($produto->getPreco() ?: 0);
                        ?>

                        <td class="pd-10 txt-c">R$ <?= $formater->converterMoeda($precoCustoFloat); ?></td>
                        <td class="pd-10 txt-c">R$ <?= $formater->converterMoeda($precoFloat); ?></td>
                        <td class="pd-10 txt-c"><?= $desconto; ?> %</td>
                        <td class="txt-c">
                            <?php if ($status == 'A'): ?>
                                <span class="ativo" data-id="<?= $id; ?>" data-status="I" data-url="index.php?controller=ProdutoController&metodo=alterarStatus">
                                    <i class="fa-solid fa-lock-open fonte14 fnc-sucesso"></i>
                                </span>
                            <?php else: ?>
                                <span class="ativo" data-id="<?= $id; ?>" data-status="A" data-url="index.php?controller=ProdutoController&metodo=alterarStatus">
                                    <i class="fa-solid fa-lock fonte16 fnc-error"></i>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="pd-10 txt-c flex justify-center item-centro">
                            <a href="index.php?controller=ProdutoController&metodo=deleteConfirm&id=<?= $id; ?>"><i class="fa-solid fa-trash-can mg-r-2 fnc-secundario fonte14"></i></a>
                            <a href="index.php?controller=ProdutoController&metodo=index&id=<?= $id; ?>"><i class="fa-solid fa-pen fnc-primario fonte14"></i></a>
                        </td>
                    </tr>
            <?php endforeach;
            endif; ?>
        </tbody>
    </table>
</div>