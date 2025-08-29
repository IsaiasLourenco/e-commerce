<?php

namespace App\Services;

use App\Models\Dao\VendaDao;
use App\Models\ItensVenda;
use App\Models\Venda;
use Exception;
use PDOException;

class VendaService
{

   private VendaDao $vendaDao;

   public function __construct()
   {
      $this->vendaDao = new VendaDao();
   }

   public function inserirVenda($dados)
   {

      if ($dados instanceof Venda):
         $dados = $dados->toArray();
      endif;

      $venda = new Venda();
      $venda->setid(null);
      $venda->setValor($dados['valor']);
      $venda->setCliente($dados['cliente']);
      $venda->setStatus($dados['status']);

      try {

         $this->vendaDao->iniciarTransacao();

         $idvenda = $this->vendaDao->adicionar($venda);
         $venda->setid($idvenda);
         $id = $venda->getid();
   #var_dump($dados);
         if (!empty($dados['itensvenda'])):
            foreach ($dados['itensvenda'] as $item):

               $itens_venda = new ItensVenda();
               $itensVenda->setVenda($id);
               $itensVenda->setProduto($item['produto']);
               $itensVenda->setQtde($item['quantidade']);
               $itensVenda->setPrecoUni($item['valorunitario']);
               $itensVenda->setSubTotal($item['valorunitario'] * $item['valorunitario']);

               $this->vendaDao->adicionarItens($itensVenda);
            endforeach;
         endif;
         
         $this->vendaDao->confirmarTransacao();
         return $dados['itensvenda'];
      } catch (PDOException $e) {
         $this->vendaDao->reverterTransacao();
         throw new Exception("Erro ao inserir venda: " . $e->getMessage());
      }
   }
}
