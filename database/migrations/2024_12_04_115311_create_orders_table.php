<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for the order
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table (if exists)
            $table->integer('shop_id')->nullable();
            $table->string('delivery_address')->nullable(); 
            $table->string('phone')->nullable(); 
            $table->string('total')->nullable(); 
            $table->string('driver_id')->nullable();
             $table->string('status')->default('En Attente');
            $table->string('payment')->default('non rémunéré');
            $table->string('paymentid')->nullable(); 
            $table->string('prescription_photo')->nullable();
            $table->decimal('latitude', 10, 7)->nullable(); // Latitude for the location
            $table->decimal('longitude', 10, 7)->nullable(); // Longitude for the location
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
