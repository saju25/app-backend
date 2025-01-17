<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_type');
            $table->string('product_brand_name');
            $table->text('product_description')->nullable();
            $table->decimal('mrp_price_of_piece', 8, 2);  
            $table->decimal('best_price_of_piece', 8, 2); 
            $table->string('Num_of_piece_one_strip'); 
            $table->string('Num_of_strip_one_pack'); 
            $table->integer('stock_quantity')->default(0);  
            $table->string('product_photo')->nullable(); 
            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
