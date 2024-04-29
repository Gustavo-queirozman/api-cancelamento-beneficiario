<?php

namespace App\Http\Controllers\Configuracao\CopiaEmail;

use App\Http\Controllers\Controller;
use App\Models\CopiaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class EditarController
{
    use AsAction;

    public function __invoke(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'situacao' => 'boolean'
        ]);

        $copiaEmail = CopiaEmail::find($id);

        if (!$copiaEmail) {
            return response()->json([
                "error" => "Cópia de email não encontrada."
            ], 404);
        }

        $copiaEmail->nome = $request->input('nome');
        $copiaEmail->email = $request->input('email');
        $copiaEmail->situacao = bcrypt($request->input('situacao'));
        $copiaEmail->users_id = Auth::user()->id;
        $copiaEmail->save();

        return response()->json([
            "message" => "Configuração editada com sucesso!"
        ]);
    }
}
