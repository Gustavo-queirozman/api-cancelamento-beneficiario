<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermoCancelamento extends Model
{
    use HasFactory;

    protected $table = 'termos_de_cancelamento';

    protected $fillable = [
        'caminho_termo',
        'users_id',
        'situacao'
    ];

    public $timestamps = true;
}
