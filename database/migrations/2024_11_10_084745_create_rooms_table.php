<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); 
            $table->string('room_no')->unique(); 
            $table->foreignId('room_category_id')->constrained('room_categories')->onDelete('cascade'); 
            $table->foreignId('block_id')->constrained('blocks')->onDelete('cascade'); 
            $table->decimal('room_charge', 8, 2);
            $table->string('description')->nullable(); 
            $table->integer('number_of_members')->nullable()->default(0);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms'); // Drop the rooms table if it exists
    }
}