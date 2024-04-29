<?php

namespace App\Http\Controllers\Configuracao\CopiaEmail;

use App\Http\Controllers\Controller;
use App\Models\CopiaEmail;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class ExcluirController
{
    use AsAction;

    public function __invoke(Request $request, $id)
    {
        $copiaEmail = CopiaEmail::find($id);
        $copiaEmail->delete();
        return response()->json(["message"=>"deletado com sucesso!"],202);
    }
}
