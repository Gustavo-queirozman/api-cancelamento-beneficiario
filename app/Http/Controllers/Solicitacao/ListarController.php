<?php

namespace App\Http\Controllers\Solicitacao;

use App\Http\Controllers\Controller;
use App\Models\Beneficiario;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class ListarController
{
    use AsAction;

    public function __invoke(Request $request)
    {
        $beneficiarios = new Beneficiario();
        $dependentes = $beneficiarios->selectDependentes($request->input('codigoCarteirinha'));

        return response()->json([
            'dependentes'=> $dependentes
        ]);
    }
}
