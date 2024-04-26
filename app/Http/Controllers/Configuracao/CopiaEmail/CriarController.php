<?php

namespace App\Http\Controllers\Configuracao\CopiaEmail;

use App\Http\Controllers\Controller;
use App\Models\CopiaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CriarController
{
    use AsAction;

    public function __invoke(Request $request)
    {
        DB::setDefaultConnection('Cancelamento');
        $configuracaoCopiaEmail = $request->all();
        $configuracaoCopiaEmail['users_id'] = Auth::user()->id;

        CopiaEmail::insert(
            $configuracaoCopiaEmail
        );

        return response()->json([
            'message' => "Criado com sucesso!"
        ]);
    }
}
