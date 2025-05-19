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
        //
        Schema::create('tb_perfiles', function (Blueprint $table) {
            $table->uuid('pk_perfil_id')->primary();
            $table->foreignUuid('user_id')->nullable()->index()->constrained('users')->onDelete('cascade');
            $table->string('str_nombre');
            $table->string('str_apellido_paterno');
            $table->string('str_apellido_materno');
            $table->date('dt_fecha_nacimiento');
            $table->string('str_curp');
            $table->string('str_municipio_nacimiento');
            $table->string('str_estado_nacimiento');
            $table->enum('str_sexo', ['Masculino', 'Femenino']);
            $table->boolean('bool_es_mayahablante')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tb_perfiles');
            
    }
};
