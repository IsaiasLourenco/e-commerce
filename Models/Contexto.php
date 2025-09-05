<?php
declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;
use PDOStatement;
use Dotenv\Dotenv;

class Contexto
{
    private static ?PDO $conexao = null;

    private function __construct() {}

    protected static function getConexao(): PDO
    {
        if (self::$conexao === null) {
            // Carrega o .env
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->safeLoad(); // safeLoad para não quebrar se .env estiver ausente

            $host = $_ENV['DB_HOST'] ?? 'localhost';
            $db   = $_ENV['DB_DATABASE'] ?? 'e-commerce';
            $user = $_ENV['DB_USERNAME'] ?? 'root';
            $pass = $_ENV['DB_PASSWORD'] ?? '';

            $dsn = "mysql:host={$host};dbname={$db};charset=utf8";

            try {
                self::$conexao = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco: " . $e->getMessage());
            }
        }

        return self::$conexao;
    }

    public function iniciarTransacao(): void
    {
        self::getConexao()->beginTransaction();
    }

    public function confirmarTransacao(): void
    {
        self::getConexao()->commit();
    }

    public function reverterTransacao(): void
    {
        self::getConexao()->rollBack();
    }

    protected static function closeConexao(): void
    {
        self::$conexao = null;
    }

    protected function executarConsulta(string $sql, array $params = []): PDOStatement
    {
        $stmt = self::getConexao()->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        $stmt->execute();
        return $stmt;
    }

    protected function listar(string $tabela, string $condicao = "", array $params = []): array
    {
        $sql = "SELECT * FROM {$tabela} {$condicao} ORDER BY id DESC";
        $stmt = $this->executarConsulta($sql, $params);
        return $stmt->fetchAll();
    }

    protected function listarUltimoRegistro(string $tabela, string $campo, string $condicao = "", array $params = []): array
    {
        $sql = "SELECT MAX({$campo}) AS ULTIMOVALOR FROM {$tabela} {$condicao} ORDER BY id DESC";
        $stmt = $this->executarConsulta($sql, $params);
        return $stmt->fetchAll();
    }

    protected function inserir(string $tabela, array $atributos, array $valores): int
    {
        $placeholders = implode(',', array_fill(0, count($valores), '?'));
        $sql = "INSERT INTO {$tabela} (" . implode(',', $atributos) . ") VALUES ({$placeholders})";
        $this->executarConsulta($sql, $valores);
        return (int)self::getConexao()->lastInsertId();
    }

    protected function atualizar(string $tabela, array $atributos, array $valores, int $id): int
    {
        $set = implode(',', array_map(fn($attr) => "{$attr} = ?", $atributos));
        $sql = "UPDATE {$tabela} SET {$set} WHERE id = ?";
        $stmt = $this->executarConsulta($sql, array_merge($valores, [$id]));
        return $stmt->rowCount();
    }

    protected function deletar(string $tabela, int $id): int
    {
        $sql = "DELETE FROM {$tabela} WHERE id = ? LIMIT 1";
        $stmt = $this->executarConsulta($sql, [$id]);
        return $stmt->rowCount();
    }
}
