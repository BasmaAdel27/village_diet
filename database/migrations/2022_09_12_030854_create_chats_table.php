<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('trainer_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('citizen_id')->constrained('users')->cascadeOnDelete();
            $table->string('type')->default('Text')->comment('TEXT , IMAGE', 'AUDIO');
            $table->text('message');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });


        Schema::create('admin_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('admin_chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_chat_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->string('type')->default('Text')->comment('TEXT , IMAGE', 'AUDIO');
            $table->text('message');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });


        Schema::create('society_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('society_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->string('type')->default('Text')->comment('TEXT , IMAGE', 'AUDIO');
            $table->text('message');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('admin_chats');
        Schema::dropIfExists('admin_chat_messages');
        Schema::dropIfExists('society_messages');
    }
}
