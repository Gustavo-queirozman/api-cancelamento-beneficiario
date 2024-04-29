<?php

namespace App\Http\Controllers\TermoCancelamento;

use App\Http\Controllers\Controller;
use App\Models\TermoCancelamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CriarController
{
    use AsAction;

    public function __invoke(Request $dadosDoFormulario)
    {
        DB::setDefaultConnection('Cancelamento');
        $nomeDoArquivo = $this->gerarNomeParaArquivo();
        $this->geraArquivoHtml($nomeDoArquivo, $dadosDoFormulario);
        try{
            $this->salvaTermoCancelamentoNoBancoDeDados($nomeDoArquivo);
        }catch(\Exception $error){
            return response()->json([
                "error" => $error
            ]);
        }
    }

    private function gerarNomeParaArquivo(){
        $nomeDoArquivo = Carbon::now()->format('YmdHmsv').".html";
        return"storage/termosCancelamento/$nomeDoArquivo";
    }

    private function geraArquivoHtml($nomeDoArquivo, $request){
        ob_start();
        file_put_contents($nomeDoArquivo,$request->input('html'));
    }

    private function salvaTermoCancelamentoNoBancoDeDados($nomeDoArquivo){
        TermoCancelamento::insert([
            'caminho_termo' => "storage/termosCancelamento/$nomeDoArquivo",
            'users_id' => Auth::user()->id
        ]);
    }
}
