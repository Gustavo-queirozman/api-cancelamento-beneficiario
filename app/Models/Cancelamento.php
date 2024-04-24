<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancelamento extends Model
{
    use HasFactory;

    protected $table = "cancelamentos";

    protected $fillable = [
        'motivo',
        'email',
        'aceitou_termo_cancelamento',
        'carteirinha_beneficiario',
        'ddd',
        'telefone',
        'observacao'
    ];
}
