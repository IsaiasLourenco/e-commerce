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
      $venda->setId(null);
      $venda->setValor($dados['valor']);
      $venda->setCliente($dados['cliente']);
      $venda->setStatus($dados['status']);

      try {

         $this->vendaDao->iniciarTransacao();

         $idvenda = $this->vendaDao->adicionar($venda);
         $venda->setId($idvenda);
         $id = $venda->getId();

         if (!empty($dados['itensVenda'])):
            foreach ($dados['itensVenda'] as $item):

               $itensVenda = new ItensVenda();
               $itensVenda->setVenda($id);
               $itensVenda->setProduto($item['produto']);
               $itensVenda->setQtde($item['quantidade']);
               $itensVenda->setPrecoUni($item['precounitario']);
               $itensVenda->setSubTotal($item['quantidade'] * $item['precounitario']);

               $this->vendaDao->adicionarItens($itensVenda);
            endforeach;

         endif;
         $this->vendaDao->confirmarTransacao();
         return $dados['itensVenda'];
      } catch (PDOException $e) {
         $this->vendaDao->reverterTransacao();
         throw new Exception("Erro ao inserir venda: " . $e->getMessage());
      }
   }
}
