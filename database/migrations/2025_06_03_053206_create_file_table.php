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
        Schema::create('tb_files', function (Blueprint $table) {
            $table->uuid('pk_file_id')->primary();

            $table->uuid('fileable_id');
            $table->string('fileable_type');

            $table->string('str_path_archivo');
            $table->string('str_categoria_archivo');
            $table->string('str_nombre_archivo');
            
            $table->enum('str_status',['Activo', 'Inactivo', 'En Revision', 'Necesita Actualizacion'])->default('En Revision');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
