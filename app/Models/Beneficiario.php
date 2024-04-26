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
        return DB::select("select Pessoa.Nome as nome,
        Beneficiario.Codigo as 'codigoCarteirinha',
        Pessoa.Cnp as cnp,
        CASE
            WHEN (SELECT AutoId FROM BENEFICIARIO WHERE Beneficiario.Codigo = '$codigoCarteirinha') = Beneficiario.AutoId THEN 'verdadeiro'
            WHEN (SELECT AutoId FROM BENEFICIARIO WHERE Beneficiario.Codigo = '$codigoCarteirinha') != Beneficiario.AutoId THEN 'falso'
        END AS 'titular'
        from Beneficiario
        INNER JOIN Pessoa ON Pessoa.AutoId = Beneficiario.Pessoa
        WHERE Beneficiario.Titular = (SELECT AutoId FROM BENEFICIARIO WHERE Beneficiario.Codigo = '$codigoCarteirinha')");
    }

    public function selectBeneficiariosAutoId($codigosCarteirinha){
        DB::setDefaultConnection('Cardio');
        return DB::select("SELECT AutoId AS 'autoid_beneficiario' FROM BENEFICIARIO WHERE Beneficiario.Codigo IN ($codigosCarteirinha);");
    }

    public function insertBeneficiario($beneficiario){
        DB::setDefaultConnection('Cancelamento');
        return DB::table('beneficiarios')->insert([
            $beneficiario
        ]);
    }

    protected $fillable = [
        'autoid_beneficiario',
        'cancelamentos_id'
    ];
}
