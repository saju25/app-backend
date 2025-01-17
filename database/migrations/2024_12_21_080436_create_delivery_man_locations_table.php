<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryManLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_man_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_man_id')->constrained('dm')->onDelete('cascade'); // Reference to the dm table
            $table->decimal('latitude', 10, 7); // Latitude for the location
            $table->decimal('longitude', 10, 7); // Longitude for the location
            $table->boolean('is_avialable')->default(false); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_man_locations');
    }
}
