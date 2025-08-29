<?php require_once 'Views/shared/header.php'; ?>
<section class="info mg-t-6">
    <div class="container flex justify-center">
        <div class="box-2 bg-branco flex justify-center item-centro pd-10">
            <i class="fa-solid fa-check fonte40 fnc-primario mg-r-1"></i>
            <p class="fonte16"> Qualidade</p>
        </div>
        <div class="box-2 bg-branco flex justify-center item-centro pd-10">
            <i class="fa-solid fa-truck-arrow-right fonte40 fnc-primario mg-r-1"></i>
            <p class="fonte16"> Frete Gratis </p>
        </div>
        <div class="box-2 bg-branco flex justify-center item-centro pd-10">
            <i class="fa-solid fa-truck-fast fonte40 fnc-primario mg-r-1"></i>
            <p class="fonte16"> Entrega Rápida </p>
        </div>
        <div class="box-2 bg-branco flex justify-center item-centro pd-10">
            <i class="fa-solid fa-phone-volume fonte40 fnc-primario mg-r-1"></i>
            <p class="fonte16"> Suporte 24/7</p>
        </div>
    </div>
</section>
<div class="limpar"></div>
<!-- sessão de carregamento de produtos -->
<section class="destaque mg-t-6">
    <div class="container">

        <div class="box-12 flex justify-start item-centro mg-b-4 mg-t-6">
            <h1 class=" fnc-secundario fonte24">PRODUTOS EM DESTAQUE </h1>
            <div class="divider-pontilhado mg-l-2 wd-50"></div>
        </div>
        <!-- LISTAGEM DE PRODUTOS -->
        <div class="box-12 flex justify-center item-centro flex-wrap">
            <?php
            if (isset($produtos) && count($produtos) > 0):
                foreach ($produtos as $produto): ?>

                    <div class="box-3 bg-branco shadow-down pd-10 mg-b-4">
                        <div class="box-12 img">
                            <img src="lib/img/upload/produtos/<?= $produto->imagem; ?>" alt="">
                            <div class="box-12 flex justify-center item-centro oculta">
                                <div class="box-2 flex justify-center item-centro borda-1 bg-secundario-hover fnc-primario-hover">
                                    <a href="index.php?controller=CarrinhoController&metodo=inserirProdutoCarrinho&id=<?= $produto->id; ?>">
                                        <i class="fa-solid fa-cart-shopping fnc-primario-hover fonte18 fnc-secundario"></i>
                                    </a>
                                </div>
                                <div class="box-2 flex justify-center item-centro borda-1 bg-secundario-hover fnc-primario-hover">
                                    <i class="fa-solid fa-heart fnc-primario-hover fonte18 fnc-secundario"></i>
                                </div>
                            </div>
                        </div>

                        <div class="box-12 footer pd-20">

                            <p class="fonte20 fnc-secundario fnc-primario-hover txt-c poppins-black"><?= $formater->formataTextoCap($produto->nomeE); ?></p>
                            <div class="divider bg-cinza mg-b-1 mg-t-1"></div>
                            <p class="fonte22 fnc-secundario fw-300 roboto-condensed fnc-primario-hover txt-c">R$ <?= $formater->converterMoeda($produto->preco); ?></p>
                        </div>
                    </div>

            <?php endforeach;
            endif;

            ?>

        </div>
    </div>
</section>
<div class="limpar"></div>
<!-- sessão de ofertas -->
<section class="ofertas mg-t-4">
    <div class="container">
        <div class="box-12 flex justify-start item-centro mg-b-4 mg-t-6">
            <h1 class=" fnc-secundario fonte24">OFERTAS ESPECIAIS </h1>
            <div class="divider-pontilhado mg-l-2 wd-50"></div>
        </div>
    </div>
    <div class="container flex justify-center">
        <div class="box-5 overflow-hidden">
            <div class="img">
                <img src="lib/img/sapatos.jpg" alt="">

                <div class="oculta pd-t-6">
                    <p class="fnc-branco txt-c block mg-b-1 fonte24 roboto-condensed fw-900">Sapatos com <br> 20% de descontos</p>
                    <a href="" class="btn bg-primario fnc-secundario mg-auto">Comprar</a>
                </div>

            </div>
        </div>

        <div class="box-5 overflow-hidden">
            <div class="img">
                <img src="lib/img/ternos.jpg" alt="">

                <div class="oculta pd-t-6">
                    <p class="fnc-branco txt-c block mg-b-1 fonte24 roboto-condensed fw-900">Ternos com <br>20% de descontos</p>
                    <a href="" class="btn bg-primario fnc-secundario mg-auto">Comprar</a>
                </div>

            </div>
        </div>

    </div>
</section>


<?php
require_once 'Views/shared/footer.php';
?>