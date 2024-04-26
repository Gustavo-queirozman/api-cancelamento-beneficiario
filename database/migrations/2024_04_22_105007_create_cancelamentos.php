<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cancelamentos', function (Blueprint $table) {
            $table->id();
            $table->string('protocolo',50);
            $table->string('contrato',10);
            $table->boolean('situacao_cancelamento');
            $table->string('motivo');
            $table->string('email');
            $table->boolean('aceitou_termo_cancelamento');
            $table->string('ddd',2);
            $table->string('telefone', 9);
            $table->string('observacao');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('termos_cancelamento_id');
            $table->unsignedBigInteger('tipos_de_atendimento_id');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('termos_cancelamento_id')->references('id')->on('termos_de_cancelamento');
            $table->foreign('tipos_de_atendimento_id')->references('id')->on('tipos_de_atendimento');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancelamentos');
    }
};
