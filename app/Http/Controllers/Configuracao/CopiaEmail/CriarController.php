<?php

namespace App\Http\Controllers\Configuracao\CopiaEmail;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CopiaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class CriarController
{
    use AsAction;

    public function __invoke(Request $request)
    {
        $validaDados = $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:copias_de_email|max:256',
            'situacao' => 'required|boolean|max:1'
        ]);

        DB::setDefaultConnection('Cancelamento');

        try {
            $copiaEmail = new CopiaEmail();
            $copiaEmail->fill($validaDados);
            $copiaEmail->users_id = Auth::user()->id;
            $copiaEmail->timestamps = true;
            $copiaEmail->save();

            return response()->json([
                'message' => "Criado com sucesso!"
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage()
            ]);
        }
    }
}
