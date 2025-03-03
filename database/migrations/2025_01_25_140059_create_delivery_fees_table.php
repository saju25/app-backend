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
        Schema::create('delivery_fees', function (Blueprint $table) {
            $table->id();
            $table->decimal('dayfee', 8, 0)->nullable(); 
            $table->decimal('addi_dayfee', 8, 0)->nullable(); 
            $table->decimal('nightfee', 8, 0)->nullable(); 
            $table->decimal('addi_nightfee', 8, 0)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_fees');
    }
};
