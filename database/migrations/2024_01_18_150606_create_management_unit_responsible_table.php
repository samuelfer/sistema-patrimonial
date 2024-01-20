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
        Schema::create('management_unit_responsibles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\People::class)->onDelete('CASCADE');
            $table->foreignIdFor(\App\Models\ManagementUnit::class)->onDelete('CASCADE');
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->foreignIdFor(\App\Models\Situation::class)->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('management_unit_responsible');
    }
};
