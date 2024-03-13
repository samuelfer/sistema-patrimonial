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
        Schema::table('management_units', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('organs', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('sectors', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('offices', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('managements', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('peoples', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('management_unit_responsibles', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('organs_responsibles', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('sectors_responsibles', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {}
};
