<?php

namespace App\Models\Dao;

use App\Models\Contexto;
use App\Models\Cliente;
use PDO;

class ClienteDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('CLIENTES');
    }
    public function listarClientesAtivos()
    {
        return $this->listar('CLIENTES', "WHERE  ESTATUS = 'A' ");
    }
    public function obterPorId($id)
    {
        return $this->listar('CLIENTES', "WHERE ID = ?", [$id]);
    }
    public function autenticar($cliente){
        return $this->listar("CLIENTES","WHERE EMAIL = '".$cliente."' OR CPF = '".$cliente."'"); 
    }   
     public function validarDados($campo, $valor){
        $sql = "SELECT COUNT(*) as total FROM CLIENTES WHERE $campo = ?";
        $stmt = $this->executarConsulta($sql,[$valor]);
        $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
        return $retorno['total'] > 0;
     }

    public function adicionar(Cliente $cliente)
    {
        $atributos = array_keys($cliente->atributosPreenchidos());
        $valores = array_values($cliente->atributosPreenchidos());
        return $this->inserir('CLIENTES', $atributos, $valores);
    }

    public function alterar(Cliente $cliente)
    {
        $atributos = array_keys($cliente->atributosPreenchidos());
        $valores = array_values($cliente->atributosPreenchidos());
        return $this->atualizar('CLIENTES', $atributos, $valores, $cliente->getId());
    }
    public function excluir($id)
    {
        return $this->deletar('CLIENTES', $id);
    }
}
