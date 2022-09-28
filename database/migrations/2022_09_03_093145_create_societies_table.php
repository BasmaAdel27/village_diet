<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocietiesTable extends Migration
{
    public function up()
    {
        Schema::create('societies', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->timestamp('date_from')->nullable();

            $table->foreignId('trainer_id')->nullable()->nullOnDelete(); // on users
            $table->timestamps();
        });

        Schema::create('society_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('title');

            $table->unique(['society_id', 'locale']);
            $table->foreignId('society_id')->constrained('societies')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('society_translations');
        Schema::dropIfExists('societies');
    }
}
