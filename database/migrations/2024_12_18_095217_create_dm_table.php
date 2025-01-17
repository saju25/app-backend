<?php

// migration file: database/migrations/xxxx_xx_xx_create_dm_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmTable extends Migration
{
    public function up()
    {
        Schema::create('dm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key for user_id
            $table->string('dm_name');
            $table->string('dm_address');
            $table->string('dm_phone')->unique();
            $table->string('dm_email')->unique();
            $table->string('face_photo');
            $table->string('id_card');
            $table->string('pdf_contract');
            $table->boolean('is_approved')->default(false); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dm');
    }
}
