<?php

namespace App\Http\Controllers\Solicitacao\Beneficiario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Beneficiario;

class ListarController
{
    use AsAction;

    public function __invoke(Request $request)
    {
        $beneficiarios = new Beneficiario;
        $beneficiarios = $beneficiarios->selectBeneficiarios($request->input('codigoCarteirinha'));

        return response()->json([
            'beneficiarios'=> $beneficiarios
        ]);
    }
}
