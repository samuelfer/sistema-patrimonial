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
        Schema::create('department_responsible', function (Blueprint $table) {
            $table->id();
            $table->string('observation')->nullable();
            $table->foreignIdFor(\App\Models\People::class)->onDelete('CASCADE');
            $table->foreignIdFor(\App\Models\Management::class)->onDelete('CASCADE');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_responsible');
    }
};
