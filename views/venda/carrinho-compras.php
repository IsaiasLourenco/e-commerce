<?php require_once "Views/shared/header.php";  ?>

<section class="mg-t-4">
    <div class="container flex justify-center">
        <div class="box-8">
            <h1 class="fonte26 fw-400">Meu carrinho de compras</h1>
            <form action="" method="POST" class="">
                <table class="wd-100 zebra collapse">
                    <thead class="bg-primario">
                        <tr>
                            <th class="pd-10 fnc-branco txt-c">Imagem</th>
                            <th class="pd-10 fnc-branco txt-c">Código</th>
                            <th class="pd-10 fnc-branco txt-c">Produto</th>
                            <th class="pd-10 fnc-branco txt-c">Qtde</th>
                            <th class="pd-10 fnc-branco txt-c">Preço</th>
                            <th class="pd-10 fnc-branco txt-c">Desconto</th>
                            <th class="pd-10 fnc-branco txt-c">Subtotal</th>
                            <th class="pd-10 fnc-branco txt-c">Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                    <?php
                    $total = 0;

                    if (!empty($_SESSION['carrinho'])):
                        foreach ($_SESSION['carrinho'] as $key => $item):
                            $preco = (float) $item['preco'];
                            $qtde = (int) $item['qtde'];
                            $desconto = isset($item['desc']) ? (float) $item['desc'] : 0;

                            $subtotal = $preco * $qtde; // Subtotal antes do desconto
                            $descontoValor = round(($subtotal * $desconto) / 100, 2); // Calcula o desconto e arredonda para 2 casas decimais
                            $subtotalFinal = round($subtotal - $descontoValor, 2); // Subtrai o desconto e arredonda

                            $total = round($total + $subtotalFinal, 2); // Soma ao total geral
                    ?>
                            <tr>

                                <td class="txt-c"><img class="logo-60 mg-auto" src="lib/img/upload/<?= htmlspecialchars($item['imagem']); ?>" alt="Imagem do Produto"></td>

                                <td class="txt-c">
                                    <?= $formater->zeroEsquerda(htmlspecialchars($item['id']), 6, '0'); ?>
                                </td>
                                <td class="txt-c">
                                    <?= $formater->formataTextoCap(htmlspecialchars($item['nome'])); ?>
                                </td>

                                <td class="pd-t-1 txt-c">
                                    <input class='qtde mg-auto' type='number' min='1' value='<?= $item['qtde']; ?>' data-linha="<?= $key; ?>" />
                                </td>

                                <td class="txt-c">
                                    R$ <?= number_format($item['preco'], 2, ',', '.'); ?>
                                </td>

                                <td class="txt-c">
                                    <?= $item['desc']; ?> %
                                </td>

                                <td class="txt-c">
                                    R$ <?= number_format($subtotal, 2, ',', '.'); ?>
                                </td>

                                <td class="txt-c">
                                    <a href="index.php?controller=CarrinhoController&metodo=atualizarCarrinho&linha=<?= $key; ?>" class="btn-action" title="Excluir produto">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="total-label">Total:</td>
                            <td class="total-value">R$ <?= number_format($total, 2, ',', '.'); ?></td>
                            <td></td>
                        </tr>

                    <?php else: ?>
                        <tr>
                            <td colspan="6">Seu carrinho está vazio.</td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="6">
                            <a href="index.php?controller=BaseController&metodo=index" class="btn bg-primario fnc-branco">Comprar Mais</a>
                            <a href="index.php?controller=CarrinhoController&metodo=finalizarCarrinho" class="btn bg-secundario mg-t-1 fnc-branco"> Finalizar Compra </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
    <div class="limpar"></div>
</section>