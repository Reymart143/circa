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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->time('end_time')->nullable();
            $table->double('price',10,2)->nullable(); 
            $table->time('start_time')->nullable();
            $table->integer('status')->default(0);
            $table->string('category')->nullable();
             $table->string('image');
             $table->string('description')->nullable();
             
            $table->string('discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
