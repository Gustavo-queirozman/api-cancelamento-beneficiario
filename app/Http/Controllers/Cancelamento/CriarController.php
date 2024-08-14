<?php

namespace App\Http\Controllers\Cancelamento;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmaCancelamentoBeneficiario;
use App\Models\Beneficiario;
use App\Models\Cancelamento;
use App\Models\CopiaEmail;
use App\Models\TermoCancelamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Str;
use Carbon\Carbon;
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
        $idTermoCancelamento = TermoCancelamento::where('situacao', 1)->pluck('id')[0];

        $nomeArquivo = TermoCancelamento::where('situacao', 1)->pluck('caminho_termo')[0];
        $caminhoArquivo = "C://xampp2//htdocs//api-cancelamento//public//storage//termosCancelamento//$nomeArquivo";
        $html = file_get_contents($caminhoArquivo);

        $emailsCopia =CopiaEmail::where('situacao', 1)->pluck('email');
        $cancelamento = $request->all();
        $cancelamento['users_id'] = Auth::user()->id;
        $cancelamento['termos_cancelamento_id'] =  $idTermoCancelamento;
        $cancelamento['protocolo'] = Carbon::now()->format('Ymdisu');
        $cancelamento = Cancelamento::create($cancelamento);

        foreach ($beneficiarios as $beneficiario) {

            $beneficiario = array_merge(json_decode(json_encode($beneficiario), true), array('cancelamentos_id' => $cancelamento->id));
            $teste = new Beneficiario;
            $teste->insertBeneficiario($beneficiario);
        }

        // Enviar e-mail com cópia (CC)
        Mail::to($request->input('email'))
        ->cc($emailsCopia)
        ->send(new ConfirmaCancelamentoBeneficiario($html));

        return response()->json([
            "message" => "Cancelado com sucesso!"
        ], 202);
    }
}
