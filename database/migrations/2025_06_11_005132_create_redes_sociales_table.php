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
        Schema::create('tb_redes_sociales', function (Blueprint $table) {
            $table->uuid('pk_redes_sociales')->primary();
            $table->foreignUuid('fk_dato_fiscal')
                ->references('pk_dato_fiscal')
                ->on('tb_datos_fiscales')
                ->onDelete('cascade');
            $table->string('str_nombre_red_social');
            $table->string('str_perfil_red_social');
            $table->string('str_url_red_social');

            $table->enum('status', ['Por verificar', 'Verificado', 'Rechazado'])
                ->default('por verificar')
                ->comment('Estado de la red social: por verificar, verificado, rechazado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_redes_sociales');
    }
};
