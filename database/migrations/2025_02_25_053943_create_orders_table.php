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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('unique_order_id')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->double('total_amount')->nullable();
            $table->enum('status', ['processing', 'completed', 'cancelled'])->default('processing');
            $table->text('checkout_url')->nullable();
            $table->string('payment_method')->nullable();
            $table->double('shipping_fee')->nullable(); 
            $table->double('discount')->nullable(); 
            $table->boolean('is_first_order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
