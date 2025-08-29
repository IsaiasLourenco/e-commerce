<?php

namespace App\Models;

class Usuario
{
    private $id;
    private $nome;
    private $usuario;
    private $cpf;
    private $data_nascimento;
    private $senha;
    private $perfil;
    private $email;
    private $cep;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $uf;
    private $imagem;
    private $ativo;
    private $data_cadastro;

    public function __construct(
        $id = null,
        $nome = null,
        $usuario = null,
        $cpf = null,
        $data_nascimento = null,
        $senha = null,
        $email = null,
        $cep = null,
        $logradouro = null,
        $numero = null,
        $bairro = null,
        $cidade = null,
        $uf = null,
        $imagem = null,
        $ativo = null,
        $data_cadastro = null
    ) {
        date_default_timezone_set('America/Sao_Paulo');
        $this->id = $id;
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->cpf = $cpf;
        $this->data_nascimento = $data_nascimento;
        $this->senha = $senha;
        $this->perfil = null;
        $this->email = $email;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->imagem = $imagem;
        $this->ativo = $ativo;
        $this->data_cadastro = $data_cadastro ?? date('Y-m-d');
    }

    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
    {
        $this->id = $id;
    }

    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    // Método mágico __set
    public function __set($chave, $valor)
    {
        $this->$chave = $valor;
    }

    public function __get($chave)
    {
        if (property_exists($this, $chave)) {
            return $this->$chave;
        }
    }

    # este método converte o objeto em um array associativo, onde as chaves são os nomes dos atributos e os valores são os valores dos atributos.
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'usuario' => $this->usuario,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento,
            'senha' => $this->senha,
            'perfil' => $this->perfil,
            'email' => $this->email,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'uf' => $this->uf,
            'imagem' => $this->imagem,
            'data_cadastro' => $this->data_cadastro,
            'ativo' => $this->ativo,
        ];
    }

    public function atributosPreenchidos()
    {
        # Utilizando um fn() funcão anonima ou arrow function (funçao baseada em setas)
        # uma arrow function retorna em uma mesma linha um valor validado, no caso retornara os atributos que vierem preenchidos
        return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
    }
}
