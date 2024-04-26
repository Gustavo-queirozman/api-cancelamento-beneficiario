<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopiaEmail extends Model
{
    use HasFactory;

    protected $table = 'copias_de_email';

    protected $fillable = [
        'nome',
        'email',
        'situacao',
        'users_id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
}
