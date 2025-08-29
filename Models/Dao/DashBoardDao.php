<?php

namespace App\Models\Dao;

use App\Models\Contexto;
use PDO;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class DashBoardDao extends Contexto
{
    public function indicadores()
    {
        $sql = "SELECT sum(valor) AS faturamento,  
                      (SELECT count(*) FROM venda) AS totalvendas, 
                      (sum(valor) / nullif((SELECT count(*) FROM venda), 0)) AS ticketmedio FROM venda";
        $stmt = $this->executarConsulta($sql);
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }

    public function produtosMaisVendidos()
    {
        $sql = "SELECT p.id, p.nome, sum(i.quantidade) AS quantidade FROM itens_venda INNER JOIN produto p ON p.id = i.produto GROUP BY 1,2 ORDER BY 3 DESC LIMIT 10";
        $stmt = $this->executarConsulta($sql);
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }

    public function vendasPorMes()
    {
        $sql = "SELECT sum(valor) AS total, DATE(data_venda) AS data FROM venda GROUP BY data_venda ORDER BY total DESC ";
        $stmt = $this->executarConsulta($sql);
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }

    public function categoriasMaisVendidas()
    {
        $sql = "SELECT  p.categoria,  c.descricao,  sum(i.quantidade) AS total FROM itensvenda i INNER JOIN produto p ON p.id = i.produto INNER JOIN categoria c ON c.id = p.categoria GROUP BY 1,2 ORDER BY 3 DESC LIMIT 10 ";
        $stmt = $this->executarConsulta($sql);
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }
}
