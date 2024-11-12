<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBuildingsAndBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create buildings table
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Building name
            $table->timestamps();
        });

        // Insert a default building
        $buildingId = DB::table('buildings')->insertGetId([
            'name' => 'Default Building', // You can change this to whatever name you want
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create blocks table
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained('buildings')->onDelete('cascade'); // Foreign key to buildings
            $table->string('block_name'); // Name of the block (e.g., A, B, C, D)
            $table->timestamps();
        });

        // Insert default blocks for the newly created building
        DB::table('blocks')->insert([
            ['building_id' => $buildingId, 'block_name' => 'A'],
            ['building_id' => $buildingId, 'block_name' => 'B'],
            ['building_id' => $buildingId, 'block_name' => 'C'],
            ['building_id' => $buildingId, 'block_name' => 'D'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('buildings');
    }
}