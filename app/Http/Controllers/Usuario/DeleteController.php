<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteController
{
    use AsAction;

    public function __invoke(Request $request)
    {
        $id = $request->input('id');
        $usuario = User::find($id);
        $usuario->delete();
        return response()->json(["message"=>"deletado com sucesso!"],202);
    }
}
