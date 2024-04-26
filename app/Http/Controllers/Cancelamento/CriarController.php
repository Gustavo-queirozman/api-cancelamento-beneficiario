<?php

namespace App\Http\Controllers\Cancelamento;

use App\Http\Controllers\Controller;
use App\Models\Beneficiario;
use App\Models\Cancelamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Str;

class CriarController
{
    use AsAction;

    public function __invoke(Request $request)
    {
        $codigosCarteirinha = [];
        foreach ($request->all() as $chave => $valor) {
            if (Str::contains($chave, "carteirinha")) {
                array_push($codigosCarteirinha, $valor);
            }
        }

        $beneficiarios = new Beneficiario();
        $beneficiarios = $beneficiarios->selectBeneficiariosAutoId(implode(", ", $codigosCarteirinha));


        DB::setDefaultConnection('Cancelamento');
        $cancelamento = $request->all();
        $cancelamento['users_id'] = Auth::user()->id;

        $cancelamento = Cancelamento::create($cancelamento);

        foreach ($beneficiarios as $beneficiario) {

            $beneficiario = array_merge(json_decode(json_encode($beneficiario), true), array('cancelamentos_id' => $cancelamento->id));
            $teste = new Beneficiario;
            $teste->insertBeneficiario($beneficiario);
        }

        return response()->json([
            "message" => "Cancelado com sucesso!"
        ], 202);
    }
}
