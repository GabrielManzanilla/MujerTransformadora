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
        Schema::create('tb_domicilios', function (Blueprint $table) {
            $table->uuid('pk_domicilio')->primary();
            $table->foreignUuid('fk_user')->constrained('users')->onDelete('cascade');
            $table->string('str_direccion');
            $table->string('str_estado');
            $table->string('str_municipio');
            $table->string('str_localidad');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_domicilios');
    }
};
