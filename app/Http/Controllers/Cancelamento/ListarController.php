<?php

namespace App\Http\Controllers\Cancelamento;

use App\Http\Controllers\Controller;
use App\Models\Cancelamento;
use Lorisleiva\Actions\Concerns\AsAction;
use MarvinLabs\DiscordLogger\Logger;

class ListarController
{
    use AsAction;

    public function __invoke()
    {
        try {
            $cancelamentos = Cancelamento::all();
            return response()->json([
                'cancelamentos' => $cancelamentos
            ]);
        } catch (\Exception $error) {
            logs()->emergency("teste", [1,2,3]);
        }
    }
}
