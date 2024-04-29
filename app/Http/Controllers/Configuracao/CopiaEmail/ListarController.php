<?php

namespace App\Http\Controllers\Configuracao\CopiaEmail;

use App\Http\Controllers\Controller;
use App\Models\CopiaEmail;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class ListarController
{
    use AsAction;

    public function __invoke()
    {
        $copiasEmail = CopiaEmail::all();
        return response()->json([
            "copiasEmail" => $copiasEmail
        ]);
    }
}
