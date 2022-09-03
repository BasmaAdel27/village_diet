<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->timestamps();
        });


        Schema::create('day_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('title');

            $table->unique(['day_id', 'locale']);
            $table->foreignId('day_id')->constrained('days')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('day_translations');
        Schema::dropIfExists('days');
    }
}
