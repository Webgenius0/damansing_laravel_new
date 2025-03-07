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
        Schema::create('price_calculations', function (Blueprint $table) {
            $table->id();
            $table->integer('dog_weight')->nullable();
            
            $table->enum('gender' ,['male','female'])->default('male');
            $table->enum('activity_level', ['moderate', 'high'])->default('moderate');
            $table->string('calories');
            $table->decimal('price', 8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_calculations');
    }
};
