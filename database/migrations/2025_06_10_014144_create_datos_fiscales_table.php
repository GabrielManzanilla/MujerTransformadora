<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //
    public function up(): void
    {
        Schema::create('tb_datos_fiscales', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('fk_user')->index()->constrained('users')->onDelete('cascade');

            $table->string('str_regimen')->comment('Régimen fiscal del contribuyente');
            $table->string('str_actividad_economica')->comment('Actividad económica del contribuyente');
            $table->string('str_nombre_comercial')->comment('Nombre comercial del negocio');
            $table->integer('int_numero_empleados')->comment('Número de empleados del negocio');
            $table->string('str_razon_social')->comment('Razón social del contribuyente');
            $table->string('str_clave_imss')->comment('Clave del IMSS del contribuyente');
            $table->string('str_clave_impi')->comment('Clave del IMPI del contribuyente');
            $table->string('str_clave_affy')->comment('Clave de la AFFY del contribuyente');
            $table->string('str_clave_sat')->comment('Clave del SAT del contribuyente');
            $table->string('str_clave_cif')->comment('Clave del CIF del contribuyente');

            $table->enum('str_status', ['Activo', 'Inactivo', 'En Revision', 'Necesita Actualizacion'])
                ->default('En Revision');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_datos_fiscales');
    }
};
