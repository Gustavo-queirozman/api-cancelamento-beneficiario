<?php

namespace App\Http\Controllers\TermoCancelamento;

use App\Http\Controllers\Controller;
use App\Models\TermoCancelamento;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class ListarController
{
    use AsAction;

    public function __invoke()
    {
        $termosCancelamento = TermoCancelamento::all();

        return response()->json([
            "termosCancelamento" => $termosCancelamento
        ]);
    }
}
