<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->foreignId('day_id')->nullable()->constrained('days')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('video_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('title');

            $table->unique(['video_id', 'locale']);
            $table->foreignId('video_id')->constrained('videos')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_translations');
        Schema::dropIfExists('videos');
    }
}
