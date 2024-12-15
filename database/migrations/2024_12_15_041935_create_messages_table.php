<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('message_id'); // Primary key for the message
            $table->foreignId('conversation_id')->constrained('conversations')->onDelete('cascade'); // Link to the conversation
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Link to the sender
            $table->text('message_content'); // Content of the message
            $table->boolean('is_read')->default(false); // Read status
            $table->timestamps(); // Created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
