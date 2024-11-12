

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('user_id'); // Define user_id as string to match users table
            $table->string('email'); // Store the user's email
            $table->text('message'); // Feedback message
            $table->enum('status', ['pending', 'reviewed', 'resolved'])->default('pending');
            $table->timestamps();

            // Foreign key constraint for user_id
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); // Ensure this matches the user_id in users
        });
    }

    public function down()
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop the foreign key constraint for user_id
        });
        Schema::dropIfExists('feedbacks'); // Drop the feedbacks table
    }
}
