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
            $table->id(); // Auto-incrementing ID
            $table->string('room_no')->unique(); // Unique room number
            $table->foreignId('room_category_id')->constrained('room_categories')->onDelete('cascade'); // Foreign key to room categories
            $table->foreignId('block_id')->constrained('blocks')->onDelete('cascade'); // Foreign key to blocks
            $table->decimal('room_charge', 8, 2); // Room charge
            $table->string('description')->nullable(); // Optional description
            $table->integer('number_of_members')->nullable()->default(0); // Optional number of members
            $table->timestamps(); // Created at and updated at timestamps
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