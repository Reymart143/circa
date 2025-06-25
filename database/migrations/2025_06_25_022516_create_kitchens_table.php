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
        Schema::create('kitchens', function (Blueprint $table) {
            $table->id();
            $table->string('food_id')->nullable();
            $table->string('order_no')->nullable();
            $table->string('table_no')->nullable();
            $table->string('user_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('timer')->nullable();
            $table->integer('kitchen_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchens');
    }
};
