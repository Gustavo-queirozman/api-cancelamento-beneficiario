<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class EditController
{
    use AsAction;

    public function __invoke(Request $request)
    {
        $usuario = User::find($request->input('id'));
        $usuario->name =  $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = $request->input('password');
        $usuario->is_admin = $request->input('is_admin');
        $usuario->blocked  = $request->input('blocked');
        $usuario->save();
        return response()->json([
            "message" => "Usuário editado com sucesso!"
        ]);
    }
}
