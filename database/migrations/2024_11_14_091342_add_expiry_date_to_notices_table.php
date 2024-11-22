<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpiryDateToNoticesTable extends Migration
{
    public function up()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->dateTime('expiry_date')->nullable()->after('date');
        });
    }

    public function down()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn('expiry_date');
        });
    }
}
