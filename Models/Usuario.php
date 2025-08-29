<?php 
namespace App\Models;

class Usuario
{
    private $id;
    private $nome;
    private $usuario;
    private $senha;
    private $perfil;
    private $email;
    private $imagem;
    private $data_cadastro;
    private $ativo;

    public function __construct($id = null, $nome = null, $usuario = null, $senha = null, $email = null, $imagem = null, $ativo = null, $data_cadastro = null)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->id = $id;
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->perfil = [];
        $this->email = $email;
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

     // Método mágico __set
     public function __set($chave, $valor)
     {
         if (property_exists($this, $chave)) {
             $this->$chave = $valor;
         }
     }
# este método converte o objeto em um array associativo, onde as chaves são os nomes dos atributos e os valores são os valores dos atributos.
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'usuario' => $this->usuario,
            'senha' => $this->senha,
            'perfil'=> $this->perfil,
            'email' => $this->email,
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