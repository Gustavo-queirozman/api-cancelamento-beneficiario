<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Beneficiario extends Model
{
    use HasFactory;

    public function selectDependentes($codigoCarteirinha){
        $dependentes = DB::select("select Pessoa.Nome,
        Beneficiario.Codigo,
        Pessoa.Cnp,
        CASE
            WHEN (SELECT AutoId FROM BENEFICIARIO WHERE Beneficiario.Codigo = '$codigoCarteirinha') = Beneficiario.AutoId THEN 'true'
            WHEN (SELECT AutoId FROM BENEFICIARIO WHERE Beneficiario.Codigo = '$codigoCarteirinha') != Beneficiario.AutoId THEN 'falso'
        END AS 'Titular'
        from Beneficiario
        INNER JOIN Pessoa ON Pessoa.AutoId = Beneficiario.Pessoa
        WHERE Beneficiario.Titular = (SELECT AutoId FROM BENEFICIARIO WHERE Beneficiario.Codigo = '$codigoCarteirinha')");
        return $dependentes;
    }
}
