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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'admin'])->nullable()->change();
            $table->timestamp('email_verified_at')->nullable()->change();
            $table->string('password')->nullable()->change();
            $table->rememberToken()->nullable()->change();
            $table->timestamp('created_at')->nullable()->change();
            $table->timestamp('updated_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'admin'])->default('user')->change();
            $table->timestamp('email_verified_at')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
            $table->rememberToken()->nullable(false)->change();
            $table->timestamp('created_at')->nullable(false)->change();
            $table->timestamp('updated_at')->nullable(false)->change();
        });
    }
};
