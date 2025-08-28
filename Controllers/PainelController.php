<?php 
namespace App\Controllers;

use App\Models\Dao\DashBoardDao;
class PainelController
{   
    public function index()
    {
        $indicadores = (new DashBoardDao())->indicadores();
        $produtosMaisVendidos = (new DashBoardDao())->produtoMaisVendidos();
        $vendaPorMes = (new DashBoardDao())->vendasPorMes();
        $categoriaMaisVendida = (new DashBoardDao())->categoriasMaisVendidas();
        
        require_once "views/painel/index.php";
    }
    
}