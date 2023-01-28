<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldTrainersTable extends Migration
{
    public function up()
    {
        Schema::create('old_trainers', function (Blueprint $table) {
            $table->id();
            $table->text('trainers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('old_trainers');
    }
}
