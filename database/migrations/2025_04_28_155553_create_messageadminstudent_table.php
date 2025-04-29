<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messageadminstudent', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->string('sender_id'); // Sender ID as a string
            $table->string('receiver_id'); // Receiver ID as a string
            $table->text('message'); // Message content
            $table->boolean('is_read')->default(false); // Read status
            $table->timestamps(); // Timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messageadminstudent');
    }
};
