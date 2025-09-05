<?php 
namespace App\Controllers;

use App\Models\Dao\DashBoardDao;

class PainelController
{   
    public function index(): void
    {
        $dashDao = new DashBoardDao();

        $indicadores = $dashDao->indicadores();
        $produtosMaisVendidos = $dashDao->produtosMaisVendidos();
        $vendaPorMes = $dashDao->vendasPorMes();
        $categoriaMaisVendida = $dashDao->categoriasMaisVendidas();
        
        require_once __DIR__ . '/../views/painel/index.php';
    }
}
