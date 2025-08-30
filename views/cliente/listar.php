<div class="box-12 mg-t-12">
    <div class="box-8">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-person"></i> Lista de Clientes
        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="index.php?controller=ClienteController&metodo=index" class=" bg-primario fnc-secundario pd-10 radius fw-600">Novo Cliente</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <table class="zebra wd-100 collapse" id="tabela">
        <thead>
            <tr>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Nome</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Nacimento</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">CPF</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Email</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Status</th>
                <th class="fonte12 espaco-letra fw-bold" style="text-align: center;">Açoes</th>
            </tr>
        </thead>
        <tbody>

            <?php if (isset($clientes) && count($clientes) > 0):
                foreach ($clientes as $cliente):
            ?>
                    <tr class="zebra">
                        <td class="espaco-letra fw-300" style="text-align: center;"><?= $cliente->nome; ?></td>
                        <td class="espaco-letra fw-300" style="text-align: center;">
                            <?= !empty($cliente->data_nascimento) ? date('d/m/Y', strtotime($cliente->data_nascimento)) : '—'; ?>
                        </td>
                        <td class="espaco-letra fw-300" style="text-align: center;"><?= $cliente->cpf; ?></td>
                        <td class="espaco-letra fw-300" style="text-align: center;"><?= $cliente->email; ?></td>
                        <td style="text-align: center;">
                            <?php if ($cliente->ativo == '1'): ?>
                                <span style="cursor: pointer;" class="ativo" data-id="<?= $cliente->id; ?>" data-status="0" data-url="index.php?controller=ClienteController&metodo=alterarStatus">
                                    <i class="fa-solid fa-lock-open fonte16 fnc-sucesso"></i>
                                </span>
                            <?php else: ?>
                                <span style="cursor: pointer;" class="ativo" data-id="<?= $cliente->id; ?>" data-status="1" data-url="index.php?controller=ClienteController&metodo=alterarStatus">
                                    <i class="fa-solid fa-lock fonte16 fnc-error"></i>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="flex justify-center item-centro">
                            <a href="index.php?controller=ClienteController&metodo=deleteConfirm&id=<?= $cliente->id; ?>">
                                <i class="fa-solid fa-trash-can fonte12 mg-r-2 fnc-cinza"></i>
                            </a>
                            <a href="index.php?controller=ClienteController&metodo=index&id=<?= $cliente->id; ?>">
                                <i class="fa-solid fa-pen fonte12 fnc-vermelho-claro"></i>
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