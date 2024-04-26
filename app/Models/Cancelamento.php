<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cancelamento extends Model
{
    use HasFactory;

    protected $table = "cancelamentos";

    protected $fillable = [
        'protocolo',
        'contrato',
        'motivo',
        'situacao_cancelamento',
        'email',
        'aceitou_termo_cancelamento',
        'ddd',
        'telefone',
        'observacao',
        'users_id',
        'termos_cancelamento_id',
        'tipos_de_atendimento_id'
    ];
}
