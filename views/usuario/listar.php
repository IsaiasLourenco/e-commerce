<div class="box-12 mg-t-12">
    <div class="box-8">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-user mg-r-1 fonte22 fnc-secundario"></i> Lista de Usuario
        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="index.php?controller=UsuarioController&metodo=index" class=" bg-primario fnc-secundario pd-10 radius fw-600">Novo Usuario</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
<table class="zebra wd-100 collapse" id="tabela">
    <thead>
        <tr>
            <th class="fonte12 espaco-letra fw-bold">Data Cadastro</th>
            <th class="fonte12 espaco-letra fw-bold">Nome</th>
            <th class="fonte12 espaco-letra fw-bold">Email</th>
            <th class="fonte12 espaco-letra fw-bold">Perfil</th>
            <th class="fonte12 espaco-letra fw-bold">Status</th>
            <th class="fonte12 espaco-letra fw-bold">Açoes</th>
        </tr>
    </thead>
    <tbody>

        <?php
        #var_dump($proprietario);
        if (isset($clientes) && count($clientes) > 0):
            foreach ($clientes as  $cliente):
                $dataCadastro = $cliente->DATACADASTRO ?: date('0000-00-00');
        ?>
                <tr class=" zebra">
                    <td class="espaco-letra fw-300 txt-c"><?= $formater->formatarDataTime($dataCadastro); ?></td>
                    <td class="espaco-letra fw-300 txt-c"><?= $formater->formataTextoCap($cliente->NOME); ?></td>
                    <td class="espaco-letra fw-300 txt-c"> <?= $formater->formataTextoLow($cliente->EMAIL); ?></td>
                    <td class="espaco-letra fw-300 txt-c"><?php if ($cliente->PERFIL == '1'): echo 'Administrador';
                                                                    else: echo 'Usuário';
                                                                    endif; ?></td>
                    <td class=" txt-c">
                        <?php if ($cliente->ATIVO == '1'): ?>
                            <span class="ativo" data-id="<?= $cliente->ID; ?>" data-status="0" data-url="index.php?controller=UsuarioController&metodo=alterarStatus">
                                <i class="fa-solid fa-lock-open fonte16 fnc-sucesso"></i>
                            </span>
                        <?php else: ?>
                            <span class="ativo" data-id="<?= $cliente->ID; ?>" data-status="1" data-url="index.php?controller=UsuarioController&metodo=alterarStatus">
                                <i class="fa-solid fa-lock fonte16 fnc-error"></i>
                            </span>

                        <?php endif; ?>
                    </td>
                    <td class="flex justify-center item-centro">
                        <a href="index.php?controller=UsuarioController&metodo=deleteConfirm&id=<?= $cliente->ID; ?>">
                            <i class="fa-solid fa-trash-can fonte12 mg-r-2 fnc-cinza"></i>
                        </a>
                        <a href="index.php?controller=UsuarioController&metodo=index&id=<?= $cliente->ID; ?>">
                            <i class="fa-solid fa-pen fonte12 fnc-vermelho-claro "></i>
                        </a>

                    </td>
                </tr>
            <?php endforeach;
        else: ?>
           <td colspan="7" class="pd-t-2"> 
           <h1 class="txt-c fonte16 poppins-medium"> Nenhum registro na base de dados </h1>
           </td>
        <?php endif; ?>


    </tbody>
    <tfoot>

    </tfoot>
</table>   
    
</div>
