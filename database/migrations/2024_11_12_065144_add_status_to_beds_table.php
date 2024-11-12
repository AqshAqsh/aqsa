<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('beds', function (Blueprint $table) {
        $table->string('status')->default('available'); // Adjust as needed
    });
}

public function down()
{
    Schema::table('beds', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
}
