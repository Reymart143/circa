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

            $table->string('food_id')->nullable();
            $table->string('table_no')->nullable();
            $table->string('user_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('flavor')->nullable();
            $table->string('size')->nullable();
            $table->string('order_no')->nullable();
            $table->double('total_price',10,2)->nullable();
            $table->double('customer_amount',10,2)->nullable();
            $table->integer('payment_status')->default(0);
            $table->string('payment_type')->nullable();
            $table->integer('kitchen_status')->default(0);
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
