<?php

namespace App\Models\Dao;

use App\Models\Contexto;
use PDO;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class DashBoardDao extends Contexto
{
    public function indicadores()
    {
        $sql = "SELECT SUM(VALOR) AS FATURAMENTO,  
                      (SELECT COUNT(*) FROM VENDA) AS TOTALVENDAS, 
                      (SUM(VALOR) / NULLIF((SELECT COUNT(*) FROM VENDA), 0)) AS TICKETMEDIO
                 FROM VENDA ";
        $stmt = $this->executarConsulta($sql);
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }

    public function produtoMaisVendidos()
    {
        $sql = "SELECT P.ID, P.NOME, SUM(I.QUANTIDADE) AS QUANTIDADE
                  FROM ITENSVENDA I  
            INNER JOIN PRODUTO P ON P.ID = I.PRODUTO
              GROUP BY 1,2 
              ORDER BY 3 DESC
                 LIMIT 10";
        $stmt = $this->executarConsulta($sql);
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }

    public function vendasPorMes()
    {
        $sql = "SELECT SUM(VALOR) AS TOTAL,  DATE(DATAVENDA) AS DATA
                  FROM VENDA
              GROUP BY DATA
              ORDER BY TOTAL DESC ";
        $stmt = $this->executarConsulta($sql);
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }

    public function categoriasMaisVendidas()
    {
        $sql = "SELECT  P.CATEGORIA,  C.DESCRICAO,  SUM(I.QUANTIDADE) AS TOTAL
                   FROM ITENSVENDA I  
             INNER JOIN PRODUTO P ON P.ID = I.PRODUTO  
             INNER JOIN CATEGORIA C ON C.ID = P.CATEGORIA
               GROUP BY 1,2
               ORDER BY 3 DESC 
               LIMIT 10 ";
        $stmt = $this->executarConsulta($sql);
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }
}
