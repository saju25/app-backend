<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->text('shop_description')->nullable();
            $table->string('shop_address');
            $table->string('shop_phone')->nullable();
            $table->string('shop_photo')->nullable();
            $table->string('shop_email')->nullable();
            $table->string('shop_review')->nullable();
            $table->string('shop_review_no')->nullable();
            $table->boolean('is_approved')->default(false); 
            $table->foreignId('user_id')->constrained('users');  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
