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
        Schema::table('sectors', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\ManagementUnit::class)->onDelete('CASCADE');
        });

        Schema::table('offices', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\ManagementUnit::class)->onDelete('CASCADE');
        });

        Schema::table('peoples', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\ManagementUnit::class)->onDelete('CASCADE');
        });

        Schema::table('organs_responsibles', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\ManagementUnit::class)->onDelete('CASCADE');
        });

        Schema::table('sectors_responsibles', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\ManagementUnit::class)->onDelete('CASCADE');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\ManagementUnit::class)->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
