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
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Data Cadastro</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Nome</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Descrição</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Quantidade</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Preço</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Desconto</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Preço Custo</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Status</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Açoes</th>
            </tr>
        </thead>
        <tbody>

            <?php if (isset($produtos) && count($produtos) > 0):
                foreach ($produtos as $produto):
                    $data_cadastro = $produto->data_cadastro ?: date('0000-00-00');
            ?>
                    <tr class="zebra">
                        <td class="espaco-letra fw-300" style="text-align: center;"><?= date('d/m/Y', strtotime($produto->getDataCadastro())); ?></td>
                        <td class="espaco-letra fw-300" style="text-align: center;"><?= $produto->nome; ?></td>
                        <td class="espaco-letra fw-300" style="text-align: center;"><?= $produto->descricao; ?></td>
                        <td class="espaco-letra fw-300" style="text-align: center;"><?= $produto->quantidade; ?></td>
                        <td class="espaco-letra fw-300" style="text-align: center;">
                            R$ <?= number_format((float) $produto->preco, 2, ',', '.'); ?>
                        </td>
                        <td class="espaco-letra fw-300" style="text-align: center;">
                            <?= number_format((float) $produto->desconto, 2, ',', '.'); ?> %
                        </td>
                        <td class="espaco-letra fw-300" style="text-align: center;">
                            R$ <?= number_format((float) $produto->preco_custo, 2, ',', '.'); ?>
                        </td>

                        <td style="text-align: center;">
                            <?php if ($produto->status_produto == 'A'): ?>
                                <span class="ativo" data-id="<?= $produto->id; ?>" data-status="I" data-url="index.php?controller=ProdutoController&metodo=alterarStatus">
                                    <i class="fa-solid fa-lock-open fonte14 fnc-sucesso" style="cursor: pointer;"></i>
                                    </span>
                                <?php else: ?>
                                    <span class="ativo" data-id="<?= $produto->id; ?>" data-status="A" data-url="index.php?controller=ProdutoController&metodo=alterarStatus">
                                        <i class="fa-solid fa-lock fonte16 fnc-error"></i>
                                </span>

                            <?php endif; ?>
                        </td>
                        <td class="flex justify-center item-centro">
                            <a href="index.php?controller=ProdutoController&metodo=deleteConfirm&id=<?= $produto->id; ?>">
                                <i class="fa-solid fa-trash-can fonte12 mg-r-2 fnc-cinza" title="Apagar Registro"></i>
                            </a>
                            <a href="index.php?controller=ProdutoController&metodo=index&id=<?= $produto->id; ?>">
                                <i class="fa-solid fa-pen fonte12 fnc-vermelho-claro" title="Editar Registro"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;
            else: ?>
                <tr>
                    <td colspan="6" class="pd-t-2">
                        <h1 class="txt-c fonte16 poppins-medium"> Nenhum registro na base de dados </h1>
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>

<script>
    let tabela = new DataTable('#tabela', {
        language: {
            emptyTable: "Nenhum registro na base de dados"
        },
        columnDefs: [{
            targets: '_all',
            defaultContent: ""
        }]
    });
</script>