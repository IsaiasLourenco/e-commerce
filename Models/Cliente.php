<?php

namespace App\Models;

class Cliente
{
    private ?string $id;
    private ?string  $nome;
    private ?string  $cpf;
    private ?string  $datanascimento;
    private ?string  $email;
    private ?string  $senha;
    private ?string  $cep;
    private ?string  $logradouro;
    private ?string  $numero;
    private ?string  $bairro;
    private ?string  $uf;
    private ?string  $cidade;
    private ?string  $imagem;
    private ?string  $datacadastro;
    private ?string  $ativo;
    private ?string  $perfil;

    public function __construct($id = '', $nome = '', $cpf = '', $datanascimento = '', $email = '',  $senha = '',   $cep = '',   $logradouro = '',    $numero = '', $bairro = '', $uf = '', $cidade = '', $imagem = '', $datacadastro = '', $ativo = '', $perfil = '')
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->datanascimento = $datanascimento;
        $this->email = $email;
        $this->senha = $senha;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->uf = $uf;
        $this->cidade = $cidade;
        $this->imagem = $imagem;
        $this->datacadastro = $datacadastro ?: date("Y-m-d H:i:s");
        $this->ativo = $ativo ?: '0';
        $this->perfil = $perfil;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function __set($chave, $valor)
    {
        if (property_exists($this, $chave)) {
            $this->$chave = $valor;
        }
    }    
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'datanascimento' => $this->datanascimento,
            'email' => $this->email,
            'senha' => $this->senha,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'uf' => $this->uf,
            'cidade' => $this->cidade,
            'imagem' => $this->imagem,
            'datacadastro' => $this->datacadastro,
            'ativo' => $this->ativo,
            'perfil' => $this->perfil,
        ];
    }

    public function atributosPreenchidos()
    {
        return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
    }
}
