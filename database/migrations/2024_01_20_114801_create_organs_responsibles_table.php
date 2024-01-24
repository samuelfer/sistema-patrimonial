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
        Schema::create('organs_responsibles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\People::class)->onDelete('CASCADE');
            $table->foreignIdFor(\App\Models\Situation::class)->onDelete('CASCADE');
            $table->foreignIdFor(\App\Models\Organ::class)->onDelete('CASCADE');
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organs_responsibles');
    }
};
