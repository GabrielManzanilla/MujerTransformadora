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
        Schema::create('tb_productos', function (Blueprint $table) {
            $table->uuid('pk_producto')->primary();
            $table->foreignUuid('fk_dato_fiscal')
                ->references('pk_dato_fiscal')
                ->on('tb_datos_fiscales')
                ->onDelete('cascade');
            $table->string('str_nombre');
            $table->text('str_descripcion');
            $table->integer('int_produccion_mensual');
            $table->decimal('double_ventas_mensuales', 10, 2);
            $table->decimal('double_ventas_anuales', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_productos');
    }
};
