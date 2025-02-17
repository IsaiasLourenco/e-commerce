<?php
# Classe Contexto: Refatorada para melhor clareza e reutilização
namespace App\Models;

use PDO;
use PDOException;

class Contexto
{
    private static $conexao;

    protected static function getConexao()
    {
        if (self::$conexao === null) {
            $inf = "mysql:host=localhost;dbname=ar3-pdv";
            try {
                self::$conexao = new PDO($inf, "root", "", [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco: " . $e->getMessage());
            }
        }
        return self::$conexao;
    }

    protected static function closeConexao()
    {
        self::$conexao = null;
    }

    protected function executarConsulta($sql, $params = [])
    {
        try {
            $stmt = self::getConexao()->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key + 1, $value);
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            die("Erro na execução da consulta: " . $e->getMessage());
        }
    }

    protected function listar($tabela, $condicao = "", $params = [])
    {
        $sql = "SELECT * FROM {$tabela} {$condicao} ORDER BY ID DESC";
        $stmt = $this->executarConsulta($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    protected function inserir($tabela, $atributos, $valores)
    {
        $sql = "INSERT INTO {$tabela} (" . implode(",", $atributos) . ") VALUES (" . implode(",", array_fill(0, count($valores), "?")) . ")";
        $stmt = $this->executarConsulta($sql, $valores);
        return self::getConexao()->lastInsertId();
    }

    protected function atualizar($tabela, $atributos, $valores, $id)
    {/*
        Essa função recebe um parâmetro chamado $attr, que representa cada um dos elementos do array $atributos. Para cada elemento do array $atributos, a função retorna uma string no formato "$attr = ?", onde $attr é o valor de cada item do array.
        Por exemplo, se $attr = "nome", a função retorna a string "nome = ?".
        Se $attr = "idade", a função retorna a string "idade = ?".
        E assim por diante para cada item do array $atributos.
    */
        $set = implode(",", array_map(fn($attr) => "$attr = ?", $atributos));
        $sql = "UPDATE {$tabela} SET {$set} WHERE id = ?";
        $stmt = $this->executarConsulta($sql, array_merge($valores, [$id]));
        return $stmt->rowCount();
    }

    protected function excluir($tabela, $id)
    {
        $sql = "DELETE FROM {$tabela} WHERE id = ? LIMIT 1";
        $stmt = $this->executarConsulta($sql, [$id]);
        return $stmt->rowCount();
    }
}
