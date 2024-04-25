<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Beneficiario extends Model
{
    use HasFactory;

    public function selectBeneficiarios($codigoCarteirinha){
        Db::setDefaultConnection('Cardio');
        return DB::select("select Pessoa.Nome,
        Beneficiario.Codigo,
        Pessoa.Cnp,
        CASE
            WHEN (SELECT AutoId FROM BENEFICIARIO WHERE Beneficiario.Codigo = '2267004000193004') = Beneficiario.AutoId THEN 'true'
            WHEN (SELECT AutoId FROM BENEFICIARIO WHERE Beneficiario.Codigo = '2267004000193004') != Beneficiario.AutoId THEN 'falso'
        END AS 'Titular'
        from Beneficiario
        INNER JOIN Pessoa ON Pessoa.AutoId = Beneficiario.Pessoa
        WHERE Beneficiario.Titular = (SELECT AutoId FROM BENEFICIARIO WHERE Beneficiario.Codigo = '2267004000193004')");
    }
}
