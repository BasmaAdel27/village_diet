<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthyInformationTable extends Migration
{
    public function up()
    {
        Schema::create('healthy_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('sleep_hours');
            $table->integer('daily_cup_count');
            $table->string('weight');
            $table->foreignId('subsciption_id')->nullable()->constrained('subsciptions')->nullOnDelete();
            $table->foreignId('day_id')->nullable()->constrained('days')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('healthy_information');
    }
}
