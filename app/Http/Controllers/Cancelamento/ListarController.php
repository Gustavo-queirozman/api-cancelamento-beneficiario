<?php

namespace App\Http\Controllers\Cancelamento;

use App\Http\Controllers\Controller;
use App\Models\Cancelamento;
use Lorisleiva\Actions\Concerns\AsAction;

class ListarController
{
    use AsAction;

    public function __invoke()
    {
        $cancelamentos = Cancelamento::all();
        return response()->json([
            'cancelamentos' => $cancelamentos
        ]);
    }
}
