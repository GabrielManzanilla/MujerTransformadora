<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::table('tb_datos_fiscales', function (Blueprint $table) {
			$table->dropForeign(['fk_user']);
			$table->foreign('fk_user')->references('pk_perfil_id')->on('tb_perfiles')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('tb_datos_fiscales', function (Blueprint $table) {
			$table->dropForeign(['fk_user']);
			$table->foreign('fk_user')->references('id')->on('users')->onDelete('cascade');
		});
	}
};
