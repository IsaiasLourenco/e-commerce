<div class="box-12 mg-t-12">
    <h1 class="fonte30 poppins-medium">Dashboard</h1>
    <div class="divider mg-t-2 mg-b-2"></div>
    <!-- $indicadores   $produtosMaisVendidos   $vendaPorMes   $categoriaMaisVendida -->
    <div class="box-12 flex justify-around">

        <div class="box-3 shadow-down radius pd-20 bg-cinza">
            <h2 class="fonte18 poppins-medium fw-400 txt-c">Faturamento</h2>
            <div class="divider bg-preto-azulado-escuro"></div>
            <p class="fonte22 poppins-medium txt-c">R$ <?= $formater->converterMoeda($indicadores[0]["FATURAMENTO"]); ?></p>
        </div>

        <div class="box-3 shadow-down radius pd-20 bg-cinza">
            <h2 class="fonte18 poppins-medium fw-400 txt-c">Total de Vendas</h2>
            <div class="divider bg-preto-azulado-escuro"></div>
            <p class="fonte22 poppins-medium txt-c"><?= $indicadores[0]["TOTALVENDAS"]; ?></p>

        </div>

        <div class="box-3 shadow-down radius pd-20 bg-cinza">
            <h2 class="fonte18 poppins-medium fw-400 txt-c">Ticket Medio</h2>
            <div class="divider bg-preto-azulado-escuro"></div>
            <p class="fonte22 poppins-medium txt-c">R$ <?= $formater->converterMoeda($indicadores[0]["TICKETMEDIO"]); ?></p>

        </div>
    </div>

    <!-- CRIANDO GRAFICOS COM CHART JS -->
    <!-- GRAFICO DE VENDAS POR MES -->
    <div class="box-12 line mg-t-6">
        <?php
        $labelsV = [];
        $valoresV = [];
        foreach ($vendaPorMes as $venda):
            $labelsV[] = $venda['DATA'];
            $valoresV[] = $venda['TOTAL'];
        endforeach;
        ?>
        <h2 class="fonte18 poppins-medium fw-400 txt-c captalize">Vendas por mês</h2>
        <div class="divider bg-cinza"></div>
        <canvas id="vendasPorMes"></canvas>

    </div>

    <!-- GRAFICO DE PRODUTOS MAIS VENDIDOS -->
    <div class="box-6 mg-t-6">
        <?php
        $labels = [];
        $valores = [];
        foreach ($produtosMaisVendidos as $produto):
            $labels[] = $produto['NOME'];
            $valores[] = $produto['QUANTIDADE'];
        endforeach;
        ?>
        <h2 class="fonte18 fnc-ter poppins-medium fw-400 txt-c captalize">os 10 PRODUTOS MAIS VENDIDOS</h2>
        <div class="divider bg-cinza"></div>
        <canvas id="produtosMaisVendidos"></canvas>

    </div>

    <!-- GRAFICO DE CATEGORIAS MAIS VENDIDAAS -->
    <div class="box-6 mg-t-6">
    <?php
        $labelsC = [];
        $valoresC = [];
        foreach ($categoriaMaisVendida as $categoria):
            $labelsC[] = $categoria['DESCRICAO'];
            $valoresC[] = $categoria['TOTAL'];
        endforeach;
        ?>
        <h2 class="fonte18 poppins-medium fw-400 txt-c captalize">Categorias mais vendidas</h2>
        <div class="divider bg-cinza"></div>
        <canvas id="categoriasMaisVendidas"></canvas>
    </div>

</div>
<!-- CODIGO JAVA SCRIPT PARA RECUPERAR OS DADOS DO BANCO E CRIAR OS GRAFICOS -->
<script>
    // grafico de barras dos produtos mais vendidos
    new Chart(document.getElementById('produtosMaisVendidos'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels); ?>,
            datasets: [{
                label: 'Quantidade Vendida',
                data: <?= json_encode($valores); ?>,
                backgroundColor: '#afdeee'
            }]
        }
    });

    // grafico de vendas por mês   

    new Chart(document.getElementById('vendasPorMes'), {
        type: 'line',
        data: {
            labels: <?= json_encode($labelsV); ?>,
            datasets: [{
                label: 'Total de Vendas',
                data: <?= json_encode($valoresV ); ?>,
                borderColor: '#FF6384',
                fill: true,
                tension: 0.3
            }]
        }
    });

    // grafico de categorias mais vendidas

    new Chart(document.getElementById('categoriasMaisVendidas'), {
         type: 'pie',
         data: {
             labels:<?= json_encode($labelsC); ?>,
             datasets: [{
                 data: <?= json_encode($valoresV); ?>,
                 backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#9966FF']
             }]
         }
     });

</script>