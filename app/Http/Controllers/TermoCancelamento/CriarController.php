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

    public function __invoke(Request $request)
    {
        DB::setDefaultConnection('Cancelamento');
        ob_start();
        $caminhoParaSalvarArquivo = "storage/termosCancelamento/".Carbon::now()->format('YmdHmsv').".html";
        file_put_contents($caminhoParaSalvarArquivo,$request->input('html'));
        TermoCancelamento::insert([
            'caminho_termo' => $caminhoParaSalvarArquivo,
            'users_id' => Auth::user()->id
        ]);
    }
}
