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
            $table->string('product_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('quantity')->nullable();
            $table->string('transaction_no')->nullable();
            $table->double('total_amount',10,2)->nullable();
            $table->integer('status')->default(0);
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
