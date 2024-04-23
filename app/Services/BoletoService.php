<?php

namespace App\Services;

use App\Models\Boleto;
use Carbon\Carbon;
use DateTime;
use OpenBoleto\Banco\Unicred;
use OpenBoleto\Agente;

class BoletoService
{
    public function __construct(public string $cnp, public string $autoId)
    {
        // Nada será feito no construtor agora
    }

    public function criarBoleto()
    {
        $boleto = $this->carregarBoleto($this->cnp, $this->autoId);

        $sacado = new Agente($boleto->nomePessoa, $boleto->cnp, $boleto->rua, $boleto->numero, $boleto->bairro, $boleto->cep, $boleto->cidade, $boleto->uf);
        $cedente = new Agente('Unimed Noroeste de Minas', '41.905.498/0001-19', 'RUA JOSINO VALARES 33 CENTRO', '38600-000', 'Paracatu', 'MG');

        $unicredBoleto = new Unicred([
            // Parâmetros obrigatórios
            'dataVencimento' => new Datetime(Carbon::now()->format('m/d/Y')),
            'sequencial' => substr($boleto->nossoNumero, 0, -1), // Para gerar o nosso número /*6 numeros
            'especieDoc' => 'DM',
            'sacado' => $sacado,
            'cedente' => $cedente,
            'agencia' => 5841, // Até 4 dígitos *4digitos
            'carteira' => 21,
            'conta' => 502348, // Até 8 dígitos *6digitos
            'convenio' => 4, // 4, 6 ou 7 dígitos
            'numeroDocumento' => $boleto->numeroDoDocumento,
            'quantidade' => 1,
            'valor' => $boleto->valorDoDocumento,
            //'moraMulta' => $this->multa,
            //'valorCobrado' => $boleto->valorDoDocumento,

            'descricaoDemonstrativo' => [
                // Até 5
                'Plano de Saúde'
            ],
            'instrucoes' => [
                // Até 8
                'APÓS O VENCIMENTO: JUROS DE 0,033% AO DIA E MULTA DE 2%',
                "NÃO RECEBER APÓS 60 DIAS DE VENCIMENTO <br> Contrato: " . $boleto->contrato . " Competência: " . $boleto->competenciaDeGeracao,
            ],
        ]);

        return $unicredBoleto->getOutput();
    }

    private function carregarBoleto($cnp, $autoId)
    {
        $boleto = new Boleto();
        return $boleto->selectBoleto($cnp, $autoId)[0];
    }
}
