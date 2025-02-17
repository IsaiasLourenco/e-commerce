<?php

namespace App\Models;
use PDOException;
use PDO;

class UsuarioDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('USUARIO');
    }

    public function obterPorId($id)
    {
        return $this->listar('USUARIO', "WHERE ID = ?", [$id]);
    }

    public function adicionar(Usuario $usuario)
    {
        $atributos = array_keys($usuario->atributosPreenchidos());
        $valores = array_values($usuario->atributosPreenchidos());
        return $this->inserir('USUARIO', $atributos, $valores);
    }

    public function alterar(Usuario $usuario)
    {
        $atributos = array_keys($usuario->atributosPreenchidos());
        $valores = array_values($usuario->atributosPreenchidos());
        return $this->atualizar('USUARIO', $atributos, $valores, $usuario->getId());
    }

    public function deletar($id)
    {
        return $this->excluir('USUARIO', $id);
    }
    // FUNÇÃO RESPONSAVEL POR AUTENTICAR UM USUARIO
    public function autenticarUsuario(string $usuario): ?array
    {
        $sql = "SELECT ID, NOME, IMAGEM, PERFIL, SENHA FROM USUARIO WHERE USUARIO = :usuario";

        try {
            $conexao = self::getConexao();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultado ?: null; // Retorna null caso nenhum resultado seja encontrado
        } catch (PDOException $e) {
            throw new PDOException("Erro ao autenticar o usuário: " . $e->getMessage());
        } 
    }
}