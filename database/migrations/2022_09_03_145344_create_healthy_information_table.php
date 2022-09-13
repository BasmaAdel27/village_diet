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
            $table->string('sleep_hours')->nullable();
            $table->string('daily_cup_count')->nullable();
            $table->string('walk_duration')->nullable();
            $table->string('weight')->nullable();
            $table->foreignId('subscription_id')->nullable()->constrained('subscriptions')->nullOnDelete();
            $table->foreignId('day_id')->nullable()->constrained('days')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('healthy_information');
    }
}
