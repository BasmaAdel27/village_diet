<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->foreignId('day_id')->nullable()->constrained('days')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('meal_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->text('braakfast');
            $table->text('lunch');
            $table->text('dinner');

            $table->unique(['meal_id', 'locale']);
            $table->foreignId('meal_id')->constrained('meals')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_translations');
        Schema::dropIfExists('meals');
    }
}
