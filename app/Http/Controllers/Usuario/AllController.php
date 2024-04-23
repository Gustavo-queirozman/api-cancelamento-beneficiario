<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class AllController extends Controller
{
    use AsAction;

    public function __invoke()
    {
        $usuarios = User::all()->get('id');
        return response()->json([
            "usuarios" => $usuarios
        ],202);
    }
}
