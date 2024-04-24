<?php

namespace App\Http\Controllers\Cancelamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class CriarController
{
    use AsAction;

    public function __invoke(Request $request)
    {
        $cancelamento = Cancelamento::create([
            $request->all()
        ]);

        return response()->json([
            "message" => "Cancelamento realizado conforme solicitado"
        ], 202);
    }
}
