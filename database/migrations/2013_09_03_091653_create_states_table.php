<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::create('state_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained('states')->cascadeOnDelete();
            $table->string('name');

            $table->string('locale')->index();
            $table->unique(['state_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('state_translations');
        Schema::dropIfExists('states');
    }
}
