<?php

namespace App\Models\Dao;

use App\Models\Contexto;
use App\Models\Cliente;
use PDO;

class ClienteDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('clientes');
    }

    public function listarClientesAtivos()
    {
        return $this->listar('clientes', "WHERE  ativo = '1' ");
    }

    public function obterPorid($id)
    {
        return $this->listar('clientes', "WHERE id = ?", [$id]);
    }

    public function autenticar($cliente)
    {
        return $this->listar("clientes", "WHERE email = '" . $cliente . "' OR cpf = '" . $cliente . "'");
    }

    public function obterUltimoRegistro($campo)
    {
        return $this->listarUltimoRegistro('Cliente', $campo);
    }

    public function validarDados($campo, $valor, $id = null)
    {
        $sql = "SELECT COUNT(*) AS total FROM clientes WHERE $campo = ?";
        $params = [$valor];

        if ($id) {
            $sql .= " AND id <> ?";
            $params[] = $id;
        }

        $stmt = $this->executarConsulta($sql, $params);
        $dados = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $dados['total'] > 0;
    }

    public function adicionar(Cliente $cliente)
    {
        $atributos = array_keys($cliente->atributosPreenchidos());
        $valores = array_values($cliente->atributosPreenchidos());
        return $this->inserir('clientes', $atributos, $valores);
    }

    public function alterar(Cliente $cliente)
    {
        $atributos = array_keys($cliente->atributosPreenchidos());
        $valores = array_values($cliente->atributosPreenchidos());

        return $this->atualizar('clientes', $atributos, $valores, $cliente->getid());
    }

    public function excluir($id)
    {
        return $this->deletar('clientes', $id);
    }
}
