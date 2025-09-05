<?php

namespace App\Configurations;

class Formater
{
    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function converterMoeda(float $var): string
    {
        return number_format($var, 2, ',', '.');
    }

    public function converterMoedaBd(string $var): float
    {
        $var = str_replace('.', '', $var);
        $var = str_replace(',', '.', $var);
        return (float) $var;
    }

    public function formataTextoLow(string $var): string
    {
        return strtolower($var);
    }

    public function formataTextoCap(string $var): string
    {
        return ucwords(strtolower($var));
    }

    public function formataTextoUpp(string $var): string
    {
        return strtoupper(strtolower($var));
    }

    public function formatarDataTime(string $data): string
    {
        return date('d-m-Y H:i:s', strtotime($data));
    }

    public function formatarData(string $data): string
    {
        return date('d/m/Y', strtotime($data));
    }

    public function retornaHora(): string
    {
        return date('H:i');
    }

    public function retornaData(): string
    {
        return date('d/m/Y');
    }

    public function retornaDataHora(): string
    {
        return date('d-m-Y H:i:s');
    }

    public function QuebraDeLinha(string $string): string
    {
        return str_replace('.', '.<br>', $string);
    }

    public function zeroEsquerda(int $num, int $qtde, string $char = '0'): string
    {
        return str_pad($num, $qtde, $char, STR_PAD_LEFT);
    }

    public function formataCpf(string $valor): string
    {
        return str_replace(str_replace($valor, '.', ''), '-', '');
    }
}
