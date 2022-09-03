<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSocietiesTable extends Migration
{
    public function up()
    {
        Schema::create('user_societies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('society_id')->constrained('societies')->cascadeOnDelete();

            $table->unique([
                'user_id',
                'society_id'
            ]);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_societies');
    }
}
