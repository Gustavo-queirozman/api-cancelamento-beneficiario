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

    private $copiaEmail;

    public function __invoke(Request $dadosDoFormulario, $id)
    {
        $this->validaDados($dadosDoFormulario);

        if (!$this->pesquisaConfiguracaoCopiaEmail($id)) {
            return response()->json([
                "error" => "Cópia de email não encontrada."
            ], 404);
        }

        try{
            $this->editaConfiguracaoCopiaEmailNoBancoDeDados($dadosDoFormulario);
            return response()->json([
                "message" => "Configuração editada com sucesso!"
            ]);
        }catch(\Exception $error){
            return response()->json([
                "error" => $error
            ]);
        }
    }

    private function validaDados($dadosDoFormulario){
        return $dadosDoFormulario->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:copias_de_email|max:256',
            'situacao' => 'required|integer|between:0,1'
        ]);
    }

    private function pesquisaConfiguracaoCopiaEmail($id){
        $this->copiaEmail = CopiaEmail::find($id);
    }

    private function editaConfiguracaoCopiaEmailNoBancoDeDados($dadosDoFormulario){
        $this->copiaEmail->nome = $dadosDoFormulario->input('nome');
        $this->copiaEmail->email = $dadosDoFormulario->input('email');
        $this->copiaEmail->situacao = $dadosDoFormulario->input('situacao');
        $this->copiaEmail->users_id = Auth::user()->id;
        $this->copiaEmail->save();
    }
}
